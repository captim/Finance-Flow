<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
defineProps({
    posts: {
        type: Array,
    }
});
</script>
<template>
    <Head title="Рекомендації" />
    <Header />
    <div class="container md:px-0 px-4">
        <div class="title">
            Рекомендації
        </div>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-8">
            <div class="item" v-for="(item, index) in posts" :key="item.id">
                <Link :href="`/posts/${item.id}`">
                <img :src="item.preview" alt="">
                </Link>
                <div class="description">
                    <button class="favorite" @click="toFavorite(item, index)">
                        <svg v-if="!item.favorite" class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 21 19">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 4C5.5-1.5-1.5 5.5 4 11l7 7 7-7c5.458-5.458-1.542-12.458-7-7Z" />
                        </svg>
                        <svg v-else class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                        </svg>
                    </button>
                    <div class="title">
                        <Link :href="`/posts/${item.id}`">{{ item.title }}</Link>
                    </div>
                    <p>{{ item.description.replace(/(<([^>]+)>)/gi, '').slice(0, 100) }}...</p>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>
<script>
export default {
    methods: {
        toFavorite(item, index) {
            axios.post('/favorites/' + item.id)
                .then((response) => {
                    this.posts[index] = response.data
                    swal.fire({
                        icon: "success",
                        title: "Збережено!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
        }
    }
}
</script>
<style scoped>
.title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 30px;
}

.item {
    border-radius: 40px;
    background: var(rgba(255, 255, 255, 0.10));
    overflow: hidden;
    font-size: 18px;
    font-weight: 400;
    background: rgba(255, 255, 255, 0.10);
}

.item img {
    width: 100%;
    height: 215px;
    object-fit: cover;
}

.item .title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 16px;
    margin-top: 24px;
}

.item .favorite {
    padding: 10px;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.7px;
    text-transform: uppercase;
    background: #88B702;
    border-radius: 50px;
}

.item .description {
    padding: 0 23px 30px 23px;
    margin-top: -14px;
}
</style>