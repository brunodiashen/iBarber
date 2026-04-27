<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="servico in barbeiroStore.barbeiro.servicos" :key="servico.id">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" v-model="requestStore.pendente.servico_id" 
                    :value="servico.id" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{ servico.tipo }} - R${{ servico.preco }}
                </label>
            </div>
        </li>
    </ul>
</template>

<script setup lang="ts">
import { useRequestStore } from '@/stores/request'
import { useBarbeiroStore } from '@/stores/barbeiro'

const requestStore = useRequestStore()
const barbeiroStore = useBarbeiroStore()

</script>

<style scoped>
</style>