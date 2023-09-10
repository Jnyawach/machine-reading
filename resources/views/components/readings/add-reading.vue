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
                                    <h6>Update Machine</h6>
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
                            <div class="grid my-5">
                                <label for="name" class="text-sm font-medium text-gray-700">Status</label>
                                <select class="sumo-input my-2" v-model="form.product_id">
                                    <option value="">Select product</option>
                                    <option :value="product.id" :key="product.id" v-for="product in products">
                                        {{product.name}} {{product.product_weight}}
                                    </option>

                                </select>
                                <div class="sumo-error" v-if="form.errors.product_id">
                                    {{ form.errors.product_id }}
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-5">
                                <div>
                                    <label for="reading_entry" class="text-sm font-medium text-gray-700">Reading</label>
                                    <input v-model="form.reading_entry" placeholder="Enter reading" type="password" id="reading_entry" class="sumo-input my-2">
                                    <div class="sumo-error" v-if="form.errors.reading_entry">
                                        {{ form.errors.reading_entry }}
                                    </div>
                                </div>

                                <div>
                                    <label for="confirm" class="text-sm font-medium text-gray-700">Confirm reading</label>
                                    <input v-model="form.reading_confirmation" placeholder="Confirm reading" type="password" id="confirm" class="sumo-input my-2">
                                    <div class="sumo-error" v-if="form.errors.reading_confirmation">
                                        {{ form.errors.reading_confirmation }}
                                    </div>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-5">
                               <div>
                                   <label for="shift" class="text-sm font-medium text-gray-700">Shift</label>
                                   <select id="shift" class="sumo-input my-2" v-model="form.shift">
                                       <option value="">Select shift</option>
                                       <option :value="shift.id" :key="shift.id" v-for="shift in shifts">
                                           {{shift.name}} {{moment(shift.start_time,["h:mm A"]).format("hh:mm A")}}- {{moment(shift.end_time,["h:mm A"]).format("hh:mm A")}}
                                       </option>

                                   </select>
                                   <div class="sumo-error" v-if="form.errors.shift">
                                       {{ form.errors.shift }}
                                   </div>
                               </div>

                                <div>
                                    <label for="shift" class="text-sm font-medium text-gray-700">Machine</label>
                                    <select id="shift" class="sumo-input my-2" v-model="form.machine_id">
                                        <option value="">Select machine</option>
                                        <option :value="machine.id" :key="machine.id" v-for="machine in machines">
                                          {{machine.name}}
                                        </option>

                                    </select>
                                    <div class="sumo-error" v-if="form.errors.machine_id">
                                        {{ form.errors.machine_id }}
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                    <hr>
                    <footer class="p-3.5">
                        <div class="flex justify-end">
                            <button form="saveFacilities" type="submit" class="btn-primary btn-medium flex items-center gap-2">
                                <span>Save reading</span>
                                <svg v-if="form.processing" class="fill-white w-5 animate-ping" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M400 256c0 26.5 21.5 48 48 48s48-21.5 48-48S474.5 208 448 208S400 229.5 400 256zM112 256c0-26.5-21.5-48-48-48S16 229.5 16 256S37.5 304 64 304S112 282.5 112 256zM304 256c0-26.5-21.5-48-48-48S208 229.5 208 256S229.5 304 256 304S304 282.5 304 256z"/>
                                </svg>
                            </button>
                        </div>
                    </footer>
                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {watch, ref, onMounted, computed} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import axios from "axios";
import moment from "moment";



const show=ref(false)
const products=ref([])
const shifts=ref([])
const machines=ref([])

watch(show,(val)=>{
    if(val){
        document.body.style.overflow='hidden'
    }else{
        document.body.style.overflow='auto'
    }
})

const user=computed(()=>usePage().props.auth.id)

let form=useForm({
    product_id:'',
    shift:'',
    reading_entry:'',
    reading_confirmation:'',
    machine_id:'',
    user_id:user.value
})

const submit = () => {
    form.post(route('readings.store'),{
        preserveScroll:true,
        onSuccess:()=>{
            show.value=false
            form.reset()

        }
    })
}

onMounted(()=>getData())
const getData= async()=>{
   await axios.get(`/api/get/products`).then((res)=>{
        products.value=res.data.products
        shifts.value=res.data.shifts
       machines.value=res.data.machines
    }).catch((err)=>{
        console.log(err)
    });
}
</script>

<style scoped>

</style>
