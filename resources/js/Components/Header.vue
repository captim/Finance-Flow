<script setup>
import { FwbAvatar } from 'flowbite-vue'
import { Link } from '@inertiajs/vue3'
</script>
<template>
    <div class="popup" v-if="menu">
        <div class="head">
            <button class="close" @click="menu = !menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex items-center justify-center gap-5">
            <a v-if="$page.props.auth.user" href="/dashboard">
                <fwb-avatar :img="$page.props.auth.user.photo" rounded />
            </a>
            <Link href="/favorites" v-if="$page.props.auth.user">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            </Link>
            <Link href="/questions" v-if="$page.props.auth.user">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
            </svg>
            </Link>
            <Link href="/logout" method="post" as="button" type="button" v-if="$page.props.auth.user">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            </Link>
        </div>
        <ul>
            <li>
                <a href="/">Головна</a>
            </li>
            <li v-if="$page.props.auth.user">
                <a href="/wallet/1">Доходи</a>
            </li>
            <li v-if="$page.props.auth.user">
                <a href="/wallet/2">Витрати</a>
            </li>
            <li v-if="$page.props.auth.user">
                <a href="/wallet/3">Збереження</a>
            </li>
            <li v-if="$page.props.auth.user">
                <a href="/statistic">Статистика</a>
            </li>
            <li>
                <a href="/posts">Рекомендації</a>
            </li>
            <li>
                <a href="/about">Про нас</a>
            </li>
        </ul>

        <div class="flex justify-center gap-3 mt-5">
            <a v-if="!$page.props.auth.user" class="auth" href="/login">вхід</a>
            <a v-if="!$page.props.auth.user" class="auth active" href="/register">зареєструватися</a>
        </div>

        <div class="course" v-if="$page.props.auth.user">
            <div v-for="(item, index) in courses" :key="index">
                {{ item.ccy }} {{ (+item.buy).toFixed(2) }} / {{ (+item.sale).toFixed(2) }}
            </div>
        </div>
    </div>
    <div class="container header">
        <div class="flex items-center">
            <div class="logo">
                <img src="/img/logo.png" alt="">
                FinanceFlow
            </div>
            <ul>
                <li>
                    <a href="/">Головна</a>
                </li>
                <li v-if="$page.props.auth.user">
                    <a href="#">Гаманець</a>
                    <ul>
                        <li>
                            <a href="/wallet/1">Доходи</a>
                        </li>
                        <li>
                            <a href="/wallet/2">Витрати</a>
                        </li>
                        <li>
                            <a href="/wallet/3">Збереження</a>
                        </li>
                        <li>
                            <a href="/statistic">Статистика</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/posts">Рекомендації</a>
                </li>
                <li>
                    <a href="/about">Про нас</a>
                </li>
            </ul>
        </div>
        <button class="burger" @click="menu = !menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        <div class="flex items-center gap-5 auth-block">
            <a v-if="!$page.props.auth.user" class="auth" href="/login">вхід</a>
            <a v-if="!$page.props.auth.user" class="auth active" href="/register">зареєструватися</a>
            <div class="course" v-if="$page.props.auth.user">
                <div v-for="(item, index) in courses" :key="index">
                    {{ item.ccy }} {{ (+item.buy).toFixed(2) }} / {{ (+item.sale).toFixed(2) }}
                </div>
            </div>
            <a v-if="$page.props.auth.user" href="/dashboard">
                <fwb-avatar :img="$page.props.auth.user.photo" rounded />
            </a>
            <Link href="/favorites" v-if="$page.props.auth.user">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            </Link>
            <Link href="/questions" v-if="$page.props.auth.user">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
            </svg>
            </Link>
            <Link href="/logout" method="post" as="button" type="button" v-if="$page.props.auth.user">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            </Link>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            courses: [],
            menu: false
        }
    },
    created() {
        this.getCounrse();
    },
    methods: {
        getCounrse() {
            axios.get('/course')
                .then((response) => {
                    this.courses = response.data
                })
        }
    }
}
</script>
<style scoped>
.popup {
    background: #111928;
    width: 100%;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 999;
}

.popup .head {
    text-align: end;
    padding: 20px;
}

.popup ul li {
    text-align: center;
    padding: 15px;
    font-size: 24px;
}

.header {
    height: 66px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 32px auto;
}

.header .logo {
    display: flex;
    align-items: center;
    gap: 12px;
    border-right: 1px solid #434343;
    padding: 18px 0;
    padding-right: 32px;
    font-weight: 500;
    font-size: 18px;
}

.header ul {
    margin: 0;
    display: flex;
}

.header ul li {
    margin-left: 32px;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1.4px;
    text-transform: uppercase;
    position: relative;
}

.header ul li:hover>a {
    text-decoration: underline;
}

.header ul li>ul {
    padding: 5px 0;
    position: absolute;
    display: flex;
    flex-direction: column;
    background: #000;
    visibility: hidden;
    border: 1px solid #fff;
    left: -29px;
    z-index: 1;
    border-radius: 5px;
}

.header ul li:hover>ul {
    visibility: visible;
}

.header ul li>ul li {
    margin: 0;
    padding: 10px 20px;
    text-align: center;
}

.course {
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1.4px;
    text-transform: uppercase;
}

.burger {
    display: none;
}

@media screen and (max-width: 600px) {
    .header ul {
        display: none;
    }

    .header .auth-block {
        display: none;
    }

    .burger {
        display: block;
    }

    .course {
        text-align: center;
        margin-top: 20px;
    }
}
</style>