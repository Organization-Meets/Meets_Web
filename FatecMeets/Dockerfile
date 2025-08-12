FROM php:8.2-apache

# Instala extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Habilita .htaccess e reescrita de URL se quiser futuramente
RUN a2enmod rewrite

# Instala o Composer no container
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia configurações personalizadas
COPY ./docker/php.ini /usr/local/etc/php/

# Define o diretório raiz do Apache
WORKDIR /var/www/html