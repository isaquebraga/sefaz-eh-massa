FROM php:8.2

RUN apt-get update && apt-get install -y \
    zip unzip sqlite3 libsqlite3-dev git curl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install

RUN cp .env.example .env && php artisan key:generate

RUN mkdir -p database && touch database/database.sqlite

RUN php artisan migrate --seed

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
