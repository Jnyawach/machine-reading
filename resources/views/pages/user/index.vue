<script setup lang="ts">
import {Head,Link} from "@inertiajs/vue3";
import User from "@/views/layouts/user.vue";
import WeeklyReadings from "@/views/components/dashboard/weekly-readings.vue";
defineProps({
    readings: Number,
    users:Number,
    products:Number,
    machines:Number,
    weeklyReadings:Array
})

</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <user>
        <div class="my-5 grid md:grid-cols-2 lg:grid-cols-3 gap-3">
            <div class="p-3 border bg-white rounded-xl">
                <div class="flex justify-between ">
                    <h6 class="text-md font-bold">Readings</h6>
                    <Link :href="route('user.readings.index')" title="Portfolios" class="btn-outline-primary btn-small">View all</Link>
                </div>
                <div class="pt-5">
                    <p class="text-md font-bold text-sumo-300">{{readings}} Total</p>
                </div>
            </div>


            <div class="p-3 border bg-white rounded-xl">
                <div class="flex justify-between ">
                    <h6 class="text-md font-bold">Products</h6>
                    <Link :href="route('user.products.index')" title="Portfolios" class="btn-outline-primary btn-small">View all</Link>
                </div>
                <div class="pt-5">
                    <p class="text-md font-bold text-sumo-300">{{products}} Saved</p>
                </div>
            </div>

            <div class="p-3 border bg-white rounded-xl">
                <div class="flex justify-between ">
                    <h6 class="text-md font-bold">Machines</h6>
                    <Link :href="route('user.machines.index')" title="Portfolios" class="btn-outline-primary btn-small">View all</Link>
                </div>
                <div class="pt-5">
                    <p class="text-md font-bold text-sumo-300">{{machines}} Available</p>
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-7 gap-3 my-5">

            <div class="lg:col-span-4 grid">
                <weekly-readings :weeklyReadings="weeklyReadings"></weekly-readings>
            </div>

        </div>
    </user>

</template>

<style scoped>

</style>
