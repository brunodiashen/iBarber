<template>
    <div id="horarios">
        <div v-if="requestStore.pendente.data" class="row">
            <p v-if="possuiAgendamento">
                Você já possui horario agendado
            </p>
            <p v-else-if="HorarioStore.validaPassouLimitePendente()">
                Você atingiu o limite de solicitacoes
            </p>
            <p v-else-if="disponiveis.length == 0">
                Não existe mais horario disponivel para essa data
            </p>
            <div v-else v-for="(horario, i) in disponiveis" class="horario" :key="i">
                <horario :horario="horario" />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import horario from '../buttons/horario.vue'
import { computed, ref, watch } from 'vue'
import type { Barbeiro, Intervalo, Pendente } from '@/core/interfaces'
import { useBarbeiroStore } from '@/stores/barbeiro'
import { useHorarioStore } from '@/stores/horario'
import { useIntervaloStore } from '@/stores/intervalo'
import { useRequestStore } from '@/stores/request'

const requestStore = useRequestStore()
const barbeiroStore = useBarbeiroStore()
const HorarioStore = useHorarioStore()
const IntervaloStore = useIntervaloStore()

const disponiveis = ref<string[]>([])
const today: Date = new Date()

const barbeiro = computed(()
    : Barbeiro =>
    barbeiroStore.barbeiro
)
const possuiAgendamento = computed(()
    : boolean =>
    HorarioStore.agendados.length > 0
)
const confirmados = computed(()
    : Pendente[] => []
)
const intervalos = computed(()
    : Intervalo[] =>
    IntervaloStore.intervalos
)

watch((): string => requestStore.pendente.data,
    (): void => geraHorarios())
watch((): number => barbeiro.value.id,
    (): void => trocaBarbearia())

const trocaBarbearia = ()
    : void => {
        disponiveis.value = []
        setTimeout(geraHorarios, 1000);
    }

const geraHorarios = ()
    : void => {
    if (possuiAgendamento.value ||
        HorarioStore.validaPassouLimitePendente()) return;

    const horario_inicio = barbeiro.value.horario_inicio.slice(0, 5)
    const horario_fim = barbeiro.value.horario_fim.slice(0, 5)
    const horarios = [horario_inicio]
    let espaco = barbeiro.value.espaco
    let horario = horario_inicio
    let hora, minuto, newDate, removeHorario = null
    if (!requestStore.pendente.data) {
        return
    }
    while (horario < horario_fim) {
        newDate = new Date(new Date(requestStore.pendente.data.split('')[0] + 'T' + horario_inicio)
            .setMinutes(espaco))

        hora = newDate.getHours()
        if (hora < 10) hora = '0' + hora
        minuto = newDate.getMinutes()
        if (minuto < 10) minuto = '0' + minuto

        horario = hora + ':' + minuto
        confirmados.value.forEach(confirmado => {
            if (confirmado.data == requestStore.pendente.data + ' ' + horario + ':00') {
                removeHorario = true
            }
        });
        intervalos.value.forEach(intervalo => {
            if (horario >= intervalo.inicio && horario <= intervalo.fim) {
                removeHorario = true
            }
        })

        if (!removeHorario) {
            horarios.push(horario)
        } else {
            removeHorario = false
        }
        espaco += barbeiro.value.espaco
    }

    if (requestStore.pendente.today) {
        let hora = today.getHours()
        let horaAtual = `${hora < 10 ? '0' + hora : hora}:${today.getMinutes()}`
        disponiveis.value = horarios.filter(hora => horaAtual < hora)
    } else {
        disponiveis.value = horarios
    }
}
</script>

<style>
.horario {
    width: 70px;
}
</style>