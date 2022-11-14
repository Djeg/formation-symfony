FROM php:8

RUN apt-get update
RUN apt-get -y install git build-essential libzip-dev zlib1g-dev default-mysql-client
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN ln -s /composer.phar /usr/bin/composer
RUN chmod +x /usr/bin/composer
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo pdo_mysql zip
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli
RUN mkdir /app

WORKDIR /app

CMD [ "composer" ]
