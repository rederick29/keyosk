# Aston University Team Project Group 46 2024/2025

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

3. Set up environment file:
    ```bash
    cp .env.example .env
    ```

4. Generate and assign `APP_KEY` in `.env`:
    ```bash
    php artisan key:generate
    ```
    
6. Build assets:
    ```bash
    npm run dev
    ```

7. Start the application:
    ```bash
    php artisan migrate
    php artisan serve
    ```

The website should now be running locally.