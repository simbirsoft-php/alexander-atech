# Description
Реализовать на Laravel Framework сервис, который хранит и возвращает расписание работы СТОА. 
СТОА - станция технического обслуживания автомобиля.

Функциональность:

- выгрузка данных о расисаниях работы абстрактного провайдера данных (для тестового задания данные передаются как csv файлик)

- сохранение расписания в бд (структура базы, методы по сохранению)

- получение расписания о всех СТОА

- получения расписания о СТОА в заданном временном интервале (интервал передается как аргумент к api методу)


Также реализовать:

- тесты unit/интеграционные c code coverage
- swagger документация к API, которая автоматически собирается
- Dockerfile и docker-compose для запуска проекта

# Installation

Run this script:
`install.sh`

# Using
Documentation for API available on
[http://localhost/api/documentation](http://localhost/api/documentation)

# Testing
Run tests with `vendor/bin/phpunit` from php container. (For tests using SQLite)

Code coverage info available on [http://localhost/test/](http://localhost/test/).
