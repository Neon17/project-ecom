# E-Commerce Platform

A full-featured e-commerce platform built with **Laravel 12**, featuring role-based access for admins and customers, payment processing, and fast product search.

## Features

- **Auth** — Register, login, email verification, forgot/reset password
- **Products** — Category filtering, Typesense-powered search, product detail pages
- **Cart** — Guest cart with automatic merge on login
- **Checkout & Orders** — Full order lifecycle with order history for users
- **Coupons** — Discount coupon system at checkout
- **Payments** — Payment integration with PDF invoice generation (DomPDF)
- **Admin Dashboard** — Manage products, categories, orders, users, coupons, and payments
- **Contact** — Contact form with message storage

## Tech Stack

| Layer | Tech |
|---|---|
| Backend | Laravel 12, PHP 8.2 |
| Frontend | Blade, Tailwind CSS, Vite |
| Search | Typesense |
| PDF | barryvdh/laravel-dompdf |
| Database | MySQL |

## Setup

```bash
git clone https://github.com/Neon17/project-ecom
cd project-ecom
composer install && npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```
