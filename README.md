Project Overview

The Namibian Market Catalog is a full-stack web application that allows users to browse, search, and filter locally made Namibian products.
It consists of:

A public interface (for customers to view products).

An admin dashboard (for managing products).

The project demonstrates data distribution and analytics concepts using PHP, SQLite, JSON APIs, and JavaScript for frontend interaction.

 Features
 Public Interface

Displays all products in responsive card format

Product search, category filter, and sorting (by name, price, or newest)

Data fetched dynamically via a RESTful API (/api/products.php)

Clean and responsive design

Admin Dashboard

Secure login system using hashed passwords

Ability to add, edit, and delete products

Automatic product synchronization with the frontend

SQLite database initialized and seeded automatically
| Component   | Technology                                    |
| ----------- | --------------------------------------------- |
| Frontend    | HTML5, CSS3, JavaScript                       |
| Backend     | PHP 8.4                                       |
| Database    | SQLite3                                       |
| Web Server  | PHP built-in server (`php -S localhost:8080`) |
| Data Format | JSON (API communication)                      |



Database Schema

Tables:

users

id, username, password_hash, created_at

products

id, name, description, category, price, image_url, created_at

 How to Run the Project

Open a terminal in the project folder (nam-catalog).

Start the PHP development server:

php -S localhost:8080


Visit in your browser:

http://localhost:8080/


To access the admin panel:

http://localhost:8080/admin/login.php


Login credentials:
Username: admin
Password: admin123 

nam-catalog/
│
├── api/
│   └── products.php
│
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── add.php
│   ├── edit.php
│   ├── delete.php
│   ├── logout.php
│   └── guard.php
│
├── db/
│   ├── db.php
│   ├── init.sql
│   ├── seed.sql
│   └── catalog.sqlite
│
├── assets/
│   └── images/
│
├── index.html
├── styles.css
├── script.js
└── README.md


Security & Validation

Passwords securely hashed with password_hash()

All database operations use prepared statements

Form inputs validated before insertion or updates

Session handling ensures only logged-in admins can access admin pages

Data Distribution Aspect

Product data distributed through a JSON API endpoint (/api/products.php)

Client-side fetching using JavaScript’s fetch() method

Demonstrates separation of concerns (backend data source vs frontend presentation)


format

Homepage showing product cards

Admin login page

Dashboard with CRUD operations

(Attach screenshots or reference them in your report)

 Conclusion

This project integrates front-end and back-end technologies to showcase a realistic small-scale e-commerce system. It highlights essential data distribution techniques and serves as a foundation for larger database-driven web applications.