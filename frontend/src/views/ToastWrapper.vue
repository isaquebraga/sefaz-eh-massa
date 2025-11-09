<script setup>
import { useToast } from '@/composables/useToast';
const { toasts, removeToast } = useToast();

const iconSuccess = `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg>`;

const iconError = `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>`;
</script>

<template>
    <div class="toast-wrapper">
        <TransitionGroup name="toast" tag="div">

            <div v-for="toast in toasts" :key="toast.id" :class="['toast', `toast-${toast.type}`]"
                @click="removeToast(toast.id)">
                <div class="toast-icon">
                    <span v-if="toast.type === 'success'" v-html="iconSuccess"></span>
                    <span v-if="toast.type === 'error'" v-html="iconError"></span>
                </div>

                <div class="toast-message">
                    {{ toast.message }}
                </div>
            </div>

        </TransitionGroup>
    </div>
</template>

<style scoped>
.toast-wrapper {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 2000;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.toast {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 1px solid #e5e7eb;
    cursor: pointer;
    width: 300px;
    height: 50px;
}

.toast-icon {
    flex-shrink: 0;
}

.toast-icon :deep(svg) {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toast-message {
    font-size: 13px;
    font-weight: 500;
    color: #111827;
}

.toast-success .toast-icon :deep(svg) {
    color: #000;
}

.toast-success .toast-icon {
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toast-success .toast-icon :deep(svg) {
    width: 13px;
    height: 13px;
    padding-top: 2px;
    padding-left: 1px;
}

.toast-error .toast-icon :deep(svg) {
    width: 22px;
    height: 22px;
}

.toast-error .toast-icon :deep(svg) {
    color: #ef4444;
}

.toast-error .toast-message {
    color: #ef4444;
}

.toast-enter-active,
.toast-leave-active {
    transition: all 0.4s ease;
}

.toast-enter-from,
.toast-leave-to {
    opacity: 0;
    transform: translateX(100%);
}

.toast-move {
    transition: transform 0.3s ease;
}
</style>