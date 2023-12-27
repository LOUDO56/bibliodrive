FROM php:apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Install PDO and PDO MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql

# Restart Apache
CMD ["apache2-foreground"]