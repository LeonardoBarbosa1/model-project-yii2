FROM yiisoftware/yii2-php:8.1-apache

USER root

RUN apt-get update -y
RUN apt-get install nano -y
RUN a2enmod ssl
RUN a2ensite default-ssl.conf

WORKDIR /var/www/html

RUN apt-get install -yq tzdata && \
    ln -fs /usr/share/zoneinfo/America/Recife /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

RUN #apt-get install -y certbot python3-certbot-dns-route53

RUN apt-get install -y supervisor

COPY ./docker/apache/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY ./docker/apache/entrypoint.sh /usr/sbin/entrypoint.sh

RUN chmod +x /usr/sbin/entrypoint.sh

COPY composer.json /var/www/html/

COPY ./functions.php /var/www/html/

#RUN composer install --no-dev --optimize-autoloader
#RUN composer install
RUN composer install --ignore-platform-req=php

COPY . /var/www/html

#ENTRYPOINT ["sh", "-c", "/usr/sbin/entrypoint.sh"]

