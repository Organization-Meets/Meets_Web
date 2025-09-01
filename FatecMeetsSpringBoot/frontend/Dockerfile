# Usar Node 22 LTS (recomendado para Vite 5+)
FROM node:22-alpine

# Definir diretório de trabalho
WORKDIR /app

# Copiar arquivos de dependências primeiro (cache build)
COPY package*.json ./

# Instalar dependências
RUN npm install

# Copiar resto dos arquivos do projeto
COPY . .

# Expor a porta padrão do Vite (5173)
EXPOSE 5173

# Rodar servidor dev do Vite acessível de fora do container
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "5173"]
