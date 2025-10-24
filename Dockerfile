FROM ghcr.io/rpungello/laravel-frankenphp:php8.4

ARG VERSION=1.0.0
ENV APP_VERSION=${VERSION}
COPY . /app
RUN composer install && npm install && npm run build \
 && chown -R www-data:www-data /app

HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD php artisan status
