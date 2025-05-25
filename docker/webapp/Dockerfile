# Start with PHP 8.3 FPM (FastCGI Process Manager)
FROM php:8.3-fpm

ARG APP_ID=1000

# Update package list and install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libbz2-dev \
    libxml2-dev \
    libxslt-dev \
    libsodium-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip

# Clean up to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
# Each one serves specific purpose:
RUN docker-php-ext-install \
  bcmath \
  bz2 \
  calendar \
  exif \
  gd \
  gettext \
  intl \
  mbstring \
  mysqli \
  opcache \
  pcntl \
  pdo_mysql \
  soap \
  sockets \
  sodium \
  sysvmsg \
  sysvsem \
  sysvshm \
  xsl \
  zip

# Redis for caching/sessions
RUN pecl install redis && docker-php-ext-enable redis

# Xdebug for debugging - REMOVE IN PRODUCTION!
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Get Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g "$APP_ID" webapp \
  && useradd -g "$APP_ID" -u "$APP_ID" -d /var/www -s /bin/bash webapp

#RUN apt-get install -y gnupg \
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - \
  && apt-get install -y nodejs \
  && mkdir /var/www/.config /var/www/.npm \
  && chown webapp:webapp /var/www/.config /var/www/.npm \
  && npm install -g grunt-cli

# Add our PHP config phpX.Y is the standard convention in ubuntu
COPY php8.3 /usr/local/etc/php-fpm.d/
COPY php8.3 /usr/local/etc/php/
COPY php8.3 /usr/local/etc/


RUN mkdir -p /var/www/webapp /sock \
  && chown -R webapp:webapp /var/www /usr/local/etc/php/conf.d /sock

# USER webapp:webapp

# Set working directory
WORKDIR /var/www/webapp

# What command to run
CMD ["php-fpm"]

# Document that we use port 9000
EXPOSE 9000