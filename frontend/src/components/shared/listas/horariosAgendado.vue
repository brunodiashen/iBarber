<template>
    <ul class="list-group">
        <div class="text-center">
            <span class="text-success">Agendado: {{ store.agendados.length }}</span>
        </div>
        <li v-for="(dado, i) in store.agendados" :key="i">
            <div class="py-2">
                <strong>Salao: </strong> <br>
                {{ dado.nome }} <br>
                <strong>Horario: </strong> <br>
                {{ formaters.data(dado.data) }} <br>
                <strong>Servicos: </strong>
                <ul>
                    <li v-for="servico in dado.servicos"> 
                        {{ servico.tipo }}
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</template>

<script setup lang="ts">
import { formaters } from '@/core/helpers'
import { useHorarioStore } from '@/stores/horario'

const store = useHorarioStore()
store.buscaHorariosAgendado()
</script>