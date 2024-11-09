#!/bin/bash

wait-for-it.sh $DB_HOST:$DB_PORT --timeout=300 -- echo "База данных доступна!"

php artisan migrate