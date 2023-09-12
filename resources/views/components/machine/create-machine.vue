<template>
    <div @click="show=true">
        <slot name="trigger"></slot>
    </div>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="show=false" v-if="show" class="inset-0 fixed bg-black bg-opacity-40 z-[100000] grid place-items-center p-5">
                <div class="bg-white lg:w-1/2 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-bold text-sumo-300 text-lg">
                                    <h6>Add Machine</h6>
                                </div>
                            </slot>
                            <div>
                                <div class="text-end">
                                    <button type="button" @click="show=false" class="rounded-full bg-sky-700 h-7 w-7 flex place-content-center">
                                        <svg class="h-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>
                    <hr>
                    <div class="p-3.5">

                        <form @submit.prevent="submit" id="saveFacilities">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label for="name" class="text-sm font-medium text-gray-700">Machine name</label>
                                    <input v-model="form.name" type="text" id="name" name="name" class="sumo-input my-2">
                                    <div class="sumo-error" v-if="form.errors.name">
                                        {{ form.errors.name }}
                                    </div>
                                </div>
                                <div>
                                    <label for="name" class="text-sm font-medium text-gray-700">Status</label>
                                    <select class="sumo-input my-2" v-model="form.status">
                                        <option value="">Select status</option>
                                        <option :value="status" :key="index" v-for="(status, index) in statuses">{{status}}</option>

                                    </select>
                                    <div class="sumo-error" v-if="form.errors.status">
                                        {{ form.errors.status }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid my-5">
                                <label for="name" class="text-sm font-medium text-gray-700">Product type</label>
                                <select class="sumo-input my-2" v-model="form.product_type" required>
                                    <option value="">Select product type</option>
                                    <option :value="product_type.id" :key="index" v-for="(product_type, index) in product_types">{{product_type.name}}</option>

                                </select>
                                <div class="sumo-error" v-if="form.errors.product_type">
                                    {{ form.errors.product_type}}
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <footer class="p-3.5">
                        <div class="flex justify-end">
                            <button form="saveFacilities" type="submit" class="btn-primary btn-medium">Save machine</button>
                        </div>
                    </footer>
                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {watch, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

let props=defineProps({
    statuses:Object,
    product_types:Object
})

const show=ref(false)

watch(show,(val)=>{
    if(val){
        document.body.style.overflow='hidden'
    }else{
        document.body.style.overflow='auto'
    }
})



let form=useForm({
    name:'',
    status:'',
    product_type:''
})

const submit = () => {
    form.post(route('machines.store'),{
        preserveScroll:true,
        onSuccess:()=>{
            show.value=false
            form.reset()

        }
    })
}
</script>

<style scoped>

</style>
