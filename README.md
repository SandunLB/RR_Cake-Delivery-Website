# Cake Website

Welcome to the Cake Website repository! This project is a sophisticated web application for ordering cakes online, built using PHP and MySQL.

## Features

- **Dynamic Cake Listing**: View various types of cakes dynamically fetched from the database.
- **Order Placement**: Place orders seamlessly through a user-friendly order form.
- **Database Integration**: Store orders securely in a MySQL database.
- **Responsive Design**: Optimized for various screen sizes to ensure a consistent user experience.
- **Contact Form**: Easily reachable via a contact form for inquiries and special requests.

## Prerequisites

- PHP (version 7 or higher)
- MySQL (or compatible database system)
- Web server (Apache, Nginx, etc.)

## Installation

1. **Clone the repository**:
    ```sh
    git clone https://github.com/yourusername/cake-website.git
    cd cake-website
    ```

2. **Set up the database**:
    - Create a MySQL database.
    - Import the `database.sql` file to set up the necessary tables.
    ```sh
    mysql -u username -p database_name < database.sql
    ```

3. **Configure the application**:
    - Update the `config.php` file with your database credentials.
    ```php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'your_db_username');
    define('DB_PASSWORD', 'your_db_password');
    define('DB_NAME', 'your_db_name');
    ```

4. **Run the application**:
    - Ensure your web server is running.
    - Access the application through your web browser at `http://localhost/cake-website`.


Thank you for visiting the Cake Website repository! We hope you enjoy using our application.
