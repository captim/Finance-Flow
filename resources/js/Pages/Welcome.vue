<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue'
import Footer from '../Components/Footer.vue'
</script>

<template>
    <Head title="Головна" />
    <div class="blick_1"></div>

    <Header />

    <div class="block_1">
        <div class="container">
            <h1>Finance Flow</h1>
            <h2>Керуйте сьогоденням для майбутнього: фінансова мудрість - ваш ключ до успіху!</h2>
            <a class="auth" href="/login">вхід</a>
            <a class="auth active ml-5" href="/register">зареєструватися</a>
        </div>
        <div class="blick_2"></div>
        <img src="/img/bank.png" class="preview">
    </div>

    <div class="container">
        <div class="block_2">
            <div class="title">Фінансова стабільність ґрунтується на кількох ключових засадах <br>які є залогами стійкості в фінансах</div>
            <div class="grid md:grid-cols-5 grid-cols-2 gap-4">
                <div>
                    Ефективне управління бюджетом
                </div>
                <div>
                    Економія та інвестування
                </div>
                <div>
                    Стабільні доходи
                </div>
                <div>
                    Управління боргами
                </div>
                <div>
                    Навички фінансової грамотності
                </div>
            </div>
        </div>
    </div>
    <div class="block_3">
        <div class="container">
            <div class="title">Керуй своїми збереженнями</div>
            <div class="description"> Знання та контроль над тим, куди йдуть ваші гроші, є важливим аспектом фінансової стабільності</div>
            <div class="grid md:grid-rows-2 grid-rows-1 md:grid-flow-col md:grid-cols-12 grid-cols-1 gap-8">
                <div class="md:col-span-4 col-span-12">
                    <div class="class_block_gray">
                        <img src="/img/icon1.png" class="icon">
                        <div class="title">Доходи</div>
                        Надійні та стабільні джерела доходу забезпечують основу для фінансової стабільності.
                    </div>
                </div>
                <div class="md:col-span-4 col-span-12">
                    <div class="class_block_gray">
                        <img src="/img/icon2.png" class="icon">
                        <div class="title">Управління</div>
                        Контроль за боргами, розумне використання кредитів і вчасна їх сплата важливі для уникнення фінансових проблем.
                    </div>
                </div>
                <div class="md:row-span-2 row-span-1 md:col-span-10 col-span-12">
                    <div class="class_block_green h-full">
                        <div class="title">Фінансова незалежність</div>
                        <p>Фінансова незалежність - це стан, коли ви маєте достатньо ресурсів (грошей, активів, джерел доходу), щоб забезпечити своє життя і життя вашої сім'ї без необхідності працювати на постійній основі.</p>
                        <p>Фінансова незалежність може бути досягнута різними способами, такими як активне інвестування, створення пасивного доходу, підприємництво, ефективне управління бюджетом і зменшення витрат, а також планування на майбутнє.</p>
                    </div>
                </div>
            </div>
        </div>
        <img src="/img/cards.png" class="preview">
        <div class="blick_3"></div>
    </div>
    <div class="container grid md:grid-cols-2 grid-cols-1 md:gap-8 block_4">
        <div>
            <img src="/img/gears.png" alt="">
        </div>
        <div>
            <div class="title">Ефективне управління бюджетом</div>
            <div class="description">Знання та контроль над тим, куди йдуть ваші гроші, є важливим аспектом фінансової стабільності.</div>
            <ul>
                <li>
                    <img src="/img/icon3.png" class="icon"> Важливо точно оцінювати реальні доходи для планування ефективного бюджету
                </li>
                <li>
                    <img src="/img/icon4.png" class="icon"> Детальне вивчення та оцінка витрат допомагає контролювати витрати та визначити області для заощаджень
                </li>
                <li>
                    <img src="/img/icon5.png" class="icon"> Визначення областей, де можна зменшити витрати, і встановлення стратегій для накопичення коштів
                </li>
            </ul>
        </div>
    </div>
    <div class="block_5">
        <div class="blick_4"></div>
        <div class="container grid md:grid-cols-2 grid-cols-1 md:gap-8">
            <div class="md:p-0 p-3">
                <div class="title">Обмінюй та зберігай валюту</div>
                <div class="description">Основна мета обміну валют полягає в забезпеченні можливості клієнтам отримувати інші валюти для здійснення різних операцій, таких як подорожі, торгівля, інвестування та здійснення міжнародних операцій.</div>
                <a class="auth" href="/login">вхід</a>
            </div>
            <div>
                <img src="/img/coins.png" class="preview">
            </div>
        </div>
    </div>
    <Footer />
</template>

<style scoped>
.blick_1 {
    position: absolute;
    z-index: -1;
    width: 700px;
    height: 700px;
    background: #343434;
    left: -300px;
    top: -300px;
    border-radius: 50%;
    filter: blur(100px);
}
.blick_2 {
    position: absolute;
    z-index: -1;
    width: 600px;
    height: 600px;
    background: #88B702;
    right: 0px;
    top: 55%;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.4;
}
.blick_3 {
    position: absolute;
    z-index: -1;
    width: 800px;
    height: 800px;
    background: #88B702;
    right: 0px;
    top: 0;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.4;
}
.blick_4 {
    position: absolute;
    z-index: -1;
    width: 800px;
    height: 800px;
    background: #88B702;
    left: 50%;
    transform: translate(-50%, 0);
    top: -50%;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.4;
}

.block_1 {
    margin-top: 50px;
    padding-top: 150px;
    position: relative;
}

.block_1 h1 {
    font-size: 66px;
    font-style: normal;
    font-weight: 700;
    line-height: 79.992px;
    letter-spacing: -1px;
    margin-bottom: 9px;
    max-width: 700px;
}

.block_1 h2 {
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
    margin-bottom: 52px;
    max-width: 550px;
}

.block_1 .preview {
    position: absolute;
    right: 0;
    top: 0;
    width: 900px;
    height: auto;
}

.block_2 {
    margin-top: 350px;
    text-align: center;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
}

.block_2 .title {
    font-size: 24px;
    font-weight: 400;
    margin-bottom: 32px;
}

.block_3 {
    margin-top: 100px;
    position: relative;
}

.block_3 .title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 15px;
    text-align: center;
}

.block_3 .description {
    font-size: 18px;
    font-weight: 400;
    text-align: center;
    margin: auto;
    margin-bottom: 85px;
    max-width: 490px;
}

.block_3 .class_block_gray {
    background: rgba(255, 255, 255, 0.10);
    border-radius: 40px;
    padding: 48px 23px;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 26px;
}

.block_3 .class_block_gray .title {
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0.9px;
    text-transform: uppercase;
    text-align: start;
    margin-top: 20px;
}

.block_3 .class_block_green {
    background: #88B702;
    border-radius: 40px;
    padding: 44px 33px;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 26px;
    height: 100%;
}

.block_3 .class_block_green .title {
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0.9px;
    text-transform: uppercase;
    text-align: start;
    margin-top: 20px;
}

.block_3 .class_block_green p {
    max-width: 300px;
    margin-bottom: 30px;
}

.block_3 .preview {
    position: absolute;
    right: 0px;
    top: 220px;
    width: 750px;
    height: 750px;
}

.block_4 {
    margin-top: 150px;
}

.block_4 .title {
    font-size: 42px;
    font-style: normal;
    font-weight: 700;
    line-height: 55.02px;
    margin-bottom: 16px;
}

.block_4 .description {
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
    margin-bottom: 32px;
}

.block_4 ul {
    margin: 0;
}

.block_4 ul li {
    display: flex;
    gap: 17px;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
    margin-bottom: 17px;
    align-items: center;
}

.block_5 {
    background: #88B702;
    padding: 100px 0;
    margin-top: 100px;
    position: relative;
}

.block_5 .title {
    font-size: 42px;
    font-style: normal;
    font-weight: 700;
    line-height: 55.02px;
    margin-bottom: 16px;
}

.block_5 .description {
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 32.004px;
    margin-bottom: 32px;
}

.block_5 .auth {
    background: #fff;
    color: #88B702;
}
@media screen and (max-width: 600px) {
    .block_1 {
        text-align: center;
        padding-top: 50px;
    }
    .block_1 .preview {
        display: none;
    }
    .block_1 .blick_2 {
        display: none;
    }
    .block_2 {
        margin-top: 90px;
    }
    .block_3 .preview {
        display: none;
    }
    .block_5 .blick_4 {
        display: none;
    }
}
</style>
