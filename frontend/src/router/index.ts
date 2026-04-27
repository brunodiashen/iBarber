import { createRouter, createWebHistory } from "vue-router";
import type { Router } from "vue-router";
import { authenticated } from '@/core/auth';
import { Routes } from '@/core/enums';
import { useClienteStore } from '@/stores/cliente';

const router: Router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
      {
        path: Routes.Home,
        name: 'Home',
        component: () => import('../views/Home.vue')
    },
    {
        path: Routes.Register,
        name: 'Register',
        component: () => import('../views/Register.vue')
    },
    {
        path: Routes.Login,
        name: 'Login',
        component: () => import('../views/Login.vue')
    },
    {
        path: Routes.Reset,
        name: 'Reset',
        component: () => import('../views/ResetPassword.vue')
    },
    {
        path: Routes.Usuario,
        name: 'Usuario',
        component: () => import('../views/Usuario.vue')
    },
    {
        path: Routes.Agenda,
        name: 'Agenda',
        component: () => import('../views/Agenda.vue')
    }
  ]
})

router.beforeEach((to): object | void => {
    if (!authenticated) {
        if (to.name != 'Login' &&
            to.name != 'Register' &&
            to.name != 'Reset')
            return { name: 'Login' }
    } else if (to.name == 'Agenda') {
        const clienteStore = useClienteStore()
        if (!clienteStore.cliente.barbeiro_id) {
            return { name: 'Home' }
        }
    } else if (
        to.name == 'Login' ||
        to.name == 'Register')
        return { name: 'Home' }
})

export default router