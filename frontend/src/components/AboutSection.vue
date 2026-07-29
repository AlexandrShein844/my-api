<template>
    <section class="about">

        <div class="container">

            <h2>
                О проекте
            </h2>

            <p class="description">
                Developer Landing API — это fullstack-приложение,
                состоящее из backend на Laravel и frontend на Vue 3.
                Проект демонстрирует взаимодействие клиента с REST API,
                обработку пользовательских обращений и дополнительные
                backend-возможности.
            </p>


            <div class="features">

                <div class="feature-card">
                    <h3>
                        REST API
                    </h3>

                    <p>
                        Реализованы API-эндпоинты,
                        валидация запросов и единый формат ответов.
                    </p>
                </div>


                <div class="feature-card">
                    <h3>
                        AI анализ
                    </h3>

                    <p>
                        Пользовательские сообщения анализируются
                        с помощью AI и получают автоматический ответ.
                    </p>
                </div>


                <div class="feature-card">
                    <h3>
                        Email уведомления
                    </h3>

                    <p>
                        После отправки формы пользователь и владелец
                        получают уведомления на email.
                    </p>
                </div>


                <div class="feature-card">
                    <h3>
                        Метрики
                    </h3>

                    <p>
                        Собирается статистика обращений и отображается
                        в интерфейсе в реальном времени.
                    </p>
                </div>

            </div>

        </div>

    </section>
</template>


<style scoped>

.about{
    padding:80px 0;
}


h2{
    text-align:center;
    font-size:36px;
    margin-bottom:20px;
}


.description{
    max-width:800px;
    margin:0 auto;
    text-align:center;
    color:#4b5563;
    line-height:1.7;
}


.features{

    margin-top:50px;

    display:grid;

    grid-template-columns:
        repeat(auto-fit,minmax(240px,1fr));

    gap:24px;
}


.feature-card{

    background:white;

    padding:30px;

    border-radius:12px;

    box-shadow:
        0 5px 15px rgba(0,0,0,.08);

}


.feature-card h3{

    margin-bottom:12px;

    color:#2563eb;

}


.feature-card p{

    color:#4b5563;

    line-height:1.6;

}


</style>