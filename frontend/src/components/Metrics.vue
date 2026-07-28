<template>
    <div class="container">
        <p v-if="loading">Загрузка...</p>

        <p v-else-if="error" class="error">
            {{ error }}
        </p>

        <div v-else class="metrics-grid">
            <div class="metric-card">
                <h3>Всего отзывов</h3>
                <p>{{ metrics.total_contacts }}</p>
            </div>

            <div class="metric-card">
                <h3>Сегодня</h3>
                <p>{{ metrics.today_contacts }}</p>
            </div>

            <div class="metric-card">
                <h3>Позитивных</h3>
                <p>{{ metrics.sentiment.positive }}</p>
            </div>

            <div class="metric-card">
                <h3>Нейтральных</h3>
                <p>{{ metrics.sentiment.neutral }}</p>
            </div>

            <div class="metric-card">
                <h3>Негативных</h3>
                <p>{{ metrics.sentiment.negative }}</p>
            </div>

            <div class="metric-card">
                <h3>Не определено</h3>
                <p>{{ metrics.sentiment.unknown }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { getMetrics } from "../api/metrics";

const loading = ref(true);
const error = ref("");

const metrics = ref({
    total_contacts: 0,
    today_contacts: 0,
    sentiment: {
        positive: 0,
        neutral: 0,
        negative: 0,
        unknown: 0,
    },
});

async function loadMetrics() {
    try {
        const response = await getMetrics();

        metrics.value = response.data;
    } catch (e) {
        error.value = e.message;
    } finally {
        loading.value = false;
    }
}

onMounted(loadMetrics);
</script>

<style scoped>
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, auto);
    gap: 20px;
    margin-top: 30px;
}

.metric-card {
    padding: 24px;
    border-radius: 12px;
    background: white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    min-width: 80%;
}

.metric-card h3 {
    margin-bottom: 10px;
}

.metric-card p {
    font-size: 32px;
    font-weight: bold;
}

.error {
    color: red;
}
</style>
