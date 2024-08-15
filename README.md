
# Запуск приложения

### Поднять контейнеты

    cd ./_docker &&
    docker-compose up --build -d

---

### Провести миграции

    docker exec task_app php artisan migrate

> В приложении нет заранее добавленых пользователей и постов, а так же заготовленых фабрик.

# Использование API

### Пользователи

#### Создание

    localhost:8080/pulic/index.php/user/store?name={name}&email={email}&password={password}

---

#### Чтение

    localhost:8080/pulic/index.php/user/

    localhost:8080/pulic/index.php/user/{user_id}

---

#### Изменение

    localhost:8080/pulic/index.php/user/update/{user_id}?name={name}&email={email}&password={password}

---

#### Удаление

    localhost:8080/pulic/index.php/user/destroy/{user_id}

---

#### Авторизация

    localhost:8080/pulic/index.php/login?email={email}&password={password}

---


### Посты

#### Создание

    localhost:8080/pulic/index.php/post/store?title={title}&body={body}&author_id={user_id}

---

#### Чтение

##### Получить пост по id

    localhost:8080/pulic/index.php/post/{post_id}

##### Получить список постов

    localhost:8080/pulic/index.php/post

Сортировка

<p>Для сортировки нужно передать массив sort</p>

    {
        "sort": [
            "column": "{колонка для сортировки}",
            "inverted": "{1|0}"
        ]
    }

###### Фильтрация

**Сервер вернёт посты с точным совпадением.**

<p>Для фильтрации нужно передать массив filter.</p>

    {
        "filter": [
            "{Название колонки}": "{Значение колонки}"
        ]
    }

Колонки для сортировки и фильтрации

- id
- title
- body
- author_id
- created_at
- updated_at

---

#### Изменение

    localhost:8080/pulic/index.php/post/update/{post_id}?title={title}&body={body}&author_id={user_id}

---

#### Удаление

    localhost:8080/pulic/index.php/post/destroy/{post_id}

---

> Указание author_id при создании и изменении поста требуется из-за проблемы с авторизацией sanctum, решение которой я не успел найти.

> При изменении постов и пользователей обязательно указывать значения всех колонок. Старые данные не подтягиваются.