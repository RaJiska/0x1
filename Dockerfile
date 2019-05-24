FROM alpine:3.8

EXPOSE 80

# Nginx, SQL Database & PHP Installation
RUN \
	apk update && \
	apk upgrade && \
	apk add php7-cli php7-fpm php7-fileinfo php7-pdo php7-pdo_mysql nginx mariadb-client && \
	adduser -D -g 'www' www && \
	rm /etc/nginx/conf.d/default.conf && \
	rm /etc/php7/php-fpm.d/www.conf && \
	rm /etc/php7/php.ini && \
	mkdir -p /run/nginx && \
	mkdir -p /var/www && \
	rm -rf /var/www/*

ADD docker/nginx.conf /etc/nginx/conf.d/default.conf
ADD docker/php-fpm.conf /etc/php7/php-fpm.d/www.conf
ADD docker/php.ini /etc/php7/php.ini
ADD sql/database.sql /tmp/database.sql

# Setup crontab for www user
RUN \
	echo '0 */1 * * * (cd /var/www/html/crons && php clean.php)' > /tmp/cron && \
	crontab -u www /tmp/cron && \
	rm /tmp/cron

ADD docker/entrypoint.sh /tmp/entrypoint.sh
RUN chmod 700 /tmp/entrypoint.sh
ENTRYPOINT ["/tmp/entrypoint.sh"]