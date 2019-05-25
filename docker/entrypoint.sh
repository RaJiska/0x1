#! /bin/sh
php-fpm7

if [[ ! -e "/tmp/docker_configured" ]]; then
	# Docker first start
	echo "Configuring according to environment"
	sed -i -e "s/^CREATE DATABASE.*/CREATE DATABASE $DB_NAME;/g" /tmp/database.sql
	sed -i -e "s/^USE.*/USE $DB_NAME;/g" /tmp/database.sql
	sed -i -e "s/^GRANT ALL PRIVILEGES.*/GRANT ALL PRIVILEGES ON $DB_NAME\.* TO '$DB_USERNAME'@'%' IDENTIFIED BY '$DB_PASSWORD';/g" /tmp/database.sql

	sed -i -e "s/\$config\['db'\]\['host'\].*/\$config\['db'\]\['host'\] = \"$DB_HOST\";/g" /var/www/html/config/config.php
	sed -i -e "s/\$config\['db'\]\['name'\].*/\$config\['db'\]\['name'\] = \"$DB_NAME\";/g" /var/www/html/config/config.php
	sed -i -e "s/\$config\['db'\]\['username'\].*/\$config\['db'\]\['username'\] = \"$DB_USERNAME\";/g" /var/www/html/config/config.php
	sed -i -e "s/\$config\['db'\]\['password'\].*/\$config\['db'\]\['password'\] = \"$DB_PASSWORD\";/g" /var/www/html/config/config.php
fi
touch /tmp/docker_configured

sleep 10 # Wait for MaruaDB to start
mysql -u root -p$DB_ROOT_PASSWORD -h $DB_HOST -D $DB_NAME -e '#' 2>/dev/null # Check if database exists
if [[ "$?" == "1" ]]; then
	echo "Sourcing Database to MariaDB"
	mysql -u root -p$DB_ROOT_PASSWORD -h $DB_HOST < /tmp/database.sql
fi

echo "Starting Nginx"
nginx -g 'daemon off;'