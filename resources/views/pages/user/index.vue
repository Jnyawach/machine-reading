<script setup lang="ts">
import {onMounted} from "vue";
import { initFlowbite } from 'flowbite'
import {Head} from "@inertiajs/vue3";
import User from "@/views/layouts/user.vue";

onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
  <user>

  </user>

</template>

<style scoped>

</style>
