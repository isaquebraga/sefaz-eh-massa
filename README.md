# SEFAZ é Massa! 🚀

Sistema de gerenciamento e consulta de impostos desenvolvido com Laravel e Vue.js. Interface moderna e responsiva para visualização e administração de dados fiscais.

## 💻 Tecnologias

### Backend
- PHP 8.2
- Laravel 10
- Laravel Sanctum (Autenticação)
- SQLite (Banco de dados)

### Frontend
- Vue.js 3
- Vite
- Axios
- Vue Router
- CSS Puro (Sem frameworks)

## 🚀 Funcionalidades

- ✅ Autenticação segura com Laravel Sanctum
- 📊 Painel administrativo
- 💰 Consulta de impostos
- 👥 Gerenciamento de usuários
- 🎨 Interface moderna e responsiva
- 🔒 Proteção CSRF e validação de tokens

## 📦 Instalação

### Requisitos
- PHP >= 8.2
- Composer
- Node.js >= 16
- Git

### Backend (Laravel)

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/sefaz-eh-massa.git
cd sefaz-eh-massa/backend

# Instale as dependências
composer install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Crie e popule o banco
php artisan migrate --seed

# Inicie o servidor
php artisan serve
```

### Frontend (Vue.js)

```bash
# Na pasta frontend
cd ../frontend

# Instale as dependências
npm install

# Inicie o servidor de desenvolvimento
npm run dev
```

## ⚙️ Configuração

### Backend (.env)
```env
APP_URL=http://127.0.0.1:8000
FRONTEND_URL=http://localhost:5173

SESSION_DRIVER=file
SESSION_DOMAIN=localhost
SANCTUM_STATEFUL_DOMAINS=127.0.0.1:5173,localhost:5173

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

FRONTEND_SECRET=vue-access-123
```

### Frontend
O frontend já está configurado para acessar a API em `http://127.0.0.1:8000`. Se precisar alterar, ajuste no arquivo de ambiente do frontend.

## 👤 Credenciais de Teste

```
Usuário: admin
Senha: admin123
```

## 🤝 Contribuindo

1. Faça o fork do projeto
2. Crie sua feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## ✨ Agradecimentos

Desenvolvido com 💙 para a SEFAZ.