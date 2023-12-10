<template>
    <div>
        <Pie :data="data" />
    </div>
</template>
<script>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
ChartJS.register(ArcElement, Tooltip, Legend)
export default {
    props: {
        data: Object
    },
    components: {
        Pie
    },
}
</script>