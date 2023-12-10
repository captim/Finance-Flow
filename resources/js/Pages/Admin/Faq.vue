<script setup>
import { Head } from '@inertiajs/vue3';
import Faq from './Components/Faq.vue'
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
defineProps({
    faq: {
        type: Array,
    }
});
</script>
<template>
    <Head title="Адмінпанель" />
    <div class="admin">
        <Header />
        <div class="content">
            <div>
                <Navigations />
            </div>
            <div>
                <div class="main">
                    <Faq :faq="faq" />
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>