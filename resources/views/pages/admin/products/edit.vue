<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, useForm} from "@inertiajs/vue3";


let props=defineProps({
    product_types:Object,
    product_weights:Object,
    product:Object
})

let form=useForm({
    name:props.product?.name,
    description:props.product?.description,
    product_type:props.product?.product_type_id,
    product_weight:props.product?.product_weight_id,

})
</script>

<template>
    <Head title="Add product" />
    <admin>
        <div class="my-3">
            <div>
                <h1 class="text-2xl font-bold">Add a product</h1>
            </div>
            <div class="my-5">
                <form @submit.prevent="form.patch(route('products.update',product.id))">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div>
                            <label class="sumo-label" for="product_name">Product name:</label>
                            <input v-model="form.name" placeholder="Enter product name" type="text" id="product_name"  class="sumo-input my-2">
                            <div class="sumo-error" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div>
                            <label for="product_type" class="text-sm font-medium text-gray-700">Product type</label>
                            <select class="sumo-input my-2" v-model="form.product_type" id="product_type">
                                <option value="">Select type</option>
                                <option :value="product_type.id" :key="product_type.id" v-for="product_type in product_types">{{product_type.name}}</option>

                            </select>
                            <div class="sumo-error" v-if="form.errors.product_type">
                                {{ form.errors.product_type }}
                            </div>
                        </div>
                        <div>
                            <label for="product_weight" class="text-sm font-medium text-gray-700">Product weight</label>
                            <select class="sumo-input my-2" v-model="form.product_weight" id="product_weight">
                                <option value="">Select weight</option>
                                <option :value="product_weight.id" :key="product_weight.id" v-for="product_weight in product_weights">{{product_weight.weight}} {{product_weight.measurement_unit}}</option>

                            </select>
                            <div class="sumo-error" v-if="form.errors.product_weight">
                                {{ form.errors.product_weight }}
                            </div>
                        </div>
                    </div>
                    <div class="grid my-5">
                        <label class="sumo-label" for="product_description">Description (optional):</label>
                        <textarea v-model="form.description" placeholder="Enter product description" id="product_description" class="sumo-textarea my-2" rows="5"></textarea>
                    </div>
                    <div class="my-5 flex justify-end">
                        <button :disabled="form.processing" type="submit" class="btn-primary flex gap-2 items-center">
                            <span>Update product</span>
                            <svg v-if="form.processing" class="fill-white w-5 animate-ping" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M400 256c0 26.5 21.5 48 48 48s48-21.5 48-48S474.5 208 448 208S400 229.5 400 256zM112 256c0-26.5-21.5-48-48-48S16 229.5 16 256S37.5 304 64 304S112 282.5 112 256zM304 256c0-26.5-21.5-48-48-48S208 229.5 208 256S229.5 304 256 304S304 282.5 304 256z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </admin>
</template>

<style scoped>

</style>
