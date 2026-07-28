<h1>Новое обращение с сайта</h1>

<p>
Имя: {{ $contact->name }}
</p>

<p>
Email: {{ $contact->email }}
</p>

<p>
Телефон: {{ $contact->phone }}
</p>

<p>
Комментарий:
</p>

<p>
{{ $contact->comment }}
</p>

<hr>

<p>
AI анализ:
</p>

<p>
Тональность:
<strong>
{{ $contact->ai_sentiment }}
</strong>
</p>

<p>
Предварительный ответ:
</p>

<p>
{{ $contact->ai_response }}
</p>