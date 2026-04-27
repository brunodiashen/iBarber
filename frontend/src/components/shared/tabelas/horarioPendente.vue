<template>
    <div class="col-md-12">
        <div class="row my-3">
            <div class="col-12">
                <h4>Horarios pendente</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                <p><strong>Filtro: </strong></p>
            </div>
            <div class="col-3 input-group-sm">
                <input class="form-control input-sm" type="text" name="filtro" 
                    id="filtro" v-model="filtro" />
            </div>
            <div class="col-8 text-end pe-3">
                <span class="pe-2"><strong>Total: </strong>{{ pendentes.length }}</span>
                <confirmaHorario :confirmar="selected"/>
            </div>
        </div>
        <div class="table-responsive" style="height: 300px; overflow-y: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            <input class="form-check-input ms-1" name="selectAll" type="checkbox" 
                                value="" id="flexCheckChecked" v-model="selectAll" @click="getAll"/>
                        </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Informacoes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cliente in pendentes" :key="cliente.id">
                        <td>
                            <input class="form-check-input" type="checkbox" v-model="selected"
                                :value="cliente.id" id="flexCheckChecked" :checked="selectAll">
                        </td>
                        <td>{{ cliente.name }}</td>
                        <td>{{ formataData(cliente.data)}}</td>
                        <td>
                            <a class="dropdown-toggle" type="button" id="info-cliente" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="../../../assets/imgs/info.png" alt="info" style="width: 20px;" />
                            </a>
                            <ul class="dropdown-menu p-2" aria-labelledby="info-cliente">
                                <p> 
                                    <strong>Email: </strong> <br> 
                                    {{ cliente.email }} 
                                </p> 
                                <p> 
                                    <strong>Telefone: </strong> <br> 
                                    <a :href="'https://api.whatsapp.com/send?phone='+cliente.telefone
                                        +'&text=Ola!%20Tudo%20bem?%20estou%20entrando%20em%20contato%20para%20falar%20do%20horario%20'+formataData(cliente.data)" target="_blank">
                                        {{ cliente.telefone }}
                                    </a>
                                </p>
                                <strong>Servicos:</strong>
                                <ul>
                                    <li v-for="servico in cliente.servicos" :key="servico.id">
                                        {{ servico.tipo }}
                                    </li>
                                </ul>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import confirmaHorario from "../buttons/confirmaHorario.vue"
import { useAgendaStore } from '@/stores/agenda'
import type { Solicitacao } from '@/core/interfaces'

const store = useAgendaStore()
store.buscaHorariosPendente()

const selectAll = ref<boolean>(false)
const selected = ref<number[]>([])
const filtro = ref<string>('')

watch(() => filtro.value, () => {
    selectAll.value = false
    selected.value = []
})

const pendentes = computed(()
    : Solicitacao[] =>
    store.pendentes.filter(pendente => {
        if (filtro.value) {
            return formataData(pendente.data).includes(filtro.value) 
                || pendente.name.includes(filtro.value)
                || pendente.email.includes(filtro.value)
                || pendente.telefone.includes(filtro.value)
        }
        return pendente
    })
)

function getAll() {
    selected.value = []
    if (!selectAll.value) {
        pendentes.value.forEach(pendente => {
            selected.value.push(pendente.id)
        })
    }
}

function formataData(data: string): string {
    let separado = data.split(' ') 
    let horario = separado[1]
    let formatado = separado[0].split('-').reverse().join('.')
    return formatado + ' ' + horario.slice(0, 5)
}

</script>

<style scoped>
.dropdown-toggle::after {
    display:none;
}
</style>