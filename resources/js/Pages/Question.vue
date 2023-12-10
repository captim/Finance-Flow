<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
import {
    FwbButton,
    FwbTextarea
} from 'flowbite-vue'
defineProps({
    question: {
        type: Object,
    }
});
</script>
<template>
    <Head title="Технічна підтримка" />
    <div>
        <Header />

        <div class="container">
            <div class="mb-7">
                <div class="title">{{ question.title }}</div>
                <div class="description">
                    {{ question.description }}
                </div>
                <div class="date">
                    {{ question.created_at }}
                </div>
                <hr class="mb-5">
                <textarea v-model="form.description" :rows="4" label="" placeholder="Відповідь..."></textarea>
                <fwb-button class="mt-1" @click="send()" color="default">Відповісти</fwb-button>
            </div>
            <div v-for="(item, index) in question.answers" :key="item.id">
                <div :class="['comment-item', index % 2 !== 0 ? 'bg' : '', 'padding']">
                    <img class="avatar" :src="item.user.photo" alt="">
                    <div class="w-full">
                        <div class="name">{{ item.user.name }} {{ item.user.surname }} <span>{{ item.created_at
                        }}</span></div>
                        <p>{{ item.description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                description: "",
                questions_id: this.question.id
            }
        }
    },
    methods: {
        send() {
            axios.post('/answers', this.form)
                .then((response) => {
                    this.question.answers.push(response.data)
                    this.form.description = ""
                })
        }
    }
}
</script>
<style scoped>
.comment-item {
    display: flex;
    gap: 20px;
    padding: 20px;
}

.comment-item.bg {
    background: #373737;
}

.avatar {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 5px;
}

.name {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.name span {
    color: #838383;
    font-size: 14px;
}

.title {
    font-size: 24px;
    line-height: 24px;
    margin-bottom: 15px;
}

.date {
    color: #838383;
    font-size: 14px;
    margin: 15px 0;
}

textarea {
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 27px;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.10);
    margin-bottom: 12px;
    display: block;
    width: 100%;
    outline: none;
}
</style>