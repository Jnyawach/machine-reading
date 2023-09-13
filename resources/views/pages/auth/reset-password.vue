<template>
    <Head>
        <title>Reset Password</title>
    </Head>
    <div class="flex h-screen place-content-center ">
        <div class="self-center  px-5">
            <div class="mt-24">
                <h6 class="text-center mb-8">Forgot Password</h6>
                <form @submit.prevent="form.post(route('auth.updatePassword'))">
                    <div class="my-5">
                        <input type="email" class="sumo-input"   required v-model="form.email" placeholder="Your email"/>
                        <div v-if="form.errors.email" class="mt-3 text-red-800 text-sm">
                            <span>{{ form.errors.email }}</span>
                        </div>
                    </div>
                    <div class="my-5">
                        <input type="text" class="sumo-input"   required v-model="form.otp_code" placeholder="OTP Code"/>
                        <div v-if="form.errors.otp_code" class="mt-3 text-red-800 text-sm">
                            <span>{{ form.errors.otp_code }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 my-5">
                        <div>
                            <input type="password" class="sumo-input" id="password" placeholder="Enter your password" required v-model="form.password" autocomplete="new-password"/>
                            <div v-if="form.errors.password" class="mt-3 text-red-800 text-sm">
                                <span>{{ form.errors.password}}</span>
                            </div>
                        </div>
                        <div>
                            <input type="password" class="sumo-input" id="password_confirmation" placeholder="Confirm your password" required v-model="form.password_confirmation"/>

                        </div>
                    </div>
                    <div class="flex mt-4 place-content-end">

                        <button type="submit" class="btn-primary  m-1">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";



let form=useForm({
    email:'',
    password: '',
    password_confirmation: '',
    otp_code:''
})






</script>

<style scoped>

</style>
