import { defineStore } from 'pinia'

export const useServicoStore = defineStore('servico', {
    state: () => {
        return { 
            dados: [] as number[]
        }
    },
    getters: {
        servicos: (state) => state.dados
    },
    actions: {
        seleciona(dados: number[]) {
            this.dados = dados
        }
    },
});
