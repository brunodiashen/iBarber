import { defineStore } from 'pinia'
import { busca } from '@/core/functions'
import type { Barbeiro, Endereco } from '@/core/interfaces'

const path: string = 'barbeiro'
const allCities = 'Todas'

export const useBarbeiroStore = defineStore('barbeiro', {
    state: () => {
        return { 
            dados: [] as Barbeiro[],
            dado: {} as Barbeiro,
            cidadesSelect: [] as Endereco[]
        }
    },
    getters: {
        barbeiros: (state) => state.dados,
        barbeiro: (state) => state.dado,
        cidades: (state) => state.cidadesSelect
    },
    actions: {
        buscar(cidade?: string) {
            if (cidade == allCities) {
                cidade = ''
            }
            busca(path, { cidade }).then(resp => 
                this.dados = resp.data)
        },
        seleciona(dado: Barbeiro) {
            this.dado = dado
        },
        buscaCidades() {
            busca(path + '/cidades').then(resp => {
                this.cidadesSelect = resp.data
                this.cidadesSelect.push({
                    id: 0,
                    estado: '',
                    cidade: 'Todas',
                    bairro: '',
                    rua: '',
                    numero: 0,
                    cep: '',
                    telefone: ''
                })
            })
        }
    },
});
