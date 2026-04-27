<template>
    <ul class="list-group">
        <div>
            <span class="text-success text-center">Agendado: {{ store.agendados.length }}</span>
            <li v-for="(dado, i) in store.agendados" :key="i">
                <div class="p-2">
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
        </div>
    </ul>
</template>

<script setup lang="ts">
import { formaters } from '@/core/helpers'
import { useHorarioStore } from '@/stores/horario';
const store = useHorarioStore()
store.buscaHorariosAgendado()
</script>