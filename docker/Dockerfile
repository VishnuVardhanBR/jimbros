FROM ubuntu:latest

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository -y ppa:ondrej/php

RUN apt-get update && \
    apt-get install -y \
    apache2 \
    php7.4 php7.4-fpm \
    curl

RUN a2enmod proxy_fcgi setenvif && a2enconf php7.4-fpm

RUN rm -rf /var/www/html

COPY . /var/www/html

# RUN rm -rf /etc/apache2/sites-available

# COPY docker/apache2/sites-available /etc/apache2/sites-available

COPY docker/start-script.sh /root/

RUN chmod +x /root/start-script.sh

CMD /root/start-script.sh


# Cmd to build
# docker build -t jimbros -f docker/Dockerfile .

# Cmd to run (for dev)
# docker run -it --rm -p 8080:80 -v $pwd:/var/www/html -v jimbros

# Cmd to run (for prod)
# docker run -it --rm -p 8080:80 jimbros
