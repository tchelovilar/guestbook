FROM php:7.2-apache-stretch

RUN apt-get update -y && \
    apt-get -y install \
        git && \
    curl https://getcomposer.org/installer -o /tmp/composer-install && \
    php /tmp/composer-install --install-dir=/usr/bin --filename=composer && \
    rm -rf /var/lib/apt/lists/* && \
    rm -f /tmp/composer-install

WORKDIR /var/www/html

COPY src  /var/www/html

RUN composer install

EXPOSE 80

