<script setup>
import { FwbAvatar } from 'flowbite-vue'
import {
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbToggle,
    FwbPagination
} from 'flowbite-vue'
import { ref } from 'vue'
const currentPage = ref(1)
</script>
<template>
    <div>
        <h1 class="title">Користувачі</h1>
        <fwb-table hoverable class="mb-4">
            <fwb-table-head>
                <fwb-table-head-cell>Фото</fwb-table-head-cell>
                <fwb-table-head-cell>ПІБ</fwb-table-head-cell>
                <fwb-table-head-cell>Email</fwb-table-head-cell>
                <fwb-table-head-cell class="text-right">Бан</fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>

                <fwb-table-row v-for="item in users" :key="item.id">
                    <fwb-table-cell>
                        <fwb-avatar :img="item.photo" />
                    </fwb-table-cell>
                    <fwb-table-cell>{{ item.name }} {{ item.surname }}</fwb-table-cell>
                    <fwb-table-cell>{{ item.email }}</fwb-table-cell>
                    <fwb-table-cell>
                        <label :for="`user-${item.id}`" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input type="checkbox" @change="updateUser(item)" v-model="item.is_ban" :id="`user-${item.id}`"
                                class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </fwb-table-cell>
                </fwb-table-row>

            </fwb-table-body>
        </fwb-table>
        <fwb-pagination v-model="currentPage" :total-items="users.length" show-icons previous-label=""
            next-label=""></fwb-pagination>
    </div>
</template>
<script>
export default {
    props: {
        users: Array
    },
    methods: {
        updateUser(item) {
            axios.post('/user/' + item.id, {
                is_ban: item.is_ban
            })
        },
    }
}
</script>
<style></style>