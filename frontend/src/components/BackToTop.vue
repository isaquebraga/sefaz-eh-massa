<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const mostrarBotao = ref(false);

const verificarScroll = () => {
    mostrarBotao.value = window.scrollY > 200;
};

const voltarAoTopo = () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
};

onMounted(() => {
    window.addEventListener("scroll", verificarScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", verificarScroll);
});
</script>

<template>
    <transition name="fade">
        <div v-if="mostrarBotao" class="back-to-top" @click="voltarAoTopo" aria-label="Voltar ao topo">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 19V6"></path>
                <path d="M5 12l7-7 7 7"></path>
            </svg>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: scale(0.8);
}

.fade-enter-to,
.fade-leave-from {
    opacity: 1;
    transform: scale(1);
}

.back-to-top {
    position: fixed;
    bottom: 40px;
    right: 40px;
    height: 40px;
    width: 40px;
    background-color: #0058B1;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
}

.back-to-top:hover {
    background-color: #004488;
}

svg {
    width: 20px;
    height: 20px;
}
</style>
