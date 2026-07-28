<script setup>
import ContactForm from './components/ContactForm.vue'
import Metrics from './components/Metrics.vue'
</script>

<template>
  <main class="container">
    <h1>
      Разработка веб-приложений
    </h1>

    <p>
      Оставьте заявку, и я свяжусь с вами
    </p>

    <ContactForm />
    <Metrics />
  </main>
</template>

<style scoped>
.container {
  background-color: #f9f9f9;
  border-radius: 8px;
  max-width: 700px;
  margin: 50px auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}
</style>