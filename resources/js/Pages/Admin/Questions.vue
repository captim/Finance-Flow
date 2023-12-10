<script setup>
import { Head } from '@inertiajs/vue3';
import Questions from './Components/Questions.vue'
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
defineProps({
    questions: {
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
                    <Questions :questions="questions" />
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>