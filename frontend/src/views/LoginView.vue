<script>
import axiosInstance from "../../services/http.js";
import { isAuthenticated } from "../auth.js";

export default {
    data() {
        return {
            showPassword: false,
            usuario: "",
            senha: "",
            errorMessage: ""
        };
    },
    computed: {
        inputType() {
            return this.showPassword ? "text" : "password";
        }
    },
    methods: {
        toggleVisibility() {
            this.showPassword = !this.showPassword;
            this.$nextTick(() => {
                const el = document.getElementById("senha");
                if (el) el.focus();
            });
        },

        async submitLogin() {
            try {
                const res = await axiosInstance.post(
                    "/login",
                    {
                        usuario: this.usuario,
                        senha: this.senha
                    }
                );

                const token = res.data.token;

                localStorage.setItem("token", token);
                localStorage.setItem("usuario", this.usuario);
                axiosInstance.defaults.headers.common["Authorization"] = `Bearer ${token}`;

                isAuthenticated.value = true;

                this.$router.push("/admin");
            } catch (err) {
                console.error(err);
                this.errorMessage = "Usuário ou senha inválidos.";
            }
        }
    },
    mounted() {
        const token = localStorage.getItem("token");
        if (token) {
            axiosInstance.defaults.headers.common["Authorization"] = `Bearer ${token}`;
            isAuthenticated.value = true;
        }
    }
};
</script>


<template>
    <section class="section-login">
        <div class="top-form">
            <div class="div-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#155DFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-lock w-6 h-6 text-blue-600" aria-hidden="true">
                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <span class="title">Login Administrativo</span>
            <span class="body">Acesse o painel de gerenciamento</span>
        </div>

        <div v-if="errorMessage" class="error-message">
            <span>{{ errorMessage }}</span>
        </div>

        <form @submit.prevent="submitLogin">
            <div>
                <label for="usuario">Usuário</label>
                <input id="usuario" type="text" v-model="usuario" placeholder="Digite seu usuário" />
            </div>

            <div>
                <label for="senha">Senha</label>
                <div class="input-password">
                    <input :type="inputType" v-model="senha" id="senha" placeholder="Digite sua senha"
                        autocomplete="off" />

                    <button type="button" @click="toggleVisibility" class="toggle-password-button"
                        :aria-label="showPassword ? 'Ocultar senha' : 'Mostrar senha'"
                        :title="showPassword ? 'Ocultar senha' : 'Mostrar senha'">
                        <img v-if="showPassword" src="/eye-off.svg" alt="Ocultar senha" width="20" height="20" />
                        <img v-else src="/eye.svg" alt="Mostrar senha" width="20" height="20" />
                    </button>
                </div>
            </div>

            <!-- comen -->

            <!-- <div class="bottom-form">
                <span class="title">Credenciais de teste:</span>
                <span class="body">Usuário: admin</span>
                <span class="body">Senha: admin123</span>
            </div> -->

            <div class="buttons">
                <button type="submit" class="first-button">Entrar</button>

                <router-link to="/" custom v-slot="{ navigate }">
                    <button class="second-button" @click="navigate" data-slot="button">
                        Cancelar
                    </button>
                </router-link>
            </div>
        </form>
    </section>
</template>

<style scoped>
.section-login {
    margin: 100px 0 100px 0;
    background-color: #FFFFFF;
    padding: 50px;
    border-radius: 15px;
    border: 1px solid #a1a1a180;
    width: 50%;
    max-width: 700px;
}

.section-login .top-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.section-login .div-icon {
    width: 50px;
    height: 50px;
    background-color: #DBEAFE;
    border-radius: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.section-login .error-message {
    background-color: #FEF2F2;
    color: #E7000B;
    border: 1px solid #ffc9c9;
    margin-bottom: 20px;
    padding: 10px 0 10px 20px;
    border-radius: 10px;
    font-size: 13px;
    height: max-content;
}

.section-login .top-form .title {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 10px;
}

.section-login .top-form .body {
    font-size: 14px;
    font-weight: 300;
    margin-bottom: 20px;
}

.section-login form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.section-login form div {
    display: flex;
    flex-direction: column;
}

.section-login form div label {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 5px;
}

.section-login form div input {
    font-size: 12px;
    height: 40px;
    width: 100%;
    border: none;
    border-radius: 10px;
    background-color: #F3F3F5;
    padding: 10px 0 10px 10px;
    transition: box-shadow 0.2s;
    transition: all ease-in-out 0.2s;
}

.section-login .input-password {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.section-login .input-password button {
    margin-left: -35px;
    border: none;
    background-color: transparent;
    cursor: pointer;
    width: 20px;
    height: 20px;
}

.section-login form div input::placeholder {
    opacity: 0.7;
}

.section-login form div input:focus {
    box-shadow: 0 0 3px 0.5px;
    outline: 1px solid #a1a1a180;
}

.section-login .bottom-form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    background-color: #EFF6FF;
    border-radius: 10px;
    padding: 10px;
}

.section-login .bottom-form .title {
    opacity: 0.7;
    font-size: 12px;
    font-weight: 500;
}

.section-login .bottom-form .body {
    opacity: 0.7;
    font-size: 11px;
}

.section-login .buttons {
    margin-top: 20px;
    display: flex;
    flex-direction: row;
    gap: 10px;
}

.section-login .buttons .first-button,
.section-login .buttons .second-button {
    height: 40px;
    border: none;
    font-size: 12px;
    font-weight: 500;
    border-radius: 10px;
    cursor: pointer;
}

.section-login .buttons .first-button {
    width: 80%;
    background-color: #0066CC;
    color: #FFF;
}

.section-login .buttons .first-button:hover {
    background-color: #005fbf;
    transform: translateY(1px);
}

.section-login .buttons .second-button {
    width: 20%;
    background-color: #FFF;
    border: 1px solid #a1a1a180;
}

.section-login .buttons .second-button:hover {
    background-color: #e7e7e7;
    transform: translateY(1px);
}

@media (max-width: 1024px) {
    .section-login {
        width: 70%;
        padding: 40px;
    }

    .section-login .top-form .title {
        font-size: 18px;
    }

    .section-login .buttons .first-button {
        width: 75%;
    }

    .section-login .buttons .second-button {
        width: 25%;
    }
}

@media (max-width: 768px) {
    .section-login {
        width: 90%;
        padding: 35px;
        margin: 80px auto;
    }

    .section-login .top-form .title {
        font-size: 17px;
    }

    .section-login .top-form .body {
        font-size: 13px;
    }

    .section-login form div input {
        font-size: 12px;
        height: 38px;
    }

    .section-login .buttons {
        flex-direction: column;
    }

    .section-login .buttons .first-button,
    .section-login .buttons .second-button {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .section-login {
        width: 90%;
        padding: 25px;
        margin: 60px auto;
    }

    .section-login img {
        width: 15px;
        margin-left: 5px;
    }

    .section-login .top-form .title {
        font-size: 16px;
    }

    .section-login .top-form .body {
        font-size: 12px;
    }

    .section-login form div label {
        font-size: 11px;
    }

    .section-login form div input {
        font-size: 11px;
        height: 36px;
    }

    .section-login .bottom-form {
        font-size: 11px;
        padding: 8px;
    }

    .section-login .buttons .first-button,
    .section-login .buttons .second-button {
        height: 38px;
        font-size: 11px;
    }
}
</style>