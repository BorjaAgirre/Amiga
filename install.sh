#!/bin/bash
# Inicializa después de un pull
php composer.phar install
chown -R www-data app/cache
chown -R www-data app/logs
chgrp -R www-data app/cache
chgrp -R www-data app/logs
