# Aston University Team Project Group 46 2024/2025

## Description

Our project includes a search function for easy product lookup and product tagging for improved navigation. Users can read reviews, explore trending items, and filter out unwanted products. A custom keyboard maker allows for tailored orders, complemented by a compatibility checker for part integration. We offer a streamlined e-commerce system for cart, checkout, and payments, alongside a rewards system using virtual currency to boost engagement. Users can also test keyboard performance, while admins manage stock levels and inventory replenishment.

## Installation Guide

### Prerequisites

Ensure you have the following installed:
- [Node.js](https://nodejs.org/) - Used for running JavaScript on the server and managing frontend dependencies.
- [PHP](https://www.php.net/) - Used for the backend of the application.
- [Composer](https://getcomposer.org/) - Dependency manager for PHP, used to install and manage libraries.

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/rederick29/team-project
    cd team-project
    ```

2. Install dependencies:
    ```bash
    npm install
    composer install
    ```

3. Set up environment file and generate `APP_KEY`:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Build assets and start the application:
    ```bash
    npm run dev
    php artisan migrate
    php artisan serve
    ```

The website should now be running locally.