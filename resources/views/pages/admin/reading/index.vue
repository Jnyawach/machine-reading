<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";
import AddReading from "@/views/components/readings/add-reading.vue";
import DataPagination from "@/views/components/general-components/data-pagination.vue";
import {ref, watch} from "vue";
import moment from "moment"

let props=defineProps({
    readings:Object,
    filters:Object,
    shifts:Object,
    machines:Object
})

const markConfirmed=(id:number)=>{
    router.patch(route('mark.reading.confirmed',id))
}

const search = ref<String>(props.filters?.search);
const showing = ref<Number>(props.filters?.showing??10);
const shift = ref<String>(props.filters?.shift);
const machine = ref<String>(props.filters?.machine);

const clearFilter=()=>{
 shift.value=''
    machine.value=''
    search.value=''
}

watch([search,showing,shift, machine],()=>{
    router.get(route('readings.index'),{
        search: search.value,
        showing: showing.value,
        shift:shift.value ,
        machine:machine.value
    },{preserveState:true,preserveScroll:true})
})
</script>

<template>
    <Head>
        <title>Readings</title>
    </Head>
<admin>
    <div class="flex justify-between items-center my-5">
        <div>
            <h1 class="text-2xl font-bold">Readings</h1>
        </div>
        <div>
            <add-reading>
                <template #trigger>
                    <button class="btn-simple btn-medium flex items-center gap-2">

                        <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/>
                        </svg>
                        <span>Add a reading</span>
                    </button>
                </template>
            </add-reading>

        </div>

    </div>


        <div class="flex justify-between my-5">
            <div class="flex gap-2">
                <h6 class="self-center">Showing Entries:</h6>
                <select v-model="showing" class="font-medium text-xs  rounded-xl border bg-gray-50 border border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 self-center">
                <div class="flex gap-2">
                    <h6 class="self-center">Machine:</h6>
                    <select v-model="machine" class="font-medium text-xs  rounded-xl border bg-gray-50 border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                        <option :value="null">All</option>
                        <option :key="machine.id" v-for="machine in machines" :value="machine.id">{{machine.name}}</option>

                    </select>
                </div>
                <div class="flex gap-2">
                    <h6 class="self-center">Shift:</h6>
                    <select v-model="shift" class="font-medium text-xs  rounded-xl  bg-gray-50 border border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                        <option :value="null">All</option>
                        <option :key="shift.id" v-for="shift in shifts" :value="shift.id">{{shift.name}} {{moment(shift.start_time,["h:mm A"]).format("hh:mm A")}}- {{moment(shift.end_time,["h:mm A"]).format("hh:mm A")}}</option>

                    </select>
                </div>
                <div class="flex gap-2">
                    <h6 class="self-center">Search:</h6>
                    <input  placeholder="Search by name" type="search" class="small-input" v-model="search">
                </div>
                <div class="flex gap-2" v-if="search || machine || shift">
                    <button @click="clearFilter" class="btn-secondary btn-small">
                        <span>Clear</span>
                    </button>
                </div>
            </div>
        </div>

    <div class="border rounded-xl shadow-sm overflow-hidden">

        <div>
            <div class="relative">
                <table class="w-full text-sm text-left text-gray-700 font-medium">
                    <thead class="text-xs text-sky-700 uppercase bg-sky-50 rounded-t-xl">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Reading entry
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Automatic entry
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Count
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Product
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Machine
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Read by
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Confirmation status
                        </th>
                        <th scope="col" class="px-2 py-3 text-end">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b" v-for="reading in readings.data" :key="reading.id" >
                        <th scope="row" class="px-2 py-3 font-semibold whitespace-nowrap">
                            {{reading.reading_entry}}
                        </th>
                        <td class="px-2 py-3">
                            {{reading.automatic_count}}

                        </td>
                        <td class="px-2 py-3 ">
                            {{reading.reading_count}}

                        </td>
                        <td class="px-2 py-3">
                            {{reading.product.name}} {{reading.product.product_weight}}

                        </td>
                        <td class="px-2 py-3 ">
                            {{reading.machine.name}}

                        </td>
                        <td class="px-2 py-3 ">
                            {{reading.user.name}}

                        </td>
                        <td class="px-2 py-3">
                           <span class="text-yellow-500" v-if="reading.confirm_status==='Pending'">{{reading.confirm_status}}</span>
                            <span class="capitalize" v-else><span class="text-green-500">{{reading.confirm_status}}</span> :{{reading.confirm_by.name}}</span>

                        </td>

                        <td class="px-2 py-3 flex justify-end">
                            <button v-if="reading.confirm_status==='Pending'" class="btn-simple btn-medium" @click="markConfirmed(reading.id)">Mark confirmed</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="readings"></data-pagination>
            </div>
        </div>
    </div>
</admin>
</template>

<style scoped>

</style>
