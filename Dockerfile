FROM php:8.1-fpm

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
    libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/apapaya

COPY . /var/www/apapaya
RUN rm -rf /var/www/apapaya/node_modules

#RUN mkdir /var/www/storage
RUN chmod -R 755 /var/www
RUN usermod -u 1000 www-data
RUN chown -R 1000:1000 /var/www

RUN apt-get update && apt-get install -y locales
# Locale
RUN sed -i -e \
  's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen \
   && locale-gen

ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU:ru
ENV LC_LANG ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

# +Timezone (если надо на этапе сборки)
ENV TZ Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone


RUN /usr/bin/composer install --ignore-platform-req=ext-http

#ENTRYPOINT ["/var/www/apapaya/migrate.sh"]
