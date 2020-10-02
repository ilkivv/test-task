Для того, чтобы развернуть проект требуется Git и Docker.

### 1. Клонировать хранилище LaraDock.

A. Если у вас уже есть проект Laravel, клонируйте этот репозиторий в корневой каталог Laravel:

git submodule add https://github.com/LaraDock/laradock.git
B. Если у вас нет проекта Laravel, и вы хотите установить Laravel из Docker, клонируйте это репо где угодно на вашем компьютере:

git clone https://github.com/LaraDock/laradock.git

### 2. В папке laradock выполнить .
docker-compose up -d nginx postgres pgadmin php-fpm

### 3. Перейти в рабочую область.
docker-compose exec workspace bash

### 4.Клонировать репозиторий проекта.
https://github.com/ilkivv/test-task.git

### 5. Первоначальная настройка.
- настроить файл .env
- выполнить миграции с помощью команды php artisan migrate
- наполнить бд начальными данными с помощью php artisan db:seed
- создать персональный ключ с помощью команды php artisan passport:client --personal со значением test-task

### Схема БД

схема базы данных создана в <b>DbVisualizer</b>