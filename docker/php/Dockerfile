FROM php:8.2.7-cli-alpine3.18

RUN apk add --update --no-cache \
    icu-dev \
    git \
    unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY composer.json /app/composer.json
COPY composer.lock /app/composer.lock

RUN composer install --no-scripts --no-autoloader

COPY . /app

RUN composer dump-autoload

CMD ["php", "bin/console"]