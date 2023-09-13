<script setup lang="ts">
import {onMounted,ref, watch, PropType} from "vue";
import { initFlowbite } from 'flowbite'
import {Head, Link, router} from "@inertiajs/vue3";
import Admin from "@/views/layouts/admin.vue";
import DataPagination from "@/views/components/general-components/data-pagination.vue";
import EditUser from "@/views/components/user/edit.vue";
import CreateUser from "@/views/components/user/create.vue";
import PromptAlert from "@/views/components/general-components/prompt-alert.vue";

onMounted(() => {
    initFlowbite();
})

export interface Filters{
    showing: number
    search: string
}
let props=defineProps({
    users:Object,
    roles:Object,
    filters:{
        type: Object as PropType<Filters>,
        required: true,
    },
})
console.log(props);


const deleteUser=(id:number)=>{
    router.delete(route('admin.users.destroy',id))
}

const showing=ref(props.filters.showing?props.filters.showing:10)
const search=ref(props.filters.search?props.filters.search:'')

const clearFilter=()=>{
    router.get(route('admin.users.index'))
}

watch([search,showing],()=>{
    router.get(route('admin.users.index', {
        search: search.value,
        showing: showing.value,
    },{preserveScroll:true,preserveState:true}))
},)
</script>

<template>
    <Head>
        <title>Users</title>
    </Head>
  <admin>
    <div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold">Users</h1>
    </div>
    <div>
        <create-user :roles="roles">
            <template #trigger>
                <button class="btn-simple btn-medium flex items-center gap-2">
                    <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/>
                    </svg>
                    <span> Add User</span>
                </button>
            </template>
        </create-user>
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
      <div class="flex justify-end gap-3 self-center my-3">
          <h6 class="font-semibold">Export Data:</h6>
          <a :href="route('admin.users.report','pdf')" class="text-sky-700 font-bold">PDF</a>
          <a :href="route('admin.users.report','excel')" class="text-sky-700 font-bold">CSV</a>
      </div>
    <div class="border rounded-xl overflow-hidden shadow-sm">
        <div>
            <div class="relative">
                <table class="w-full text-sm text-left text-gray-700 font-medium">
                    <thead class="text-xs text-sky-700 uppercase bg-sky-50">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Email
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Role
                        </th>
                        <th scope="col" class="px-2 py-3" colspan="2">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b" v-for="user in users.data" :key="user.id" >
                        <th scope="row" class="px-2 py-3 font-semibold whitespace-nowrap">
                            {{user.name}}
                        </th>
                        <td class="px-2 py-3">
                            {{user.email}}
                        </td>
                        <td class="px-2 py-3">
                            {{user.role}}
                        </td>
                        <td class="px-2 py-3">
                            <div class="flex">
                                <edit-user :user="user" :roles="roles">
                                <template #trigger>
                                    <button class="text-green-600">Update</button>
                                </template>
                            </edit-user>
                            <span class="px-2">|</span>
                            <prompt-alert
                                title="Are you sure you want to delete this User?"
                                description="All related data will be deleted"
                                @proceed="deleteUser(user.id)"
                            >
                                <template #trigger>
                                    <button class="text-red-500">Delete</button>
                                    </template>
                            </prompt-alert>
                            </div>


                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="users"></data-pagination>
            </div>
        </div>
    </div>
  </admin>

</template>

<style scoped>

</style>
