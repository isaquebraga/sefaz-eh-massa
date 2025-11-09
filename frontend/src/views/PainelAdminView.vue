<script setup>
import { ref } from 'vue';

import ImpostosConteudo from '../components/Impostos.vue';
import UsuariosConteudo from '../components/Usuarios.vue';

const currentTab = ref('impostos');

const usuarioLogado = ref({
    nome: localStorage.getItem('usuario')
});
</script>


<template>
    <section class="admin">
        <div class="top-admin">
            <span class="title">Painel Administrativo</span>
            <span class="body">Gerencie informações sobre impostos e usuários do sistema</span>
        </div>

        <div class="menu-controle">
            <button class="option" :class="{ active: currentTab === 'impostos' }" @click="currentTab = 'impostos'">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <span>Impostos</span>
            </button>

            <button v-if="usuarioLogado.nome === 'admin'" class="option" :class="{ active: currentTab === 'usuarios' }"
                @click="currentTab = 'usuarios'">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Usuários</span>
            </button>
        </div>

        <div class="conteudo-dinamico">
            <ImpostosConteudo v-if="currentTab === 'impostos'" />
            <UsuariosConteudo v-if="currentTab === 'usuarios'" />
        </div>
    </section>
</template>

<style scoped>
.admin {
    background-color: #FFF;
    width: 70%;
    padding: 40px 30px 30px 30px;
    border-radius: 15px;
    border: 1px solid #a1a1a180;
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
}

.admin .top-admin {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.admin .title {
    font-size: 20px;
    font-weight: 600;
}

.admin .body {
    font-size: 14px;
}

.menu-controle {
    display: flex;
    background-color: #f0f2f5;
    border-radius: 999px;
    padding: 4px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    height: 35px;
}

.option {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background-color: transparent;
    border: none;
    border-radius: 999px;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #555;
    cursor: pointer;
    transition: all 0.3s ease;
}

.option.active {
    background-color: #ffffff;
    color: #111;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

@media (max-width: 1024px) {
    .admin {
        width: 85%;
        padding: 35px 25px;
    }

    .admin .title {
        font-size: 18px;
    }

    .admin .body {
        font-size: 13px;
    }

    .menu-controle {
        height: 33px;
    }

    .option {
        font-size: 12px;
        gap: 6px;
    }
}

@media (max-width: 768px) {
    .admin {
        width: 90%;
        padding: 30px 20px;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .admin .title {
        font-size: 17px;
        text-align: center;
    }

    .admin .body {
        font-size: 12px;
        text-align: center;
    }

    .menu-controle {
        flex-direction: row;
        height: auto;
        padding: 6px;
    }

    .option {
        font-size: 12px;
        padding: 8px 10px;
        gap: 6px;
    }

    .conteudo-dinamico {
        margin-top: 10px;
    }
}

@media (max-width: 480px) {
    .admin {
        width: 90%;
        padding: 20px 15px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .admin .title {
        font-size: 16px;
        padding-bottom: 10px;
        text-align: center;
    }

    .admin .body {
        font-size: 11px;
        text-align: center;
    }

    .menu-controle {
        border-radius: 15px;
        gap: 6px;
        padding: 8px;
    }

    .option {
        width: 100%;
        font-size: 11px;
        padding: 10px;
    }

    .conteudo-dinamico {
        margin-top: 10px;
    }
}
</style>