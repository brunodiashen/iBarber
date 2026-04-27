import { defineStore } from 'pinia'
import { action } from '@/core/auth'
import type { Usuario } from '@/core/interfaces'
import { useNotificacaoStore } from './notificacao'

export const useAuthStore = defineStore('auth', {
    state: () => {
        return { 
            dado: {} as Usuario,
            notificacaoStore: useNotificacaoStore()
        }
    },
    getters: {
        usuario: (state) => state.dado
    },
    actions: {
        login() {
            if (!this.dado.email) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor preencha o campo email',
                    color: 'bg-warning'
                })
            } else if (!this.dado.password) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor preencha o campo senha',
                    color: 'bg-warning'
                })
            }
            action('/login', this.dado)
                .catch(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao efetuar o login, verifique seu email e senha',
                        color: 'bg-danger'
                    })
                })
        },
        registrar() {
            if (!this.dado.name) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor preencha o campo nome',
                    color: 'bg-warning'
                })
            } else if (!this.dado.email) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor preencha o campo email',
                    color: 'bg-warning'
                })
            } else if (!this.dado.password) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor preencha o campo senha',
                    color: 'bg-warning'
                })
            }
            action('/register', this.dado)
                .catch(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao efetuar o cadastro, verifique as informacoes',
                        color: 'bg-danger'
                    })
                })
        }
    },
});
