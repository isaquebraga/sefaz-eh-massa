#!/bin/bash
set -e

# Instala dependências se não existirem
if [ ! -d "node_modules" ]; then
  echo "Instalando dependências do frontend..."
  npm install
else
  echo "Dependências já instaladas."
fi

# Inicia o servidor de desenvolvimento
echo "Iniciando servidor Vite..."
npx vite --host 0.0.0.0
