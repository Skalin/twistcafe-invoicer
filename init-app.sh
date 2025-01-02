#!/bin/sh


set -e

cd /app

mkdir -p var/cache var/log
chmod -R 777 var/cache var/log

composer install

php bin/console doctrine:migrations:migrate --no-interaction
