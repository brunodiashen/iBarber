<template>
    <div class="container">
        <form class="form form-control mt-4 p-4 text-center">
            <div class="row mb-4">
                <h3>Formulario de dados pessoais</h3>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-4">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" class="form-control" v-model="enderecoStore.dado.estado" required
                                minlength="2" maxlength="3" alt="Estado">
                        </div>
                        <div class="col-8">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" class="form-control" v-model="enderecoStore.dado.cidade" required
                                maxlength="30" alt="Cidade">
                        </div>
                    </div>
                    <div class="col">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" class="form-control" v-model="enderecoStore.dado.bairro" required
                            maxlength="30" alt="Bairro">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col">
                        <label for="rua">Rua</label>
                        <input type="text" name="rua" class="form-control" v-model="enderecoStore.dado.rua" required
                            maxlength="30" alt="Rua">
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="numero">Numero</label>
                            <input type="text" name="numero" class="form-control" v-model="enderecoStore.dado.numero" required
                                maxlength="5" alt="Numero" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="col-4">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" class="form-control" v-model="enderecoStore.dado.cep" required
                                minlength="8" maxlength="9" alt="CEP" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="col-4">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" class="form-control" v-model="enderecoStore.dado.telefone" required
                                minlength="11" maxlength="12" alt="telefone" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                    </div>
                </div>
                <p class="mt-4" v-if="!enderecoStore.endereco">
                    Por favor, preencha o formulario com seus dados
                    para que o sistema encontre as barbearias de sua cidade
                </p>
            </div>
            <cadastra v-if="!clienteStore.cliente.id" />
            <atualiza v-else />
        </form>
    </div>
</template>

<script setup lang="ts">
import cadastra from '@/components/shared/buttons/cadastraEndereco.vue'
import atualiza from "@/components/shared/buttons/atualizaEndereco.vue"
import { useEnderecoStore } from "@/stores/endereco"
import { useClienteStore } from '@/stores/cliente'

const enderecoStore = useEnderecoStore()
const clienteStore = useClienteStore()

enderecoStore.buscar()
</script>

<style scoped>
label {
    padding-top: 10px;
}
</style>