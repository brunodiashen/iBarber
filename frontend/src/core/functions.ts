import axios, { type AxiosResponse } from 'axios'

const busca = async (path: string, params?: any)
    : Promise<any | AxiosResponse> =>
    await axios.get(path, { params })

const cadastra = async (path: string, body: object)
    : Promise<true | void> =>
    await axios.post(path, body)

const edita = async (path: string, body: object)
    : Promise<true | void> =>
    await axios.put(path, body)

export { busca, cadastra, edita }