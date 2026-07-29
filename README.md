# My API — Developer Landing Backend

## 1. Как запустить проект

### Установка зависимостей

```bash
cd c:/OSPanel/home/my-api
composer install
npm install
```

### Настройка окружения

Скопируйте файл конфигурации:

```bash
copy .env.example .env
```

Затем задайте переменные:

- `APP_URL=http://my-api.local`
- `FRONTEND_URL=http://localhost:3000`
- `OPENAI_API_KEY=ваш_ключ`
- `OPENAI_BASE_URL=https://openrouter.ai/api/v1`
- `OPENAI_MODEL=google/gemini-2.0-flash-exp:free`
- `MAIL_MAILER=log`
- `MAIL_OWNER=your-owner@example.com`
- `MAIL_FROM_ADDRESS=hello@example.com`
- `DB_CONNECTION=sqlite` или другая СУБД

Для SQLite можно создать файл:

```bash
php artisan key:generate
php artisan migrate
```

### Запуск проекта

```bash
php artisan serve
npm run dev
```

Если нужно только backend:

```bash
php artisan serve
```

### Команды

- `composer install` — установка PHP-зависимостей
- `npm install` — установка фронтенд-зависимостей
- `php artisan migrate` — запуск миграций
- `npm run dev` — запуск Vite сервера
- `php artisan test` — запуск тестов
- `php artisan l5-swagger:generate` — генерация OpenAPI спецификации

---

## 2. Стек технологий

### Backend

- Язык: PHP 8.3
- Фреймворк: Laravel 13
- HTTP-роутинг: Laravel routes
- Валидация: FormRequest (`app/Http/Requests/ContactRequest.php`)
- ORM: Eloquent
- OpenAPI/Swagger: `darkaonline/l5-swagger`
- Почта: Laravel Mail (`App\Mail`, `config/mail.php`)

### Frontend

- Vite + Vue
- Tailwind CSS

### AI

- `openai-php/client`
- OpenAI-совместимый провайдер через `OPENAI_BASE_URL`
- Провайдер: OpenRouter — выбран за большой выбор бесплатных моделей и возможность работать с ними напрямую
- Модель: `google/gemini-2.0-flash-exp:free`

---

## 3. Архитектура

### Структура проекта

- `app/Http/Controllers/Api` — контроллеры API
- `app/Http/Requests` — правила валидации
- `app/Services` — бизнес-логика сервиса
  - `AI/AiService.php` — работа с AI
  - `Mail/ContactMailService.php` — отправка писем
  - `MetricsService.php` — агрегирование статистики
- `app/Models/Contact.php` — модель контакта
- `routes/api.php` — API-маршруты
- `storage/logs` — логи приложения
- `storage/api-docs` — OpenAPI спецификация

### Паттерны проектирования

- Слой `Controller -> Service` разделяет HTTP-логику и бизнес-логику
- `FormRequest` отвечает за валидацию и сообщения об ошибках
- `Service` инкапсулирует работу AI, сохранение контакта и отправку почты
- `OpenApi`-аннотации документируют API и позволяют генерировать спецификацию

### Выбор технологий

Laravel выбран за его встроенный DI-контейнер, поддержку middleware, валидацию и лёгкость организации API. OpenAI-пакет выбран за простую интеграцию с AI-провайдером и гибкую настройку базового URL.

---

## 4. Реализация API

### Эндпоинты

#### `POST /api/contact`

Принимает данные формы обратной связи и сохраняет контакт.

Тело запроса:

```json
{
  "name": "Александр",
  "phone": "+79999999999",
  "email": "test@example.com",
  "comment": "Хочу заказать разработку сайта"
}
```

Успешный ответ:

```json
{
  "success": true,
  "message": "Contact request created",
  "data": {
    "id": 1,
    "ai_sentiment": "positive",
    "ai_response": "Спасибо за обращение. Мы скоро свяжемся с вами."
  }
}
```

Валидация:

- `name` — обязательное, строка, до 255 символов
- `phone` — обязательное, строка, до 30 символов
- `email` — обязательное, корректный email
- `comment` — обязательное, строка, до 2000 символов

Ошибки валидации возвращаются с кодом `422`.

#### `GET /api/health`

Проверка доступности сервиса. Возвращает:

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "status": "ok"
  }
}
```

#### `GET /api/metrics`

Возвращает статистику по обращениям и AI-настроению:

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "total_contacts": 10,
    "today_contacts": 2,
    "sentiment": {
      "positive": 4,
      "neutral": 3,
      "negative": 1,
      "unknown": 2
    }
  }
}
```

### Обработка ошибок

- `422` — валидация через `ContactRequest`
- `429` — rate limiting для email и IP
- `500` — внутренние ошибки обрабатываются глобально через `bootstrap/app.php`

---

## 5. AI-интеграция

### Инструменты

- AI-провайдер: OpenAI-совместимый API
- PHP-клиент: `openai-php/client`
- Конфигурация через `config/ai.php`

### Как используется AI

Backend анализирует комментарий и возвращает:

- `sentiment` — одно из `positive`, `neutral`, `negative`, `unknown`
- `response` — короткий дружелюбный ответ пользователю

### Fallback

Если AI недоступен или ключ не задан, сервис не падает. В `AiService` ловится любое исключение, логируется ошибка, и возвращается:

```json
{
  "sentiment": "unknown",
  "response": "Спасибо за обращение. Мы скоро свяжемся с вами."
}
```

### Промпт

Используется системное сообщение:

```
Ты помощник сайта разработчика. Проанализируй сообщение пользователя. Верни только JSON в формате:
{
  "sentiment": "positive|neutral|negative",
  "response": "короткий ответ пользователю"
}

sentiment может быть только positive, neutral или negative.
Ответ пользователю должен быть коротким, вежливым и дружелюбным и только на том языке, на котором написано сообщение.
Если не можешь определить sentiment, верни unknown.
Если не можешь придумать ответ, верни "Спасибо за ваше обращение."
```

---

## 6. Что сделано с помощью AI

### Какие части кода генерировались

- Базовые шаблоны и структура были сгенерированы с помощью AI: `Raptor mini` и ChatGPT
- Код ускорялся за счёт AI, но основная логика адаптирована вручную под проект

### Промпты

- Использован один основной промпт для анализа сообщения и генерации ответа
- Промпты корректируются вручную для контроля формата JSON

### Исправления вручную

- Обработка ошибок AI
- Правильное сохранение `ai_sentiment` и `ai_response`
- Интеграция с базой данных и почтой
- Формат ответа для frontend

---

## 7. Хранение данных

### Логи

- Запросы логируются через `app/Http/Middleware/LogRequests.php`
- Ошибки логируются глобально через `bootstrap/app.php`
- Основной лог-файл: `storage/logs/laravel.log`

### Rate limiting

- IP-лимит через `app/Http/Middleware/ContactRateLimit.php`
- Email-лимит через `ContactService` и `RateLimiter::tooManyAttempts`

### Статистика

- Статистика хранится в таблице `contacts`
- Метрики собираются в `app/Services/MetricsService.php`
- Эндпоинт `/api/metrics` возвращает агрегированные данные по обращениям

---

## Замечания

- `MAIL_MAILER=log` выбран для работы без реальной почтовой службы
- `APP_URL` и `FRONTEND_URL` должны соответствовать настройкам фронтенда и CORS
- OpenAPI спецификация генерируется командой `php artisan l5-swagger:generate`
