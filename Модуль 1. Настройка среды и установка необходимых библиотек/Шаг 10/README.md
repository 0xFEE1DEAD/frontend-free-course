## Запуск групп контейнеров

Если нам необходимо запустить например базу данных и приложение, будет неудобно запускать каждое приложение по отдельности, для этого в Docker был придуман docker compose. Podman также реализует эту функциональность и умеет запускать несколько контейнеров.

Сначала необходимо определить файл `docker-compose.yaml`, это файл описывающий список сервисов которые необходимо запустить
```yaml
services:
  app:
    image: ghcr.io/0xfee1dead/app-for-course:latest
    restart: always
    ports:
      - 7313:80
    environment:
      DB_CONNECTION: pgsql
      DB_HOST: db
      DB_PORT: 5432
      DB_DATABASE: postgres
      DB_USERNAME: postgres
      DB_PASSWORD: dbpassword

  runmigrations:
    image: ghcr.io/0xfee1dead/app-for-course:latest
    entrypoint: /docker-entrypoint.d/init.sh
    environment:
      DB_CONNECTION: pgsql
      DB_HOST: db
      DB_PORT: 5432
      DB_DATABASE: postgres
      DB_USERNAME: postgres
      DB_PASSWORD: dbpassword

  db:
    image: docker.io/postgres:latest
    restart: always
    environment:
      POSTGRES_PASSWORD: dbpassword
    volumes:
      - pgdata:/var/lib/postgresql/data

volumes:
  pgdata:
```
Разберем файл. Мы указываем в нем ряд сервисов:
* app
* runmigrations
* db

Каждый сервис запускается из образа. Сервис `app` и `runmigrations` использует 1 и тот же образ - `ghcr.io/0xfee1dead/app-for-course:latest`. Сервис `db` использует образ `docker.io/postgres:latest`.