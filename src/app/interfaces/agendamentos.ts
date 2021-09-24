export interface Agendamentos {
    error: string,
    result: {
        id: number,
        data: string,
        consultor: { id: number, nome: string, email: string },
        servico: { id: number, descricao: string },
        email_cliente: string
    }
}