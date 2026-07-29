<template>
    <footer class="footer">

        <div class="container footer-content">

            <p>
                Developer Landing API
            </p>

            <p class="copyright">
                Laravel 13 • Vue 3 • 2026
            </p>

        </div>

    </footer>
</template>


<style scoped>

.footer {

    padding:30px 0;

    background:#111827;

    color:white;

}


.footer-content {

    display:flex;

    justify-content:space-between;

    align-items:center;

}


.copyright {

    color:#9ca3af;

}


@media (max-width:600px) {

    .footer-content {

        flex-direction:column;

        gap:10px;

        text-align:center;

    }

}

</style>