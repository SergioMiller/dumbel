#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM php:8.1-fpm-alpine

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#

RUN apk update && apk add --no-cache \
    supervisor \
    gcc \
    make \
    autoconf \
    libc-dev \
    pkgconfig \
    libzip-dev \
    curl \
    libcurl \
    git \
    unzip \
    postgresql-dev \
    libwebp-dev \
    openssl \
    libxml2-dev

#install gd
RUN apk update && apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Get latest Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install sockets

RUN docker-php-ext-install pdo_pgsql pcntl posix zip

#RUN apk add --no-cache imagemagick-dev \
#    && pecl install imagick \
#    && docker-php-ext-enable imagick

RUN pecl install redis \
    && docker-php-ext-enable redis

#
#--------------------------------------------------------------------------
# Install mcrypt extension, required for base Laravel app
#--------------------------------------------------------------------------
#
#RUN apk add --no-cache libmcrypt-dev \
#    && pecl install mcrypt-1.0.1 \
#    && docker-php-ext-enable mcrypt

COPY docker/queue/config/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www

COPY app /var/www/app/
COPY bootstrap /var/www/bootstrap/
COPY config /var/www/config/
COPY database /var/www/database/
COPY lang /var/www/lang/
COPY public /var/www/public/
COPY resources /var/www/resources/
COPY routes /var/www/routes/
COPY storage /var/www/storage/
COPY tests /var/www/tests/
COPY .env /var/www/

COPY composer.json composer.lock artisan .php-cs-fixer.php phpunit.xml firebase.json /var/www/

#RUN set -eux; \
#    mkdir -p storage/logs; \
#    chmod -R 777 storage; \
#    chmod -R 777 bootstrap/cache; \
#    composer install; \
#    chmod +x artisan; \
#    php artisan optimize

RUN set -eux; \
    composer install; \
    mkdir -p storage/logs; \
    chmod -R 777 bootstrap/cache; \
    chmod -R 777 storage


COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]

COPY docker/queue/supervisord.conf /etc/supervisord.conf
COPY docker/queue/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/queue/default-job.conf /etc/supervisor/conf.d/default-job.conf

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
