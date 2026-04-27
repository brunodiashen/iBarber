<template>
    <div id="barbeiros" class="py-5">
        <div class="text-center">
            <label for="cidades"><strong>Cidades: </strong></label>
            <select class="ms-2 mb-2" name="cidades" id="cidades" 
                v-model="cidade" @change="store.buscar(cidade)">
                <option v-for="cidade in cidades" :value="cidade.cidade">
                    {{ cidade.cidade }}
                </option>
            </select>
        </div>
        <div class="esteira" v-if="store.barbeiros.length > 0">
            <card v-for="(barbeiro, i) in store.barbeiros" :key="i" 
                :options="barbeiro" class="mx-2"/>
        </div>
        <div v-else class="text-center h4">
            <p v-if="!clienteStore.cliente.id">
                Para mostrar as barbearias por favor <br>
                cadastre seu endereco no formulario clicando no botao a baixo <br>
                <button class="btn btn-primary mt-3" 
                    @click="router.push(Routes.Usuario)">
                    Cadastrar endereco
                </button>
            </p>
            <p v-else>
                Ainda não temos barbearias disponiveis na sua cidade
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue'
import { useRouter, type Router } from 'vue-router'
import card from './shared/cards/barbeiro.vue'
import { useBarbeiroStore } from '@/stores/barbeiro'
import { useClienteStore } from '@/stores/cliente'
import { Routes } from '@/core/enums'
import type { Endereco } from '@/core/interfaces'

const clienteStore = useClienteStore()
const store = useBarbeiroStore()
const router: Router = useRouter()

const cidades = computed((): Endereco[] => store.cidades)
const cidade = ref('Todas')

store.buscar()
store.buscaCidades()
</script>

<style scoped lang="css">
button:hover {
    background-color: #555;
    border-radius: 10px;
}
.esteira {
    display: flex;
    overflow-x: auto;
}
</style>