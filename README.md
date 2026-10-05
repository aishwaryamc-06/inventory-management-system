# 📦 Inventory Management System

A web-based Inventory Management System built with **PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap**. Manages products, categories, users, stock, sales, and sales reports through a role-based interface.

**Built by:** Aishwarya M C
🔗 [LinkedIn](#) • [GitHub](#)

---

## 📑 Table of Contents
- [Overview](#-project-overview)
- [Problem Statement](#-problem-statement)
- [Features](#-main-features)
- [Screenshots](#-screenshots)
- [Tech Stack](#️-technologies-used)
- [Database](#️-database)
- [Project Structure](#️-project-structure)
- [Setup & Installation](#-installation-and-setup)
- [Demo Login](#-demo-login)
- [Improvements Made](#-key-improvements-made)
- [Limitations](#️-limitations)
- [Future Enhancements](#-future-enhancements)
- [Learning Outcomes](#-learning-outcomes)
- [License](#-license)

---

## 📌 Project Overview

Managing inventory manually becomes difficult as the number of products and sales grows — leading to incorrect stock counts, lost sales records, and slow report generation.

This project provides a **centralized web-based system** for managing inventory and sales operations, allowing authorized users to manage products and categories, record sales, automatically update stock, monitor low-stock items, and generate sales reports.

## 🎯 Problem Statement

Small businesses often track inventory using notebooks or spreadsheets, which leads to:
- Incorrect stock calculations
- Difficulty tracking products
- Duplicate or outdated records
- No proper user access control
- Difficulty spotting low-stock products
- Time-consuming sales/report calculations
- Higher chance of human error

## 💡 Proposed Solution

A centralized application where users can manage products/categories, maintain inventory, record sales, auto-update stock, prevent overselling, monitor low stock, manage users, and generate sales reports with profit calculations.

## 🎯 Objectives

1. Develop a simple, web-based inventory management system
2. Digitally maintain product and category information
3. Manage inventory quantities efficiently
4. Record and track sales transactions
5. Automatically update stock after each sale
6. Prevent sales beyond available inventory
7. Identify low-stock products
8. Provide role-based user access
9. Generate useful sales reports
10. Calculate sales revenue and profit

---

## ⭐ Main Features

### 1. User Authentication
Login system with session-based access for authorized users.

### 2. User Management (Admin)
Add, edit, delete users; manage roles, passwords, and account info.

### 3. Category Management
Add, edit, delete, and organize products by category.

### 4. Product Management
Manage product name, category, image, buying price, selling price, and stock. Add, edit, search, filter, and delete products.

### 5. Inventory Management
Stock is automatically reduced whenever a sale is recorded.

### 6. Insufficient Stock Validation
Prevents recording a sale greater than available inventory.
```

Available quantity: 5
Requested quantity: 8
→ "Insufficient stock! Available quantity: 5"

```

### 7. Sales Management
Record, view, edit, and delete sales; select products, enter quantities, auto-calculate totals.

### 8. Automatic Stock Update
```

Initial Stock = 50
Sale Quantity = 5
Remaining Stock = 45

```

### 9. Low Stock Monitoring
Dashboard flags products at or below the threshold:
```

Quantity <= 10

```

### 10. Dashboard
Overview of Total Products, Total Categories, Low Stock Items, Total Sales, and Low Stock Alerts.

### 11. Sales by Date
View sales filtered by a selected date range.

### 12. Daily Sales Report
Product-wise report for a selected month — date, product, quantity, prices, total sale, profit, plus monthly totals.

### 13. Monthly Sales Report
Product-wise report for a selected year, with yearly totals.

---

## 📷 Screenshots

| Dashboard | Product Management | Sales Report |
|---|---|---|
| _add screenshot_ | _add screenshot_ | _add screenshot_ |

---

## 💰 Sales and Profit Calculation

**Total Sale** = Selling Price × Quantity
Example: ₹500 × 4 = **₹2,000**

**Profit** = (Selling Price − Buying Price) × Quantity
Example: (₹500 − ₹400) × 4 = **₹400**

---

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Server-side application logic |
| MySQL | Database management |
| HTML5 | Page structure |
| CSS3 | Styling and layout |
| JavaScript | Client-side functionality |
| Bootstrap | Responsive UI |
| XAMPP | Local Apache + MySQL server |
| VS Code | Development environment |
| Git & GitHub | Version control & hosting |

## 🗄️ Database

Database name: `inventory_system`
SQL file: `DATABASE FILE/inventory_system.sql`

Stores: Users, Products, Categories, Sales, user groups/permissions, and product media — connected via relationships to maintain consistent inventory data.

## 🏗️ Project Structure

```

InventorySystem_PHP/
├── DATABASE FILE/
│   └── inventory_system.sql
├── includes/
│   ├── config.php
│   ├── database.php
│   ├── functions.php
│   ├── load.php
│   ├── session.php
│   ├── sql.php
│   └── upload.php
├── layouts/
│   ├── admin_menu.php
│   ├── footer.php
│   ├── header.php
│   ├── special_menu.php
│   └── user_menu.php
├── libs/
│   ├── css/
│   └── js/
├── uploads/
│   ├── products/
│   └── users/
├── home.php
├── users.php
├── product.php
├── categorie.php
├── sales.php
├── daily_sales.php
├── monthly_sales.php
├── sales_report.php
├── add_product.php
├── edit_product.php
├── add_sale.php
├── edit_sale.php
└── index.php

```

## 🔄 System Workflow

```

User Login → Dashboard → Manage Categories → Add/Manage Products
→ Maintain Stock → Record Sale → Check Available Stock
→ Update Product Quantity → Generate Sales Reports → Calculate Sales & Profit

```

## 🔐 Role-Based Access

Three roles with session-based access control:
- **Administrator**
- **Special User**
- **Employee/User**

---

## 🚀 Installation and Setup

**1. Install XAMPP** (Apache + MySQL)

**2. Copy the project**
```

C:\xampp\htdocs\InventorySystem_PHP

```

**3. Start XAMPP** — launch Apache and MySQL from the control panel

**4. Create the database**
Go to `http://localhost/phpmyadmin` → create a database named `inventory_system`

**5. Import the SQL file**
Select the database → Import → `DATABASE FILE/inventory_system.sql`

**6. Configure the database connection**
Edit `includes/config.php`:
```

Host: localhost
User: root
Password: (blank)
Database: inventory_system

```

**7. Run the app**
Visit `http://localhost/InventorySystem_PHP/`

## 🔑 Demo Login

| Role | Username | Password |
|---|---|---|
| Administrator | admin | admin |
| Special User | special | special |
| Employee/User | user | user |

> ⚠️ Demo credentials are for local testing only — not intended for production use.

---

## 📈 Key Improvements Made

**Functional**
- Added insufficient-stock validation to prevent overselling
- Added low-stock monitoring and dashboard alerts
- Added daily and monthly product-wise sales reports
- Added total sales and total profit calculation

**UI**
- Improved dashboard cards and layout
- Updated product, user, category, and sales management interfaces
- Added responsive tables and forms

> 🔧 *Note: If you've also added password hashing, prepared statements, or CSRF protection, move those items here and remove them from Future Enhancements below.*

## ⚠️ Limitations

- Local XAMPP-based deployment only
- Legacy PHP/MySQL architecture
- Basic authentication implementation
- No cloud deployment or payment integration
- No advanced analytics dashboard

## 🔮 Future Enhancements

- Password hashing using modern password APIs
- Prepared SQL statements (SQL injection prevention)
- CSRF protection
- Advanced role and permission management
- Barcode scanning
- Supplier and purchase management
- Email notifications
- Advanced charts and analytics
- PDF report generation
- Cloud deployment
- REST API integration

## 📚 Learning Outcomes

PHP web development • MySQL & database relationships • CRUD operations • Session management & authentication • Role-based authorization • Form validation • Sales/inventory calculations • Report generation • Git & GitHub • Front-end UI development

## 👨‍💻 Project Purpose

Built as a practical software development project to demonstrate **PHP + MySQL + HTML + CSS + JavaScript + Bootstrap** skills, implementing a real-world inventory and sales workflow with a relational database and web interface.

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

⭐ If you found this project useful, consider giving it a star!
