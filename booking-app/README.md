# Booking

### Развернуть проект:
1) Подтянуть зависимости
    ```
    composer install
    ```
2) Запустить миграции
    ```
    php artisan migrate
    ```
3) Создать symbolic link
    ```
    php artisan storage:link
    ```
4) Запустить сидер для заполнения данными
    ```
    php artisan db:seed
    ```
5) Собрать документации
    ```
    php artisan scribe:generate
    ```
