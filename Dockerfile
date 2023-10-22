FROM php:8.0-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

# Install dependencies for the operating system software
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

#COPY --chown=www:www . /var/www

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

#USER www

EXPOSE 9000
CMD ["php-fpm", "-F"]
