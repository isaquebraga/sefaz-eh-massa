#!/bin/bash
set -e

# Caminho do banco SQLite
DB_PATH="/var/www/html/database/database.sqlite"

# Instalar dependências
composer install

# Criar o .env se ainda não existir
if [ ! -f ".env" ]; then
  cp .env.example .env
  php artisan key:generate
fi

# Criar banco de dados se não existir
if [ ! -f "$DB_PATH" ]; then
  echo "Banco de dados não encontrado. Criando..."
  mkdir -p /var/www/html/database
  touch "$DB_PATH"
  php artisan migrate --seed
else
  echo "Banco de dados já existe. Pulando migrations e seeders."
fi

# Iniciar o servidor Laravel
php artisan serve --host=0.0.0.0 --port=8000
