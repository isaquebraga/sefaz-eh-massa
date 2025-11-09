<script setup>
import { ref, reactive, onMounted } from "vue";
import axiosInstance from "../../services/http.js";
import FormModal from './modals/UsuariosFormModal.vue';
import ConfirmarExclusaoModal from './modals/ConfirmarExclusaoModalUsuario.vue';
import { useToast } from '../composables/useToast.js';

const usuarios = ref([]);
const carregando = ref(false);

const mostrarModal = ref(false);
const modoEdicao = ref(false);
let usuarioEditando = null;

const mostrarConfirmacao = ref(false);
const usuarioParaExcluir = ref(null);

const { addToast } = useToast();

const form = reactive({
    id: null,
    usuario: "",
    senha: ""
});

const DicionarioErros = {
    "The usuario field is required.": "O campo usuário é obrigatório.",
    "The usuario has already been taken.": "Este usuário já está em uso.",
    "The usuario must be a string.": "O usuário deve ser um texto.",
    "The usuario must not be greater than 255 characters.": "O usuário não pode ter mais que 255 caracteres.",

    "The senha field is required.": "O campo senha é obrigatório.",
    "The senha field must be at least 8 characters.": "A senha deve ter no mínimo 8 caracteres.",
};

const getErrorMessage = (error, defaultMessage = "Ocorreu um erro inesperado.") => {
    let rawMessage = null;

    if (error.response && error.response.data && (error.response.status === 400 || error.response.status === 422)) {
        const errors = error.response.data;
        if (typeof errors === 'object' && errors !== null) {
            const firstErrorKey = Object.keys(errors)[0];
            if (firstErrorKey && Array.isArray(errors[firstErrorKey]) && errors[firstErrorKey].length > 0) {
                rawMessage = errors[firstErrorKey][0];
            }
        }
    }

    else if (error.response && error.response.data && typeof error.response.data.message === 'string') {
        rawMessage = error.response.data.message;
    }

    else if (error.response && typeof error.response.data === 'string') {
        rawMessage = error.response.data;
    }

    if (rawMessage && DicionarioErros[rawMessage]) {
        return DicionarioErros[rawMessage];
    }

    return rawMessage || defaultMessage;
}

const carregarUsuarios = async () => {
    try {
        carregando.value = true;
        const response = await axiosInstance.get("/usuarios");
        usuarios.value = response.data;
    } catch (error) {
        console.error("Erro ao carregar usuários:", error);
        const message = getErrorMessage(error, "Erro ao carregar os usuários.");
        addToast(message, 'error');
    } finally {
        carregando.value = false;
    }
};

const abrirModalNovo = () => {
    modoEdicao.value = false;
    Object.assign(form, {
        id: null,
        usuario: "",
        senha: ""
    });
    mostrarModal.value = true;
};

const abrirModalEditar = (usuario) => {
    modoEdicao.value = true;
    Object.assign(form, { ...usuario });
    form.senha = "";
    usuarioEditando = usuario.id;
    mostrarModal.value = true;
};

const fecharModal = () => {
    mostrarModal.value = false;
};

const salvarUsuario = async () => {
    try {
        if (form.usuario.includes(" ")) {
            addToast("O usuário não pode conter espaços.", "error");
            return;
        }

        const payload = {
            usuario: form.usuario,
        };

        if (form.senha) {
            payload.senha = form.senha;
        }

        if (modoEdicao.value) {
            await axiosInstance.put(`/usuarios/${usuarioEditando}`, payload);
        } else {
            await axiosInstance.post("/usuarios", payload);
        }

        await carregarUsuarios();
        fecharModal();

        const successMessage = modoEdicao.value
            ? "Usuário atualizado com sucesso!"
            : "Usuário adicionado com sucesso!";
        addToast(successMessage, 'success');
    } catch (error) {
        console.error("Erro ao salvar usuário:", error);
        const message = getErrorMessage(error, "Erro ao salvar o usuário.");
        addToast(message, 'error');
    }
};

const prepararExclusao = (usuario) => {
    usuarioParaExcluir.value = usuario;
    mostrarConfirmacao.value = true;
};

const removerUsuario = async (id) => {
    try {
        await axiosInstance.delete(`/usuarios/${id}`);
        addToast("Usuário excluído com sucesso!", 'success');
        await carregarUsuarios();
    } catch (error) {
        console.error("Erro ao excluir usuário:", error);
        const message = getErrorMessage(error, "Erro ao excluir o usuário.");
        addToast(message, 'error');
    }
};

const confirmarExclusao = async () => {
    if (!usuarioParaExcluir.value) return;
    await removerUsuario(usuarioParaExcluir.value.id);
    usuarioParaExcluir.value = null;
    mostrarConfirmacao.value = false;
};

onMounted(carregarUsuarios);
</script>

<template>
    <section class="impostos-container">
        <div class="table-header">
            <button class="add-btn" @click="abrirModalNovo">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                <span>Adicionar Usuário</span>
            </button>
        </div>

        <div class="tabela-wrapper">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="usuario in usuarios" :key="usuario.id">
                        <td>{{ usuario.usuario }}</td>
                        <td>********</td>
                        <td class="buttons-edit">
                            <div class="btns-edit">
                                <button class="edit-btn" @click="abrirModalEditar(usuario)"
                                    :class="{ 'btn-admin': usuario.usuario === 'admin' }">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z">
                                            </path>
                                            <path d="m15 5 4 4"></path>
                                        </svg>
                                    </div>
                                </button>
                                <button class="delete-btn" @click="prepararExclusao(usuario)"
                                    :class="{ 'btn-admin': usuario.usuario === 'admin' }">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="#fb2c36" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 11v6"></path>
                                            <path d="M14 11v6"></path>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                            <path d="M3 6h18"></path>
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <FormModal v-model="mostrarModal" :modo-edicao="modoEdicao" :form="form" @submit="salvarUsuario" />

        <ConfirmarExclusaoModal v-model="mostrarConfirmacao" :item-name="usuarioParaExcluir?.usuario"
            @confirm="confirmarExclusao" />
    </section>
</template>

<style>
/* ... (O seu <style> continua exatamente o mesmo) ... */
.table-header {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 15px;
}

/* ... (estilos restantes) ... */
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

.tabela-wrapper {
    overflow-x: auto;
    border: 1px solid #a1a1a180;
    border-radius: 15px;
}

.tabela {
    width: 100%;
    border-collapse: collapse;
}

.tabela th:nth-child(1),
.tabela td:nth-child(1) {
    width: 40%;
    text-align: left;
}

.tabela th:nth-child(2),
.tabela td:nth-child(2) {
    width: 30%;
    text-align: left;
}

.tabela th:nth-child(3) {
    padding-right: 30px;
}

.tabela th:nth-child(3),
.tabela td:nth-child(3) {
    width: 30%;
    text-align: end;
}

.tabela th,
.tabela td {
    padding: 10px 12px;
    text-align: center;
}

.tabela th {
    font-weight: 600;
    font-size: 14px;
    border-bottom: 1px solid #a1a1a180;
}

.tabela td {
    font-size: 13px;
    border-bottom: 1px solid #a1a1a180;
}

.btn-admin {
    display: none;
}

.btns-edit {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.tabela td button {
    background-color: transparent;
    border: none;
}

.tabela td button div {
    border: 1px solid #a1a1a180;
    padding: 5px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
}

.tabela tr:last-child td {
    border-bottom: none;
}
</style>