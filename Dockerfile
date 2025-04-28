# Usa uma imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instala extensões necessárias (PDO para MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Copia os arquivos da pasta src para o diretório padrão do Apache
COPY src/ /var/www/html/

# Define permissões corretas
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80
EXPOSE 80