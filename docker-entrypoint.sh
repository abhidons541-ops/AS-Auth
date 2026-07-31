#!/bin/bash
set -e

# Copy credentials.example.php to credentials.php if it doesn't exist
if [ ! -f /var/www/html/includes/credentials.php ]; then
    echo "Creating includes/credentials.php from example..."
    cp /var/www/html/includes/credentials.example.php /var/www/html/includes/credentials.php
fi

# Execute the main container command
exec "$@"
