## Required Software
- PHP 8.2.4 .
- Composer version 2.6.2
- Node Version: v20.5.1

## Database
- MySql

  <strong>Note:</strong> create a .env file in the root directory and copy the content from .env.example file. <br />
        Create a database with name <strong>astro_app</strong> in phpMyAdmin.

## Installation Process
Run the below command on the terminal, in the root directory
- Composer Install
- php artisan migrate
- php artisan db:seed --class=AdminSeeder


## Run the Project 
- php artisan serve
- Project will run http://127.0.0.1:8000

