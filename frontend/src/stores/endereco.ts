import { defineStore } from 'pinia'
import { busca, cadastra, edita } from '@/core/functions'
import type { Endereco } from '@/core/interfaces'
import { useNotificacaoStore } from './notificacao'
import { useClienteStore } from './cliente'

const path: string = 'endereco/me'

export const useEnderecoStore = defineStore('endereco', {
    state: () => {
        return { 
            dado: {} as Endereco
        }
    },
    getters: {
        endereco: (state) => state.dado,
        notificacaoStore: (state) => useNotificacaoStore(),
        clienteStore: (state) => useClienteStore()
    },
    actions: {
        buscar() {
            busca(path).then(resp => {
                if (resp.data) {
                    this.dado = resp.data
                }
            })
        },
        cadastrar() {
            if(!this.validate()) {
                return false
            }
            cadastra('cliente', this.dado)
                .then(resp => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Endereco cadastrado com sucesso',
                        color: 'bg-success'
                    })
                    this.clienteStore.buscar()
                }).catch(err => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao cadastrar o endereco',
                        color: 'bg-danger'
                    })
                })
        },
        atualizar() {
            if(!this.validate()) {
                return false
            }
            edita('endereco', this.dado)
                .then(resp => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Endereco atualizado com sucesso',
                        color: 'bg-success'
                    })
                    this.clienteStore.buscar()
                }).catch(err => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao atualizado o endereco',
                        color: 'bg-danger'
                    })
                })
        },
        validate() {
            if (!this.dado.bairro || this.dado.bairro.length > 30 ||
                !this.dado.cep    || this.dado.cep.length < 8 ||
                !this.dado.cidade || this.dado.cidade.length > 30 ||
                !this.dado.estado || this.dado.estado.length < 2 ||
                !this.dado.rua || this.dado.rua.length > 30 ||
                !this.dado.numero ||
                !this.dado.telefone || this.dado.telefone.length < 10
            ) {
                this.notificacaoStore.setNotificacao({
                    text: 'Por favor preencha todos os campos',
                    color: 'bg-danger'
                })
                return false
            }
            return true
        }
    },
});
