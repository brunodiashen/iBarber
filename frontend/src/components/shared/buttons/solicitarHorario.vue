<template>
    <button type="button" class="btn btn-sm btn-dark" 
        @click="store.cadastraHorarioPendenteSemAgenda()">
        <span>Solicitar horario</span>
    </button>
</template>

<script setup lang="ts">
import { useHorarioStore } from '@/stores/horario';

const store = useHorarioStore()

</script>