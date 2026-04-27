import { defineStore } from 'pinia'
import type { PendenteRequest } from '@/core/interfaces'

export const useRequestStore = defineStore('request', {
    state: () => {
        return { 
            pendenteRequest: {} as PendenteRequest
        }
    },
    getters: {
        pendente: (state) => state.pendenteRequest
    },
    actions: {
        setPendenteRequest(dado: PendenteRequest) {
            this.pendenteRequest = dado
        },
        setServicosSelecionado(dados: number[]) {
            this.pendenteRequest.servico_id = dados
        }
    },
});
