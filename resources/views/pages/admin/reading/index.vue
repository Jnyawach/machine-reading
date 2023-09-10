<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, Link} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";
import AddReading from "@/views/components/readings/add-reading.vue";
import CustomDropdown from "@/views/components/general-components/custom-dropdown.vue";
import DataPagination from "@/views/components/general-components/data-pagination.vue";
import PromptAlert from "@/views/components/general-components/prompt-alert.vue";

defineProps({
    readings:Object
})

const markConfirmed=(id:number)=>{
    router.patch(route('mark.reading.confirmed',id))
}
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

    <div class="border rounded-xl  shadow-sm">
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
                        <td class="px-2 py-3">
                           <span class="text-yellow-500" v-if="reading.confirm_status==='Pending'">{{reading.confirm_status}}</span>
                            <span class="capitalize" v-else><span class="text-green-500">{{reading.confirm_status}}</span> :{{reading.confirm_by.name}}</span>

                        </td>

                        <td class="px-2 py-3">
                            <custom-dropdown>
                                <template #trigger>
                                    <button class="flex gap-2 items-center">
                                        <span> More</span>
                                        <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                            <path d="M64 112c26.5 0 48-21.5 48-48S90.5 16 64 16S16 37.5 16 64S37.5 112 64 112zM64 400c-26.5 0-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48S90.5 400 64 400zM64 208C37.5 208 16 229.5 16 256S37.5 304 64 304s48-21.5 48-48S90.5 208 64 208z"/>
                                        </svg>
                                    </button>
                                </template>
                                <div>
                                    <ul class="divide-y">
                                        <li>
                                            <button class="text-green-600 p-2">Update</button>
                                        </li>
                                        <li>
                                            <button class="p-2" @click="markConfirmed(reading.id)">Mark confirmed</button>
                                        </li>
                                    </ul>


                                </div>
                            </custom-dropdown>


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
