# Project Management

## Installation

1. Clone

`git clone https://gitlab.com/Heritsam/project-management.git project_management`

2. Setup

```shell
cd ~/project_management
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
```
   1. Create database **project_management**
   2. Edit .env file
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
    3. Migrating tables
        ```shell
        php artisan migrate:fresh --seed
        ```

3. Running
```shell
php artisan serve
```
- Users available
| Email Address | username | password |
| :-----------: | :------: | :------: |
| ariqhm@gmail.com | heritsam | heritsam |
