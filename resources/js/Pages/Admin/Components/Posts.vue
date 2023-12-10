<script setup>
import {
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbButton,
    FwbPagination
} from 'flowbite-vue'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
const currentPage = ref(1)
</script>
<template>
    <div>
        <h1 class="title flex justify-between items-center">
            Публікації
            <fwb-button href="/admin/posts/create" color="default">Додати</fwb-button>
        </h1>
        <fwb-table hoverable class="mb-4">
            <fwb-table-head>
                <fwb-table-head-cell>Заголовок</fwb-table-head-cell>
                <fwb-table-head-cell>Користувач</fwb-table-head-cell>
                <fwb-table-head-cell>Дата</fwb-table-head-cell>
                <fwb-table-head-cell class="text-right"></fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>

                <fwb-table-row v-for="item in posts" :key="item.id">
                    <fwb-table-cell>{{ item.title }}</fwb-table-cell>
                    <fwb-table-cell>{{ item.user.name }} {{ item.user.surname }}</fwb-table-cell>
                    <fwb-table-cell>{{ item.created_at }}</fwb-table-cell>
                    <fwb-table-cell class="flex justify-end gap-3">
                        <Link :href="`/admin/posts/${item.id}/edit`">
                        <fwb-button color="dark" outline square>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </fwb-button>
                        </Link>
                        <fwb-button color="dark" @click="deleteItem(item, index)" outline square>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </fwb-button>
                    </fwb-table-cell>
                </fwb-table-row>

            </fwb-table-body>
        </fwb-table>
        <fwb-pagination v-model="currentPage" :total-items="posts.length" show-icons previous-label=""
            next-label=""></fwb-pagination>
    </div>
</template>
<script>
export default {
    props: {
        posts: Array
    },
    methods: {
        deleteItem(item, index) {
            axios.post('/posts-delete/' + item.id)
                .then(() => {
                    this.posts.splice(index, 1)
                })
        }
    }
}
</script>
<style></style>