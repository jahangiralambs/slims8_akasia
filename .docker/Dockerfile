FROM php:5.6-apache

COPY . /src/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update -y && apt-get install -y  libfreetype6-dev libwebp-dev libjpeg62-turbo-dev libxpm-dev sendmail libpng-dev zlib1g-dev mysql-client libyaz-dev wget

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ &&\ 
docker-php-ext-install mbstring pdo pdo_mysql mysqli gettext gd

RUN pecl install yaz

RUN chown -R www-data:www-data /src/app
RUN a2enmod rewrite


