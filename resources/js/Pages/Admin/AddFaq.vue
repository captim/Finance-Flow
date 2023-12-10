<script setup>
import { Head } from '@inertiajs/vue3';
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
import ClassicEditor from "ckeditor5-build-classic-image";
import { FwbButton, FwbInput } from 'flowbite-vue'
defineProps({
    faq: {
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
                    <fwb-input placeholder="Заголовок" v-model="formData.title" label="" class="mb-2" />
                    <ckeditor tag-name="textarea" ref="cktext" v-model="formData.description" :editor="editor">
                    </ckeditor>
                    <div class="mt-5 flex gap-4">
                        <fwb-button gradient="blue" @click="add()" v-if="!faq">Додати</fwb-button>
                        <fwb-button gradient="blue" @click="update()" v-else>Зберегти</fwb-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        editor: ClassicEditor,
        formData: {
            title: "",
            description: ""
        }
    }),
    created() {
        if (this.faq) {
            this.formData = this.faq;
        }
    },
    methods: {
        add() {
            var data = new FormData;
            for (let index in this.formData) {
                data.append(index, this.formData[index]);
            }
            axios.post('/admin/faq', data)
                .then(() => {
                    document.location.href = '/admin/faq'
                })
        },
        update() {
            axios.put('/admin/faq/' + this.faq.id, this.formData)
                .then(() => {
                    document.location.href = '/admin/faq'
                })
        }
    }
}
</script>