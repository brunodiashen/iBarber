<template>
    <div class="container">
        <form class="form form-control mt-4 p-4 text-center">
            <div class="row">
                <h3>Agenda</h3>
                <div class="col-lg-6 mt-3">
                    <horarioAgendado />
                </div>
                <div class="col-lg-6 mt-3 border-start border-3">
                    <HorarioPendente />
                </div>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import HorarioPendente from '../components/shared/tabelas/horarioPendente.vue';
import horarioAgendado from '../components/shared/tabelas/horarioAgendado.vue';
</script>

<style scoped>
</style>