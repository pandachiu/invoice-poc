FROM composer AS composer
COPY composer.* /app/
RUN composer install

FROM php:7.3-fpm
COPY . .
COPY --from=composer /app/vendor/ vendor/

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
