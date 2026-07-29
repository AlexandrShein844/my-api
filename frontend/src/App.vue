<script setup>
import HeroSection from "./components/HeroSection.vue";
import AboutSection from "./components/AboutSection.vue";
import MetricsSection from "./components/MetricSection.vue";
import ContactSection from "./components/ContactSection.vue";
import FooterSection from "./components/FooterSection.vue";
</script>

<template>
    <HeroSection />

    <AboutSection />

    <ContactSection />
    
    <MetricsSection />

    <FooterSection />
</template>

<style scoped>
.info-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}
</style>
