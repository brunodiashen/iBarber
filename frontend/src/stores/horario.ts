import { defineStore } from 'pinia'
import { busca, cadastra } from '@/core/functions'
import type { Agendado, Pendente } from '@/core/interfaces'
import { useNotificacaoStore } from './notificacao'
import { useBarbeiroStore } from './barbeiro'
import { useClienteStore } from './cliente'
import { useRequestStore } from './request'

const agendamentoPath: string = 'agendamento/cliente'
const pendentePath: string = 'pendente/me'
const servicosPath: string = 'pendente/servicos/'

export const useHorarioStore = defineStore('horario', {
    state: () => {
        return { 
            dadosPendentes: [] as Pendente[],
            dadosAgendados: [] as Agendado[],
            limite: 4 as number
        }
    },
    getters: {
        pendentes: (state) => state.dadosPendentes,
        agendados: (state) => state.dadosAgendados,
        requestStore: (state) => useRequestStore(),
        clienteStore: (state) => useClienteStore(),
        barbeiroStore: (state) => useBarbeiroStore(),
        notificacaoStore: (state) => useNotificacaoStore(),
    },
    actions: {
        buscaHorariosPendente() {
            busca(pendentePath)
                .then(resp => this.dadosPendentes = resp.data)
                .finally(() => {
                    this.dadosPendentes.forEach(dado => {
                        busca(servicosPath + dado.id)
                            .then(resp => dado.servicos = resp.data)
                    })
                })
        },
        buscaHorariosAgendado() {
            busca(agendamentoPath)
                .then(resp => this.dadosAgendados = resp.data)
                .finally(() => {
                    this.dadosAgendados.forEach(async dado => {
                        await busca(servicosPath + dado.pendente_id)
                            .then(resp => dado.servicos = resp.data)
                    })
                    if (this.dadosAgendados.length > 0) {
                        return this.notificacaoStore.setNotificacao({
                            text: 'Voce possui horario agendado',
                            color: 'bg-success'
                        })
                    }
                })
        },
        validaPassouLimitePendente() {
            let passou = this.dadosPendentes.length >= this.limite
            if (passou) {
                this.notificacaoStore.setNotificacao({
                    text: 'Voce atingiu o limite maximo de solicitacoes',
                    color: 'bg-warning'
                })
            }
            return passou
        },
        cadastraHorarioPendente() {
            if (this.dadosAgendados.length) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Voce ja possui horario agendado',
                    color: 'bg-warning'
                })
            } else if (!this.requestStore.pendente.data) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor selecione o dia e horario que deseja',
                    color: 'bg-warning'
                })
            } else if (this.requestStore.pendente.servico_id.length == 0) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Por favor selecione os servicos que deseja',
                    color: 'bg-warning'
                })
            }
            cadastra('pendente', this.requestStore.pendente)
                .then(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Horario solicitado com sucesso',
                        color: 'bg-success'
                    })
                    this.buscaHorariosPendente()
                }).catch(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao solicitar o horario',
                        color: 'bg-danger'
                    })
                })
        },
        cadastraHorarioPendenteSemAgenda() {
            if (this.dadosAgendados.length > 0) {
                return this.notificacaoStore.setNotificacao({
                    text: 'Voce ja possui horario agendado',
                    color: 'bg-warning'
                })
            }
            const body = {
                cliente_id: this.clienteStore.cliente.id,
                barbeiro_id: this.barbeiroStore.barbeiro.id
            }
            cadastra('pendente', body)
                .then(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Horario solicitado com sucesso',
                        color: 'bg-success'
                    })
                    this.buscaHorariosPendente()
                }).catch(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao solicitar o horario',
                        color: 'bg-danger'
                    })
                })
        }
    },
});
