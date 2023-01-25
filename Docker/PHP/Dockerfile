FROM php:7.4-apache
RUN docker-php-ext-install mysqli && a2enmod rewrite
RUN pecl install xdebug-3.0.3
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini


