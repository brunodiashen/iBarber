<template>
    <button class="btn btn-primary" 
        @click="store.cadastraHorarioPendente()">
        Solicitar
    </button>
</template>

<script setup lang="ts">
import { useHorarioStore } from '@/stores/horario';

const store = useHorarioStore()
</script>