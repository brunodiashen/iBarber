<template>
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="meus-horarios" data-bs-toggle="dropdown"
            aria-expanded="false">
            Meus horarios
        </button>
        <ul class="dropdown-menu" aria-labelledby="meus-horarios">
            <div class="p-2" style="width: 220px;">
                <horariosAgendado />
                <hr>
                <horariosPendente />
            </div>
        </ul>
    </div>
</template>

<script setup lang="ts">
import horariosAgendado from './listas/horariosAgendado.vue';
import horariosPendente from './listas/horariosPendente.vue';
</script>

<style>
.dropdown-menu {
  max-height: 270px;
  overflow-y: scroll;
}
</style>