FROM webdevops/php-dev:8.3

RUN docker-php-ext-install pdo pdo_mysql && \ 
    docker-php-ext-enable pdo_mysql
