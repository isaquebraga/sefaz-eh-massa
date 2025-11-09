#!/bin/bash
set -e

if [ ! -d "node_modules" ]; then
  echo "Instalando dependências do frontend..."
  npm install
else
  echo "Dependências já instaladas."
fi

npm run dev -- --host
