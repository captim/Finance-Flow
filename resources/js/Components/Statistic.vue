<template>
    <div class="container md:px-0 px-4">
        <div class="info_items">
            <div class="info_item green">
                Доходи <span>
                    {{ data.income }} UAH
                </span>
            </div>
            <div class="info_item red">
                Витрати <span>
                    {{ data.costs }} UAH
                </span>
            </div>
            <div class="info_item blue">
                Заощядження <span>
                    {{ data.savings }} UAH
                </span>
            </div>
            <div class="info_item gray">
                Залишилось <span>
                    {{ data.remains }} UAH
                </span>
            </div>
        </div>
        <div class="info_items2" v-if="data.EUR">
            <div class="info_item green">
                Доходи <span>
                    {{ data.EUR.income }} EUR
                </span>
            </div>
            <div class="info_item red">
                Витрати <span>
                    {{ data.EUR.costs }} EUR
                </span>
            </div>
            <div class="info_item blue">
                Заощядження <span>
                    {{ data.EUR.savings }} EUR
                </span>
            </div>
            <div class="info_item gray">
                Залишилось <span>
                    {{ data.EUR.remains }} EUR
                </span>
            </div>
        </div>
        <div class="info_items2" v-if="data.USD">
            <div class="info_item green">
                Доходи <span>
                    {{ data.USD.income }} USD
                </span>
            </div>
            <div class="info_item red">
                Витрати <span>
                    {{ data.USD.costs }} USD
                </span>
            </div>
            <div class="info_item blue">
                Заощядження <span>
                    {{ data.USD.savings }} USD
                </span>
            </div>
            <div class="info_item gray">
                Залишилось <span>
                    {{ data.USD.remains }} USD
                </span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        filter: Object
    },
    data() {
        return {
            data: {
                income: 0,
                costs: 0,
                savings: 0,
                remains: 0,
            }
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/general-statistic', {
                params: this.filter
            })
                .then((response) => {
                    this.data = response.data
                })
        }
    }
}
</script>
<style scoped>
.container {
    border-bottom: 1px solid #fff;
    padding-bottom: 30px;
    margin-bottom: 30px;
}
.info_items {
    display: flex;
    gap: 20px;
    font-weight: bold;
}
.info_items2 {
    display: flex;
    gap: 20px;
    font-weight: bold;
    color: #000;
}

.info_item {
    border-radius: 73.44px;
    padding: 0 18px;
    font-size: 13.219px;
    font-weight: 400;
    color: #fff;
    display: flex;
    align-items: center;
    height: 50px;
    position: relative;
    font-weight: 700;
}

.info_items2 .info_item {
    color: #000;
}

.info_item.green {
    width: 200px;
}

.info_item.red {
    width: 200px;
}

.info_item.blue {
    width: 240px;
}

.info_item.gray {
    width: 230px;
}

.info_item span {
    border-radius: 73.44px;
    background: #343434;
    padding: 0 18px;
    height: 50px;
    width: 120px;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    top: 0;
    right: 0px;
    color: #fff;
}

.info_items > .gray {
    background: rgba(255, 255, 255, 0.40);
}

.info_items > .red {
    background: #B70217;
}

.info_items > .green {
    background: #88B702;
}
.info_items > .blue {
    background: #0029FF;
}
@media screen and (max-width: 600px) {
    .info_items {
        flex-direction: column;
    }
    .info_item {
        width: 100% !important;
    }
}
</style>