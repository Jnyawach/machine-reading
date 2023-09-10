<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, PropType, watch} from "vue";
import DataPagination from "@/views/components/general-components/data-pagination.vue";
import PromptAlert from "@/views/components/general-components/prompt-alert.vue";
import CustomDropdown from "@/views/components/general-components/custom-dropdown.vue";

let props=defineProps({
    products: {
        type: Object as PropType<Machine[]>,
        required: true
    },
    filters: Object as PropType<Filters>,
    product_weights: {
        type: Object as PropType<Machine[]>,
        required: true
    },
    product_types: {
        type: Object as PropType<Machine[]>,
        required: true
    },
})

const search = ref<String>(props.filters.search);
const showing = ref<Number>(props.filters.showing??10);
const product_type = ref<String>(props.filters.product_type);
const product_weight= ref<String>(props.filters.product_weight);
const clearFilter=()=>{
    search.value="";
}

watch([search,showing, product_type, product_weight],()=>{
    router.get(route('products.index', {
        search: search.value,
        showing: showing.value,
        product_type:product_type.value ,
        product_weight:product_weight.value
    },{preserveScroll:true,preserveState:true}))
})

const deleteProduct=(id:number)=>{
    router.delete(route('products.destroy',id))
};
</script>

<template>
    <Head title="Shifts" />
<admin>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Products</h1>
        </div>
        <div>
            <Link :href="route('products.create')">
                <button class="btn-simple btn-medium flex items-center gap-2">

                    <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/>
                    </svg>
                    <span> Add product</span>
                </button>
            </Link>

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
                    <h6 class="self-center">Weight:</h6>
                    <select v-model="product_weight" class="font-medium text-xs  rounded-xl border bg-gray-50 border border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                        <option :value="null">All</option>
                        <option :key="weight.id" v-for="weight in product_weights" :value="weight.id">{{weight.weight}} {{weight.measurement_unit}}</option>

                    </select>
                </div>
                <div class="flex gap-2">
                    <h6 class="self-center">Type:</h6>
                    <select v-model="product_type" class="font-medium text-xs  rounded-xl border bg-gray-50 border border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                        <option :value="null">All</option>
                        <option :key="type.id" v-for="type in product_types" :value="type.id">{{type.name}}</option>

                    </select>
                </div>
                <div class="flex gap-2">
                    <h6 class="self-center">Search:</h6>
                    <input  placeholder="Search by name" type="search" class="small-input" v-model="search">
                </div>
                <div class="flex gap-2" v-if="search || product_type || product_weight">
                    <button @click="clearFilter" class="btn-secondary btn-small">
                        <span>Clear</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="border rounded-xl  shadow-sm">
        <div>
            <div class="relative">
                <table class="w-full text-sm text-left text-gray-700 font-medium">
                    <thead class="text-xs text-sky-700 uppercase bg-sky-50">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Machine name
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Weight
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Product Type
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-2 py-3 text-end">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b" v-for="product in products.data" :key="product.id" >
                        <th scope="row" class="px-2 py-3 font-semibold whitespace-nowrap">
                            {{product.name}}
                        </th>
                        <td class="px-2 py-3 capitalize">
                            {{product.product_weight}}

                        </td>
                        <td class="px-2 py-3 capitalize">
                            {{product.product_type}}

                        </td>
                        <td class="px-2 py-3 capitalize">
                            {{product.status}}

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
                                            <prompt-alert
                                                title="Are you sure you want to delete this product?"
                                                description="All related data will be deleted"
                                                @proceed="deleteProduct(product.id)"
                                            >
                                                <template #trigger>
                                                    <button class="text-red-500 p-2">Delete</button>
                                                </template>
                                            </prompt-alert>
                                        </li>
                                        <li>
                                            <Link :href="route('products.edit',product.id)">
                                                <button class="text-green-600 p-2">Update</button>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="route('products.show',product.slug)">
                                                <button class="p-2">Details</button>
                                            </Link>
                                        </li>
                                    </ul>


                                </div>
                            </custom-dropdown>


                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="products"></data-pagination>
            </div>
        </div>
    </div>
</admin>
</template>

<style scoped>

</style>
