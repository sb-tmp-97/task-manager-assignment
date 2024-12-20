# Collaborative Task Manager Assignment

## Installation
#### 1. Install composer and npm packages
```
composer install
npm install
```
#### 2. Prepare .env
Copy `.env.example` to `.env`. After doing so, run the following command to generate the application key
```
php artisan key:generate
```
#### 3. Generate assets
```
npm run dev
```
#### 4. Serve application
```
php artisan serve
```
#### 5. Run migrations and seed database
```
php artisan migrate:refresh --seed
```
The seeder will create 5 users with the following e-mails
- `admin.1@example.com`
- `user.2@example.com`
- `user.3@example.com`
- `user.4@example.com`
- `user.5@example.com`

The default password for these users is `password`
