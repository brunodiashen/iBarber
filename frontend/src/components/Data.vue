<template>
    <div v-if="barbeiro" id="dias">
        <div class="bg-dark py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <DatePicker class="etapa" v-model="date" :min-date="new Date()" 
                            @dayclick="selected" color="blue"/>
                    </div>
                    <div class="col-lg-4 my-4">
                        <servicos class="etapa mx-auto"/>
                    </div>
                    <div class="col-lg-4">
                        <listagem class="etapa mx-auto"/>
                    </div>
                    <div class="col-12 my-5 text-center">
                        <solicitarServico class="etapa"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { DatePicker } from 'v-calendar';
import 'v-calendar/style.css';
import listagem from './shared/listas/horarios.vue'
import servicos from './shared/servicos.vue'
import { computed, ref } from 'vue'
import solicitarServico from './shared/buttons/solicitarServico.vue';
import { useBarbeiroStore } from '@/stores/barbeiro';
import { useRequestStore } from '@/stores/request';
import type { PendenteRequest } from '@/core/interfaces';

const requestStore = useRequestStore()
const store = useBarbeiroStore()
const date = ref(null);

const barbeiro = computed(()
    : number =>
    store.barbeiro.id
)
const pendente = computed(()
    :PendenteRequest =>
    requestStore.pendente)

const selected = (e: any)
    : void => {
    if (!e.isDisabled) {
        let fulldate = e.id
        if (pendente.value.data) {
            let lista = pendente.value.data.split(' ')
            if (lista.length > 1) {
                fulldate = e.id + ' ' + lista[1]
            }
        }
        pendente.value.data = fulldate
        pendente.value.today = e.isToday
        requestStore.setPendenteRequest(pendente.value)
    }
}

</script>

<style>
.etapa {
    width: 350px;
}
</style>