# Restoran App

A fully-featured restaurant management web application built with Laravel.  
This app allows users to browse the menu, add foods to the cart, place orders with payment, leave reviews, and admins to manage the system.

🚀Live Demo: https://myre.page.gd/

---

## Table of Contents

1. [Features](#features)
2. [Technologies Used](#technologies-used)
3. [Installation](#installation)
4. [Database Setup](#database-setup)
5. [Running the App](#running-the-app)
6. [Folder Structure](#folder-structure)
7. [Notes](#notes)
8. [Optional Enhancements](#optional-enhancements)

---

## Features

### User Functionality

-   Browse food menu (Breakfast, Lunch, Dinner).
-   View details for each food item: name, price, description, image.
-   Add/remove foods to/from the cart.
-   Checkout and place orders with payment integration(paypal).
-   Leave reviews and ratings for foods.
-   Fully mobile responsive design for all devices.

### Admin Functionality

-   Authentication (admins can log in separately).
-   CRUD operations: create, read, update, delete foods.
-   Manage carts, orders, and checkouts.
-   Review and manage user orders and payments.

---

## Technologies Used

-   Backend: PHP 8.x, Laravel 10
-   Frontend: Blade Templates, Tailwind CSS / Bootstrap (mobile responsive)
-   Database: MySQL (`restoran`)
-   Other Tools: Composer, Artisan commands,

---

## Installation

1. Clone the repository

```bash
git clone <github.com/ahmeddin12/restoran>
cd restoran


Install dependencies

composer install
npm install && npm run dev


Set up .env file

APP_NAME=Restoran
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restoran
DB_USERNAME=root
DB_PASSWORD=


Generate application key

php artisan key:generate

Database Setup

Ensure your MySQL database restoran exists.

Run migrations to create tables:

php artisan migrate


Seed the database with sample foods, categories, users, and reviews:

php artisan db:seed


Place food images in public/images/foods/ and make sure image_url in foods table points to the correct paths (e.g., images/foods/pancakes.jpg).

Running the App

Start the Laravel development server:

php artisan serve


Open your browser and navigate to:

http://127.0.0.1:8000


Users can browse foods, add to cart, checkout, and leave reviews.

Admins can log in and manage foods, carts, orders, and payments.

Folder Structure (Key Parts)
app/
├─ Http/Controllers/        # Controllers for foods, cart, orders, checkout, admin
├─ Models/                  # Eloquent models (Food, Cart, Order, Review, User)
resources/
├─ views/foods/             # Food-related Blade templates
├─ views/admin/             # Admin dashboard templates
public/images/foods/        # Store food images here
database/
├─ migrations/              # Database migrations
├─ seeders/                 # Sample data seeders

Notes

Make sure all images are in public/images/foods and paths in DB are correct.

Mobile responsive design works across all devices.

Payment system is already integrated for checkout.

Admin users must log in to perform CRUD operations.

Minor formatting changes (spaces, line breaks) don’t need separate commits.

Optional Enhancements

Add category filters for menu items.

Email notifications for users/admins when orders are placed.

Advanced analytics dashboard for admin to track sales.

Multi-language support for international users.
```
