FROM php:7-cli

#USER 1000:1000

RUN apt-get update && apt-get install -y curl git zip && rm -rf /var/lib/apt/lists/* && nano

RUN docker-php-ext-install bcmath pdo mysqli pdo_mysql

WORKDIR /app

COPY ./ /app/

VOLUME /my_volume1