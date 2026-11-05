# syntax=docker/dockerfile:1

ARG PHP_VERSION=8.4.27
ARG FRANKENPHP_VERSION=1.13.4

FROM dunglas/frankenphp:${FRANKENPHP_VERSION}-php${PHP_VERSION}-bookworm AS base

ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_ALLOW_SUPERUSER=1 \
    APP_HOME=/app

WORKDIR /app

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
        libzip-dev \
        libicu-dev \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache \
        sockets \
        fileinfo \
        tokenizer \
        xml \
        ctype \
        curl \
        dom

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/php/Caddyfile /etc/frankenphp/Caddyfile

FROM base AS vendor

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

FROM node:24-slim AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci || npm install

COPY vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm run build

FROM base AS runtime

ARG APP_ENV=production
ENV APP_ENV=${APP_ENV}

COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

COPY . .

RUN composer dump-autoload --no-dev --optimize --classmap-authoritative \
    && mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/framework/testing \
        storage/logs \
        storage/app/public \
        bootstrap/cache \
    && chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

COPY docker/php/entrypoint.sh /usr/local/bin/app-entrypoint
RUN chmod +x /usr/local/bin/app-entrypoint

ENV SERVER_NAME=:80 \
    SERVER_ROOT=/app/public \
    FRANKENPHP_CONFIG="" \
    RUN_MIGRATIONS=false

EXPOSE 80 443 443/udp

HEALTHCHECK --interval=30s --timeout=5s --start-period=40s --retries=3 \
    CMD php -r "exit(@file_get_contents('http://127.0.0.1:80/up') === false ? 1 : 0);"

ENTRYPOINT ["app-entrypoint"]
CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
