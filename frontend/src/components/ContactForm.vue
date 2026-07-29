<template>
    <form @submit.prevent="submit">
        <div class="field">
            <input
                v-model="form.name"
                type="text"
                @input="clearFieldError('name')"
                placeholder="Имя"
            />
            <p v-if="validationErrors.name" class="error">
                {{ validationErrors.name[0] }}
            </p>
        </div>

        <div class="field">
            <input
                v-model="form.phone"
                type="tel"
                @input="clearFieldError('phone')"
                placeholder="Телефон"
            />
            <p v-if="validationErrors.phone" class="error">
                {{ validationErrors.phone[0] }}
            </p>
        </div>
        <div class="field">
            <input
                v-model="form.email"
                type="email"
                @input="clearFieldError('email')"
                placeholder="Email"
            />
            <p v-if="validationErrors.email" class="error">
                {{ validationErrors.email[0] }}
            </p>
        </div>

        <div class="field">
            <textarea
                v-model="form.comment"
                @input="clearFieldError('comment')"
                placeholder="Комментарий"
            ></textarea>
            <p v-if="validationErrors.comment" class="error">
                {{ validationErrors.comment[0] }}
            </p>
        </div>

        <button :disabled="loading">
            {{ loading ? "Отправка..." : "Отправить" }}
        </button>

        <p v-if="successMessage" class="success">
            {{ successMessage }}
        </p>

        <p v-if="error" class="error">
            {{ error }}
        </p>

        <div v-if="aiResult">
            <h3>AI анализ сообщения</h3>
            <p>Настроение: {{ sentimentLabel(aiResult.ai_sentiment) }}</p>
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
const successMessage = ref("");
const aiResult = ref(null);
const error = ref("");
const validationErrors = ref({});

const sentimentLabels = {
    positive: 'Положительное',
    neutral: 'Нейтральное',
    negative: 'Отрицательное',
    unknown: 'Не определено',
};

function sentimentLabel(value) {
    return sentimentLabels[value] ?? 'Не определено';
}

function clearFieldError(field) {
    if (validationErrors.value[field]) {
        delete validationErrors.value[field];
    }
}

function resetForm() {
    Object.assign(form, {
        name: "",
        phone: "",
        email: "",
        comment: "",
    });
}

async function submit() {
    loading.value = true;

    successMessage.value = "";
    error.value = "";
    aiResult.value = null;
    validationErrors.value = {};

    try {
        const response = await sendContact(form);

        successMessage.value = "Сообщение отправлено";
        aiResult.value = response.data;

        resetForm();
    } catch (e) {
        if (e.errors) {
            validationErrors.value = e.errors;
            return;
        }

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
    resize: none;
    min-height: 100px;
}

button {
    padding: 12px;
    cursor: pointer;
}

.field {
    display: flex;
    flex-direction: column;
}

.success {
    color: #16a34a;
    font-size: 14px;
    margin-top: 4px;
}

.error {
    color: #dc2626;
    font-size: 14px;
    margin-top: 4px;
}
</style>
