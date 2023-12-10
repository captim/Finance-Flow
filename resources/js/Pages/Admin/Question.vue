<script setup>
import { Head } from '@inertiajs/vue3';
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
import { FwbTextarea, FwbButton } from 'flowbite-vue'
defineProps({
    question: {
        type: Object,
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
                    <div class="main-content">
                        <div class="padding">
                            <div class="title">{{ question.title }}</div>
                            <div class="description">
                                {{ question.description }}
                            </div>
                            <div class="date">
                                {{ question.created_at }}
                            </div>
                            <hr class="mb-5">
                            <fwb-textarea v-model="form.description" :rows="4" label="" placeholder="Відповідь..." />
                            <fwb-button class="mt-1" @click="send()" color="default">Відповісти</fwb-button>
                        </div>
                        <div v-for="(item, index) in question.answers" :key="item.id">
                            <div :class="['comment-item', index % 2 !== 0 ? 'bg' : '', 'padding']">
                                <img class="avatar" :src="item.user.photo" alt="">
                                <div class="w-full">
                                    <div class="name">{{ item.user.name }} {{ item.user.surname }} <span>{{ item.created_at }}</span></div>
                                    <p>{{ item.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                })
        }
    }
}
</script>
<style>
.comment-item {
    display: flex;
    gap: 20px;
}

.comment-item.bg {
    background: #f3f3f3;
}

.main-content {
    box-shadow: 0px 5px 5px #dedede;
    background: #fff;
}

.padding {
    padding: 40px;
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
    align-items: center;
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
</style>