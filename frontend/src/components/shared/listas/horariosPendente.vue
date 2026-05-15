<template>
    <ul class="list-group">
        <div class="text-center">
            <span class="text-primary">Solicitado: {{ store.pendentes.length }}</span>
        </div>
        <li v-for="(dado, i) in store.pendentes" :key="i">
            <div class="py-2 border-bottom border-2">
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
store.buscaHorariosPendente()
</script>
