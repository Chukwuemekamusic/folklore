FROM php:7.4-apache
RUN apt-get update && apt upgrade -y

# ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# ENV APACHE_LOG_DIR /var/log/apache2

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli &&\
    a2enmod rewrite


COPY . /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf 
# &&\
#     a2enmod rewrite &&\
#     a2enmod headers &&\
#     a2endmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]

