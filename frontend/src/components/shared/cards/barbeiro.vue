<template>
    <div class="card">
        <img src="@/assets/imgs/card/padrao.jpg" />
        <div class="card-body">
            <div>
                <p class="text-center">
                    <strong>{{ options.nome }}</strong>
                </p>
                <p>
                    <strong>{{ options.cidade }}</strong>
                    <br>
                    {{ options.bairro }} -
                    {{ options.rua }} -
                    {{ options.numero }}
                </p>
                <strong>Servicos:</strong>
                <ul>
                    <li v-for="servico in options.servicos" :key="servico.id">
                        {{ servico.tipo }} - R${{ servico.preco }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-footer bg-transparent">
            <div class="text-center">
                <!-- land Page da barbearia -->
                <!-- <button class="btn btn-sm btn-outline-dark mb-2">
                    Mais informacoes
                </button> -->
                <solicitarHorario v-if="options.semAgenda" :barbeiro="options.id" />
                <horarioDisponivel v-else :options="options" />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import horarioDisponivel from '../buttons/horario-disponivel.vue'
import solicitarHorario from '../buttons/solicitarHorario.vue'

defineProps({
    options: {
        type: Object,
        required: true
    }
})
</script>

<style scoped lang="css">
.card {
    flex: none;
    width: 200px;
}
</style>