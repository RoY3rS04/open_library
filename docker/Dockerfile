FROM php:8.5-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmagickwand-dev \
    ghostscript \
    qpdf \
    libonig-dev  \
    libcurl4-openssl-dev  \
    zlib1g-dev \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql zip gd mbstring bcmath xml curl pcntl exif fileinfo intl \
    && pecl install imagick \
    && pecl install redis \
    && docker-php-ext-enable imagick redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www

RUN echo "upload_max_filesize = 20M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 25M" >> /usr/local/etc/php/conf.d/uploads.ini

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
