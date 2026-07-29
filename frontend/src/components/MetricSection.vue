<template>
    <section id="metrics" class="metrics">
        <div class="container">
            <h2>Статистика</h2>

            <p class="description">
                Статистика всех отзывов. Здесь вы можете увидеть общее количество отзывов, количество отзывов за сегодня, а также честное распределение отзывов по типам. 
            </p>

            <Metrics />
        </div>
    </section>
</template>

<script setup>
import Metrics from "./Metrics.vue";
</script>

<style scoped>
.metrics {
    padding: 80px;
}

h2 {
    text-align: center;
    font-size: 36px;
    margin-bottom: 20px;
}

.description {
    max-width: 700px;

    margin: 0 auto;

    text-align: center;

    color: #4b5563;

    line-height: 1.7;
}

.form-wrapper {
    max-width: 600px;

    margin: 50px auto 0;

    background: white;

    padding: 40px;

    border-radius: 16px;

    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
}
</style>
