<script setup>
import { defineProps, defineEmits } from 'vue';
import IconSelect from '../IconSelects.vue';

defineProps({
    modelValue: { type: Boolean, required: true }, 
    modoEdicao: { type: Boolean, required: true }, 
    form: { type: Object, required: true },       
    iconOptions: { type: Array, required: true }  
});

const emit = defineEmits(['update:modelValue', 'submit']);

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
                    <span class="title">{{ modoEdicao ? "Editar Imposto" : "Adicionar Novo Imposto" }}</span>
                    <span class="body">Preencha as informações sobre o imposto</span>
                </div>
                <button class="close-btn" @click="handleClose">&times;</button>
            </div>

            <div class="modal-body">
                <form @submit.prevent="handleSubmit">
                    <div class="form-group">
                        <label>Sigla *</label>
                        <input v-model="form.sigla" placeholder="Ex: IPTU" required />
                    </div>

                    <div class="form-group">
                        <label>Nome Completo *</label>
                        <input v-model="form.nome_completo" placeholder="Ex: Imposto Predial e Territorial Urbano"
                            required />
                    </div>

                    <div class="form-group">
                        <IconSelect label="Ícone" v-model="form.icone" :options="iconOptions" />
                    </div>

                    <div class="form-group">
                        <label>Descrição *</label>
                        <textarea v-model="form.descricao" placeholder="O que é este imposto?" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Finalidade *</label>
                        <textarea v-model="form.finalidade" placeholder="Para que serve este imposto?"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Curiosidades</label>
                        <textarea v-model="form.curiosidades" placeholder="Digite uma curiosidade por linha"
                            required></textarea>
                    </div>

                    <span class="observation">Digite uma curiosidade por linha</span>

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
}

.form-group textarea {
    height: max-content;
    resize: none;
    field-sizing: content;
    overflow: hidden;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    box-shadow: 0 0 3px 0.5px;
    outline: 1px solid #a1a1a180;
}

.observation {
    display: block;
    font-size: 11px;
    opacity: 0.7;
    padding-left: 10px;
    margin-top: -5px;
}

.buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
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