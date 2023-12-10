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
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3';
const currentPage = ref(1)
</script>
<template>
    <div>
        <h1 class="title">Запитання</h1>
        <fwb-table hoverable class="mb-4">
            <fwb-table-head>
                <fwb-table-head-cell>Тема</fwb-table-head-cell>
                <fwb-table-head-cell>Користувач</fwb-table-head-cell>
                <fwb-table-head-cell>Дата</fwb-table-head-cell>
                <fwb-table-head-cell class="text-right"></fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>

                <fwb-table-row v-for="item in questions" :key="item.id">
                    <fwb-table-cell>
                        <Link :href="`/admin/questions/${item.id}`">{{ item.title }}</Link>
                    </fwb-table-cell>
                    <fwb-table-cell>{{ item.user.name }} {{ item.user.surname }}</fwb-table-cell>
                    <fwb-table-cell>{{ item.created_at }}</fwb-table-cell>
                    <fwb-table-cell>
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
        <fwb-pagination v-model="currentPage" :total-items="questions.length" show-icons previous-label=""
            next-label=""></fwb-pagination>
    </div>
</template>
<script>
export default {
    props: {
        questions: Array
    },
    methods: {
        deleteItem(item, index) {
            axios.post('/admin/questions-delete/' + item.id)
                .then(() => {
                    this.questions.splice(index, 1)
                })
        }
    }
}
</script>
<style></style>