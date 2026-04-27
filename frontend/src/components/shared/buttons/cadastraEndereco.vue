<template>
    <button class="btn btn-primary" @click.prevent="store.cadastrar()">
        <span>Cadastrar</span>
    </button>
</template>

<script setup lang="ts">
import { useEnderecoStore } from '@/stores/endereco'
const store = useEnderecoStore()
    
</script>