export interface Endereco {
    id: number,
    estado: string,
    cidade: string,
    bairro: string,
    rua: string,
    numero: number,
    cep: string,
    telefone: string
}

export interface Cliente {
    id: number,
    nome: string,
    email: string,
    endereco_id: number,
    user_id: number,
    barbeiro_id: number,
    created_at: Date,
    updated_at: Date
}

export interface Barbeiro {
    id: number,
    nome: string,
    email: string,
    endereco_id: number,
    user_id: number,
    horario_inicio: string,
    horario_fim: string,
    servicos: Servico[],
    espaco: number,
    created_at: Date,
    updated_at: Date
}

export interface Pendente {
    id: number,
    data: string,
    cliente_id: number,
    barbeiro_id: number,
    created_at: Date,
    updated_at: Date,
    nome: string,
    servicos?: PendenteServicoRequest[]
}

export interface Solicitacao {
    id: number,
    data: string,
    name: string,
    email: string,
    telefone: string,
    cliente_id: number,
    barbeiro_id: number,
    servicos?: Servico[]
}

export interface Agenda {
    pendentes: Solicitacao[],
    agendados: Agendado[],
}

export interface Agendamento {
    id: number,
    pendente_id: number
    created_at: Date,
    updated_at: Date,
    data: string
}

export interface Agendado {
    id: number,
    pendente_id: number,
    cliente_id: number,
    data: string,
    name: string,
    nome: string,
    email: string,
    telefone: string,
    servicos?: PendenteServicoRequest[]
}

export interface Horarios {
    pendentes: Pendente[],
    agendados: Agendado[],
    limite: number
}

export interface Usuario {
    id: number,
    name: string,
    email: string,
    token: string,
    password?: string
}

export interface Intervalo {
    inicio: string,
    fim: string,
    user_id: number
}

export interface Servico {
    id: number,
    tipo: string,
    preco: string,
    duracao: string,
    barbeiro_id: number
}

export interface Notificacao {
    text: string,
    color: string,
    img?: string,
    show?: boolean,
}

export interface Bus {
    emit: Function,
    on: Function
}

export interface AgendamentoRequest {
    barbeiro_id: number,
    cliente_id: number,
    pendente_id: number
}

export interface PendenteRequest {
    id: number,
    data: string,
    today?: boolean,
    cliente_id: number,
    barbeiro_id: number,
    servico_id: number[],
    created_at: Date,
    updated_at: Date,
    nome: string
}

export interface PendenteServicoRequest {
    id: number,
    pendente_id: number,
    servico_id: number,
    tipo: string
}