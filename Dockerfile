# Sử dụng PHP 8.1 với Apache
FROM php:8.1-apache

# Cập nhật và cài đặt thư viện cần thiết
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ \
    && docker-php-ext-install pdo_pgsql pgsql

# Cấu hình ServerName cho Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Sao chép mã nguồn vào container
COPY ./public /var/www/html/

# Thiết lập quyền cho thư mục web
RUN chown -R www-data:www-data /var/www/html

# Chạy Apache
CMD ["apache2-foreground"]
