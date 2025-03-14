FROM php:8.3.17-fpm

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install --yes --no-install-recommends \
        git \
        unzip \
        libpq-dev \
    && docker-php-ext-install  \
        pdo  \
        pdo_pgsql \
    && pecl channel-update pecl.php.net \
    && pecl install \
        igbinary \
        xdebug-3.4.1 \
    # Clean apt cache
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    # Upgrade default shell
    && rm /bin/sh \
    && ln -s /bin/bash /bin/sh

# Create unprivileged user
RUN groupadd appuser \
    && useradd -m -g appuser -s /bin/bash appuser
USER appuser:appuser
COPY --chown=appuser:appuser docker/.bashrc /home/appuser/

# Allow Composer to use all available RAM while installing packages
ENV COMPOSER_MEMORY_LIMIT="-1"

WORKDIR /var/www/

CMD ["php-fpm"]
