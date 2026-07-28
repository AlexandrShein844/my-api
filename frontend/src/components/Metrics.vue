<script setup>
import { onMounted, ref } from "vue";

import { getMetrics } from "../api/metrics";

const metrics = ref(null);

const error = ref(null);

async function loadMetrics() {
    try {
        const response = await getMetrics();

        metrics.value = response.data;
    } catch (e) {
        error.value = "Не удалось загрузить статистику";
    }
}

onMounted(loadMetrics);
</script>

<template>
    <div v-if="error">
        {{ error }}
    </div>

    <div v-else-if="metrics">
        <p>
            Всего обращений:
            <b>
                {{ metrics.total_contacts }}
            </b>
        </p>

        <p>
            Сегодня:
            <b>
                {{ metrics.today_contacts }}
            </b>
        </p>

        <h3>AI анализ</h3>

        <ul>
            <li>
                Положительные:
                {{ metrics.sentiment.positive }}
            </li>

            <li>
                Нейтральные:
                {{ metrics.sentiment.neutral }}
            </li>

            <li>
                Отрицательные:
                {{ metrics.sentiment.negative }}
            </li>

            <li>
                Неизвестные:
                {{ metrics.sentiment.unknown }}
            </li>
        </ul>
    </div>

    <div v-else>Загрузка...</div>
</template>
