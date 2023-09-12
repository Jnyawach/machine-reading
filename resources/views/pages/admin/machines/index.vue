<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {PropType, ref, watch, watchEffect} from "vue";
import PromptAlert from "@/views/components/general-components/prompt-alert.vue";
import debounce from 'lodash'
import DataPagination from "@/views/components/general-components/data-pagination.vue";
import UpdateMachine from "@/views/components/machine/update-machine.vue";
import CreateMachine from "@/views/components/machine/create-machine.vue";
let props=defineProps({
    machines: {
        type: Object as PropType<Machine[]>,
        required: true
    },
    filters: Object as PropType<Filters>,
    statuses: {
        type: Object as PropType<Status[]>,
        required: true
    },
})

const search = ref<String>(props.filters.search);
const showing = ref<Number>(props.filters.showing??10);
const clearFilter=()=>{
    search.value="";
}


watch([search,showing],()=>{
    router.get(route('machines.index', {
        search: search.value,
        showing: showing.value,
    },{preserveScroll:true,preserveState:true}))
},)

const deleteMachine=(id:number)=>{
    router.delete(route('machines.destroy',id))
};

</script>

<template>
    <Head title="Machines" />
<admin>
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold">Machines</h1>
    </div>
    <div>
        <create-machine :statuses="statuses">
            <template #trigger>
                <button class="btn-simple btn-medium flex items-center gap-2">

                    <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/>
                    </svg>
                    <span> Add Machine</span>
                </button>
            </template>
        </create-machine>

    </div>
</div>
    <div>
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
                    <h6 class="self-center">Search:</h6>
                    <input  placeholder="Search by name" type="search" class="small-input" v-model="search">
                </div>
                <div class="flex gap-2" v-if="search">
                    <button @click="clearFilter" class="btn-secondary btn-small">
                        <span>Clear</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--machine table-->
    <div class="flex justify-end gap-3 self-center my-3">
        <h6 class="font-semibold">Export Data:</h6>
        <a :href="route('admin.machines.report','pdf')" class="text-sky-700 font-bold">PDF</a>
        <a :href="route('admin.machines.report','excel')" class="text-sky-700 font-bold">CSV</a>
        <button class="text-sky-700 font-bold">JSON</button>
    </div>
    <div class="border rounded-xl overflow-hidden shadow-sm">
        <div>
            <div class="relative">
                <table class="w-full text-sm text-left text-gray-700 font-medium">
                    <thead class="text-xs text-sky-700 uppercase bg-sky-50">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Machine name
                        </th>

                        <th scope="col" class="px-2 py-3">
                           Status
                        </th>
                        <th scope="col" class="px-2 py-3" colspan="2">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b" v-for="machine in machines.data" :key="machine.id" >
                        <th scope="row" class="px-2 py-3 font-semibold whitespace-nowrap">
                            {{machine.name}}
                        </th>
                        <td class="px-2 py-3 capitalize">
                            {{machine.status}}
                        </td>
                        <td class="px-2 py-3">
                            <update-machine :machine="machine" :statuses="statuses">
                                <template #trigger>
                                    <button class="text-green-600">Update</button>
                                </template>
                            </update-machine>


                        </td>
                        <td class="px-2 py-3">
                            <prompt-alert
                                title="Are you sure you want to delete this machine?"
                                description="All related data will be deleted"
                                @proceed="deleteMachine(machine.id)"
                            >
                                <template #trigger>
                                    <button class="text-red-500">Delete</button>
                                    </template>
                            </prompt-alert>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="machines"></data-pagination>
            </div>
        </div>
    </div>
</admin>
</template>

<style scoped>

</style>
