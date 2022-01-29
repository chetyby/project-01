FROM php:7.4-apache
RUN apt-get update && apt-get install -y libpq-dev nano
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY ./php.ini /usr/local/etc/php/php.ini
CMD ["apache2-foreground"]