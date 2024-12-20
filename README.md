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
#### 3. Run migrations and create SQLite database
```
php artisan migrate
```
#### 4. Seed database
```
php artisan db:seed
```
The seeder will create 5 users with the following e-mails
- `admin.1@example.com`
- `user.2@example.com`
- `user.3@example.com`
- `user.4@example.com`
- `user.5@example.com`

The default password for these users is `password`
#### 5. Generate assets
```
npm run dev
```
#### 6. Serve application
```
php artisan serve
```
You can now visit the url in the CLI and login using one of the seeded users.