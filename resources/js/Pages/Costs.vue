<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
import Statistic from '../Components/Statistic.vue'

import {
    FwbButton,
    FwbInput,
    FwbTextarea,
    FwbDropdown,
    FwbListGroup,
    FwbListGroupItem
} from 'flowbite-vue'
import Modal from '../Components/Modal.vue'
defineProps({
    id: {
        type: Number,
    }
});
</script>
<template>
    <Head title="Витрати" />
    <div>
        <Header />
        <Modal :show="categoryModal" maxWidth="sm">
            <div class="relative w-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="px-6 py-6 pt-8">
                        <fwb-input placeholder="Назва" v-model="category.title" type="text" class="mb-3" />
                        <div class="text-right mt-2">
                            <fwb-button color="green" @click="saveCaregory()" pill>Зберегти</fwb-button>
                            <fwb-button color="red" class="ml-2" @click="categoryModal = false" pill>Закрити</fwb-button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

        <Modal :show="newItemModal" maxWidth="sm">
            <div class="relative w-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="px-6 py-6 pt-8">
                        <div class="label">
                            <fwb-input type="search" @focus="show = true" @blur="close()" placeholder="Категорія"
                                v-model="form.category" />
                        </div>
                        <ul class="list-multiselect" v-if="show && filterData.length > 0">
                            <li v-for="(item, index) in filterData" :key="index" @click="setValue(item)">
                                {{ item.title }}
                            </li>
                        </ul>
                        <fwb-input placeholder="Сума" v-model="form.sum" label="" type="number" class="mt-1" />
                        <fwb-input placeholder="Дата" v-model="form.date" label="" type="date" class="mt-1" />
                        <fwb-textarea :rows="4" label="" v-model="form.comment" placeholder="Коментар" />
                        <div class="text-right mt-2">
                            <fwb-button color="green" @click="save()" pill>Зберегти</fwb-button>
                            <fwb-button color="red" class="ml-2" @click="closeModal()" pill>Закрити</fwb-button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

        <Modal :show="dayModal" maxWidth="sm">
            <div class="relative w-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="px-6 py-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-medium text-gray-900">{{ day[0].date }}</h3>
                            <button @click="dayModal = false" type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="mt-5">
                            <div class="accordion" v-for="(item, index) in day" :key="index">
                                <div class="header">
                                    <div class="flex gap-2 items-center w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                        {{ item.sum }} грн
                                    </div>
                                    <button @click="editDay(item)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="deleteDay(item, index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="description">
                                    {{ item.comment ? item.comment : 'Без коментарів...' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

        <Statistic :filter="filter" :key="componentkey" />

        <div>
            <div class="container mb-5 flex justify-between  md:px-0 px-4">
                <div class="flex gap-3">
                    <fwb-button color="purple" @click="addCategory()" pill>Додати категорію +</fwb-button>
                    <fwb-button color="green" @click="closeModal(true)" pill>Додати +</fwb-button>
                </div>
                <fwb-dropdown text="Bottom">
                    <template #trigger>
                        <fwb-button color="blue" pill>За {{ month[filter.month] }}</fwb-button>
                    </template>
                    <fwb-list-group>
                        <fwb-list-group-item v-for="(item, index) in month" :key="index" class="cursor"
                            @click="getDataMonth(index)">
                            {{ item }}
                        </fwb-list-group-item>
                    </fwb-list-group>
                </fwb-dropdown>
            </div>
            <div class="main-table">
                <table>
                    <tr>
                        <td colspan="2" rowspan="2"></td>
                        <td rowspan="2">Категорія</td>
                        <td :colspan="days.length" :class="['text-center', 'header', types[id - 1].color]">
                            {{ types[id - 1].title }} за місяць
                        </td>
                        <td rowspan="2" class="text-right">Сума</td>
                    </tr>
                    <tr>
                        <td v-for="day in days" :key="day" class="text-center bg-blue">
                            {{ new Date(day).getDate() }}
                        </td>
                    </tr>
                    <tr v-for="category in categories" :key="category.id">
                        <td style="padding: 1px;" class="text-center">
                            <button class="delete" @click="deleteCategory(category)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                            </button>
                        </td>
                        <td style="padding: 1px;" class="text-center">
                            <button class="edit" @click="editCategory(category)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                        </td>
                        <td>{{ category.title }}</td>
                        <td v-for="(day, index) in days" :key="index"
                            :class="['text-center', 'hover', sumInDay(day, category) > 0 ? 'cursor active' : '']"
                            @click="openDay(day, category)">
                            {{ sumInDay(day, category) }}
                        </td>
                        <td class="text-right">
                            {{ sumInRow(category) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td v-for="(day, index) in days" :key="index" class="text-center bg-blue">
                            {{ sumInColumn(day) }}
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <Footer />
    </div>
</template>
<script>
export default {
    data() {
        return {
            componentkey: 1,
            show: false,
            newItemModal: false,
            dayModal: false,
            categoryModal: false,
            clickModal: false,
            form: {
                category: "",
                sum: 0,
                date: "",
                comment: "",
                types_id: this.id,
                id: null
            },
            formDefault: {},
            categories: [],
            category: {
                id: null,
                types_id: this.id,
                title: ""
            },
            types: [
                {
                    title: "Доходи",
                    color: "green"
                },
                {
                    title: "Витрати",
                    color: "red"
                },
                {
                    title: "Заощядження",
                    color: "gray"
                }
            ],
            data: [],
            days: [],
            day: [],
            filter: {
                month: null
            },
            month: [
                'січень',
                'лютий',
                'березень',
                'квітень',
                'травень',
                'червень',
                'липень',
                'серпень',
                'вересень',
                'жовтень',
                'листопад',
                'грудень'
            ]
        }
    },
    created() {
        let today = new Date();
        this.filter.month = today.getMonth();
        this.getData();
        let countDays = new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();
        let days = [];
        for (let index = 1; index <= countDays; index++) {
            days.push(`${today.getFullYear()}-${today.getMonth() + 1}-${index}`);
        }
        this.days = days;
    },
    computed: {
        filterData() {
            return this.categories.filter(item => {
                return item.title.toLowerCase().includes(this.form.category.toLowerCase());
            })
        },
    },
    methods: {
        close() {
            setTimeout(() => {
                this.show = false;
            }, 200);
        },
        setValue(item) {
            this.form.category = item.title;
            this.show = false;
        },
        sumInColumn(day) {
            return this.data.filter(item => {
                return new Date(item.date).getDate() == new Date(day).getDate()
            }).reduce((accumulator, object) => {
                return accumulator + +object.sum;
            }, 0)
        },
        sumInRow(category) {
            return this.data.filter(item => {
                return category.id == item.categories_id
            }).reduce((accumulator, object) => {
                return accumulator + +object.sum;
            }, 0)
        },
        sumInDay(day, category) {
            return this.data.filter(item => {
                return new Date(item.date).getDate() == new Date(day).getDate() && category.id == item.categories_id
            }).reduce((accumulator, object) => {
                return accumulator + +object.sum;
            }, 0)
        },
        getData() {
            axios.get('/wallet-data/' + this.id, {
                params: this.filter
            })
                .then((response) => {
                    this.data = response.data.data;
                    this.categories = response.data.categories;
                })
        },
        getDataMonth(index) {
            this.filter.month = index
            this.getData()
        },
        openDay(day, category) {
            let findDay = this.data.filter(item => {
                return new Date(item.date).getDate() == new Date(day).getDate() && category.id == item.categories_id
            });
            if (findDay.length > 0) {
                this.day = findDay;
                this.dayModal = true;
            }
        },
        closeModal(show = false) {
            this.newItemModal = show;
            this.form = {
                category: "",
                sum: 0,
                date: "",
                comment: "",
                types_id: this.id,
                id: null
            };
        },
        onInput(data) {
            this.form.category = data.target ? data.target.value : data;
        },
        save() {
            this.clickModal = true;
            if (this.clickModal) {
                if (this.form.id) {
                    axios.post('/wallet/' + this.form.id, this.form)
                        .then(() => {
                            this.closeModal();
                            this.getData();
                            this.componentkey++;
                            this.clickModal = false;
                        })
                } else {
                    axios.post('/wallet', this.form)
                        .then(() => {
                            this.closeModal();
                            this.getData();
                            this.componentkey++;
                            this.clickModal = false;
                        })
                }
            }
        },
        deleteCategory(item) {
            axios.post('/admin/categories-delete/' + item.id)
                .then(() => {
                    this.getData();
                    this.componentkey++;
                })
        },
        editCategory(item) {
            this.category = item;
            this.categoryModal = true;
        },
        editDay(item) {
            this.dayModal = false;
            this.newItemModal = true;
            this.form.category = item.category.title;
            this.form.id = item.id;
            this.form.date = item.date;
            this.form.sum = item.sum;
            this.form.comment = item.comment;
            this.form.types_id = item.types_id;
        },
        saveCaregory() {
            if (!this.category.id) {
                axios.post('/categories', this.category)
                    .then(() => {
                        this.getData();
                        this.categoryModal = false;
                    })
            } else {
                axios.post('/categories/' + this.category.id, this.category)
                    .then(() => {
                        this.getData();
                        this.categoryModal = false;
                    })
            }
        },
        deleteDay(item, index) {
            axios.post('/wallet-delete/' + item.id)
                .then(() => {
                    this.getData();
                    if (this.day.length == 1) {
                        this.dayModal = false;
                    }
                    this.day.splice(index, 1);
                    this.componentkey++;
                })
        },
        addCategory() {
            this.categoryModal = true;
            this.category.id = null;
            this.category.title = '';
        }
    }
}
</script>
<style scoped>
.accordion {
    color: #000;
}

.accordion .header {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    background: #f3f3f3;
    padding: 10px;
    cursor: pointer;
    border: 1px solid #f3f3f3;
}

.accordion .description {
    padding: 10px;
    border: 1px solid #f3f3f3;
    font-size: 14px;
}

.gray {
    background: rgba(255, 255, 255, 0.40);
}

.red {
    background: #B70217;
}

.green {
    background: #88B702;
}

table td.header {
    padding: 5px;
    color: #fff;
}

table {
    width: 100%;
}

table td {
    border: 1px solid #b3b3b3;
    color: #000;
    background: #fff;
    padding: 0 10px;
}

table td.hover:hover {
    background: #dedede;
}

table td.active,
table td.active:hover {
    color: #fff;
    background: rgb(142, 142, 237);
}

.bg-blue {
    background: #dedede;
}

.delete {
    color: #000;
    width: 100%;
    height: 100%;
    padding: 5px 2px;
}

.delete:hover {
    color: red;
}

.edit:hover {
    color: blue;
}

.list-multiselect {
    background: #fff;
    position: absolute;
    width: 88%;
    z-index: 999;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #EAEAEA;
    margin: 5px 0 0 0;
    max-height: 300px;
    padding: 0;
    overflow: hidden;
    overflow-y: auto;
}

ul.list-multiselect::-webkit-scrollbar {
    width: 5px;
}

ul.list-multiselect::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
}

ul.list-multiselect::-webkit-scrollbar-thumb {
    background-color: #000000;
    border-radius: 10px;
}

ul.list-multiselect li {
    list-style: none;
    padding: 5px 10px;
    min-height: 30px;
    cursor: pointer;
    color: #000;
}

ul.list-multiselect li:hover {
    background: #fafafa;
}

.main-table {
    overflow-x: auto;
}
</style>