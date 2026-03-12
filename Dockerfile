FROM php:8.3-apache

# MySQLドライバ（pdo_mysql）をインストール
RUN docker-php-ext-install pdo_mysql

# (任意) Apacheのドキュメントルートをpublicに変更する場合
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
