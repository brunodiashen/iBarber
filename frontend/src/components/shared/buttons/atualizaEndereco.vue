<template>
    <button class="btn btn-primary" type="submit" @click.prevent="store.atualizar()">
        <span>Atualizar</span>
    </button>
</template>

<script setup lang="ts">
import { useEnderecoStore } from '@/stores/endereco'

const store = useEnderecoStore()
</script>