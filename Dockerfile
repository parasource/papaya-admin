FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/apapaya

COPY . /var/www/apapaya
RUN rm -rf /var/www/apapaya/node_modules

RUN mkdir /var/www/storage
RUN chmod -R 755 /var/www
RUN usermod -u 1000 www-data
RUN chown -R 1000:1000 /var/www

RUN /usr/bin/composer install --ignore-platform-req=ext-http

#ENTRYPOINT ["/var/www/apapaya/migrate.sh"]
