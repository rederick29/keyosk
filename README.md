# Aston University Team Project Group 46 2024/2025

## Table of Contents
1. [Description](#description)
2. [Installation Guide](#installation-guide)
    - [Prerequisites](#prerequisites)
    - [Steps (fresh install)](#steps-fresh-install)
    - [Steps (to update to latest)](#steps-to-update-to-latest)

## Description

Our project includes a search function for easy product lookup and product tagging for improved navigation. Users can read reviews, explore trending items, and filter out unwanted products. A custom keyboard maker allows for tailored orders, complemented by a compatibility checker for part integration. We offer a streamlined e-commerce system for cart, checkout, and payments, alongside a rewards system using virtual currency to boost engagement. Users can also test keyboard performance, while admins manage stock levels and inventory replenishment.

## Installation Guide

### Prerequisites

Ensure you have the following installed:
- [Node.js](https://nodejs.org/) - Used for running JavaScript on the server and managing frontend dependencies.
- [PHP](https://www.php.net/) - Used for the backend of the application.
- [Composer](https://getcomposer.org/) - Dependency manager for PHP, used to install and manage libraries.
- Choose between [PostgreSQL](https://www.postgresql.org/) or [MySQL](https://www.mysql.com/) - Used for the database management system.

### Steps (fresh install)

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
    # Open the first terminal and type:
    npx tsc        # Compiles Typescript to Javascript for the front-end to work
    npm run dev    # Runs the debug server for the website

    # Open the second terminal and type:
    php artisan migrate
    php artisan db:seed
    php artisan serve
    ```

The website should now be running locally.

### Steps (to update to latest)

1. Update dependencies:
    ```bash
    npm install
    composer install
    ```

2. Update database and views:
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

3. Build assets and start the application:
   ```bash
    # Open the first terminal and type:
    npx tsc        # Compiles Typescript to Javascript for the front-end to work
    npm run dev    # Runs the debug server for the website
   
    # Open the second terminal and type:
    php artisan serve
    ```

The website should now be updated and running locally.
