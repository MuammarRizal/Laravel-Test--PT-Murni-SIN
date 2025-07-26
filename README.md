## 🎬 Laravel + Tailwind CSS - Movie/TV Show Detail Page

## 📋 Project Overview

This project is a Laravel-based frontend implementation for a movie/TV show detail page, styled with Tailwind CSS. It features responsive design, YouTube trailer integration, and comprehensive media information display.

### ✨ Features

-   🎥 Responsive movie/TV show detail page

-   🎨 Styled using Tailwind CSS utility classes

-   📺 YouTube trailer modal integration

-   📱 Fully responsive across all devices

-   📅 Dynamic content rendering from API data

-   🖼️ Backdrop and poster image display

-   📊 Media information sections (cast, seasons, etc.)
    Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 🧰 Requirements

Before you begin, ensure you have the following installed:

PHP >= 8.1 → Download PHP

Composer → Download Composer

Node.js >= 18 → Download Node.js

Database (MySQL recommended)

Web Server (Apache/Nginx or php artisan serve)

Git (optional) → Download Git

## 💻 Technologies Used

```text
*Technology*	    *Purpose*
Laravel	        PHP web application framework
Tailwind CSS	Utility-first CSS framework
Alpine.js	    Lightweight JavaScript framework
Blade	        Laravel's templating engine
Vite	        Frontend build tool
```

## 🚀 Getting Started

1. Clone the Repository

```bash
git clone https://github.com/your-repo/laravel-movie-detail.git
cd laravel-movie-detail
```

2. Install PHP Dependencies

```bash
composer install
```

3. Install JavaScript Dependencies

```bash
npm install
```

4. Environment Setup
   Copy the .env.example file to .env:

```bash
cp .env.example .env
```

Configure your api settings in the .env file:

```bash
TMDB_API_KEY=
TMDB_ACCESS_TOKEN=
TMDB_API_URL=https://api.themoviedb.org/3
TMDB_API_IMAGE_URL=https://image.tmdb.org/t/p
TMDB_API_IMAGE_URL_COMPRESS=https://image.tmdb.org/t/p/w500
TMDB_API_IMAGE_URL_ORIGINAL=https://image.tmdb.org/t/p/original
```

5. Build Assets
   For development:

```bash
npm run dev
```

For Production:

```bash
npm run build
```

6. Start Development Server

```bash
php artisan serve
```

```text
laravel-movie-detail/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   └── pages/
│   │   │   └── movie.blade.php
│   │   └── partials/
│   │       └── header.blade.php
├── routes/
│   └── web.php
├── tailwind.config.js
├── vite.config.js
├── package.json
└── composer.json
```

### 🔧 Customization

## Adding New Pages

-   Create a new Blade template in resources/views/

-   Add a corresponding route in routes/web.php

-   Create a controller if needed: php artisan make:controller MovieController

## Styling Components

Use Tailwind's utility classes directly in your Blade templates:

```html
<div class="bg-netflix-dark text-white p-4 rounded-lg shadow-lg">
    <!-- Content -->
</div>
```

## 🛠️ Production Build

Before deploying to production:

1. Optimize the application:

```bash
php artisan optimize
```

2. Build assets for production:

```bash
npm run build
```

3. Cache routes and views:

```bash
php artisan route:cache
php artisan view:cache
```

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
