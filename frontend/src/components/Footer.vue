<template>
    <footer>
        <ul>
            <li>
                <span class="text-title">Secretaria Municipal de Fazenda</span>
                <span class="text-body">Responsável pela administração tributária e financeira do município de
                    Maceió.</span>
            </li>
            <li>
                <span class="text-title">Contato</span>
                <span class="text-body">Rua Pedro Monteiro, 47 - Centro</span>
                <span class="text-body">Maceió - AL. CEP: 57020-380</span>
                <span class="text-body">Tel: (82) 3312-5860</span>
            </li>
            <li>
                <span class="text-title">Horário de Atendimento</span>
                <span class="text-body">Segunda a Sexta</span>
                <span class="text-body">8h às 14h</span>
            </li>
        </ul>

        <hr>
        </hr>

        <span class="text-rights">
            © 2025 Secretaria Municipal de Fazenda de Maceió. Todos os direitos reservados.
        </span>
    </footer>
</template>

<style scoped>
footer {
    background-color: #1E2939;
    color: #FFF;
    display: flex;
    flex-direction: column;
    align-items: center;
}

footer ul {
    list-style: none;
    display: flex;
    justify-content: space-around;
    gap: 100px;
    padding: 50px 100px 50px 100px;
}

footer ul li {
    display: flex;
    flex-direction: column;
    width: max-content;
    max-width: 400px;
}

footer .text-title {
    font-size: 14px;
    padding-bottom: 10px;
    font-weight: 500;
}

footer .text-body {
    font-size: 12px;
}

hr {
    width: 80%;
    margin: 0 auto;
    opacity: 0.3;
}

.text-rights {
    margin-top: 40px;
    margin-bottom: 20px;
    font-size: 12px;
    text-align: center;
    opacity: 0.5;
}

@media (max-width: 1024px) {
    footer ul {
        gap: 60px;
        padding: 40px 60px;
    }
}

@media (max-width: 768px) {
    footer ul {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 40px;
        padding: 40px 30px;
    }

    footer ul li {
        width: 100%;
        max-width: 350px;
    }

    .text-title {
        font-size: 13px;
    }

    .text-body {
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    footer ul {
        padding: 30px 20px;
        gap: 30px;
    }

    .text-title {
        font-size: 12px;
    }

    .text-body {
        font-size: 10.5px;
    }

    .text-rights {
        font-size: 10.5px;
        width: 80%;
        margin-top: 30px;
    }
}
</style>