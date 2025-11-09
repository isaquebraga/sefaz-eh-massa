<script setup>
import { useRoute, useRouter } from 'vue-router'
import { watchEffect, ref } from 'vue'
import { isAuthenticated } from '../auth.js'

const route = useRoute()
const router = useRouter()

const usuarioLogado = ref({
    nome: localStorage.getItem('usuario')
});

const logout = async () => {
    try {
    } catch (err) {
        console.warn('Erro ao fazer logout:', err);
    } finally {
        localStorage.removeItem('token');
        localStorage.removeItem('userName');
        isAuthenticated.value = false;
        router.push('/');
    }
}

watchEffect(() => {
    isAuthenticated.value = !!localStorage.getItem('token')
})

</script>

<template>
    <header>
        <div class="header-content">
            <div class="header-left">
                <router-link to="/" custom v-slot="{ navigate }">
                    <svg @click="navigate" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-building2 lucide-building-2 w-10 h-10" aria-hidden="true">
                        <path d="M10 12h4"></path>
                        <path d="M10 8h4"></path>
                        <path d="M14 21v-3a2 2 0 0 0-4 0v3"></path>
                        <path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"></path>
                        <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path>
                    </svg>
                </router-link>

                <div class="header-text">
                    <span class="text-head">Secretaria Municipal de Fazenda</span>
                    <span class="text-body">Prefeitura de Maceió - Alagoas</span>
                </div>
            </div>

            <nav>
                <div>
                    <router-link to="/" custom v-slot="{ navigate }">
                        <button v-if="route.path !== '/'" @click="navigate" data-slot="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-house w-4 h-4 mr-2" aria-hidden="true">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                <path
                                    d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                                </path>
                            </svg>
                            Início
                        </button>
                    </router-link>
                    <router-link v-if="route.path !== '/admin' && route.path !== '/erro-admin'" to="/admin" custom
                        v-slot="{ navigate }">
                        <button v-if="route.path !== '/admin'" @click="navigate" data-slot="button">
                            Painel Admin
                        </button>
                    </router-link>
                    <router-link v-if="route.path !== '/impostos'" to="/impostos" custom v-slot="{ navigate }">
                        <button v-if="route.path !== '/impostos'" @click="navigate" data-slot="button">
                            Impostos
                        </button>
                    </router-link>
                    <router-link v-if="!isAuthenticated" to="/login" custom v-slot="{ navigate }">
                        <button v-if="route.path !== '/login'" @click="navigate" data-slot="button">
                            Login
                        </button>
                    </router-link>
                    <button v-else @click="logout" data-slot="button">
                        Sair
                    </button>
                </div>

                <div class="nav-user">
                    <span v-if="isAuthenticated">Usuário atual: <b>{{ usuarioLogado.nome }}</b>.</span>
                </div>
            </nav>
        </div>
    </header>
</template>

<style scoped>
header {
    background-color: #0058B1;
    padding-top: 25px;
    padding-bottom: 25px;
    box-shadow: 0 10px 15px -3px var(--tw-shadow-color, #0000001a), 0 4px 6px -4px var(--tw-shadow-color, #0000001a);
}

.header-content {
    width: 70%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header-left {
    display: flex;
    gap: 20px;
    align-items: center;
}

.header-left svg {
    cursor: pointer;
}

.header-text {
    display: flex;
    flex-direction: column;
    color: #FFF;
}

header .text-head {
    font-size: 18px;
    font-weight: 500;
}

header .text-body {
    font-size: 12px;
    font-weight: 300;
}

nav {
    position: relative;
}

nav div {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.nav-user {
    color: #FFF;
    font-size: 10px;
    position: absolute;
    bottom: -22px;
    left: 50%;
    transform: translateX(-50%);
}

nav button {
    width: 100px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border-radius: 15px;
    border: #ffffff4d solid 1px;
    font-size: 12px;
    background-color: #1A63AC;
    transition: all ease-in-out 0.2s;
    color: #FFF;
    cursor: pointer;
    text-decoration: none;
    outline: none;
}

nav button:hover {
    background-color: #1d6cbc;
    transform: translateY(1px);
}

@media (max-width: 1024px) {
    .header-content {
        width: 90%;
    }

    nav button {
        min-width: 90px;
        font-size: 11px;
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 15px;
    }

    .header-left {
        flex-direction: column;
        align-items: center;
    }

    nav {
        justify-content: center;
        flex-wrap: wrap;
    }

    nav button {
        width: auto;
        padding: 8px 14px;
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    header {
        padding: 15px 0 30px 0;
    }

    .header-left {
        gap: 10px;
    }

    svg {
        width: 36px;
        height: 36px;
    }

    .text-head {
        font-size: 14px;
    }

    .text-body {
        font-size: 10px;
    }

    nav {
        gap: 10px;
    }

    nav svg {
        width: 15px;
        height: 15px;
    }

    nav button {
        font-size: 11px;
        padding: 6px 10px;
    }
}
</style>