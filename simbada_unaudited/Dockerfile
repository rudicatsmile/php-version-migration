FROM docker.io/library/php:5.6-apache

# 1. Gunakan repository arsip dan matikan pengecekan masa berlaku (Valid-Until)
RUN echo "deb http://archive.debian.org/debian/ stretch main" > /etc/apt/sources.list && \
    echo "deb http://archive.debian.org/debian-security/ stretch/updates main" >> /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until

# 2. Update dan Install dengan flag --allow-unauthenticated jika diperlukan
RUN apt-get update && apt-get install -y --allow-unauthenticated \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install mysql mysqli pdo_mysql gd

# 3. Aktifkan mod_rewrite untuk PHP Native/Legacy jika diperlukan
RUN a2enmod rewrite

# 4. Pastikan Apache mengizinkan pembacaan .htaccess di folder root
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# 5. Set ServerName agar log bersih
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
