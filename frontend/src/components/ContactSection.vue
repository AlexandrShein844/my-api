<template>
    <section
        id="contact"
        class="contact"
    >
        <div class="container">

            <h2>
                Связаться со мной
            </h2>

            <p class="description">
                Оставьте сообщение, и я свяжусь с вами.
                После отправки запрос будет обработан,
                проанализирован и сохранен в системе.
            </p>


            <div class="form-wrapper">

                <ContactForm @success="emit('contact-sent')" />

            </div>

        </div>
    </section>
</template>


<script setup>
import ContactForm from './ContactForm.vue'

const emit = defineEmits([
    'contact-sent'
])

</script>


<style scoped>

.contact {
    padding:80px 0;
}


h2 {
    text-align:center;
    font-size:36px;
    margin-bottom:20px;
}


.description {

    max-width:700px;

    margin:0 auto;

    text-align:center;

    color:#4b5563;

    line-height:1.7;

}


.form-wrapper {

    max-width:600px;

    margin:50px auto 0;

    background:white;

    padding:40px;

    border-radius:16px;

    box-shadow:
        0 8px 25px rgba(0,0,0,.08);

}

</style>