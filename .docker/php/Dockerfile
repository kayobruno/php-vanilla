FROM php:8.0.5-fpm-alpine@sha256:d0ca3bb7ac1328193ef5c246da1de3ff33f663ab5576ef05ad60a9b956707222

RUN apk add $PHPIZE_DEPS --no-cache openssl postgresql-dev bash \
    && pecl install xdebug redis \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable redis

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]