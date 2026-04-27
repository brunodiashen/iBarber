<template>
    <ul class="list-group" style="width: 220px;">
        <div>
            <span class="text-primary text-center">Solicitado: {{ store.pendentes.length }}</span>
            <li v-for="(dado, i) in store.pendentes" :key="i">
                <div class="mx-3 pb-1 border-bottom border-2">
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
import { useHorarioStore } from '@/stores/horario'

const store = useHorarioStore()
store.buscaHorariosPendente()

</script>

<style>
.horario-pendente {
    width: 20px;
    height: 20px;
    background-color: orange;
}
</style>