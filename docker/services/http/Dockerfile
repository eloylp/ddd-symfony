FROM php:7.1.0-apache

COPY ./docker/services/http/symfony.conf /etc/apache2/sites-available
COPY . /var/www/html

RUN apt-get update -y && apt-get upgrade -y && apt-get dist-upgrade -y \
    && apt-get install -y libmcrypt-dev zlib1g-dev libcurl4-gnutls-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql mcrypt zip curl mbstring

RUN a2enmod rewrite && a2dissite 000-default && a2ensite symfony \
&& echo "#!/bin/sh" > /tmp/modified-entry-point \
&& echo "chown -R www-data.www-data /var/www/html/src/Infrastructure/Web/Symfony/var" >> /tmp/modified-entry-point \
&& cat /usr/local/bin/docker-php-entrypoint >> /tmp/modified-entry-point \
&& cp /tmp/modified-entry-point /usr/local/bin/docker-php-entrypoint
