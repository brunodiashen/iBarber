<template>
    <a href="#"> Esqueceu sua senha? </a>
</template>

<script setup lang="ts">
import { forgetPassword } from '@/core/auth'

const props = defineProps({
    email: {
        type: String,
        default: ''
    }
})

</script>