<pre>
Тестовое задание.
Необходимо разработать веб-приложение “Телефонная книга“:

- приложение должно быть написано на Laravel;
- должна быть регистрация, авторизация, восстановление пароля;
- пользователь должен иметь возможность:
                 -- создавать, редактировать контакты (ФИО, номер телефона);
                 -- просматривать список собственных контактов;
                 -- просматривать контакт на отдельной странице;
                 -- отмечать контакты как избранные;
                 -- удалять контакты;
                 -- должно быть api для crud контактов с описанием api с помощью Swagger. 

Решение должно быть выложено на GitHub, Bitbucket.
</pre>

Приложение разработано как SPA, кроме страниц регистрации и восстановления пароля.

Backend: Laravel 9

Frontend: Vue.js + Vue Router + Pinia; Typescript

Стили: SASS

Логика действий над контактами вынесена в ContactRepository, в RouteServiceProvider изменена логика Model binding таким образом,
чтобы экземпляр Contact был получен из ContactRepository.

Проверка прав на действия пользователя над контактами реализована в ContactPolicy.

**Запуск приложения:**

1. Склонировать данный репозиторий и перейти в созданную директорию:
   ```
   git clone git@github.com:MalikinSergey/ms-phonebook.git
   cd ms-phonebook
   ```
2. Создать файл с переменными окружения:
   ```
   php -r "copy('.env.example', '.env');"
   ```
3. Выполнить установку пакетов:
   ```
   composer install
   npm install
   ```
4. Создать APP_KEY в .env:
   ```
   php artisan key:generate --ansi
   ```
5. В .env указать данные для БД (можно sqlite, пустой файл):
   ```
   DB_CONNECTION=sqlite 
   DB_DATABASE=/absolute/path/to/database.sqlite
   ```
6. Выполнить миграции:
    ```
   php artisan migrate
    ```
7. Выполнить сборку фронтенда:
   ```
   npm run production
   ```
8. Запустить dev-сервер:
   ```
   php artisan serve
   ```
9. Перейти по URL данного сервера: http://127.0.0.1:8000/


**Документация API:**

https://app.swaggerhub.com/apis/MalikinSergey/ms-phonebook/1.0.0