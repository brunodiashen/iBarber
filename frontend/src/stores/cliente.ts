import { defineStore } from 'pinia'
import { busca } from '@/core/functions'
import type { Cliente } from '@/core/interfaces'
import { useRequestStore } from './request'

const path: string = 'cliente/me'

export const useClienteStore = defineStore('cliente', {
    state: () => {
        return { 
            dado: {} as Cliente
        }
    },
    getters: {
        cliente: (state) => state.dado,
        requestStore: (state) => useRequestStore()
    },
    actions: {
        buscar() {
            busca(path).then(resp => {
                this.dado = resp.data
                this.requestStore.pendenteRequest.cliente_id = resp.data.id
            })
        },
    },
});
