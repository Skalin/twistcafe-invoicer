#!/bin/sh


set -e

cd /app

mkdir -p var/cache var/log
chmod -R 777 var/cache var/log

if [ ! -f .env.local ]; then
  echo "DATABASE_URL=mysql://admin:password@mysql:3306/app" > .env.local
fi

composer install

php bin/console doctrine:migrations:migrate --no-interaction
