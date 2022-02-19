FROM php:7.4-fpm-alpine

RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      libmcrypt-dev \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
      libxml2-dev \
      libzip-dev \
      graphviz \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      # --with-png=/usr/include/ \ # No longer necessary as of 7.4; https://github.com/docker-library/php/pull/910#issuecomment-559383597
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && docker-php-ext-install mysqli \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*

RUN apk add libzip-dev
RUN docker-php-ext-install pdo pdo_mysql zip bcmath sockets\
    && docker-php-source delete \
    && curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .

CMD php artisan serve --host=0.0.0.0:9000
EXPOSE 9000
