import { ref, readonly } from 'vue';

const toasts = ref([]);
let idCounter = 0;

export function useToast() {

    const addToast = (message, type = 'success', duration = 3000) => {
        const id = idCounter++;


        toasts.value.unshift({ id, message, type });


        setTimeout(() => {
            removeToast(id);
        }, duration);
    };

    const removeToast = (id) => {
        const index = toasts.value.findIndex(t => t.id === id);
        if (index > -1) {
            toasts.value.splice(index, 1);
        }
    };

    return {
        toasts: readonly(toasts),
        addToast,
        removeToast
    };
}