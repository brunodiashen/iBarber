<template>
    <img src="../assets/imgs/user-default.png" alt="profilepicture" @click="router.push(Routes.Usuario)">
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
import type { Router } from 'vue-router'
import { Routes } from '@/core/enums'

const router: Router = useRouter()

</script>

<style scoped>
img {
    cursor: pointer;
}
</style>