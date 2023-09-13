<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import User from "@/views/layouts/user.vue";
import EditProfile from "@/views/components/auth/update-profile.vue";
import EditPassword from "@/views/components/auth/update-password.vue";



let props=defineProps({
    user:Object,
})
console.log(props);

</script>

<template>
    <Head>
        <title>User</title>
    </Head>
    <user>
        <div class="flex justify-between items-center mb-5">
            <div>
                <h1 class="text-2xl font-bold">Profile</h1>
            </div>
            <div class="flex gap-2">
                <edit-password :user="user">
                    <template #trigger>
                        <button class="btn-simple btn-medium flex items-center gap-2">
                            <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/>
                            </svg>
                            <span> Edit Password</span>
                        </button>
                    </template>
                </edit-password>
                <edit-profile :user="user">
                    <template #trigger>
                        <button class="btn-simple btn-medium flex items-center gap-2">
                            <svg class="h-4 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/>
                            </svg>
                            <span> Edit Profile</span>
                        </button>
                    </template>
                </edit-profile>
            </div>
        </div>
        <div>
            <div class="px-6 grid grid-cols-2">
                <div class="flex">
                    <span class="font-bold text-base pr-3">Name:</span> {{ user.name }}
                </div>
                <div class="flex">
                    <span class="font-bold text-base pr-3">Email:</span> {{ user.email }}
                </div>
            </div>
        </div>
    </user>

</template>

<style scoped>

</style>
