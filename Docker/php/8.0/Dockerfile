FROM somosyampi/docker-php-fpm:8.0

RUN apk add --update sudo
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
