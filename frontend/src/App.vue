<script setup>
import { ref } from "vue";
import HeroSection from "./components/HeroSection.vue";
import AboutSection from "./components/AboutSection.vue";
import MetricsSection from "./components/MetricSection.vue";
import ContactSection from "./components/ContactSection.vue";
import FooterSection from "./components/FooterSection.vue";

const metricsKey = ref(0);

function refreshMetrics() {
    metricsKey.value++;
}
</script>

<template>
    <HeroSection />

    <AboutSection />

    <ContactSection @contact-sent="refreshMetrics" />

    <MetricsSection :key="metricsKey" />

    <FooterSection />
</template>

<style scoped>
.info-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}
</style>
