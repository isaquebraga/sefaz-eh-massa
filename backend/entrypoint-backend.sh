#!/bin/bash
set -e

# Caminho do banco SQLite
DB_PATH="/var/www/html/database/database.sqlite"

echo "Iniciando entrypoint do backend..."

# Instala dependências do Composer
if [ ! -d "vendor" ]; then
  echo "Instalando dependências do Composer..."
  composer install
else
  echo "Dependências do Composer já instaladas."
fi

# Cria o .env se não existir
if [ ! -f ".env" ]; then
  echo "Arquivo .env não encontrado. Criando..."
  cp .env.example .env
  php artisan key:generate
else
  echo "Arquivo .env já existe."
fi

# Cria a pasta database se não existir
mkdir -p /var/www/html/database

# Cria o banco de dados se não existir ou estiver vazio
if [ ! -f "$DB_PATH" ] || [ ! -s "$DB_PATH" ]; then
  echo "Banco de dados não encontrado ou vazio. Criando e populando..."
  touch "$DB_PATH"
  php artisan migrate --seed
else
  echo "Banco de dados já existe. Pulando migrations e seeders."
fi

# Inicia o servidor Laravel
echo "Iniciando servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000