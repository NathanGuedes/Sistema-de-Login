FROM php:8.4-fpm

# Instalar dependências e extensões PHP
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        intl \
        gd \
    && rm -rf /var/lib/apt/lists/*

# Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Instalar Composer (aproveitando imagem oficial pra garantir versão atual)
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

