<template>
    <TransitionGroup
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
    >
        <div v-if="show && $page.props.status ||show && $page.props.success"  class="z-[100000] fixed top-4 right-4 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow " role="alert">
            <div v-if="show && $page.props.success" class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8  bg-green-100 rounded-lg">
                <svg class="h-4 fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM296 336h-16V248C280 234.8 269.3 224 256 224H224C210.8 224 200 234.8 200 248S210.8 272 224 272h8v64h-16C202.8 336 192 346.8 192 360S202.8 384 216 384h80c13.25 0 24-10.75 24-24S309.3 336 296 336zM256 192c17.67 0 32-14.33 32-32c0-17.67-14.33-32-32-32S224 142.3 224 160C224 177.7 238.3 192 256 192z"/></svg>
            </div>
            <div v-if="show && $page.props.status" class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8  bg-gred-100 rounded-lg">
                <svg class="h-4 fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM296 336h-16V248C280 234.8 269.3 224 256 224H224C210.8 224 200 234.8 200 248S210.8 272 224 272h8v64h-16C202.8 336 192 346.8 192 360S202.8 384 216 384h80c13.25 0 24-10.75 24-24S309.3 336 296 336zM256 192c17.67 0 32-14.33 32-32c0-17.67-14.33-32-32-32S224 142.3 224 160C224 177.7 238.3 192 256 192z"/></svg>
            </div>
            <div class="ml-3 text-sm font-normal text-red-600" v-if="$page.props.status">{{$page.props.status }}</div>
            <div class="ml-3 text-sm font-normal text-green-600" v-if="$page.props.success">{{$page.props.success}}</div>
            <button @click="show=false" type="button" class="ml-auto  bg-gray-50  hover:text-gray-900 rounded-full focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 inline-flex place-content-center h-8 w-8 p-1">
                <svg class="h-5 fill-sky-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
            </button>
        </div>
    </TransitionGroup>
</template>
<script setup lang="ts">
import {computed, ref, watch,nextTick} from "vue";
import {usePage} from "@inertiajs/vue3";
let props=defineProps({
})
const show=ref(true)
const status=computed(() => usePage().props.status)
const success=computed(() => usePage().props.success)
watch(status,()=>{
    setTimeout(()=>{
        show.value=false
    },2000)
})
nextTick(()=>{
    show.value=true
    if(status.value){
        setTimeout(()=>{
            show.value=false
        },2000)
    }
})
</script>
<style scoped>
</style>
