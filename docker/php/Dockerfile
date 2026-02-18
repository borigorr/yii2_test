FROM php:8.3.0-fpm

ENV PHP_USER_ID=1000
ENV PHP_GROUP_ID=1000

RUN apt-get update

RUN apt-get install -y git curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u $PHP_USER_ID www-data \
    && groupmod -g $PHP_GROUP_ID www-data
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN chown -R  www-data:www-data /var/www
USER www-data
