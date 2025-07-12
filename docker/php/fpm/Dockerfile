FROM composer:2.6.6 AS composer

WORKDIR /var/www/html

COPY ./app/composer.lock .
COPY ./app/composer.json .

RUN composer install --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

COPY ./app/src ./src

FROM php:8.3-fpm-alpine3.19

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions \
    pdo_pgsql \
    uuid \
 > /dev/null
RUN rm /usr/bin/install-php-extensions

COPY --from=composer /var/www/html/vendor/ /var/www/html/vendor/

USER www-data
