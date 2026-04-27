<template>
    <div v-show="notificacao.show" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-white" :class="notificacao.color">
                <img v-if="notificacao.img" :src="notificacao.img" class="rounded me-2" alt="...">
                <strong class="me-auto">Notificacao</strong>
                <small>{{ data.getHours() }}:{{ data.getMinutes() }}</small>
            </div>
            <div class="toast-body">
                {{ notificacao.text }}
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import type { Notificacao } from '@/core/interfaces'
import { useNotificacaoStore } from '@/stores/notificacao';

const store = useNotificacaoStore()
const data: Date = new Date()

const notificacao = computed(()
    : Notificacao => store.notificacao)
</script>

<style>
</style>