
# Simple user management system

An simple project made for the intern position at "Simplicity".




## How to set up the project

```bash
  git clone https://github.com/Daniel10013/laravel-users-management.git
```
Afeter cloning the project, 
Install the dependencies with composer
```bash
  comporser install
```
Set your `.env` file
#### On Linux
```bash
  cp .env.example .env
```
#### On Windows
```bash
  copy .env.example .env
```
Set your application key
```bash
  php artisan key:generate
```
This will automatically set the key in the `.env` file

### Set the database config
Run the migrations
```bash
  php artisan migrate

```

Seed the database, this will set two user accounts for start using the system, their access are on the `app/database/seeders/DefaultUsers.php`

### Run the application
This will start your application at http://localhost:8000
```bash
  php artisan serv
```
