# Book API

Этот проект представляет собой тестовое API для управления книгами и авторами, созданное на Laravel 11. Проект разработан для портфолио.

---

## Описание проекта

API предоставляет следующие возможности:

- **Управление книгами** (CRUD):
  - Создание, чтение, обновление и удаление книг.
  - Связь книг с авторами (многие-ко-многим).
- **Управление авторами** (CRUD):
  - Создание, чтение, обновление и удаление авторов.
- **Поиск книг**:
  - Поиск по названию, автору или жанру.

---

## Установка и настройка

### 1. Клонирование репозитория

Склонируйте репозиторий на ваш компьютер:

```bash
git clone https://github.com/dknz22/book-api.git
cd book-api
```

### 2. Установка зависимостей

Установите все зависимости через Composer:

```bash
composer install
```

### 3. Настройка окружения

Скопируйте файл .env.example в .env:
```bash
cp .env.example .env
```

Настройте подключение к базе данных:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Генерация ключа приложения

```bash
php artisan key:generate
```

### 5. Запуск миграций

```bash
php artisan migrate
```

# Эндпоинты

### Книги

#### GET: /api/books
- **Output**:
  - `id`: int
  - `title`: string
  - `genre`: string
  - `created_at`: string
  - `updated_at`: string
  - `authors`: array
    - `id`: int
    - `name`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

#### POST: /api/books
- **Input**:
  - `title`: string
  - `genre`: string
  - `author_ids`: array of int
- **Output**:
  - `id`: int
  - `title`: string
  - `genre`: string
  - `created_at`: string
  - `updated_at`: string
  - `authors`: array
    - `id`: int
    - `name`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

#### GET: /api/books/{id}
- **Output**:
  - `id`: int
  - `title`: string
  - `genre`: string
  - `created_at`: string
  - `updated_at`: string
  - `authors`: array
    - `id`: int
    - `name`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

#### PUT: /api/books/{id}
- **Input**:
  - `title`: string (optional)
  - `genre`: string (optional)
  - `author_ids`: array of int (optional)
- **Output**:
  - `id`: int
  - `title`: string
  - `genre`: string
  - `created_at`: string
  - `updated_at`: string
  - `authors`: array
    - `id`: int
    - `name`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

#### DELETE: /api/books/{id}
- **Output**: 204 No Content

#### GET: /api/books/search
- **Input** (query parameters):
  - `title`: string (optional)
  - `author`: string (optional)
  - `genre`: string (optional)
- **Output**:
  - `id`: int
  - `title`: string
  - `genre`: string
  - `created_at`: string
  - `updated_at`: string
  - `authors`: array
    - `id`: int
    - `name`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

### Авторы

#### GET: /api/authors
- **Output**:
  - `id`: int
  - `name`: string
  - `created_at`: string
  - `updated_at`: string
  - `books`: array
    - `id`: int
    - `title`: string
    - `genre`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

#### POST: /api/authors
- **Input**:
  - `name`: string
- **Output**:
  - `id`: int
  - `name`: string
  - `created_at`: string
  - `updated_at`: string

#### GET: /api/authors/{id}
- **Output**:
  - `id`: int
  - `name`: string
  - `created_at`: string
  - `updated_at`: string
  - `books`: array
    - `id`: int
    - `title`: string
    - `genre`: string
    - `created_at`: string
    - `updated_at`: string
    - `pivot`: object
      - `author_id`: int
      - `book_id`: int

#### PUT: /api/authors/{id}
- **Input**:
  - `name`: string (optional)
- **Output**:
  - `id`: int
  - `name`: string
  - `created_at`: string
  - `updated_at`: string

#### DELETE: /api/authors/{id}
- **Output**: 204 No Content
