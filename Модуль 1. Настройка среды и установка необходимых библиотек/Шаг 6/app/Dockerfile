FROM unit:php8.3

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
ADD --chmod=0755 https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh /usr/local/bin/

RUN install-php-extensions @composer pdo_pgsql pgsql

WORKDIR app

COPY unit-conf.json /docker-entrypoint.d/
COPY --chmod=0755 init.sh /docker-entrypoint.d/
COPY --chown=unit:unit . /app