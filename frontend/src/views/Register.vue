<template>
    <auth title="Cadastre-se">
        <form @submit.prevent="store.registrar()">
            <label class="form-label" for="name">Nome</label>
            <input type="text" id="name" v-model="store.usuario.name" class="form-control form-control-lg"
                placeholder="Digite seu nome" required minlength="5" />

            <label class="form-label mt-2" for="email">Email</label>
            <input type="email" id="email" v-model="store.usuario.email" class="form-control form-control-lg"
                placeholder="example@example.com" required />

            <label class="form-label mt-2" for="password">Senha</label>
            <input type="password" id="password" v-model="store.usuario.password" class="form-control form-control-lg"
                placeholder="********" required minlength="8" />

            <div class="text-center mt-3">
                <button class="btn btn-primary" type="submit">
                    <span> Cadastrar </span>
                </button>
                <p class="mt-2">
                    Já possui uma conta?
                    <router-link :to="Routes.Login"> Entrar </router-link>
                </p>
            </div>
        </form>
    </auth>
</template>

<script setup lang="ts">
import auth from '@/templates/auth.vue'
import { Routes } from '@/core/enums'
import { useAuthStore } from '@/stores/auth'
const store = useAuthStore()
</script>