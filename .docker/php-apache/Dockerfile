FROM php:7.2.13-apache-stretch

RUN apt-get update \
 && apt-get install -y git zlib1g-dev \
 && docker-php-ext-install pdo pdo_mysql zip \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/web!g' /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
