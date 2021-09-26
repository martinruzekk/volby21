FROM php:7.4-apache

#RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN apt-get update && apt-get upgrade -y

WORKDIR /var/www/
ADD . /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod 777 -R html/src

RUN ls -al
RUN ls -al html

EXPOSE 80


#ENV APACHE_DOCUMENT_ROOT /var/www/html

#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
