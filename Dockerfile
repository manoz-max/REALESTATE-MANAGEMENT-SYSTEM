# Use an official PHP image with Apache
FROM php:8.2-apache

# Set working directory inside the container
WORKDIR /var/www/html

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Copy project files into the container
COPY . /var/www/html/

# Change file permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
