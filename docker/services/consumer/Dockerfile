FROM php:7.1-cli

RUN apt-get update \
    && apt-get install -y libmcrypt-dev zlib1g-dev libcurl4-openssl-dev pkg-config libssl-dev \
    && docker-php-ext-install pdo pdo_mysql mcrypt curl bcmath pcntl \
    && pecl install mongodb && docker-php-ext-enable mongodb

CMD [ "php", "/ddd/src/Infrastructure/Event/Cli/EventConsumerLauncher.php" ]
