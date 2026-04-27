<template>
    <button class="btn mb-2 horario" :disabled="disabled" 
        @click="request" :class="corBotao">
        <span> {{ horario }} </span>
    </button>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { Barbeiro, PendenteRequest } from '@/core/interfaces'
import { useRequestStore } from '@/stores/request'
import { useBarbeiroStore } from '@/stores/barbeiro'
import { useHorarioStore } from '@/stores/horario'

const horarioStore = useHorarioStore()
const barbeiroStore = useBarbeiroStore()
const requestStore = useRequestStore()

const props = defineProps({
    horario: {
        type: String,
        required: true
    }
})
const barbeiro = computed(()
    : Barbeiro =>
    barbeiroStore.barbeiro
)
const pendente = computed(()
    : PendenteRequest =>
    requestStore.pendente
)
const disabled = computed(()
    : boolean =>
    horarioStore.agendados.length > 0
    || horarioStore.pendentes.some(horario => {
        return horario.barbeiro_id == barbeiro.value.id
            && horario.data.includes(props.horario)
            && horario.data.includes(pendente.value.data.split(' ')[0])
    })
)

const selecionado = computed(()
    : boolean => 
    pendente.value.data.split(' ')[1] == props.horario + ':00'
)

const corBotao = computed(()
    : string => {
    if (disabled.value) {
        return 'btn-secondary'
    } else if (selecionado.value) {
        return 'btn-primary'
    }
    return 'btn-light'
})

function request() {
    const fullData = pendente.value.data.split(' ')
    const data = fullData[0]
    pendente.value.data = data + ' ' + props.horario + ':00'
    requestStore.setPendenteRequest(pendente.value)
}
</script>

<style scoped>
.horario {
    width: 65px;
}
</style>
