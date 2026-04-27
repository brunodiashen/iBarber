<template>
    <auth title="Entrar">
        <form @submit.prevent="store.login()">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" v-model="store.usuario.email" class="form-control form-control-lg"
                placeholder="example@example.com" required />

            <label class="form-label mt-2" for="password">Senha</label>
            <input type="password" id="password" v-model="store.usuario.password" class="form-control form-control-lg"
                placeholder="********" required minlength="8" />

            <div class="mt-2">
                <forgetPassword :email="store.usuario.email" />
            </div>

            <div class="text-center mt-3">
                <button class="btn btn-primary" type="submit">
                    <span> Entrar </span>
                </button>
                <p class="mt-2">
                    Você não possui uma conta?
                    <router-link :to="Routes.Register"> Cadastrar </router-link>
                </p>
            </div>
        </form>
    </auth>
</template>

<script setup lang="ts">
import auth from '@/templates/auth.vue'
import forgetPassword from '@/components/shared/buttons/forgetPassword.vue'
import { Routes } from '@/core/enums'
import { useAuthStore } from '@/stores/auth'

const store = useAuthStore()
</script>