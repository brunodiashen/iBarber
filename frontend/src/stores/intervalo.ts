import { defineStore } from 'pinia'
import { busca } from '@/core/functions'
import type { Barbeiro, Intervalo } from '@/core/interfaces'

const path: string = 'intervalo/barbearia/'

export const useIntervaloStore = defineStore('intervalo', {
    state: () => {
        return { 
            dados: [] as Intervalo[]
        }
    },
    getters: {
        intervalos: (state) => state.dados
    },
    actions: {
        buscar(barbeiro: Barbeiro) {
            busca(path + barbeiro.id).then(resp => {
                this.dados = resp.data
            })
        },
    },
});
