#!/bin/sh
docker-compose up -d --build penawaran;
docker exec penawaran bash -c "composer install;php artisan optimize:clear"
#docker restart nginx;
#docker restart dashboard;