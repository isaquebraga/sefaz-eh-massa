FROM php:8.2-cli

RUN apt-get update && apt-get install -y unzip git libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN mkdir -p database && touch database/database.sqlite

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
