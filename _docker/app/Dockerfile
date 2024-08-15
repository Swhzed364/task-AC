FROM php:8-apache

COPY _docker/app/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY _docker/app/apache2/apache2.conf /etc/apache2/apache2.conf

RUN docker-php-ext-install mysqli && \
    docker-php-ext-install pdo && \
    docker-php-ext-install pdo_mysql

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin