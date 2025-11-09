#!/bin/bash
set -e

DB_PATH="/var/www/html/database/database.sqlite"

composer install

if [ ! -f ".env" ]; then
  cp .env.example .env
  php artisan key:generate
fi

if [ ! -f "$DB_PATH" ]; then
  echo "Banco de dados não encontrado. Criando..."
  mkdir -p /var/www/html/database
  touch "$DB_PATH"
  php artisan migrate --seed
else
  echo "Banco de dados já existe. Pulando migrations e seeders."
fi

php artisan serve --host=0.0.0.0 --port=8000
