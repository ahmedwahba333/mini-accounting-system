# Accounting System

Accounting System is a Laravel-based project designed to manage various accounting tasks efficiently. This system offers a range of features to handle items, customers, and invoices, facilitating seamless tracking and organization of financial records. The project primarily focuses on the backend functionality, while the user interface has been developed from scratch.

## Features

- **Items**: Maintain a comprehensive list of items available for purchase.
- **Customers**: Manage a database of customers who have made purchases.
- **Invoices**: Generate and store invoices for customers, with the flexibility to include one or multiple items.
- **Authentication**: Enable secure user login, logout, and password reset functionality.
- **PDF Download**: Easily download invoices in PDF format for convenient offline access.
- **Archive**: Archive and restore items and customers as needed, ensuring a clutter-free interface.
- **Translation**: Effortlessly switch between Arabic and English translations within the website.

## Installation

Follow these steps to install and set up the Accounting System project:

On GitHub:-
* Clone the repository to your local machine.

On Drive:-
download and extract the project

1. Install project dependencies by executing `composer install` and `composer dump-autoload`.
2. Create a database and configure the database connection in the `.env` file.
3. Migrate the required database tables by running `php artisan migrate`.
4. Seed the database with initial data using `php artisan db:seed --class=ItemsSeeder`.
5. Launch the application by executing `php artisan serve`.

## Usage

To access the Accounting System, navigate to the locally hosted website. The login credentials for the admin account are as follows:

- Username: admin
- Password: password

## License

This project is licensed under the name of Ahmed Mostafa Ismail and is available for use under the provided contact details:

- Name: Ahmed Mostafa Ismail
- Email: ahmedmismail39@gmail.com
- Phone: +2 01069780368