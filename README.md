# ExampleCom client

## Часть 1:

Задача:
> Есть список директорий неизвестно насколько большой вложенности
> В директории может быть файл count
> Нужно пройтись по всем директориям и вернуть сумму всех чисел из файла count (файлов count может быть много)

Пример: `examples/part_1.php`

## Часть 2:

Задача:
> Необходимо реализовать клиент для абстрактного (вымышленного) сервиса комментариев "example.com". Проект должен представлять класс или набор классов, который будет делать http запросы к серверу.
>  На выходе должна получиться библиотека, который можно будет подключить через composer к любому другому проекту.
>  У этого сервиса есть 3 метода:
>
>  GET http://example.com/comments - возвращает список комментариев
> 
>  POST http://example.com/comment - добавить комментарий.
> 
>  PUT http://example.com/comment/{id} - по идентификатору комментария обновляет поля, которые были в в запросе
>   
>  Объект comment содержит поля:
>  id - тип int. Не нужно указывать при добавлении.
>  name - тип string.
>  text - тип string.
>
>  Написать phpunit тесты, на которых будет проверяться работоспособность клиента.
>  Сервер example.com писать не надо! Только библиотеку для работы с ним.

Пример: `examples/part_2.php`

# Lint & Tests:

```bash
docker compose up
```

# Setup

```bash
composer require flexnst/example-com-client
```