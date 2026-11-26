FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
COPY resources ./resources
RUN npm ci --no-audit --no-fund && npm run build

FROM php:8.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        curl \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libzip-dev \
        libicu-dev \
        libonig-dev \
        libxml2-dev \
        libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mysqli \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        intl \
        zip \
        opcache \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && { \
        echo '<Directory /var/www/html/public>'; \
        echo '    Options Indexes FollowSymLinks'; \
        echo '    AllowOverride All'; \
        echo '    Require all granted'; \
        echo '</Directory>'; \
    } > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel \
    && { \
        echo 'upload_max_filesize=12M'; \
        echo 'post_max_size=16M'; \
        echo 'memory_limit=256M'; \
        echo 'max_execution_time=120'; \
        echo 'expose_php=Off'; \
    } > /usr/local/etc/php/conf.d/sisapras.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p \
        storage/app/public/sarpras \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader \
    && rm -rf /root/.composer/cache \
    && chown -R www-data:www-data storage bootstrap/cache public \
    && chmod -R ug+rwX storage bootstrap/cache

RUN printf '%s\n' \
    '#!/usr/bin/env bash' \
    'set -euo pipefail' \
    '' \
    'cd /var/www/html' \
    '' \
    'PORT="${PORT:-80}"' \
    'sed -ri "s/^Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf' \
    'sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf' \
    '' \
    'export APP_NAME="${APP_NAME:-SISAPRAS JTIK}"' \
    'export APP_ENV="${APP_ENV:-production}"' \
    'export APP_DEBUG="${APP_DEBUG:-false}"' \
    'export LOG_CHANNEL="${LOG_CHANNEL:-stderr}"' \
    '' \
    'if [ -z "${APP_URL:-}" ]; then' \
    '    if [ -n "${RENDER_EXTERNAL_URL:-}" ]; then' \
    '        export APP_URL="${RENDER_EXTERNAL_URL}"' \
    '    elif [ -n "${RAILWAY_PUBLIC_DOMAIN:-}" ]; then' \
    '        export APP_URL="https://${RAILWAY_PUBLIC_DOMAIN}"' \
    '    else' \
    '        export APP_URL="http://localhost:${PORT}"' \
    '    fi' \
    'fi' \
    '' \
    'if [ -z "${APP_KEY:-}" ]; then' \
    '    export APP_KEY="base64:$(php -r '\''echo base64_encode(random_bytes(32));'\'')"' \
    '    echo "[SISAPRAS] WARNING: APP_KEY is not set; generated an ephemeral key for this boot. Set APP_KEY in environment variables for persistent sessions." >&2' \
    'elif [[ "${APP_KEY}" != base64:* ]] && [ "${#APP_KEY}" -ne 32 ]; then' \
    '    export APP_KEY="base64:$(php -r '\''echo base64_encode(hash("sha256", getenv("APP_KEY"), true));'\'')"' \
    'fi' \
    '' \
    'if [ -z "${DB_URL:-}" ]; then' \
    '    if [ -n "${MYSQL_PRIVATE_URL:-}" ]; then' \
    '        export DB_URL="${MYSQL_PRIVATE_URL}"' \
    '    elif [ -n "${MYSQL_URL:-}" ]; then' \
    '        export DB_URL="${MYSQL_URL}"' \
    '    elif [ -n "${DATABASE_URL:-}" ]; then' \
    '        export DB_URL="${DATABASE_URL}"' \
    '    fi' \
    'fi' \
    '' \
    'if [ -n "${DB_URL:-}" ] && [ -z "${DB_CONNECTION:-}" ]; then' \
    '    case "${DB_URL}" in' \
    '        postgres://*|postgresql://*)' \
    '            export DB_CONNECTION="pgsql"' \
    '            ;;' \
    '        mysql://*)' \
    '            export DB_CONNECTION="mysql"' \
    '            ;;' \
    '    esac' \
    'fi' \
    '' \
    'if [ -z "${DB_HOST:-}" ] && [ -n "${MYSQLHOST:-}" ]; then' \
    '    export DB_CONNECTION="${DB_CONNECTION:-mysql}"' \
    '    export DB_HOST="${MYSQLHOST}"' \
    '    export DB_PORT="${DB_PORT:-${MYSQLPORT:-3306}}"' \
    '    export DB_DATABASE="${DB_DATABASE:-${MYSQLDATABASE:-sisapras}}"' \
    '    export DB_USERNAME="${DB_USERNAME:-${MYSQLUSER:-root}}"' \
    '    export DB_PASSWORD="${DB_PASSWORD:-${MYSQLPASSWORD:-}}"' \
    'fi' \
    '' \
    'export DB_CONNECTION="${DB_CONNECTION:-mysql}"' \
    '' \
    'mkdir -p storage/app/public/sarpras storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache' \
    'chown -R www-data:www-data storage bootstrap/cache' \
    'php artisan storage:link --force >/dev/null 2>&1 || true' \
    '' \
    'HAS_DB_CONFIG=0' \
    'if [ -n "${DB_URL:-}" ] || [ -n "${DB_HOST:-}" ]; then' \
    '    HAS_DB_CONFIG=1' \
    'fi' \
    '' \
    'MAX_TRIES=1' \
    'if [ "${HAS_DB_CONFIG}" -eq 1 ]; then' \
    '    MAX_TRIES=10' \
    'fi' \
    '' \
    'DB_READY=0' \
    'for i in $(seq 1 "${MAX_TRIES}"); do' \
    '    if php -r '\''$url = getenv("DB_URL") ?: ""; $conn = getenv("DB_CONNECTION") ?: "mysql"; try { if ($url !== "") { $parts = parse_url($url); $scheme = $parts["scheme"] ?? "mysql"; $driver = str_starts_with($scheme, "postgres") ? "pgsql" : "mysql"; $host = $parts["host"] ?? "127.0.0.1"; $port = $parts["port"] ?? ($driver === "pgsql" ? 5432 : 3306); $db = ltrim($parts["path"] ?? "", "/"); $user = urldecode($parts["user"] ?? ""); $pass = urldecode($parts["pass"] ?? ""); } else { $driver = $conn === "pgsql" ? "pgsql" : "mysql"; $host = getenv("DB_HOST") ?: "127.0.0.1"; $port = getenv("DB_PORT") ?: ($driver === "pgsql" ? "5432" : "3306"); $db = getenv("DB_DATABASE") ?: "sisapras"; $user = getenv("DB_USERNAME") ?: "root"; $pass = getenv("DB_PASSWORD") ?: ""; } new PDO("{$driver}:host={$host};port={$port};dbname={$db}", $user, $pass, [PDO::ATTR_TIMEOUT => 3]); exit(0); } catch (Throwable $e) { exit(1); }'\'' >/dev/null 2>&1; then' \
    '        DB_READY=1' \
    '        break' \
    '    fi' \
    '    if [ "${i}" -lt "${MAX_TRIES}" ]; then' \
    '        sleep 2' \
    '    fi' \
    'done' \
    '' \
    'if [ "${DB_READY}" -eq 1 ]; then' \
    '    echo "[SISAPRAS] Database connected. Running migrations..."' \
    '    php artisan migrate --force' \
    '    USER_COUNT="$(php -r '\''require "vendor/autoload.php"; $app = require "bootstrap/app.php"; $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); echo (int) Illuminate\Support\Facades\DB::table("users")->count();'\'' 2>/dev/null || echo "-1")"' \
    '    if [ "${USER_COUNT}" = "0" ]; then' \
    '        echo "[SISAPRAS] Empty users table detected. Seeding initial JTIK data..."' \
    '        php artisan db:seed --force' \
    '    fi' \
    'else' \
    '    echo "[SISAPRAS] WARNING: Database is not reachable. Falling back to file session/cache so container can boot." >&2' \
    '    export SESSION_DRIVER="file"' \
    '    export CACHE_STORE="file"' \
    'fi' \
    '' \
    'php artisan config:clear >/dev/null 2>&1 || true' \
    'php artisan config:cache' \
    'php artisan view:cache' \
    '' \
    'exec apache2-foreground' \
    > /usr/local/bin/start-container.sh \
    && chmod +x /usr/local/bin/start-container.sh

EXPOSE 80

CMD ["/usr/local/bin/start-container.sh"]
