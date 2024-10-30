# Aston University Team Project Group 46 2024/2025
## Installation Guide

## Prerequisites

Make sure you have the following installed:
- [Node.js](https://nodejs.org/) (for npm)
- [Composer](https://getcomposer.org/) (for PHP dependencies)
- [PHP](https://www.php.net/)

First, clone the repository to your local machine:
```bash
git clone <repository-url>
cd <repository-directory>
```

Install the required dependencies using npm and Composer:
```bash
npm i
composer install
```

Clone the `.env.example` file and rename it to `.env`:
```bash
cp .env.example .env
```

Run the following command to build the assets:
```bash
npm run dev
```

Finally, start the application using the Artisan server:
```bash
php artisan serve
```

The website should now be running locally.
