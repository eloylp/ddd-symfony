FROM php:7.1.0-apache

COPY symfony.conf /etc/apache2/sites-available

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    #&& echo "xdebug.profiler_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    #&& echo "xdebug.profiler_enable_trigger=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    #&& echo "xdebug.profiler_output_dir=/var/www/html/profiler" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN apt-get update \
    && apt-get install -y libmcrypt-dev zlib1g-dev libcurl4-openssl-dev pkg-config libssl-dev \
    && docker-php-ext-install pdo pdo_mysql mcrypt curl bcmath sockets \
    && pecl install mongodb && docker-php-ext-enable mongodb

RUN a2enmod rewrite && a2dissite 000-default && a2ensite symfony \
    && echo "#!/bin/sh" > /tmp/modified-entry-point \
    && echo "chown -R www-data.www-data /var/www/html/src/Infrastructure/Web/Symfony/var" >> /tmp/modified-entry-point \
    && cat /usr/local/bin/docker-php-entrypoint >> /tmp/modified-entry-point \
    && cp /tmp/modified-entry-point /usr/local/bin/docker-php-entrypoint
