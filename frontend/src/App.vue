<template>
	<div id="app">
		<Navbar v-if="checkAutenticated() && store.cliente.id" />
		<notificacao />
		<router-view />
	</div>
</template>

<script setup lang="ts">
import Navbar from './components/Navbar.vue'
import notificacao from "@/components/shared/notificacao.vue"
import { authenticated } from './core/auth'
import { useClienteStore } from '@/stores/cliente'
import { onMounted } from 'vue'
import { usuario } from '@/core/auth'

const store = useClienteStore()
const checkAutenticated = (): boolean => authenticated
onMounted(() => {
	if (authenticated) {
		usuario()
		store.buscar()
	}
})

</script>

<style>
body {
	overflow-x: hidden
}
</style>