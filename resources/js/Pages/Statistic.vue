<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
import Bar from '../Components/diagram/Bar.vue'
import Pie from '../Components/diagram/Pie.vue'
import Line from '../Components/diagram/Line.vue'
import Statistic from '../Components/Statistic.vue'
import { FwbButton } from 'flowbite-vue'
defineProps({
    categories: {
        type: Array,
    },
    types: {
        type: Array,
    }
});
</script>
<template>
    <Head title="Витрати" />
    <div>
        <Header />

        <Statistic :filter="filter" />

        <div class="container md:px-0 px-4">
            <div class="grid grid-cols-12 gap-8">
                <div class="md:col-span-3 col-span-12 md:pr-9">
                    <select class="select" v-model="filter.month" @change="getData()">
                        <option disabled :value="null">Місяць</option>
                        <option v-for="(item, index) in month" :key="index" :value="index">{{ item }}</option>
                    </select>
                    <select class="select" v-model="filter.types_id" @change="getData()" v-if="type == 2 || type == 3">
                        <option :value="null">Тип</option>
                        <option v-for="(item, index) in types" :key="index" :value="item.id">{{ item.title }}</option>
                    </select>
                    <select class="select" v-model="filter.categories_id" @change="getData()" v-if="type == 3">
                        <option :value="null">Категорія</option>
                        <option v-for="(item, index) in filteredCategories" :key="index" :value="item.id">{{ item.title }}
                        </option>
                    </select>
                </div>
                <div class="md:col-span-6 col-span-12">
                    <div class="flex gap-3 mb-2">
                        <fwb-button color="green" @click="exportExcel()">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                viewBox="0,0,256,256">
                                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                    style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </fwb-button>
                        <fwb-button color="red" @click="exportPdf()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" x="0px" y="0px" width="20" height="20">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                        </fwb-button>
                    </div>
                    <div id="divToPrint">
                        <Pie :data="data.pie" v-if="type == 1" style="width: 60%; margin: auto;" />
                        <Bar :data="data.bar" v-if="type == 2" />
                        <Line :data="data.line" v-if="type == 3" />
                    </div>
                </div>
                <div class="md:col-span-3 col-span-12 text-center">
                    <img src="/img/d1.png" :class="['btn-diagram', type == 1 ? 'active' : '']" @click="setDiagram(1)">
                    <img src="/img/d2.png" :class="['btn-diagram', type == 2 ? 'active' : '']" @click="setDiagram(2)">
                    <img src="/img/d3.png" :class="['btn-diagram', type == 3 ? 'active' : '']" @click="setDiagram(3)">
                </div>
            </div>
        </div>
        <div>

        </div>
        <Footer />
    </div>
</template>
<script>
import html2canvas from 'html2canvas';
export default {
    components: {
        Bar,
        Pie
    },
    data() {
        return {
            type: 1,
            data: {
                bar: {
                    labels: [],
                    datasets: []
                },
                pie: {
                    labels: [],
                    datasets: []
                },
                line: {
                    labels: [],
                    datasets: []
                }
            },
            filter: {
                month: null,
                types_id: null,
                categories_id: null
            },
            month: [
                'Січень',
                'Лютий',
                'Березень',
                'Квітень',
                'Травень',
                'Червень',
                'Липень',
                'Серпень',
                'Вересень',
                'Жовтень',
                'Листопад',
                'Грудень'
            ]
        }
    },
    computed: {
        filteredCategories() {
            return this.categories.filter(item => item.types_id == this.filter.types_id)
        }
    },
    created() {
        const d = new Date();
        this.filter.month = d.getMonth();
        this.getData();
    },
    methods: {
        generateReport() {
            this.$refs.vue3SimpleHtml2pdf.download()
        },
        setDiagram(id) {
            this.type = id;
            this.filter.types_id = null;
            this.filter.categories_id = null;
            this.getData();
        },
        getData() {
            axios.get('/statistics', {
                params: this.filter
            })
                .then((response) => {
                    this.data = response.data
                })
        },
        exportExcel() {
            axios.get('/api/export-excel', { params: this.filter, responseType: "blob" }).then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'Статистика.xlsx');
                document.body.appendChild(link);
                link.click();
            });
        },
        exportPdf() {
            html2canvas(document.querySelector("#divToPrint")).then(canvas => {
                const link = document.createElement("a");
                link.setAttribute("download", "diagram.png");
                link.setAttribute(
                    "href",
                    canvas
                        .toDataURL("image/png")
                        .replace("image/png", "image/octet-stream")
                );
                link.click();
            })
        }
    }
}
</script>
<style scoped>
.select {
    border: 1px solid #fff;
    background: none;
    border-radius: 40px;
    padding: 15px 28px;
    font-size: 13.219px;
    font-weight: 400;
    width: 100%;
    text-transform: uppercase;
    text-align: left;
    margin-bottom: 30px;
}

.select option {
    color: #000;
}

.btn-diagram {
    width: 100px;
    margin: auto;
    margin-bottom: 50px;
    cursor: pointer;
    opacity: 0.6;
    transition: 0.2s;
}

.btn-diagram:hover,
.btn-diagram.active {
    opacity: 1;
}

@media screen and (max-width: 600px) {
    .btn-diagram {
        display: inline-block;
        margin: 20px;
        width: 60px;
    }
}
</style>