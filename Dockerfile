FROM php:8.0-fpm-alpine

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

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/apapaya

COPY . /var/www/apapaya
RUN rm -rf /var/www/apapaya/node_modules

RUN chmod -R 755 /var/www/apapaya
#RUN usermod -u 1000 www-data
#RUN chown -R 1000:1000 /var/www/apapaya

RUN /usr/bin/composer install

#ENTRYPOINT ["/var/www/apapaya/migrate.sh"]
