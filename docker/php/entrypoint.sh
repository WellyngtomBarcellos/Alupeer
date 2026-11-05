#!/bin/sh
set -e

cd /app

echo "Starting application entrypoint..."

# Ensure writable directories exist
mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/testing \
    storage/logs \
    storage/app/public \
    bootstrap/cache

# Local bind-mount: install Composer deps if vendor is missing/empty
if [ ! -f vendor/autoload.php ] && [ -f composer.json ]; then
    echo "vendor/autoload.php missing -> composer install"
    composer install --no-interaction --prefer-dist || echo "composer install failed" >&2
fi

# Permissions (best effort)
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Refresh package discovery for the installed (production) dependencies
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php
php artisan package:discover --ansi >/dev/null 2>&1 || true

# Public storage symlink
if [ ! -e public/storage ]; then
    php artisan storage:link 2>/dev/null || true
fi

# Optional migrations (RUN_MIGRATIONS=true)
if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    echo "RUN_MIGRATIONS=true -> running php artisan migrate --force"
    php artisan migrate --force || echo "migrate failed (continuing)" >&2
else
    echo "RUN_MIGRATIONS=false -> skipping migrations"
fi

# Production optimizations
if [ "${APP_ENV:-production}" = "production" ] || [ "${APP_ENV:-production}" = "prod" ]; then
    echo "Running artisan optimize..."
    php artisan optimize || echo "optimize failed (continuing)" >&2
    php artisan storage:link 2>/dev/null || true
fi

echo "Handing off to: $*"
exec "$@"
