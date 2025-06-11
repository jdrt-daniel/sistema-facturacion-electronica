# PHP MVC Framework

A simple PHP MVC framework with environment configuration.

## Setup Instructions

1. Install dependencies:

```bash
composer install
```

2. Create a `.env` file in the root directory with the following content:

```
APP_NAME=Ventas
APP_ENV=development
APP_DEBUG=true
APP_PORT=8000
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ventas
DB_USERNAME=root
DB_PASSWORD=
```

3. Start the PHP development server:

```bash
php -S localhost:8000
```

4. Visit `http://localhost:8000` in your browser

## Project Structure

```
├── app/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── core/
├── vendor/
├── .env
├── composer.json
└── index.php
```

## Features

- MVC Architecture
- Environment Configuration
- Simple Routing System
- View Rendering
- Model Loading
- Bootstrap 5 Integration
