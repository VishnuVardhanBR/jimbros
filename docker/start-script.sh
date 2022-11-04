# !/bin/bash
a2enmod rewrite

service php7.4-fpm start
service apache2 start

sleep infinity
