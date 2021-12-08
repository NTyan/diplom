FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    npm \
    libzip-dev \
    zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli pdo pdo_mysql

#GD install
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/app

CMD ["php-fpm"]
