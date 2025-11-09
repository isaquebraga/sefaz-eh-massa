<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: Boolean,
    itemName: {
        type: String,
        default: 'este item',
    },
});

const emit = defineEmits(['update:modelValue', 'confirm']);

const fechar = () => emit('update:modelValue', false);

const confirmar = () => {
    emit('confirm');
    fechar();
};
</script>

<template>
    <div v-if="modelValue" class="confirm-modal-overlay" @click.self="fechar">
        <div class="confirm-modal-content">
            <h3 class="modal-title">Confirmar exclusão</h3>
            <p class="modal-body">
                Tem certeza que deseja excluir o imposto
                <strong>"{{ itemName }}"</strong>?
                Esta ação não pode ser desfeita.
            </p>

            <div class="modal-actions">
                <button class="btn btn-cancel" @click="fechar">Cancelar</button>
                <button class="btn btn-danger" @click="confirmar">Excluir</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.confirm-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1010;
    overflow: hidden;
}

.confirm-modal-content {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 450px;
    animation: fadeIn 0.2s ease;
    padding: 20px;
}

.modal-title {
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 16px;
    color: #111827;
}

.modal-body {
    font-size: 13px;
    width: 100%;
    margin-bottom: 20px;
}

.modal-body strong {
    color: #111827;
    font-weight: 600;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.btn {
    padding: 10px 25px;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    height: 40px;
    display: flex;
    align-items: center;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-cancel {
    background: #fff;
    color: #374151;
    border: 1px solid #a1a1a180;
}

.btn-cancel:hover {
    background-color: #f9fafb;
}

.btn-danger {
    background-color: #FB2C36;
    color: #fff;
}

.btn-danger:hover {
    background-color: #e52832;
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
</style>
