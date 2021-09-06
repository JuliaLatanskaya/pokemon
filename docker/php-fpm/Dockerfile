FROM php:8-fpm

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    wget \
    unzip \
    zip \
    libzip-dev \
    git \
    vim

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install gnupg -y

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y yarn && apt-get install -y nodejs build-essential && apt-get install -y npm

WORKDIR /app