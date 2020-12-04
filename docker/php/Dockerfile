FROM php:8.0.0-fpm-alpine

ARG UID
ENV UID=${UID:-1000}

RUN apk --no-cache add \
      git \
      vim \
      zip \
      openssh-client \
      icu-libs \
      libzip \
      libxml2 \
      libgd \
    && apk --no-cache add --virtual .build-deps \
      icu-dev \
      libzip-dev \
      libxml2-dev \
      gd-dev \
    && docker-php-ext-configure gd \
      --enable-gd \
      --with-external-gd=/usr/lib/libgd.so.3 \
    && docker-php-ext-install \
      intl \
      pdo \
      pdo_mysql \
      zip \
      gd \
      soap \
      bcmath \
      sockets \
    && apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache xdebug \
    && apk del --purge .build-deps .phpize-deps

RUN wget https://getcomposer.org/composer.phar -O /usr/bin/composer \
  && chmod +x /usr/bin/composer \
  && composer self-update

RUN wget https://cs.symfony.com/download/php-cs-fixer-v2.phar -O php-cs-fixer \
  && chmod a+x php-cs-fixer \
  && mv php-cs-fixer /usr/local/bin/php-cs-fixer

RUN adduser -u ${UID} --disabled-password --gecos "" appuser \
  && mkdir /home/appuser/.ssh \
  && chown -R appuser:appuser /home/appuser/ \
  && echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config \
  && echo "export COLUMNS=300" >> /home/appuser/.bashrc \
  && echo "alias sf=/var/www/bin/console" >> /home/appuser/.bashrc

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www
