<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
import CommentItem from "../Components/CommentItem.vue";
import { FwbButton } from 'flowbite-vue'
defineProps({
    post: {
        type: Object,
    }
});
</script>
<template>
    <Head title="Рекомендації" />
    <Header />
    <div class="container md:px-0 px-4">
        <div class="title">
            <span>{{ post.title }}</span>
            <button class="favorite" @click="toFavorite()">
                <svg v-if="!post.favorite" class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 21 19">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 4C5.5-1.5-1.5 5.5 4 11l7 7 7-7c5.458-5.458-1.542-12.458-7-7Z" />
                </svg>
                <svg v-else class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 18">
                    <path
                        d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                </svg>
            </button>
        </div>
        <div class="date">
            {{ post.created_at }} | {{ post.user.name }} {{ post.user.surname }}
        </div>
        <p style="min-height: 350px;">
            <img :src="post.preview" class="preview">
            <div v-html="post.description"></div>
        </p>
        <div class="container max-w-xl">
            <div class="comment-title">Коментарі</div>
            <textarea :rows="4" v-model="comment.description" label="" placeholder="Ваш коментар..."></textarea>
            <fwb-button color="dark" @click="send()" class="mt-3">Додати</fwb-button>
            <CommentItem v-for="item in post.comments" :item="item" :key="item.id" />
        </div>
    </div>
    <Footer />
</template>
<script>
export default {
    data() {
        return {
            comment: {
                description: "",
                posts_id: this.post.id
            }
        }
    },
    methods: {
        toFavorite() {
            axios.post('/favorites/' + this.post.id)
                .then((response) => {
                    this.post.favorite = response.data.favorite
                    swal.fire({
                        icon: "success",
                        title: "Збережено!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
        },
        send() {
            axios.post('/comments', this.comment)
                .then((response) => {
                    this.post.comments.push(response.data);
                    this.comment.description = ""
                })
        }
    }
}
</script>
<style scoped>
.comment-title {
    margin-bottom: 20px;
    padding-bottom: 5px;
    font-size: 22px;
    font-weight: bold;
    border-bottom: 1px solid #fff;
}

.title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
    border-bottom: 1px solid #fff;
    display: flex;
    justify-content: space-between;
    gap: 10px;
    align-items: center;
}

.date {
    margin-bottom: 20px;
}

.preview {
    border-radius: 10px;
    margin: 0 20px 20px 0;
    float: left;
    width: 400px;
    height: 300px;
    object-fit: cover;
}

textarea {
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 27px;
    color: #fff;
    padding: 10px 15px;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.10);
    display: block;
    width: 100%;
    outline: none;
}
</style>