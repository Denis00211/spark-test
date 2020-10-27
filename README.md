# Тестовое задание Spark

## Документация по api
https://documenter.getpostman.com/view/1752603/TVYGdJgE#cc2ee0e2-23f2-4365-9697-2d0be871a7a1

использовал php 7.4

laravel 8.*

### Порядок установки

- composer install
- меняем .env.example на .env
- в файле .env прописываем конфиги, также добавил базовые интеграционные тесты в env добавить переменную DB_DATABASE_TEST
- выполнить миграцию  php artisan migrate
- выполнить сид php artisan db:seed, для пользователя стандартный пароль password
- выполнить php artisan passport:install
- дальше использовать документацию postman для выполнения запросов



### Запуск тестов 
- php artisan test
