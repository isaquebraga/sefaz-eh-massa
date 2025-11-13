# 💰 Sefaz é Massa!

> Projeto desenvolvido como parte do processo seletivo da **Secretaria Municipal de Fazenda de Maceió (SEFAZ)**.  

> O objetivo é apresentar um **guia explicativo dos impostos** voltado aos cidadãos maceioenses, com uma **interface moderna, responsiva e interativa** para visualização e administração de dados fiscais.

---

## 🧠 Sobre o Projeto

O **Sefaz é Massa!** foi criado para facilitar o acesso à informação sobre os impostos municipais, explicando sua **importância, finalidade e descrição** de forma simples e acessível.

Além disso, o sistema possui uma **camada administrativa** voltada à gestão dos dados fiscais, com diferentes níveis de acesso, garantindo segurança e organização.

---

## 🔐 Níveis de Acesso

O sistema possui **três níveis de usuário**, cada um com permissões específicas:

### 👤 Usuário Externo
- Acessa o site público.
- Pode visualizar informações sobre os impostos (sigla, descrição, finalidade, etc).
- Não tem acesso à área administrativa.

### 🧑‍💼 Usuário Interno
- Possui acesso ao **painel administrativo**.
- Pode **criar, editar e excluir impostos**.

### 👑 Usuário Administrador
- Tem todas as permissões do usuário interno.
- Além disso, pode **criar, editar e excluir usuários internos**.
- O usuário **admin** não pode ser excluído.

> 💡 Para testar o acesso administrativo, utilize as credenciais pré-configuradas:
> ```
> Usuário: admin
> Senha: admin123
> ```
> (Essas credenciais foram incluídas apenas para **fins de avaliação e correção** do projeto - em um ambiente real, jamais seriam expostas.)
> **Observação:** após a aprovação do projeto 🥳, as credenciais administrativas foram alteradas para o ambiente de deploy e não estão mais presentes neste repositório.

---

## 🧩 Requisitos do Desafio

O projeto foi desenvolvido conforme os requisitos definidos pela SEFAZ:

- **Frontend:** Vue.js  
- **Backend:** Laravel (PHP)  
- **Banco de Dados:** SQLite  
- **Deve conter CRUD** completo  
- Extra: **Camada de Login** protegendo o CRUD e **Containerização via Docker**  
- E o principal: **abusar da criatividade!** ✨  

---

## 💻 Tecnologias

### 🧠 Backend
- **PHP 8.2**
- **Laravel 12**
- **SQLite** 
- **Composer** 

### 🎨 Frontend
- **Vue.js 3**
- **Vite** 
- **CSS Puro** 

### 🐳 Containerização
- **Docker & Docker Compose**  

---

## 🚀 Funcionalidades

✅ Visualização pública de impostos (usuário externo)  
✅ CRUD completo de impostos (usuário interno)  
✅ Gerenciamento de usuários internos (usuário administrador)  
✅ Sistema de autenticação e controle de acesso  
✅ Interface simples, moderna e responsiva  
✅ Deploy automatizado com Docker  

---

## 📦 Instalação

### 🔧 Requisitos

Antes de iniciar, você precisa ter instalado em sua máquina:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

### ▶️ Executando o Projeto com Docker

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/isaquebraga/sefaz-eh-massa.git
   cd sefaz-eh-massa
   ```

2. **Construa e inicie os containers:**
   ```bash
   docker compose up --build
   ```

3. **Aguarde a inicialização completa dos serviços.**

4. **Acesse o [site](http://127.0.0.1:5173).**

> ⚙️ O backend usa banco SQLite, criado automaticamente dentro do container.

---

## 💡 Estrutura do Projeto
    sefaz-eh-massa/
    ├── backend/            # Aplicação Laravel (API e lógica de negócios)
    │   ├── app/
    │   ├── database/
    │   ├── routes/
    │   └── Dockerfile
    ├── frontend/           # Aplicação Vue.js (interface do usuário)
    │   ├── src/
    │   ├── public/
    │   └── Dockerfile
    ├── docker-compose.yml  # Orquestração dos containers
    └── README.md           # Documentação do projeto

---

## 🤝 Contribuindo

Contribuições são sempre bem-vindas!

Sinta-se à vontade para abrir issues, enviar PRs ou sugerir melhorias criativas.

1. Faça um fork do projeto

2. Crie uma branch para sua feature:
    ```bash
    git checkout -b feature/minha-feature
    ```

3. Faça o commit:
    ```bash
    git commit -m "feat: adiciona nova funcionalidade"
    ```

4. Envie para o repositório remoto:
    ```bash
    git push origin feature/minha-feature
    ```

---

## 📝 Licença

Este projeto está sob a Licença MIT.

Consulte o arquivo [LICENSE](https://github.com/isaquebraga/sefaz-eh-massa/blob/main/LICENSE) para mais detalhes.

---

## ✨ Agradecimentos

Desenvolvido com 💙 e criatividade para a Secretaria Municipal de Fazenda de Maceió ([SEFAZ](https://maceio.al.gov.br/secretarias-e-orgaos/sefaz)).