<template>
    <section class="hero">

        <div class="container hero-content">

            <p class="hero-subtitle">
                Test Task
            </p>

            <h1>
                Developer Landing
            </h1>

            <p class="hero-description">
                Backend-приложение на Laravel с frontend на Vue 3.
                Проект демонстрирует REST API, AI-анализ обращений,
                email-уведомления, OpenAPI-документацию и сбор метрик.
            </p>

            <div class="hero-tags">

                <span>Laravel 13</span>
                <span>Vue 3</span>
                <span>REST API</span>
                <span>OpenAPI</span>
                <span>AI</span>
                <span>Email</span>

            </div>

            <a
                href="#contact"
                class="hero-button"
            >
                Связаться
            </a>

        </div>

    </section>
</template>

<style scoped>

.hero{
    background:#b6d8f8;
    padding:120px 0;
}

.hero-content{
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
}

.hero-subtitle{
    color:#2563eb;
    font-weight:600;
    margin-bottom:16px;
    text-transform:uppercase;
    letter-spacing:2px;
}

h1{
    font-size:56px;
    line-height:1.1;
    margin-bottom:24px;
}

.hero-description{
    max-width:700px;
    color:#4b5563;
    line-height:1.7;
    font-size:18px;
}

.hero-tags{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:12px;
    margin:40px 0;
}

.hero-tags span{
    background:white;
    padding:10px 18px;
    border-radius:999px;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    font-size:14px;
}

.hero-button{
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:14px 32px;
    border-radius:8px;
    transition:.2s;
}

.hero-button:hover{
    background:#1d4ed8;
}

</style>