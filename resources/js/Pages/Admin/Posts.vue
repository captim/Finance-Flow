<script setup>
import { Head } from '@inertiajs/vue3';
import Posts from './Components/Posts.vue'
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
defineProps({
    posts: {
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
                    <Posts :posts="posts" />
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>