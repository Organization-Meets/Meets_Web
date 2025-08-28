# Base PHP 8.3
FROM php:8.3-cli

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    unzip wget git curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do Laravel para dentro do container
COPY . .

# Ajusta permissões (storage e bootstrap/cache precisam ser graváveis)
RUN chmod -R 775 storage bootstrap/cache

# Expõe a porta do servidor embutido
EXPOSE 8080

# Comando padrão: roda o servidor embutido do PHP servindo o Laravel
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
