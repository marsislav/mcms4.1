#!/bin/bash
# Run this script on the Linux server as root or with sudo
# from the root of the Laravel project: bash fix_permissions.sh

echo "Fixing Laravel permissions for marsislav.net..."

# Set owner to web server user (usually www-data on Ubuntu/Debian)
# Change 'www-data' to your server's web user if different (e.g. apache, nginx)
WEB_USER="www-data"

# Make storage and bootstrap/cache writable
chmod -R 775 storage bootstrap/cache
chown -R $WEB_USER:$WEB_USER storage bootstrap/cache

# Make Uploads directory writable
chmod -R 775 public/Uploads
chown -R $WEB_USER:$WEB_USER public/Uploads

# Ensure subdirectories exist and are writable
mkdir -p public/Uploads/posts
mkdir -p public/Uploads/avatars
mkdir -p public/Uploads/portfolio
chmod -R 775 public/Uploads/posts public/Uploads/avatars public/Uploads/portfolio
chown -R $WEB_USER:$WEB_USER public/Uploads/posts public/Uploads/avatars public/Uploads/portfolio

echo "Done! Permissions fixed."
echo ""
echo "If uploads still fail, check PHP settings:"
echo "  upload_max_filesize = 10M"
echo "  post_max_size = 12M"
echo "in /etc/php/*/apache2/php.ini or /etc/php/*/fpm/php.ini"
