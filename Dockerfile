FROM php:7.2-apache
WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_mysql
COPY . .
EXPOSE 3000