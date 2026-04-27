import { defineStore } from 'pinia'
import type { Notificacao } from '@/core/interfaces'

export const useNotificacaoStore = defineStore('notificacao', {
    state: () => {
        return { 
            dado: {} as Notificacao
        }
    },
    getters: {
        notificacao: (state) => state.dado
    },
    actions: {
        setNotificacao(dado: Notificacao) {
            this.dado = dado
            this.dado.show = true
            setTimeout(() => this.dado = {text: '',color: '',img: '',show: false}, 4000)
        }
    },
});
