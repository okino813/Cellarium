FROM dunglas/frankenphp:1-php8.4-alpine AS base
RUN install-php-extensions @composer pcntl pdo_mysql pdo_pgsql gd zip intl opcache bcmath
ENV SERVER_NAME=:80
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
WORKDIR /app

FROM base AS build
RUN apk add --no-cache nodejs npm
COPY . .
RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader
RUN npm ci && npm run build && rm -rf node_modules

FROM base
COPY --from=build /app /app