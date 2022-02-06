#FROM php:8.0-alpine
FROM php:7.4-fpm-alpine

ENV COMPOSER_HOME="/tmp/composer"


RUN apk add --no-cache --virtual .persistent-deps \
    npm \
    # for intl extension
    icu-dev \
    # for postgres
    postgresql-dev \
    # for soap
    libxml2-dev \
    # for GD
    freetype \
    libpng \
    libjpeg-turbo \
    # for bz2 extension
    bzip2-dev \
    # for intl extension
    libintl gettext-dev libxslt \
    # etc
    bash nano git


COPY --from=composer:2.0.7 /usr/bin/composer /usr/bin/composer

RUN set -x \
    && apk add --no-cache binutils git \
    && apk add --no-cache --virtual .build-deps autoconf pkgconf make g++ gcc 1>/dev/null \
    # install xdebug (for testing with code coverage), but do not enable it
    && pecl install xdebug-3.0.0 1>/dev/null \
    && apk del .build-deps \
    && mkdir --parents --mode=777 /src ${COMPOSER_HOME}/cache/repo ${COMPOSER_HOME}/cache/files \
    && ln -s /usr/bin/composer /usr/bin/c \
    && composer --version \
    && php -v \
    && php -m

ENV PHPIZE_DEPS \
    autoconf \
    cmake \
    file \
    g++ \
    gcc \
    libc-dev \
    pcre-dev \
    make \
    git \
    pkgconf \
    re2c \
    # for GD
    freetype-dev \
    libpng-dev  \
    libjpeg-turbo-dev \
    libxslt-dev


RUN set -xe \
    # workaround for rabbitmq linking issue
    && ln -s /usr/lib /usr/local/lib64 \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS 


RUN set -xe \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure intl --enable-intl \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure mysqli --with-mysqli \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
    && docker-php-ext-configure soap --enable-soap 

RUN set -xe \
     && docker-php-ext-install -j$(nproc) \
        bcmath \
        intl \
        pcntl \
        mysqli \
        pdo_mysql \
        pdo_pgsql \
        soap \
        iconv \
        bz2 \
        calendar \
        exif \
        gettext \
        shmop \
        sockets \
        sysvmsg \
        sysvsem \
        sysvshm \
        opcache 


ARG GID
ARG UID
    
RUN addgroup -g $GID www
RUN adduser -u $UID --disabled-password --gecos "" --no-create-home -s /bin/bash -G www www
    
RUN mkdir /home/www && chown www:www /home/www

USER www
    
WORKDIR /var/www/app/public

CMD ["php-fpm"]
