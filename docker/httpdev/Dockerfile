FROM php:7.1.1-apache

COPY symfony.conf /etc/apache2/sites-available
RUN a2enmod rewrite && a2dissite 000-default && a2ensite symfony
