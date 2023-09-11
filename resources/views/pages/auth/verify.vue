<template>
    <Head>
        <title>Verify you account</title>
    </Head>
    <div class="flex place-content-center h-screen">
        <div class=" self-center bg-white rounded-xl flex justify-center border shadow w-1/2">
            <div class="self-center  p-5">
                <div class="">
                    <h1 class="text-center text-lg font-bold">Verify you email</h1>
                    <div class=" py-5 px-5">
                        <div class="bg-sky-50 p-3 flex rounded-md"  v-if="$page.props.status">

                            <div >
                                <p class="text-sky-800 text-sm">{{$page.props.status}}</p>
                            </div>

                        </div>
                        <p class="mt-3 text-sm text-center">Before proceeding, please check your email for a verification OTP code.</p>
                    </div>
                    <form @submit.prevent="form.post('/auth/verified')">
                        <div class="mt-7 px-5">

                            <input type="text" class="sumo-input text-center" id="otp-code" placeholder="Enter 6 digit OTP Code" required v-model="form.otp_code"/>
                            <div v-if="form.errors.otp_code" class="mt-3 text-red-800 text-sm">
                                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.otp_code}}</span>
                            </div>
                        </div>
                        <div class="py-5 px-3 flex justify-center gap-2">
                            <div>
                                <Link :href="route('resend.link')"
                                      method="post" as="button" class="btn-primary">
                                    Resend OTP
                                </Link>

                            </div>
                            <div>
                                <button :disabled="form.processing" type="submit" class="btn-success flex gap-2 items-center">
                                    <span>Verify</span>
                                    <svg v-if="form.processing" class="fill-white w-5 animate-ping" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M400 256c0 26.5 21.5 48 48 48s48-21.5 48-48S474.5 208 448 208S400 229.5 400 256zM112 256c0-26.5-21.5-48-48-48S16 229.5 16 256S37.5 304 64 304S112 282.5 112 256zM304 256c0-26.5-21.5-48-48-48S208 229.5 208 256S229.5 304 256 304S304 282.5 304 256z"/>
                                    </svg>

                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>


        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";

let form=useForm({
    otp_code:''
})


</script>

