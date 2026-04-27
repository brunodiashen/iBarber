<template>
    <button class="btn btn-sm btn-danger text-right" 
        @click.prevent="store.desmarcaAgendamento(props.confirmar)">
        <span>Desmarcar horarios</span>
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