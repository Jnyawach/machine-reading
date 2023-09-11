<script setup lang="ts">
import {useForm, Link, Head} from "@inertiajs/vue3";


let form=useForm({
    email:'',
    password:''
})
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
<section>
    <div class="h-screen flex place-content-center p-3">
        <div class="self-center border rounded-lg p-3 md:p-8 w-full md:w-3/5 lg:w-2/5 overflow-hidden bg-white">
            <h1 class="text-center font-bold text-xl text-sky-600">MACHINE READING</h1>
            <h2 class="my-5 font-medium text-center">Login to proceed</h2>
            <div class="my-5">
                <form @submit.prevent="form.post(route('authenticate'))" autocomplete="off">
                    <div class="my-5 grid">
                        <label for="form-input" class="sumo-label">Email:</label>
                        <input type="email" class="sumo-input my-2" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                        <div v-if="form.errors.email" class="sumo-error">
                            <span>{{ form.errors.email }}</span>
                        </div>
                    </div>

                    <div class="my-5 grid">
                        <label for="form-password" class="sumo-label">Password:</label>
                        <input type="password" class="sumo-input my-2" id="form-password" placeholder="Enter your password" required v-model="form.password"/>
                        <div v-if="form.errors.password" class="sumo-error">
                            <span>{{ form.errors.password }}</span>
                        </div>
                    </div>

                    <div class="my-5 grid gap-3 md:flex justify-center md:justify-between items-center">
                        <div class="order-2 md:order-1 text-center md:text-start ">
                           <Link :href="route('password-reset')" class="hover:text-sky-700">Forgot password</Link>
                        </div>
                        <div class="order-1 md:order-2">
                            <button type="submit" class="btn-primary w-44 flex items-center gap-2 justify-center">
                                <span>Login</span>
                                <svg v-if="form.processing" class="fill-white w-5 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M400 256c0 26.5 21.5 48 48 48s48-21.5 48-48S474.5 208 448 208S400 229.5 400 256zM112 256c0-26.5-21.5-48-48-48S16 229.5 16 256S37.5 304 64 304S112 282.5 112 256zM304 256c0-26.5-21.5-48-48-48S208 229.5 208 256S229.5 304 256 304S304 282.5 304 256z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="pt-8 text-center">
                        <Link class="text-center hover:text-sky-700 underline" :href="route('register')">Create new account</Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</template>

<style scoped>

</style>
