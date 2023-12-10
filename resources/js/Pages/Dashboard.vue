<script setup>
import { Head, usePage, useForm } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
import {
    FwbInput,
    FwbRadio,
    FwbButton
} from 'flowbite-vue'

const user = usePage().props.auth.user;
const form = useForm({
    name: user.name,
    surname: user.surname,
    email: user.email,
    photo: user.photo,
    currency: user.currency,
    newPhoto: null
});
const previewFiles = (event) => {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
            form.newPhoto = input.files[0];
            form.photo = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
};

const save = () => {
    var data = new FormData;
    for (let index in form) {
        data.append(index, form[index]);
    }
    axios.post('profile', data)
        .then(() => {
            swal.fire({
                icon: "success",
                title: "Збережено!",
                showConfirmButton: false,
                timer: 1500
            });
        })
}
</script>
<template>
    <Head title="Профіль" />
    <Header />
    <form @submit.prevent="save()">
        <div class="container max-w-xl grid grid-cols-12 md:gap-10 px-4 md:px-0">
            <div class="md:col-span-5 col-span-12">
                <label for="photo" class="text-center block w-full cursor">
                    <img :src="form.photo" class="rounded-lg mb-3">
                    Змінити фото
                    <input style="display: none;" @change="previewFiles($event)" type="file" id="photo">
                </label>
            </div>
            <div class="md:col-span-7 col-span-12">
                <fwb-input label="Ім'я" type="text" v-model="form.name" class="mb-1" />
                <fwb-input label="Прізвище" type="text" v-model="form.surname" class="mb-1" />
                <fwb-input label="Email" type="email" v-model="form.email" class="mb-1" />

                <label for="">Валюта</label>
                <div class="flex" style="width: 200px">
                    <fwb-radio v-model="form.currency" label="EUR" value="EUR" />
                    <fwb-radio v-model="form.currency" label="USD" value="USD" />
                </div>
                <hr class="my-3">
                <fwb-input label="Пароль" type="password" class="mb-1" />
                <fwb-input label="Повторіть пароль" type="password" class="mb-3" />
                <fwb-button color="default" pill>Зберегти</fwb-button>
            </div>
        </div>
    </form>
    <Footer />
</template>
<script>
export default {
    data() {
        return {

        }
    }
}
</script>
<style scoped></style>