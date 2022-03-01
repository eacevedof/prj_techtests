FROM php:7.3-apache

RUN apt-get update \
    && apt-get -y install --no-install-recommends \
    && apt-get install -y libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql

RUN a2enmod rewrite