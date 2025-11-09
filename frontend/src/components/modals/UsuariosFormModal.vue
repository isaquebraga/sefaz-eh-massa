<script setup>
import { defineProps, defineEmits, computed, ref } from 'vue';

defineProps({
    modelValue: { type: Boolean, required: true },
    modoEdicao: { type: Boolean, required: true },
    form: { type: Object, required: true },
});

const emit = defineEmits(['update:modelValue', 'submit']);

const showPassword = ref(false);

function toggleVisibility() {
    showPassword.value = !showPassword.value;
}

function handleClose() {
    emit('update:modelValue', false);
}

function handleSubmit() {
    emit('submit');
}
</script>

<template>
    <div v-if="modelValue" class="modal-overlay" @click.self="handleClose">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <span class="title">{{ modoEdicao ? "Editar Usuário" : "Adicionar Novo Usuário" }}</span>
                    <span class="body">Preencha as informações do usuário</span>
                </div>
                <button class="close-btn" @click="handleClose">&times;</button>
            </div>

            <div class="modal-body">
                <form @submit.prevent="handleSubmit">
                    <div class="form-group">
                        <label>Usuário *</label>
                        <input v-model="form.usuario" type="text" placeholder="Ex: fuladodetal" required />
                    </div>

                    <div class="form-group">
                        <label>Senha <span v-if="!modoEdicao">*</span></label>

                        <div class="password-wrapper">
                            <input v-model="form.senha" :type="showPassword ? 'text' : 'password'"
                                :placeholder="modoEdicao ? 'Deixe em branco para não alterar' : 'Digite uma senha forte'"
                                :required="!modoEdicao" />

                            <button type="button" @click="toggleVisibility" class="toggle-password-button"
                                :aria-label="showPassword ? 'Ocultar senha' : 'Mostrar senha'"
                                :title="showPassword ? 'Ocultar senha' : 'Mostrar senha'">

                                <img v-if="showPassword" src="/eye-off.svg" alt="Ocultar senha" width="20"
                                    height="20" />
                                <img v-else src="/eye.svg" alt="Mostrar senha" width="20" height="20" />
                            </button>

                        </div>
                    </div>

                    <div class="buttons">
                        <button type="button" class="cancel-btn" @click="handleClose">Cancelar</button>
                        <button type="submit" class="add-btn">
                            {{ modoEdicao ? "Salvar Alterações" : "Adicionar" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    overflow: hidden;
}

.modal {
    background: #fff;
    width: 700px;
    max-height: 650px;
    overflow-y: auto;
    max-width: 80%;
    border-radius: 10px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.2s ease;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 15px 20px;
}

.modal-header div {
    display: flex;
    flex-direction: column;
}

.modal-header .title {
    font-size: 16px;
    font-weight: 600;
}

.modal-header .body {
    font-size: 14px;
}

.close-btn {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #777;
}

.close-btn:hover {
    color: #000;
}

.modal-body {
    padding: 0 20px 20px 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 5px;
}

.form-group input::placeholder {
    opacity: 0.7;
}

.form-group input,
.form-group textarea,
.form-group select {
    font-size: 12px;
    height: 40px;
    width: 100%;
    border: none;
    border-radius: 10px;
    background-color: #F3F3F5;
    padding: 10px 0 10px 10px;
    transition: box-shadow 0.2s;
    transition: all ease-in-out 0.2s;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus {
    box-shadow: 0 0 3px 0.5px;
    outline: 1px solid #a1a1a180;
}

.buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.cancel-btn {
    background: #FFF;
    border: 1px solid #a1a1a180;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
}

.cancel-btn:hover {
    background: #f9fafb;
}

.add-btn {
    background: #0066CC;
    color: white;
    padding: 8px 14px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}

.add-btn:hover {
    background: #005bb5;
}

.password-wrapper {
    position: relative;
    width: 100%;
}

.password-wrapper input {
    padding-right: 45px;
}

.toggle-password-button {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
}

.toggle-password-button img {
    opacity: 0.6;
    transition: opacity 0.2s;
}

.toggle-password-button:hover img {
    opacity: 1;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}

@media (max-width: 480px) {
    .observation {
        margin-bottom: 10px;
    }
}
</style>