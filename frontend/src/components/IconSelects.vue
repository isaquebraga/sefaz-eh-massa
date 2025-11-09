<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: null,
    },
    options: {
        type: Array,
        required: true,
    },
    label: {
        type: String,
        default: '',
    }
});

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);
const selectRef = ref(null);

const selectedOption = computed(() => {
    return props.options.find(option => option.value === props.modelValue);
});

function toggleDropdown() {
    isOpen.value = !isOpen.value;
}

function selectOption(option) {
    emit('update:modelValue', option.value);
    isOpen.value = false;
}

const handleClickOutside = (event) => {
    if (selectRef.value && !selectRef.value.contains(event.target)) {
        isOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="icon-select-wrapper" ref="selectRef">
        <label v-if="label" class="form-label">{{ label }}</label>

        <div class="select-trigger" @click="toggleDropdown" :class="{ 'is-open': isOpen }" tabindex="0"
            @keydown.enter.space="toggleDropdown" role="combobox" :aria-expanded="isOpen">
            <span v-if="!selectedOption" class="placeholder">Selecione um ícone...</span>
            <span v-if="selectedOption" class="selected-item">
                <span class="icon-svg" v-html="selectedOption.icon"></span>
                <span>{{ selectedOption.label }}</span>
            </span>

            <svg class="chevron" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
            </svg>
        </div>

        <ul v-if="isOpen" class="dropdown-list" role="listbox">
            <li v-for="option in options" :key="option.value" class="option-item"
                :class="{ 'selected': modelValue === option.value }" @click="selectOption(option)" role="option"
                :aria-selected="modelValue === option.value">
                <span class="icon-svg" v-html="option.icon"></span>
                <span>{{ option.label }}</span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.form-label {
    display: block;
    margin-bottom: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
}

.icon-select-wrapper {
    position: relative;
    width: 100%;
}

.select-trigger {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 8px 12px;
    border-radius: 6px;
    background-color: white;
    font-size: 12px;
    cursor: pointer;
    box-sizing: border-box;
    background-color: #F3F3F5;
}

.select-trigger:focus {
    box-shadow: 0 0 3px 0.5px;
    outline: 1px solid #a1a1a180;
}

.placeholder {
    color: #6b7280;
}

.selected-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.chevron {
    color: #6b7280;
    transition: transform 0.2s ease;
}

.select-trigger.is-open .chevron {
    transform: rotate(180deg);
}

.dropdown-list {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background-color: white;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin: 0;
    padding: 4px;
    list-style: none;
    z-index: 10;
    max-height: 250px;
    overflow-y: auto;
    margin-top: 5px;
}

.option-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
}

.option-item:hover {
    background-color: #f3f4f6;
}

.option-item.selected {
    background-color: #e0e7ff;
    font-weight: 500;
    color: #3730a3;
}

.icon-svg {
    height: 1.1rem;
}

:deep(.icon-svg svg) {
    width: 1.1rem;
    color: #374151;
    flex-shrink: 0;
    
}

:deep(.option-item.selected .icon-svg svg) {
    color: #3730a3;
}
</style>