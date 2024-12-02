FROM webdevops/php-dev:8.3

RUN docker-php-ext-install pdo pdo_mysql && \ 
    docker-php-ext-enable pdo_mysql
   
# RUN echo extension=php_curl.dll >> /opt/docker/etc/php/php.ini
# RUN echo extension=extension=curl.so >> /opt/docker/etc/php/php.ini