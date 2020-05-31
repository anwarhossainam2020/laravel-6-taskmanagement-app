# Laravel Task Management App
This is a simple Laravel web application for task management with following features.

- Create task (info to save: task name, priority, timestamps) 
- Edit task 
- Delete task 
- Reorder tasks 
- Priority change - Priority should automatically be updated based on drag and drop in the browser. 
- -  #1 priority goes at top,
 - - #2 next down and so on. 
- Tasks should be saved to a mysql table.
- BONUS POINT: User should be able to select a project from a dropdown and only view tasks associated with that project

## Installation

Server Requirements

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

Extract attached zip file into your web server directory

Installation from Git, Clone the repository -
```
git clone https://github.com/anwarhossainam2020/laravel-6-taskmanagement-app.git
```

Then cd into the folder with this command-
```
cd laravel-6-taskmanagement-app
```

Then do a composer install
```
composer install
```

Then create a environment file using this command-
```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_USERNAME`, `DB_PASSWORD`).

Then create a database named `l6tmapp` and then do a database migration using this command-
```
php artisan migrate
```

Then change permission of storage folder using thins command-
```
(sudo) chmod 777 -R storage
```

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

Run `ProjectSeeder` seeder to Load demo data for project using faker. 10 project name will insert into database
```
php artisan db:seed --class=ProjectSeeder
```

## Run server

Run server using this command-
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.
