FROM php:7
RUN apt-get update -y && apt-get install -y openssl zip unzip git build-essential gnupg 
RUN curl -sL https://deb.nodesource.com/setup_10.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt install -y nodejs
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app
RUN npm install
RUN composer install
RUN cp .env.example .env


RUN php artisan key:generate 
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181