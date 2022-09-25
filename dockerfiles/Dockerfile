FROM php:7.4.5-apache

RUN apt-get -y update

RUN apt-get install -y \
        libzip-dev \
        zip \
        git \
        unzip \
        jq

RUN apt-get install -y libxml2-dev

RUN apt-get install -y libonig-dev

RUN apt-get install -y libcurl4-openssl-dev

RUN apt-get install -y libpng-dev

RUN apt-get install -y libpq-dev

# Install
RUN docker-php-ext-install pdo soap mbstring intl json pdo_mysql xml curl bcmath fileinfo tokenizer gd zip

# Enable Apache modules
RUN a2enmod headers rewrite
RUN a2enmod ssl
RUN service apache2 restart

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html