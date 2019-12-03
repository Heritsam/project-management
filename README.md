# Project Management

> Project Management

## Installation

### Clone

`git clone https://gitlab.com/Heritsam/project-management.git project_management`

### Setup

```bash
cd ~/project_management
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
```
- Create database **project_management**
- Edit .env file

```shell
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_management
DB_USERNAME=[database_username]
DB_PASSWORD=[database_password]
...
```

- Migrating tables
`php artisan migrate --seed`

## Running

- run using the following command
`php artisan serve`

- login using
  - username: heritsam
  - password: heritsam
