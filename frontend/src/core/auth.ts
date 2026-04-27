import axios from "axios";
import { Routes } from "./enums";
import { keytoken } from "./config";

const key_token: string = btoa(keytoken);

const gettoken = ()
    : string =>
    'Bearer ' + localStorage.getItem(key_token);

const setToken = (token: string)
    : void =>
    localStorage.setItem(key_token, token);

const isAutenticated = ()
    : boolean =>
    localStorage.getItem(key_token) != null;

const authenticated: boolean = isAutenticated();

const usuario = ()
    : Promise<true | void> =>
    axios.get('user')
        .then(resp => !resp.data
            ? logout()
            : true)
        .catch(() => logout())

const logout = ()
    : void => {
    localStorage.clear()
    window.location.replace(Routes.Login)
}

const forgetPassword = (email: string)
    : Promise<true | void> =>
    axios.post('forgetpassword', { email })

// const validaTokenReset = (id: string, token: string)
//     : Promise<true | void> =>
//     axios.post('reset/token', { token, id })
//         .then(resp => !resp.data
//             ? logout()
//             : store.dispatch(Actions.alteraUsuario, resp.data))
//         .catch(() => logout())

const resetPassword = (body: object)
    : Promise<true | void> =>
    axios.post('reset', body)
        .then(resp => !resp.data
            ? logout()
            : window.location.replace(Routes.Login))
        .catch(() => logout())

const action = (path: string, body: object)
    : Promise<true | void> =>
    axios.post(path, body)
        .then(resp => {
            if (resp.data.token) {
                setToken(resp.data.token)
                if (isAutenticated())
                    window.location.replace(Routes.Home)
            }
        })
        .finally(() => console.clear())

export {
    gettoken, authenticated,
    action, usuario, logout, resetPassword,
    forgetPassword
}