#!/bin/bash

# Other
a2enmod rewrite
chown -R www-data:www-data /var/www/html/Public/Assets
apache2-foreground
