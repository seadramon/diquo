FROM fpm-penawaran

COPY composer.lock composer.json /var/www/penawaran/

COPY database /var/www/penawaran/database

WORKDIR /var/www/penawaran

# RUN php composer.phar install --no-dev --no-scripts
# .
    
COPY . /var/www/penawaran

RUN chown -R www-data:www-data \
        /var/www/penawaran/storage \
        /var/www/penawaran/bootstrap/cache

RUN mv production.env .env
