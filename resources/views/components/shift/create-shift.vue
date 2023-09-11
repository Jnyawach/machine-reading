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
                                    <h6>Create shift</h6>
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
                            <div class="grid grid-cols-1">
                                <div>
                                    <label for="name" class="text-sm font-medium text-gray-700">Shift name</label>
                                    <input v-model="form.name" type="text" id="name" name="name" class="sumo-input my-2">
                                    <div class="sumo-error" v-if="form.errors.name">
                                        {{ form.errors.name }}
                                    </div>
                                </div>


                            </div>
                            <div class="my-5 grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label for="start_time" class="text-sm font-medium text-gray-700">Start time</label>
                                    <input v-model="form.start_time" type="time" id="start_time"  class="sumo-input my-2">
                                    <div class="sumo-error" v-if="form.errors.start_time">
                                        {{ form.errors.start_time }}
                                    </div>
                                </div>
                                <div>
                                    <label for="end_time" class="text-sm font-medium text-gray-700">End time</label>
                                    <input v-model="form.end_time" type="time" id="end_time"  class="sumo-input my-2">
                                    <div class="sumo-error" v-if="form.errors.end_time">
                                        {{ form.errors.end_time }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <footer class="p-3.5">
                        <div class="flex justify-end">
                            <button form="saveFacilities" type="submit" class="btn-primary btn-medium">Save shift</button>
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
    start_time:'',
    end_time:'',


})

const submit = () => {
    form.post(route('shifts.store'),{
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
