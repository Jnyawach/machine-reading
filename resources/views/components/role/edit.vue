<template>
    <div @click="launchForm">
        <slot name="trigger">
        </slot>
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
                <div class="bg-white lg:w-3/5 w-full rounded-xl overflow-hidden">
                    <header class="p-3 bg-gray-100">
                        <div class="flex justify-between">
                            <div class="font-medium text-sumo-300 text-lg">
                               Edit Role
                            </div>
                            <div>
                                <div class="text-end">
                                    <button type="button" @click="show=false" class="rounded-full bg-sky-700 h-7 w-7 flex place-content-center">
                                        <svg class="h-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="px-10 py-8 custom-scrolling overflow-y-auto max-h-[400px] m-2">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-1 my-5">
                                <div>
                                    <label class="sumo-label" for="name">Name:</label>
                                    <input type="text" class="sumo-input my-3" id="name" v-model="form.name">
                                    <div v-if="form.errors.name" class="mt-3 text-red-800 text-sm">
                                        <span class="text-xs">{{form.errors.name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="my-3 flex justify-end">
                                <button type="submit" class="btn-primary">Update Role <span v-show="form.processing" class="ml-2 animate-ping"><i class="fa-solid fa-ellipsis"></i></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";

let props=defineProps({
    role:Object,
})

let show=ref(false)

let form=useForm({
    'name': '',
})
const launchForm=()=>{
    console.log(props.role);

    form.name=props.role?.name
    show.value=true
}
const submit=()=>{
    form.patch(route('admin.roles.update',props.role.id),{
        onSuccess:()=>{
            show.value = false
            form.reset()
        }
    })
}
</script>

<style scoped>

</style>
