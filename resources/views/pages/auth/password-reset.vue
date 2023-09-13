<template>
    <Head>
        <title>Reset Password</title>
    </Head>
    <div class="flex h-screen justify-center">
        <div class="self-center w-full md:w-2/5 p-5 py-8 border bg-white  rounded-xl">
            <div>
                <h6 class="text-center mb-8">Forgot Password</h6>
                <form @submit.prevent=" form.post(route('check.email'));">
                    <div class="mt-3">
                        <input type="email" class="sumo-input text-center" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                        <div v-if="form.errors.email" class="mt-3 text-red-800 text-center text-xs">
                            <span >{{ form.errors.email }}</span>
                        </div>
                    </div>

                    <div class="flex mt-4 justify-center">
                        <button type="submit" class="btn-primary  m-1">Send reset link</button>
                    </div>
                    <div v-if="$page.props.status" class="text-center text-green-800 font-medium mt-5">
                        <span>{{ $page.props.status }}</span>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head,useForm} from "@inertiajs/vue3";


let form=useForm({
    'email':''
})






</script>

<style scoped>

</style>
