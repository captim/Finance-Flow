<script setup>
import { Head } from '@inertiajs/vue3';
import Categories from './Components/Categories.vue'
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
defineProps({
    categories: {
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
                    <Categories :categories="categories" />
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>