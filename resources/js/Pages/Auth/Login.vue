<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue'
import Footer from '../../Components/Footer.vue'

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Header />
    <div class="blick_1"></div>
    <div class="container md:px-0 px-4">

        <Head title="Вхід" />
        <div class="grid md:grid-cols-2 grid-cols-1 gap-10">
            <form @submit.prevent="submit">
                <div class="title">
                    Вхід
                </div>
                <div class="form_group">
                    <label for="name">Почта</label>
                    <input placeholder="name@example.com" v-model="form.email" type="text">
                </div>
                <div class="form_group">
                    <label for="name">Пароль</label>
                    <input placeholder="••••••••••" v-model="form.password" type="password">
                </div>
                <button class="btn green">Авторизація</button>
            </form>
            <div>
                <img src="/img/money.png" class="preview">
            </div>
        </div>
        <Footer />
    </div>
</template>
<style scoped>
.blick_1 {
    position: absolute;
    z-index: -1;
    width: 800px;
    height: 800px;
    background: #343434;
    right: -250px;
    top: 200px;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.7;
}

.title {
    font-size: 50px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: -1px;
    margin-bottom: 30px;
}

.form_group {
    margin-bottom: 20px;
}

.form_group label {
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0.9px;
    text-transform: uppercase;
    display: block;
}

.form_group input {
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 27px;
    color: #fff;
    padding: 20px 25px;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.10);
    margin-top: 12px;
    display: block;
    width: 100%;
    outline: none;
}

.preview {
    width: 100%;
}

@media screen and (max-width: 600px) {
    .preview {
        display: none;
    }

    .blick_1 {
        display: none;
    }
}
</style>