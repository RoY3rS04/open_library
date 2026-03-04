FROM serversideup/php:8.5-fpm-nginx

# Switch to root to install extensions
USER root

# Install qpdf and clean up to keep the image small
RUN apt-get update && apt-get install -y \
    qpdf \
    ghostscript \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install any PHP extension easily
RUN install-php-extensions imagick exif

RUN mkdir -p $APP_BASE_DIR/storage/app/private/mini/books

RUN composer install --no-dev --no-scripts --optimize-autoloader
