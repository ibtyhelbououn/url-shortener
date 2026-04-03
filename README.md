# URL Shortener API

A RESTful API built with Laravel and MySQL that allows users to shorten URLs, track click statistics, and manage redirects.

## Tech Stack

- PHP 8.2
- Laravel 12
- MySQL
- Laravel Sanctum

## Features

- Shorten any valid URL and get a unique short code
- Redirect users from short URL to original URL
- Track click count and creation date per short URL
- Input validation and clean error handling

## Installation

1. Clone the repository
   git clone https://github.com/ibtyhelbououn/url-shortener.git

2. Install dependencies
   composer install

3. Copy the environment file
   cp .env.example .env

4. Generate app key
   php artisan key:generate

5. Configure your database in .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=url_shortener
   DB_USERNAME=root
   DB_PASSWORD=

6. Run migrations
   php artisan migrate

7. Start the server
   php artisan serve

## API Endpoints

### Shorten a URL
POST /api/shorten

Request body:
{
    "original_url": "https://www.example.com"
}

Response:
{
    "short_code": "abc123",
    "short_url": "http://127.0.0.1:8000/abc123",
    "original_url": "https://www.example.com"
}

### Redirect to Original URL
GET /{code}

Redirects the user to the original URL and increments the click counter.

### Get URL Statistics
GET /api/stats/{code}

Response:
{
    "short_code": "abc123",
    "original_url": "https://www.example.com",
    "clicks": 5,
    "created_at": "2026-04-03T18:56:28.000000Z"
}

## Error Handling

Invalid or missing short codes return a 404 response:
{
    "error": "Short URL not found"
}
