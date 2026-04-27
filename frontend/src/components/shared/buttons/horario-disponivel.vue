<template>
    <button type="button" class="btn btn-sm" :class="atual" href="#dias" 
        v-smooth-scroll @click="seleciona">
        Horarios disponiveis
    </button>
</template>

<script setup lang="ts">
import type { Barbeiro } from "@/core/interfaces"
import { useBarbeiroStore } from "@/stores/barbeiro"
import { useHorarioStore } from "@/stores/horario"
import { useIntervaloStore } from "@/stores/intervalo"
import { useRequestStore } from "@/stores/request"
import { computed } from "vue"

const barbeiroStore = useBarbeiroStore()
const intervaloStore = useIntervaloStore()
const requestStore = useRequestStore()
const horarioStore = useHorarioStore()

const props = defineProps({
    options: {
        type: Object,
        required: true
    }
})

const atual = computed(()
    : string =>
    props.options.id == barbeiroStore.barbeiro.id
        ? 'bg-dark text-white'
        : 'btn-outline-dark'
)

const seleciona = () => {
    const modify = requestStore.pendente
    if (!horarioStore.validaPassouLimitePendente()) {
        barbeiroStore.seleciona(<Barbeiro>props.options)
        intervaloStore.buscar(barbeiroStore.barbeiro)
        modify.barbeiro_id = props.options.id
        modify.servico_id = []
        requestStore.setPendenteRequest(modify)
    }
}
</script>