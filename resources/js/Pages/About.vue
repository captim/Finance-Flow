<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
defineProps({
    faq: {
        type: Array,
    }
});
</script>
<template>
    <Head title="Про нас" />
    <Header />
    <div class="blick_1"></div>
    <div class="container">
        <div class="grid md:grid-cols-2 grid-cols-1 gap-8 blocks">
            <div class="title">
                Що таке FinanceFlow?
            </div>
            <div class="description">
                Надійний, зручний та безпечний спосіб управління своїми доходами та витритами.
            </div>
            <div class="block">
                <img src="/img/icon6.png" class="icon">
                <div>
                    <div class="title">Доходи</div>
                    Реєстрація всіх джерел доходу, таких як заробітна плата, інвестиційний прибуток, пенсії, соціальні виплати тощо. Важливо точно оцінювати реальні доходи для планування ефективного бюджету.
                </div>
            </div>
            <div class="block">
                <img src="/img/icon6.png" class="icon">
                <div>
                    <div class="title">Витрати</div>
                    Класифікація усіх витрат на основні категорії, такі як їжа, житло, транспорт, розваги, охорона здоров'я, платежі за кредити тощо. Детальне вивчення та оцінка витрат допомагає контролювати витрати та визначити області для заощаджень.
                </div>
            </div>
            <div class="block">
                <img src="/img/icon6.png" class="icon">
                <div>
                    <div class="title">Моніторинг та коригування</div>
                    Регулярний аналіз фактичних витрат та доходів порівняно з запланованими. Якщо щось не відповідає плану, внесення коригувань для покращення фінансової ситуації.
                </div>
            </div>
            <div class="block">
                <img src="/img/icon6.png" class="icon">
                <div>
                    <div class="title">Стратегія заощадження</div>
                    Визначення областей, де можна зменшити витрати, і встановлення стратегій для накопичення коштів, таких як автоматичні перекази на рахунок заощаджень або інвестування.
                </div>
            </div>
        </div>
        <div class="big_title">FAQ</div>
        <div class="accordion">
            <div class="item" v-for="(item, index) in faq" :key="index">
                <div class="title">{{ item.title }} <button @click="item.active = !item.active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="28" viewBox="0 0 27 28" fill="none" v-if="!item.active">
                            <g clip-path="url(#clip0_28_134)">
                                <rect x="13" y="0.5" width="2" height="27" rx="1" fill="white" />
                                <rect y="13.5" width="27" height="2" rx="1" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_28_134">
                                    <rect width="27" height="27" fill="white" transform="translate(0 0.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="28" viewBox="0 0 27 28" fill="none" v-else>
                            <g clip-path="url(#clip0_28_109)">
                                <rect x="0.5" y="15" width="2" height="27" rx="1" transform="rotate(-90 0.5 15)"
                                    fill="white" />
                                <rect y="13.5" width="27" height="2" rx="1" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_28_109">
                                    <rect width="27" height="27" fill="white" transform="translate(0 0.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
                <div class="description" v-if="item.active" v-html="item.description"></div>
            </div>
        </div>
    </div>
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
<style scoped>
.blick_1 {
    position: absolute;
    z-index: -1;
    width: 800px;
    height: 800px;
    background: #343434;
    right: -250px;
    top: -3 00px;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.7;
}

.blocks>.title {
    font-size: 42px;
    font-style: normal;
    font-weight: 700;
    line-height: 55.02px
}

.blocks>.description {
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
}

.block {
    background: rgba(255, 255, 255, 0.10);
    border-radius: 40px;
    padding: 58px 32px;
    display: flex;
    align-items: flex-start;
    gap: 24px;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
}

.block .title {
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0.9px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.big_title {
    font-size: 66px;
    font-style: normal;
    font-weight: 700;
    line-height: 79.992px;
    letter-spacing: -1px;
    text-align: center;
    margin: 80px 0;
}

.accordion {}

.accordion .item {}

.accordion .item .title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 28px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0.28px;
    padding: 32px 8px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.20);
}

.accordion .item .description {
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.20);
    padding-top: 16px;
    padding-bottom: 32px;
}
@media screen and (max-width: 600px) {
    .blick_1 { 
        display: none;
    }
}
</style>