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
    name: '',
    surname: '',
    password: '',
    password_confirmation: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Header />
    <div class="blick_1"></div>
    <div class="container md:px-0 px-4">

        <Head title="Реєстрація" />
        <div class="grid md:grid-cols-2 grid-cols-1 gap-10">
            <form @submit.prevent="submit">
                <div class="title">
                    Реєстрація
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div class="form_group">
                        <label for="name">Ім'я</label>
                        <input type="text" v-model="form.name" placeholder="Ім'я" required>
                    </div>
                    <div class="form_group">
                        <label for="surname">Прізвище</label>
                        <input type="text" v-model="form.surname" placeholder="Прізвище" required>
                    </div>
                </div>
                <div class="form_group">
                    <label for="email">Почта</label>
                    <input type="email" v-model="form.email" placeholder="Почта" required>
                </div>
                <div class="form_group">
                    <label for="password">Пароль</label>
                    <input type="password" placeholder="••••••••••" v-model="form.password" required>
                </div>
                <div class="form_group">
                    <label for="password_confirmation">Повторіть пароль</label>
                    <input type="password" placeholder="••••••••••" v-model="form.password_confirmation" required>
                </div>
                <button class="btn green">Зареєструватися</button>
            </form>
            <div>
                <img src="/img/edc.png" class="preview">
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