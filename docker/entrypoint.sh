#! /bin/sh
php-fpm7

sleep 10 # Wait for MaruaDB to start
mysql -u root -proot -h 0x1_database -D nnullptr -e '#' 2>/dev/null # Check if database exists
if [[ "$?" == "1" ]]; then
	echo "Sourcing Database to MariaDB"
	mysql -u root -proot -h 0x1_database < /tmp/database.sql
fi

echo "Starting Nginx"
nginx -g 'daemon off;'