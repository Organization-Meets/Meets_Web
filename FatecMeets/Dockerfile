FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql

# Instala dependências necessárias
RUN apt-get update && apt-get install -y unzip wget

# Baixa e extrai o phpMyAdmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-all-languages.zip \
    && unzip phpMyAdmin-5.2.1-all-languages.zip \
    && mv phpMyAdmin-5.2.1-all-languages phpmyadmin \
    && rm phpMyAdmin-5.2.1-all-languages.zip

# Define o diretório de trabalho para o phpMyAdmin
WORKDIR /var/www/html/phpmyadmin

# Comando padrão para rodar o servidor embutido do PHP servindo o phpMyAdmin
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/phpmyadmin"]