<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" placeholder="Имя" />

        <input v-model="form.phone" placeholder="Телефон" />

        <input v-model="form.email" placeholder="Email" />

        <textarea v-model="form.comment" placeholder="Комментарий" />

        <button :disabled="loading">
            {{ loading ? "Отправка..." : "Отправить" }}
        </button>

        <p v-if="message">
            {{ message }}
        </p>

        <p v-if="error">
            {{ error }}
        </p>

        <div v-if="aiResult">
            <h3>AI анализ сообщения</h3>
            <p>Настроение: {{ aiResult.ai_sentiment  }}</p>
            <blockquote>
                {{ aiResult.ai_response }}
            </blockquote>
        </div>
    </form>
</template>

<script setup>
import { reactive, ref } from "vue";
import { sendContact } from "../api/contact";

const form = reactive({
    name: "",
    phone: "",
    email: "",
    comment: "",
});

const loading = ref(false);
const message = ref("");
const aiResult = ref(null);
const error = ref("");

async function submit() {
    loading.value = true;
    message.value = "";
    error.value = "";
    aiResult.value = null;

    try {
        const response = await sendContact(form);

        message.value = response.message;

        aiResult.value = response.data;

        form.name = "";
        form.phone = "";
        form.email = "";
        form.comment = "";
    } catch (e) {
        error.value = e.message ?? "Ошибка отправки";
    } finally {
        loading.value = false;
    }
}
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input,
textarea {
    padding: 10px;
    font-size: 16px;
}

textarea {
    min-height: 120px;
}

button {
    padding: 12px;
    cursor: pointer;
}
</style>
