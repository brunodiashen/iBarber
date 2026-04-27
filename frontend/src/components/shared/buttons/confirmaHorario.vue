<template>
    <button class="btn btn-sm btn-success text-right" 
        @click.prevent="store.cadastraAgendamento(props.confirmar)">
        <span>Confirmar horarios</span>
    </button>
</template>

<script setup lang="ts">
import { useAgendaStore } from '@/stores/agenda';

const store = useAgendaStore()
const props = defineProps({
    confirmar: {
        type: Array<number>,
        default: []
    }
})
</script>