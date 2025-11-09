<template>
    <section class="section-error">
        <div class="top-section-error">
            <div class="div-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#E7000B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shield-alert w-12 h-12 text-red-600" aria-hidden="true">
                    <path
                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                    </path>
                    <path d="M12 8v4"></path>
                    <path d="M12 16h.01"></path>
                </svg>
            </div>
            <span class="title">Acesso Negado</span>
            <span class="body">Você precisa estar autenticado para acessar o painel administrativo.</span>
        </div>

        <div class="middle-section-error">
            <span>Esta área é restrita a administradores autorizados da Secretaria Municipal de Fazenda. Por favor,
                faça login com suas credenciais para continuar.</span>
        </div>

        <div class="bottom-section-error">
            <router-link to="/login" custom v-slot="{ navigate }">
                <button class="first-button" @click="navigate" data-slot="button">
                    Ir para Login
                </button>
            </router-link>

            <router-link to="/" custom v-slot="{ navigate }">
                <button class="second-button" @click="navigate" data-slot="button">
                    Voltar ao Início
                </button>
            </router-link>
        </div>
    </section>
</template>

<style scoped>
.section-error {
    margin: 100px 0 100px 0;
    background-color: #FFFFFF;
    padding: 50px;
    border-radius: 15px;
    border: 1px solid #a1a1a180;
    width: 50%;
    max-width: 700px;
}

.section-error .top-section-error {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.section-error .div-icon {
    width: 50px;
    height: 50px;
    background-color: #FFE2E2;
    border-radius: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.section-error .top-section-error .title {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 10px;
    color: #E7000B;
}

.section-error .top-section-error .body {
    font-size: 14px;
    font-weight: 300;
    margin-bottom: 20px;
}

.section-error .middle-section-error {
    font-size: 13px;
    color: #E7000B;
    margin-bottom: 20px;
    background-color: #FEF2F2;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    border: 1px solid #ffc9c9;
}

.section-error .bottom-section-error {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.section-error .bottom-section-error {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.section-error .bottom-section-error .first-button,
.section-error .bottom-section-error .second-button {
    height: 40px;
    border: none;
    font-size: 13px;
    font-weight: 500;
    border-radius: 10px;
    cursor: pointer;
}

.section-error .bottom-section-error .first-button {
    background-color: #0066CC;
    color: #FFF;
}

.section-error .bottom-section-error .first-button:hover {
    background-color: #005fbf;
    transform: translateY(1px);
}

.section-error .bottom-section-error .second-button {
    background-color: #FFF;
    border: 1px solid #a1a1a180;
}

.section-error .bottom-section-error .second-button:hover {
    background-color: #e7e7e7;
    transform: translateY(1px);
}

@media (max-width: 1024px) {
    .section-error {
        width: 70%;
        padding: 40px;
    }

    .section-error .top-section-error .title {
        font-size: 18px;
    }

    .section-error .top-section-error .body {
        font-size: 13px;
    }
}

@media (max-width: 768px) {
    .section-error {
        width: 85%;
        padding: 30px;
    }

    .section-error .div-icon {
        width: 45px;
        height: 45px;
    }

    .section-error .top-section-error .title {
        font-size: 17px;
    }

    .section-error .top-section-error .body {
        font-size: 12px;
        text-align: center;
    }

    .section-error .middle-section-error {
        font-size: 12px;
        padding: 15px;
    }

    .section-error .bottom-section-error .first-button,
    .section-error .bottom-section-error .second-button {
        font-size: 12px;
        height: 38px;
    }
}

@media (max-width: 480px) {
    .section-error {
        width: 90%;
        padding: 20px;
        margin: 60px 0;
    }

    .section-error .div-icon {
        width: 50px;
        height: 50px;
    }

    .section-error .div-icon svg {
        width: 24;
        height: 24;
    }

    .section-error .top-section-error .title {
        font-size: 16px;
        text-align: center;
    }

    .section-error .top-section-error .body {
        font-size: 11px;
        text-align: center;
    }

    .section-error .middle-section-error {
        font-size: 11px;
        padding: 10px;
    }

    .section-error .bottom-section-error {
        flex-direction: column;
        gap: 8px;
    }

    .section-error .bottom-section-error .first-button,
    .section-error .bottom-section-error .second-button {
        width: 100%;
        height: 36px;
        font-size: 11px;
    }
}
</style>
