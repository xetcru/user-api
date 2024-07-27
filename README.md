# User Management API

## Описание

Этот проект представляет собой простое API для управления пользователями внутри компании. API позволяет выполнять операции создания, чтения, обновления и удаления пользователей. Также реализована возможность аутентификации пользователей через API и простой интерфейс с постраничным выводом пользователей и управления ими.

## Функциональность API

API поддерживает следующие операции:
- Создание нового пользователя.
- Получение списка всех пользователей.
- Получение данных конкретного пользователя по его идентификатору.
- Обновление данных пользователя.
- Удаление пользователя.
- Аутентификация пользователей через API.

## Требования

1. PHP 8.3, Laravel v11.16.0.
2. Реализованы функции для работы с базой данных (MariaDB) для управления пользователями: создание, чтение, обновление и удаление.
3. Реализовать методы API для выполнения указанных операций.
4. Реализован веб-интерфейс.
5. Написаны тесты для проверки работоспособности API.
6. В панели управления:
   - Реализован список пользователей.
   - Реализована пагинация для списка пользователей.
   - Реализована страница редактирования пользователя.
   - Реализован функционал создания, просмотра, редактирования и удаления пользователя.
   - Реализована возможность поиска пользователей по различным критериям.
   - Реализован механизм авторизации.

## Инструкции по установке

1. Склонируйте репозиторий:
    ```bash
    git clone https://github.com/xetcru/user-api.git
    ```
2. Перейдите в директорию проекта:
    ```bash
    cd <директория_проекта>
    ```
3. Настройте соединение с базой данных в файле конфигурации.
4. Запустите миграции для создания необходимых таблиц в базе данных.
5. Настройте веб-сервер для доступа к вашему приложению.

## Использование

### Аутентификация

Для получения токена аутентификации используйте следующий запрос:

```http
POST http://user-api.gro/api/token
Content-Type: application/json

{
    "email": "adm@xetc.ru",
    "password": "password",
    "role": "admin",
    "device_name": "postman"
}

Токен будет использоваться для дальнейших запросов к API.

Примеры запросов к API:

- Создание нового пользователя:
POST http://user-api.gro/api/users
Authorization: Bearer <токен>
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "securepassword",
    "role": "employee"
}

- Получение списка всех пользователей:
GET http://user-api.gro/api/users
Authorization: Bearer <токен>

- Получение данных конкретного пользователя по его идентификатору:
GET http://user-api.gro/api/users/{id}
Authorization: Bearer <токен>

- Обновление данных пользователя:
PUT http://user-api.gro/api/users/{id}
Authorization: Bearer <токен>
Content-Type: application/json

{
    "name": "Jane Doe",
    "email": "jane.doe@example.com",
    "password": "newpassword",
    "role": "employee"
}

- Удаление пользователя:
DELETE http://user-api.gro/api/users/{id}
Authorization: Bearer <токен>


Для запуска тестов выполните следующую команду: php artisan test

=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> new_dev
