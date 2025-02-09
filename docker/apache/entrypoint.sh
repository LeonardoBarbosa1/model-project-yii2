#!/bin/bash

set -e

php /var/www/html/init --env=Development --overwrite=All

#composer update

chmod 777 -R common/models

/usr/bin/supervisord
