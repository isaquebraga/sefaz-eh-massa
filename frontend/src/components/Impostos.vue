<script setup>
import { ref, reactive, onMounted } from "vue";
import axiosInstance from "../../services/http.js";
import FormModal from './modals/ImpostosFormModal.vue';
import ConfirmarExclusaoModal from './modals/ConfirmarExclusaoModalImposto.vue';
import { useToast } from '../composables/useToast.js';

const impostos = ref([]);
const carregando = ref(false);

const mostrarModal = ref(false);
const modoEdicao = ref(false);
let impostoEditando = null;

const mostrarConfirmacao = ref(false);
const impostoParaExcluir = ref(null);

const { addToast } = useToast();

const iconOptions = ref([
    {
        label: 'Prédio',
        value: 'predio',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#717182
" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 12h4"></path><path d="M10 8h4"></path><path d="M14 21v-3a2 2 0 0 0-4 0v3"></path><path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"></path><path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path></svg>`
    },
    {
        label: 'Maleta',
        value: 'maleta',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#717182
" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>`
    },
    {
        label: 'Casa',
        value: 'casa',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#717182
" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>`
    },
    {
        label: 'Carrinho',
        value: 'carrinho',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#717182
" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>`
    },
    {
        label: 'Dólar',
        value: 'dolar',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#717182
" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>`
    },
    {
        label: 'Fábrica',
        value: 'fabrica',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#717182
" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 16h.01"></path><path d="M16 16h.01"></path><path d="M3 19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.5a.5.5 0 0 0-.769-.422l-4.462 2.844A.5.5 0 0 1 15 10.5v-2a.5.5 0 0 0-.769-.422L9.77 10.922A.5.5 0 0 1 9 10.5V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"></path><path d="M8 16h.01"></path></svg>`
    }
]);

const DicionarioErros = {
    "The sigla field is required.": "O campo Sigla é obrigatório.",
    "The sigla has already been taken.": "Esta Sigla já está em uso.",
    "The nome completo field is required.": "O campo Nome Completo é obrigatório.",
    "The icone field is required.": "O campo Ícone é obrigatório.",
    "The descricao field is required.": "O campo Descrição é obrigatório.",
    "The finalidade field is required.": "O campo Finalidade é obrigatório.",
    "The curiosidades field is required.": "O campo Curiosidades é obrigatório.",
};

const getErrorMessage = (error, defaultMessage = "Ocorreu um erro inesperado.") => {
    let rawMessage = null;
    let errors = null; 

    if (error.response && error.response.data && (error.response.status === 400 || error.response.status === 422)) {

        if (typeof error.response.data.errors === 'object' && error.response.data.errors !== null) {
            errors = error.response.data.errors;
        }
        else if (typeof error.response.data === 'object' && error.response.data !== null) {
            errors = error.response.data;
        }

        if (errors) {
            const firstErrorKey = Object.keys(errors)[0];
            if (firstErrorKey && Array.isArray(errors[firstErrorKey]) && errors[firstErrorKey].length > 0) {
                rawMessage = errors[firstErrorKey][0];
            }
        }
        else if (typeof error.response.data.message === 'string') {
            rawMessage = error.response.data.message;
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

const form = reactive({
    id: null,
    nome_completo: "",
    sigla: "",
    icone: "",
    descricao: "",
    finalidade: "",
    curiosidades: ""
});

const carregarImpostos = async () => {
    try {
        carregando.value = true;
        const response = await axiosInstance.get("/impostos");
        impostos.value = response.data;
    } catch (error) {
        console.error("Erro ao carregar impostos:", error);
        const message = getErrorMessage(error, "Erro ao carregar os impostos.");
        addToast(message, 'error');
    } finally {
        carregando.value = false;
    }
};

const abrirModalNovo = () => {
    modoEdicao.value = false;
    Object.assign(form, {
        id: null,
        nome_completo: "",
        sigla: "",
        icone: "predio",
        descricao: "",
        finalidade: "",
        curiosidades: ""
    });
    mostrarModal.value = true;
};

const abrirModalEditar = (imposto) => {
    modoEdicao.value = true;
    Object.assign(form, { ...imposto });
    impostoEditando = imposto.id;

    if (typeof form.curiosidades === 'string') {
        try {
            const parsed = JSON.parse(form.curiosidades);
            form.curiosidades = Array.isArray(parsed)
                ? parsed.join('\n')
                : form.curiosidades;
        } catch { }
    }

    mostrarModal.value = true;
};

const fecharModal = () => {
    mostrarModal.value = false;
};

const salvarImposto = async () => {
    try {
        const payload = {
            ...form,
            curiosidades: JSON.stringify(
                form.curiosidades
                    .split("\n")
                    .map(c => c.trim())
                    .filter(c => c)
            ),
        };

        if (modoEdicao.value) {
            await axiosInstance.put(`/impostos/${impostoEditando}`, payload);
        } else {
            await axiosInstance.post("/impostos", payload);
        }

        await carregarImpostos();
        fecharModal();

        const successMessage = modoEdicao.value
            ? "Imposto atualizado com sucesso!"
            : "Imposto adicionado com sucesso!";
        addToast(successMessage, 'success');
    } catch (error) {
        console.error("Erro ao salvar imposto:", error);
        const message = getErrorMessage(error, "Erro ao salvar o imposto.");
        addToast(message, 'error');
    }
};

const prepararExclusao = (imposto) => {
    impostoParaExcluir.value = imposto;
    mostrarConfirmacao.value = true;
};

const removerImposto = async (id) => {
    try {
        await axiosInstance.delete(`/impostos/${id}`);
        addToast("Imposto excluído com sucesso!", 'success');
        await carregarImpostos();
    } catch (error) {
        console.error("Erro ao excluir imposto:", error);
        const message = getErrorMessage(error, "Erro ao excluir o imposto.");
        addToast(message, 'error');
    }
};

const confirmarExclusao = async () => {
    if (!impostoParaExcluir.value) return;

    await removerImposto(impostoParaExcluir.value.id);

    impostoParaExcluir.value = null;
    mostrarConfirmacao.value = false;
};

onMounted(carregarImpostos);
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
                <span>Adicionar Imposto</span>
            </button>
        </div>

        <div class="tabela-wrapper">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Sigla</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="imposto in impostos" :key="imposto.id">
                        <td>{{ imposto.sigla }}</td>
                        <td>{{ imposto.nome_completo }}</td>
                        <td class="buttons-edit">
                            <div class="btns-edit">
                                <button class="edit-btn" @click="abrirModalEditar(imposto)">
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
                                <button class="delete-btn" @click="prepararExclusao(imposto)">
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

        <FormModal v-model="mostrarModal" :modo-edicao="modoEdicao" :form="form" :icon-options="iconOptions"
            @submit="salvarImposto" />

        <ConfirmarExclusaoModal v-model="mostrarConfirmacao" :item-name="impostoParaExcluir?.nome_completo"
            @confirm="confirmarExclusao" />
    </section>
</template>

<style>
.table-header {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 15px;
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
    width: 15%;
    text-align: left;
}

.tabela th:nth-child(2),
.tabela td:nth-child(2) {
    width: 45%;
    text-align: left;
}

.tabela th:nth-child(3) {
    padding-right: 30px;
}

.tabela th:nth-child(3),
.tabela td:nth-child(3) {
    width: 100%;
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

.btns-edit {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    gap: 10px;

}

.tabela td button {
    background-color: transparent;
    border: none;
    cursor: pointer;
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