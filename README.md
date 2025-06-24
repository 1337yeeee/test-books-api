# Yii2 REST API Приложение

Это REST API на Yii2 для управления книгами и авторами. Приложение использует PostgreSQL, Docker и Swagger-документацию.

## Быстрый старт

### Требования

- Docker
- Docker Compose

### Установка и запуск

1. Клонируйте репозиторий:

   ```bash
   git clone https://github.com/1337yeeee/test-books-api.git
   cd test-books-api
   ```

2. Скопируйте файл с переменными из окружения:

    ```bash
    cp example.env .env
    ```

3. Постройте и запустите контейнеры:

   ```bash
   docker-compose up -d --build
   ```

4. (Необязательно) Добавьте тестовые данные:

   ```bash
   docker-compose exec php php yii seed/run
   ```

5. Откройте приложение в браузере:

   - API доступен по адресу: http://localhost
   - Swagger-документация: http://localhost/swagger

## Переменные окружения

Переменные можно задать в `.env`:

```dotenv
# Настройки приложения
APP_NAME=MyYii2App
APP_ENV=dev

# Настройки Nginx
NGINX_PORT=80

# Настройки PostgreSQL
DB_HOST=postgres
DB_PORT=5432
DB_NAME=yii2app
DB_USER=yii2user
DB_PASSWORD=secret
```

## Остановка и очистка

```bash
docker-compose down -v
```

## Документация

Swagger JSON: [http://localhost/swagger/json](http://localhost/swagger/json)  
Swagger UI: [http://localhost/swagger](http://localhost/swagger)

## Полезные команды

```bash
# Выполнить миграции
docker-compose exec php php yii migrate

# Подключиться к PHP-контейнеру
docker-compose exec php sh

# Подключиться к PostgreSQL-контейнеру
docker-compose exec db psql -U yii2user -d yii2app
```

## Автор

- [Максимов Анатолий](https://github.com/1337yeeee)
