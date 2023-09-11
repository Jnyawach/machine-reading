<script setup lang="ts">
import {onMounted} from "vue";
import { initFlowbite } from 'flowbite'
import {Link,useForm} from "@inertiajs/vue3";

onMounted(() => {
    initFlowbite();
})
let form=useForm({

})
const logout=()=>{
    form.post(route('logout'),{
        onSuccess:()=>{
        }
    })
}
</script>

<template>

    <div class="sm:hidden flex justify-between gap-2 z-[100000] p-2 w-full bg-white shadow">
        <div>
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button">
                <svg class="fill-sky-700 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M424 392H23.1C10.8 392 0 402.8 0 415.1C0 429.2 10.8 440 23.1 440H424c13.2 0 24-10.8 24-23.1C448 402.8 437.2 392 424 392zM424 72H23.1C10.8 72 0 82.8 0 95.1S10.8 120 23.1 120H424c13.2 0 24-10.8 24-23.1S437.2 72 424 72zM424 232H23.1C10.8 232 0 242.8 0 256c0 13.2 10.8 24 23.1 24H424C437.2 280 448 269.2 448 256S437.2 232 424 232z"/>
                </svg>
            </button>
        </div>

        <div>
            <button class="flex gap-2 items-center"  data-dropdown-toggle="dropdownMenu">
                <span class="font-bold">{{$page.props.auth.name}}</span>
                <img :src="'/images/lady-smiling-on-call.jpg'" alt="Profile picture" class="h-10 rounded-full">
            </button>


            <!-- Dropdown menu -->
            <div id="dropdownMenu" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 divide-y" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <Link href="#" class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                        </Link>
                    </li>
                    <li>
                        <button @click="logout" class="block px-4 py-2 hover:bg-gray-100">
                            Logout
                        </button>
                    </li>


                </ul>
            </div>
        </div>

    </div>



    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white shadow-r-lg border-r" aria-label="Sidebar">
        <div class="h-full px-5 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <div class="my-3">
                <h1 class="font-bold text-lg ">MACHINE READING</h1>
            </div>
            <div class="my-5 bg-sky-50 rounded-xl p-2 ">
                <div class="flex gap-2 items-center border-b py-3 border-gray-300">
                    <div>
                        <img alt="User profile" :src="'/images/lady-smiling-on-call.jpg'" class="h-11 rounded-full">
                    </div>
                    <div>
                        <h6 class="font-bold text-sm">{{$page.props.auth.name}}</h6>
                        <Link :href="route('auth.editProfile')" class="text-sky-700 text-sm">Edit profile</Link>
                    </div>
                </div>
                <div class="py-3">
                    <h6 class="text-gray-600 font-medium text-sm">Role</h6>
                    <h2 class="text-xl font-black text-sky-700">{{$page.props.auth.role}}</h2>
                </div>
            </div>
            <ul class="space-y-2 font-medium pt-3 min-h-[45vh] border-b border-gray-300 text-sm">
                <li>
                    <Link :href="route('admin.index')" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M488 392H251.9C241.7 359.6 211.8 336 176 336s-65.69 23.62-75.93 56H24C10.75 392 0 402.7 0 416s10.75 24 24 24h76.07C110.3 472.4 140.2 496 176 496s65.69-23.62 75.93-56H488c13.25 0 24-10.75 24-24S501.3 392 488 392zM176 448c-17.64 0-32-14.36-32-32s14.36-32 32-32s32 14.36 32 32S193.6 448 176 448zM488 232h-76.07C401.7 199.6 371.8 176 336 176s-65.69 23.62-75.93 56H24C10.75 232 0 242.7 0 256s10.75 24 24 24h236.1C270.3 312.4 300.2 336 336 336s65.69-23.62 75.93-56H488C501.3 280 512 269.3 512 256S501.3 232 488 232zM336 288c-17.64 0-32-14.36-32-32s14.36-32 32-32s32 14.36 32 32S353.6 288 336 288zM24 120h108.1C142.3 152.4 172.2 176 208 176s65.69-23.62 75.93-56H488C501.3 120 512 109.3 512 96s-10.75-24-24-24h-204.1C273.7 39.62 243.8 16 208 16S142.3 39.62 132.1 72H24C10.75 72 0 82.75 0 96S10.75 120 24 120zM208 64c17.64 0 32 14.36 32 32s-14.36 32-32 32s-32-14.36-32-32S190.4 64 208 64z"/>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('products.index')" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/products/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/users/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M208 224h160C394.5 224 416 202.5 416 176v-128C416 21.49 394.5 0 368 0h-160C181.5 0 160 21.49 160 48v128C160 202.5 181.5 224 208 224zM208 48H256v64L288 96l32 16v-64h48v128h-160V48zM208 288h-160C21.49 288 0 309.5 0 336v128C0 490.5 21.49 512 48 512h160C234.5 512 256 490.5 256 464v-128C256 309.5 234.5 288 208 288zM208 464h-160v-128H96v64L128 384l32 16v-64h48V464zM528 288h-160C341.5 288 320 309.5 320 336v128c0 26.51 21.49 48 48 48h160c26.51 0 48-21.49 48-48v-128C576 309.5 554.5 288 528 288zM528 464h-160v-128H416v64l32-16l32 16v-64h48V464z"/>
                        </svg>
                        <span class="ml-3">Products</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('machines.index')" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/machines/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/users/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M232.1 256c0-8.75-7.188-16-15.94-16h-16C191.4 240 184.1 247.3 184.1 256l.0625 16c0 8.75 7.25 16 16 16h16c8.75 0 16-7.25 16-16L232.1 256zM168.1 304h-16c-8.75 0-16 7.25-16 16l-.0625 16c0 8.75 7.312 16 16.06 16h16c8.75 0 15.94-7.25 15.94-16L184.1 320C184.1 311.3 176.9 304 168.1 304zM264.1 304h-16c-8.75 0-16 7.25-16 16l-.0625 16c0 8.75 7.312 16 16.06 16h16c8.75 0 15.94-7.25 15.94-16l.0625-16C280.1 311.3 272.9 304 264.1 304zM136.1 256c0-8.75-7.188-16-15.94-16h-16C95.38 240 88.06 247.3 88.06 256l.0625 16c0 8.75 7.25 16 16 16h16c8.75 0 16-7.25 16-16L136.1 256zM511.3 378.8L487.9 215c-4.512-31.52-31.5-54.93-63.34-54.93l-224.4 .0566v-32L288.1 128.1c17.6 0 32.01-14.4 32.01-32V32c0-17.6-14.4-32-32-32h-224c-17.6 0-32 14.4-32 32v63.96c0 17.6 14.4 32 32 32L152.1 128v32L87.61 159.1C55.77 159.1 28.74 183.4 24.22 214.9l-23.58 164.6C.2168 382.5 0 385.5 0 388.5V480c0 17.67 14.33 32 31.1 32H479.1c17.67 0 31.1-14.33 31.1-32L512 387.9C512 384.8 511.7 381.8 511.3 378.8zM80.12 80v-32h191.1v32H80.12zM71.74 221.7C72.86 213.8 79.67 207.9 87.59 207.9l336.1 .0918c7.908 0 14.71 5.904 15.84 13.73L463.6 384H48.49L71.74 221.7zM464 464h-416v-32h416V464zM328.1 256c0-8.75-7.188-16-15.94-16h-16c-8.75 0-16.06 7.25-16.06 16l.0625 16c0 8.75 7.25 16 16 16h16c8.75 0 16-7.25 16-16L328.1 256zM408.1 240h-16c-8.75 0-16.06 7.25-16.06 16l.0625 16c0 8.75 7.25 16 16 16h16c8.75 0 16-7.25 16-16L424.1 256C424.1 247.3 416.9 240 408.1 240zM360.1 304h-16c-8.75 0-16 7.25-16 16l-.0625 16c0 8.75 7.312 16 16.06 16h16c8.75 0 15.94-7.25 15.94-16l.0625-16C376.1 311.3 368.9 304 360.1 304z"/>
                        </svg>
                        <span class="ml-3">Machines</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('shifts.index')" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/shifts/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/users/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M95.1 0c-53.02 0-96 42.98-96 96c0 18.95 5.671 36.5 15.15 51.38l145.9-121.6C143.9 9.914 121.2 0 95.1 0zM415.1 0c-25.19 0-47.93 9.914-65.06 25.79l145.9 121.6C506.3 132.5 511.1 114.9 511.1 96C511.1 42.98 469 0 415.1 0zM256 64C132.3 64 32 164.3 32 288c0 53.21 18.63 102 49.62 140.4l-42.59 42.59C34.34 475.7 32 481.9 32 488C32 500.8 42.3 512 56 512c6.141 0 12.28-2.344 16.97-7.031l42.59-42.59C153.1 493.4 202.8 512 256 512s102-18.63 140.4-49.62l42.59 42.59C443.7 509.7 449.9 512 456 512c13.71 0 24-11.21 24-24c0-6.141-2.344-12.28-7.031-16.97l-42.59-42.59c30.99-38.43 49.62-87.23 49.62-140.4C479.1 164.3 379.7 64 256 64zM256 464c-97.05 0-176-78.95-176-176S158.1 112 256 112s176 78.95 176 176S353 464 256 464zM280 292V184c0-13.25-10.75-24-24-24S232 170.8 232 184V304c0 7.562 3.563 14.66 9.594 19.19l64 48C309.9 374.4 314.1 376 319.1 376c13.2 0 24.02-10.66 24.02-23.98c0-7.297-3.315-14.5-9.597-19.2L280 292z"/>
                        </svg>
                        <span class="ml-3">Shifts</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('readings.index')" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/reading/index' }"
                    >

                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/reading/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path d="M80 256v64c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V256c0-17.67-14.33-32-32-32h-160C94.33 224 80 238.3 80 256zM365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 128h80C184.8 128 192 120.8 192 112S184.8 96 176 96H96C87.16 96 80 103.2 80 112S87.16 128 96 128zM96 192h80C184.8 192 192 184.8 192 176S184.8 160 176 160H96C87.16 160 80 167.2 80 176S87.16 192 96 192zM288 384h-80c-8.844 0-16 7.156-16 16s7.156 16 16 16H288c8.844 0 16-7.156 16-16S296.8 384 288 384z"/>
                        </svg>

                        <span class="ml-3">Readings</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.users.index')" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/users/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/users/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                           <path d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z"/>
                        </svg>

                        <span class="ml-3">Users</span>
                    </Link>
                </li>


            </ul>
            <div class="my-5">
                <ul class="space-y-2 font-medium pt-3 text-sm">
                    <li>
                        <Link href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group">
                            <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M504.1 315.1c0-8.652-4.607-16.84-12.36-21.39l-32.91-18.97C459.5 269.1 459.8 262.5 459.8 256s-.3228-13.1-.9683-19.62l32.91-18.97c7.752-4.548 12.36-12.74 12.36-21.39c0-21.27-49.32-128.2-84.52-128.2c-4.244 0-8.51 1.094-12.37 3.357l-32.78 18.97c-10.71-7.742-22.07-14.32-34.07-19.74V32.49c0-11.23-7.484-21.04-18.33-23.88C300.5 2.871 278.3 0 256 0C233.8 0 211.5 2.871 189.9 8.613C179.1 11.45 171.6 21.26 171.6 32.49v37.94c-12 5.42-23.36 12-34.07 19.74l-32.78-18.97C100.9 68.94 96.63 67.85 92.38 67.85c-.0025 0 .0025 0 0 0c-32.46 0-84.52 101.7-84.52 128.2c0 8.652 4.607 16.84 12.36 21.39l32.91 18.97C52.49 242.9 52.17 249.5 52.17 256s.3228 13.1 .9683 19.62L20.23 294.6C12.47 299.1 7.867 307.3 7.867 315.1c0 21.27 49.32 128.2 84.52 128.2c4.244 0 8.51-1.094 12.37-3.357l32.78-18.97c10.71 7.742 22.07 14.32 34.07 19.74v37.94c0 11.23 7.484 21.04 18.33 23.88C211.5 509.1 233.7 512 255.1 512c22.25 0 44.47-2.871 66.08-8.613c10.84-2.84 18.33-12.65 18.33-23.88v-37.94c12-5.42 23.36-12 34.07-19.74l32.78 18.97c3.855 2.264 8.123 3.357 12.37 3.357C452.1 444.2 504.1 342.4 504.1 315.1zM415.2 389.1l-43.66-25.26c-42.06 30.39-32.33 24.73-79.17 45.89v50.24c-13.29 2.341-25.58 3.18-36.44 3.18c-15.42 0-27.95-1.693-36.36-3.176v-50.24c-46.95-21.21-37.18-15.54-79.17-45.89l-43.64 25.25c-15.74-18.69-28.07-40.05-36.41-63.11L103.1 301.7C101.4 276.1 100.1 266.1 100.1 256c0-10.02 1.268-20.08 3.81-45.76L60.37 185.2C68.69 162.1 81.05 140.7 96.77 122l43.66 25.26c42.06-30.39 32.33-24.73 79.17-45.89V51.18c13.29-2.341 25.58-3.18 36.44-3.18c15.42 0 27.95 1.693 36.36 3.176v50.24c46.95 21.21 37.18 15.54 79.17 45.89l43.64-25.25c15.74 18.69 28.07 40.05 36.4 63.11L408 210.3c2.538 25.64 3.81 35.64 3.81 45.68c0 10.02-1.268 20.08-3.81 45.76l43.58 25.12C443.3 349.9 430.9 371.3 415.2 389.1zM256 159.1c-52.88 0-96 43.13-96 96S203.1 351.1 256 351.1s96-43.13 96-96S308.9 159.1 256 159.1zM256 304C229.5 304 208 282.5 208 256S229.5 208 256 208s48 21.53 48 48S282.5 304 256 304z"/>
                            </svg>

                            <span class="ml-3">Account Settings</span>
                        </Link>
                    </li>

                    <li>
                        <button @click="logout()" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group">

                            <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M312 336c6.156 0 12.28-2.344 16.97-7.031c9.375-9.375 9.375-24.56 0-33.94L81.94 48H192c13.25 0 24-10.75 24-24S205.3 0 192 0H24C10.75 0 0 10.75 0 24V192c0 13.25 10.75 24 24 24S48 205.3 48 192V81.94l247 247C299.7 333.7 305.8 336 312 336zM288 64c-13.25 0-24 10.75-24 24S274.8 112 288 112c97.03 0 176 78.97 176 176s-78.97 176-176 176S112 385 112 288c0-13.25-10.75-24-24-24S64 274.8 64 288c0 123.5 100.5 224 224 224s224-100.5 224-224S411.5 64 288 64z"/>
                            </svg>

                            <span class="ml-3">Logout</span>
                        </button>
                    </li>

                </ul>
            </div>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 bg-gray-50">
        <div class="hidden sm:block">
            <div class="flex justify-between">
                <div class="flex gap-3 items-center">
                    <img alt="Profile Picture" :src="'/images/lady-smiling-on-call.jpg'" class="h-12 rounded-full border border-white">
                    <h1 class="text-lg font-bold">Hello {{$page.props.auth.name}}, Welcome!</h1>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <button class="rounded-full h-10 w-10 bg-white flex
                items-center place-content-center border">

                            <svg class="h-5 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M439.4 362.3C420.1 341.5 383.9 310.2 383.9 208c0-77.75-54.38-139.9-127.9-155.1V32c0-17.62-14.38-32-32-32S192 14.38 192 32v20.88C118.5 68.12 64.13 130.2 64.13 208c0 102.2-36.25 133.5-55.5 154.3C2.625 368.8 0 376.5 0 384c.125 16.38 13 32 32.13 32h383.8c19.12 0 32-15.62 32.13-32C448 376.5 445.4 368.8 439.4 362.3zM67.5 368C88.75 340 112 293.6 112 208.6V208C112 146.1 162.1 96 224 96s112 50.12 112 112v.625C336 293.6 359.2 340 380.5 368H67.5zM223.1 512C259.4 512 288 483.4 288 448H160C160 483.4 188.6 512 223.1 512z"/>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <button class="btn-primary btn-medium">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
       <div class="pt-5">
           <slot></slot>
       </div>

    </div>

</template>

<style scoped>

</style>
