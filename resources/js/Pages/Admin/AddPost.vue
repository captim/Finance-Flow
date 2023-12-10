<script setup>
import { Head } from '@inertiajs/vue3';
import Header from './Components/Header.vue'
import Navigations from './Components/Navigations.vue'
import ClassicEditor from "ckeditor5-build-classic-image";
import { FwbButton, FwbInput } from 'flowbite-vue'
defineProps({
    post: {
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
                <div class="main grid grid-cols-12 gap-10">
                    <div class="preview col-span-3">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <img v-if="formData.preview" :src="formData.preview">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" v-else>
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Preview</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG або GIF
                                    </p>
                                </div>
                                <input id="dropzone-file" type="file" @change="previewFiles($event)" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <div class="col-span-9">
                        <fwb-input placeholder="Заголовок" v-model="formData.title" label="" class="mb-2" />
                        <ckeditor tag-name="textarea" ref="cktext" v-model="formData.description" :editor="editor">
                        </ckeditor>
                        <div class="mt-5 flex gap-4">
                            <fwb-button gradient="blue" @click="add()" v-if="!post">Додати</fwb-button>
                            <fwb-button gradient="blue" @click="update()" v-else>Зберегти</fwb-button>
                        </div>
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
        addTag: false,
        newTag: "",
        formData: {
            title: "",
            description: "",
            preview: "",
            newPhoto: null
        }
    }),
    created() {
        if (this.post) {
            this.formData = this.post;
        }
    },
    methods: {
        previewFiles(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.formData.newPhoto = input.files[0];
                    this.formData.preview = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        add() {
            var data = new FormData;
            for (let index in this.formData) {
                data.append(index, this.formData[index]);
            }
            axios.post('/admin/posts', data)
                .then(() => {
                    document.location.href = '/admin/posts'
                })
        },
        update() {
            axios.put('/admin/posts/' + this.post.id, this.formData)
                .then(() => {
                    document.location.href = '/admin/posts'
                })
        }
    }
}
</script>

<style scoped>
img.preview {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain;
}

.preview label {
    overflow: hidden;
    height: 250px;
}
</style>