#!/bin/bash
# Inicializa después de un pull
composer install
sudo chown -R www-data app/cache
sudo chown -R www-data app/logs
sudo chgrp -R www-data app/cache
sudo chgrp -R www-data app/logs
