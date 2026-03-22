#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --optimize-autoloader

# Les commandes ci-dessous peuvent échouer si la DB n'est pas encore prête lors du premier build, 
# c'est pourquoi on les met parfois dans le Start Command sur Render, 
# mais les mettre ici est classique pour Laravel.
# php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
