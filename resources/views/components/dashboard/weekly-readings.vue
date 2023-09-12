<script setup lang="ts">
import apexchart from "vue3-apexcharts";
import {Link} from "@inertiajs/vue3"
let props=defineProps({
    weeklyReadings:Array
})
const options= {
    chart: {
        id: 'Machine Readings'
    },
    xaxis: {
        categories: props.weeklyReadings?.days
    },
    colors:'#0369a1',
}
const series=[{
    name: 'Machine Readings',
    data: props.weeklyReadings?.datasets
}]
</script>

<template>
<div class="border rounded-xl p-3 bg-white">
    <div class="flex justify-between">
        <h2 class="text-lg font-bold text-sky-700">Weekly readings</h2>
        <Link title="Readings" :href="route('readings.index')" class="btn-outline-primary btn-small">
            View all
        </Link>
    </div>
    <h3 class="my-2 font-medium">Sep</h3>
    <div>
        <apexchart height="250" type="bar" :options="options" :series="series"></apexchart>
    </div>
</div>
</template>

<style scoped>

</style>
