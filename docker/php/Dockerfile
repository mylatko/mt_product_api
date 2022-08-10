ARG PHP_VERSION=8.1-fpm

FROM php:${PHP_VERSION}

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
	&& docker-php-ext-configure zip \
	&& docker-php-ext-install zip \
	&& docker-php-ext-install pdo

# Install PHP tools
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Expose the port nginx is reachable on
EXPOSE 9000

# Let supervisord start nginx & php-fpm
ENTRYPOINT ["/bin/bash", "-c"]
CMD ["php-fpm", "-F"]
