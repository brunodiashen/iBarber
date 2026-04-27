import { defineStore } from 'pinia'
import { busca, cadastra } from '@/core/functions'
import type { Agendado, AgendamentoRequest, Solicitacao } from '@/core/interfaces'
import { useNotificacaoStore } from './notificacao'
import { useClienteStore } from './cliente'

const agendamentoPath: string = 'agendamento/barbeiro'
const pendentePath: string = 'pendente/barbeiro'

export const useAgendaStore = defineStore('agenda', {
    state: () => {
        return { 
            dadosPendentes: [] as Solicitacao[],
            dadosAgendados: [] as Agendado[],
        }
    },
    getters: {
        pendentes: (state) => state.dadosPendentes,
        agendados: (state) => state.dadosAgendados,
        clienteStore: (state) => useClienteStore(),
        notificacaoStore: (state) => useNotificacaoStore()
    },
    actions: {
        buscaHorariosPendente() {
            busca(pendentePath)
                .then(resp => this.dadosPendentes = resp.data)
        },
        buscaHorariosAgendado() {
            busca(agendamentoPath)
                .then(resp => this.dadosAgendados = resp.data)
        },
        cadastraAgendamento(confirmar: number[]) {
            if(confirmar.length === 0) return false
            const confirmados: AgendamentoRequest[] = []
            this.dadosPendentes.filter(pendente => {
                if (confirmar.includes(pendente.id)) {
                    confirmados.push({
                        barbeiro_id: pendente.barbeiro_id,
                        cliente_id: pendente.cliente_id,
                        pendente_id: pendente.id
                    })
                }
            })
            cadastra('agendamento', confirmados)
                .then(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Horarios agendado com sucesso',
                        color: 'bg-success'
                    })
                    this.buscaHorariosAgendado()
                    this.buscaHorariosPendente()
                }).catch(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao tentar agendar os horarios',
                        color: 'bg-danger'
                    })
                })
        },
        desmarcaAgendamento(confirmar: number[]) {
            if(confirmar.length === 0) return false
            const confirmados: AgendamentoRequest[] = []
            this.dadosAgendados.filter(agendado => {
                if (confirmar.includes(agendado.id)) {
                    confirmados.push({
                        pendente_id: agendado.pendente_id,
                        cliente_id: agendado.cliente_id,
                        barbeiro_id: this.clienteStore.cliente.barbeiro_id
                    })
                }
            })
            cadastra('agendamento/desmarca/', confirmados)
                .then(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Horarios desmarcados com sucesso',
                        color: 'bg-success'
                    })
                    this.buscaHorariosAgendado()
                    this.buscaHorariosPendente()
                }).catch(() => {
                    this.notificacaoStore.setNotificacao({
                        text: 'Ocorreu um erro ao desmarcar os horarios',
                        color: 'bg-danger'
                    })
                })
        }
    },
});
