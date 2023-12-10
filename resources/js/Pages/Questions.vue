<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
import Modal from '../Components/Modal.vue'
import {
    FwbButton,
    FwbInput,
    FwbTextarea
} from 'flowbite-vue'
defineProps({
    questions: {
        type: Array,
    }
});
</script>
<template>
    <Head title="Технічна підтримка" />
    <div>
        <Header />

        <Modal :show="newItemModal" maxWidth="sm">
            <div class="relative w-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="px-6 py-6 pt-8">
                        <fwb-input placeholder="Заголовок" v-model="form.title" label="" type="text" class="mt-1" />
                        <fwb-textarea :rows="4" label="" v-model="form.description" placeholder="Коментар" />
                        <div class="text-right mt-2">
                            <fwb-button color="green" @click="save()" pill>Зберегти</fwb-button>
                            <fwb-button color="red" class="ml-2" @click="closeModal()" pill>Закрити</fwb-button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

        <div class="container">
            <fwb-button color="light" @click="closeModal(true)">Додати</fwb-button>
            <table class="mt-4">
                <tr v-for="(item, index) in questions" :key="item.id" :class="[index % 2 !== 0 ? 'bg' : '']">
                    <td>{{ index + 1 }}</td>
                    <td>
                        <Link :href="`/questions/${item.id}`">{{ item.title }}</Link>
                    </td>
                    <td>{{ item.answers_count }}</td>
                    <td>{{ item.created_at }}</td>
                    <td class="flex justify-end">
                        <button @click="deleteItem(item, index)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <Footer />
    </div>
</template>
<script>
export default {
    data() {
        return {
            newItemModal: false,
            form: {
                title: "",
                description: ""
            }
        }
    },
    methods: {
        deleteItem(item, index) {
            axios.post('/questions-delete/' + item.id)
                .then(() => {
                    this.questions.splice(index, 1)
                })
        },
        closeModal(show = false) {
            this.newItemModal = show;
            this.form = {
                title: "",
                description: "",
            };
        },
        save() {
            axios.post('/questions', this.form)
                .then((response) => {
                    this.closeModal();
                    this.questions.push(response.data);
                })
        },
    }
}
</script>
<style scoped>
table {
    width: 100%;
}

tr.bg, tr:hover {
    background: #5c5c5c;
}

td {
    padding: 15px;
}
</style>