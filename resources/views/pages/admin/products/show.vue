<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, Link} from "@inertiajs/vue3";
import PromptAlert from "@/views/components/general-components/prompt-alert.vue";
defineProps({
    product:Object
})

const deleteProduct=(id:number)=>{
    router.delete(route('products.destroy',id))
};
</script>

<template>
    <Head :title="product.data.name" />
<admin>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold capitalize">{{product.data.name}}</h1>
        </div>
        <div class="flex gap-2">
           <div>
               <Link :href="route('products.edit',product.data.id)">
                   <button class="btn-simple btn-medium flex items-center gap-2">
                       <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                           <path d="M455.7 18.75C443.2 6.252 426.8 0 410.5 0c-16.38 0-32.76 6.25-45.26 18.75L45.11 338.9c-8.568 8.566-14.53 19.39-17.18 31.21l-27.61 122.8C-1.7 502.1 6.159 512 15.95 512c1.047 0 2.116-.1034 3.198-.3202c0 0 84.61-17.95 122.8-26.93c11.54-2.717 21.87-8.523 30.25-16.9l321.2-321.2c24.99-24.99 24.9-65.42-.0898-90.41L455.7 18.75zM138.2 433.9c-2.115 2.115-4.503 3.463-7.308 4.123c-18.17 4.281-47.46 10.71-72.69 16.18l16.55-73.58c.666-2.959 2.15-5.654 4.296-7.803l241.9-241.9l60.13 60.13L138.2 433.9z"/>
                       </svg>
                       <span>Edit product</span>
                   </button>
               </Link>
           </div>
            <div>
                <prompt-alert
                    title="Are you sure you want to delete this product?"
                    description="All related data will be deleted"
                    @proceed="deleteProduct(product.id)"
                >
                    <template #trigger>
                        <button class="btn-danger btn-medium">Delete</button>
                    </template>
                </prompt-alert>
            </div>

        </div>

    </div>

    <div class="my-5">
        <div class="flex items-center gap-2">
            <span class="text-gray-600">Product type:</span>
            <span class="text-gray-800 font-medium capitalize">{{product.data.product_type}}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-gray-600">Product weight:</span>
            <span class="text-gray-800 font-medium capitalize">{{product.data.product_weight}}</span>
        </div>

        <div class="flex items-center gap-2">
            <span class="text-gray-600">Product description:</span>
            <span class="text-gray-800 font-medium capitalize">{{product.data.description}}</span>
        </div>

    </div>
    <div class="my-5">
        <h6 class="font-bold text-large">Product Readings</h6>
    </div>
</admin>
</template>

<style scoped>

</style>
