#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM php:8.1-fpm

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#

RUN apt-get update -y
RUN apt-get -y install gcc make autoconf libc-dev pkg-config libzip-dev

RUN docker-php-ext-install sockets

RUN apt-get install -y --no-install-recommends \
        curl libcurl4-openssl-dev \
#        geoip-bin \
#        geoip-database \
#        libgeoip-dev \
        git \
#        libmemcached-dev \
#        libz-dev \
        unzip \
        libpq-dev \
        libwebp-dev \
#        libfreetype6-dev \
#        libssl-dev \
#        libmagickwand-dev \
        openssl \
        libxml2-dev \
        mariadb-client

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#
#--------------------------------------------------------------------------
# Install the PHP extentions
#--------------------------------------------------------------------------
#

RUN docker-php-ext-configure soap --enable-soap \
  && docker-php-ext-install \
    pdo_pgsql \
    pcntl \
    posix \
#    exif \
#    iconv \
#    mbstring \
#    mysqli \
#    phar \
#    soap \
#    tokenizer \
     zip
#    gd \
#    pdo_mysql

#RUN docker-php-ext-install gd

#
#--------------------------------------------------------------------------
# Install PHP extentions by pecl
#--------------------------------------------------------------------------
#
#RUN pecl install redis memcached mongodb msgpack imagick mcrypt-1.0.1 && \
#    docker-php-ext-enable redis memcached mongodb msgpack imagick mcrypt

RUN apt-get update && apt-get install -y \
    tmux libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick


RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

#php-cs-fixer
RUN curl -L https://cs.symfony.com/download/php-cs-fixer-v3.phar -o php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

#
#--------------------------------------------------------------------------
# Install mcrypt extention, required for base laravel app
#--------------------------------------------------------------------------
#
#RUN pecl install mcrypt-1.0.1 && \
#    docker-php-ext-enable mcrypt

#RUN pecl install http://pecl.php.net/get/geoip-1.1.1.tgz && \
#    docker-php-ext-enable geoip

COPY docker/php/config/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www

COPY app /var/www/app/
COPY bootstrap /var/www/bootstrap/
COPY config /var/www/config/
COPY database /var/www/database/
COPY public /var/www/public/
COPY resources /var/www/resources/
COPY routes /var/www/routes/
COPY storage /var/www/storage/
COPY tests /var/www/tests/
COPY .env /var/www/

COPY composer.json composer.lock artisan .php-cs-fixer.php /var/www/

RUN composer install; \
    mkdir -p storage/logs; \
    chmod -R 777 bootstrap/cache; \
    chmod -R 777 storage

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

EXPOSE 9000

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm", "--nodaemonize"]