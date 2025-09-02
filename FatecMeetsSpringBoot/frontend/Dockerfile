# FatecMeetsSpringBoot/frontend/Dockerfile

FROM node:22-alpine

WORKDIR /app

COPY package*.json ./
RUN npm install

# Copia todos os arquivos, incluindo o .env.docker (renomeando para .env)
COPY . . 
RUN cp .env.docker .env

EXPOSE 5173

CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
