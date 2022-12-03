FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev && rm -rf /var/lib/apt/lists/* \
     && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd

RUN docker-php-ext-install zip pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create app directory
RUN mkdir -p /var/www/app
WORKDIR /var/www/app

# Install app dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy app code
COPY . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Run database migrations

CMD ["php-fpm"]
