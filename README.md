Inventory Management System



A web-based Inventory Management System developed using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. The system helps manage products, categories, users, inventory stock, sales, and sales reports through a role-based interface.



📌 Project Overview



Managing inventory manually can be difficult when the number of products and sales increases. Manual records can lead to incorrect stock quantities, difficulty tracking sales, and time-consuming report preparation.



This project provides a centralized web-based system for managing inventory and sales operations. It allows authorized users to manage products and categories, record sales, automatically update stock quantities, monitor low-stock products, and generate sales reports.



🎯 Problem Statement



Small businesses and shops often maintain inventory and sales information using notebooks or spreadsheets. This can cause:



\- Incorrect stock calculations

\- Difficulty tracking products

\- Duplicate or outdated records

\- Lack of proper user access control

\- Difficulty monitoring low-stock products

\- Time-consuming sales calculations

\- Difficulty generating daily and monthly reports

\- Increased chances of human error



💡 Proposed Solution



The Inventory Management System provides a centralized application where users can:



\- Manage products and categories

\- Maintain inventory quantities

\- Record sales transactions

\- Automatically reduce stock after a sale

\- Prevent sales when requested quantity exceeds available stock

\- Monitor low-stock products

\- Manage system users

\- Generate sales reports

\- Calculate total sales and profit

\- View daily and monthly product-wise sales



🎯 Objectives



1\. To develop a simple web-based inventory management system.

2\. To maintain product and category information digitally.

3\. To manage inventory quantities efficiently.

4\. To record and track sales transactions.

5\. To automatically update stock after sales.

6\. To prevent sales beyond available inventory.

7\. To identify products with low stock.

8\. To provide role-based user access.

9\. To generate useful sales reports.

10\. To calculate sales revenue and profit.



🛠️ Technologies Used



Technology| Purpose

PHP| Server-side application logic

MySQL| Database management

HTML5| Page structure

CSS3| Styling and layout

JavaScript| Client-side functionality

Bootstrap| Responsive user interface

XAMPP| Local Apache and MySQL server

VS Code| Development environment

Git| Version control

GitHub| Source code hosting



💻 Development Environment



\- Operating System: Windows

\- Web Server: Apache

\- Database Server: MySQL

\- Local Server Package: XAMPP

\- Code Editor: Visual Studio Code

\- Browser: Any modern web browser



⭐ Main Features



1\. User Authentication



The system provides login functionality for authorized users.



Different user roles can be used to control access to system features.



2\. User Management



Administrators can:



\- Add users

\- Edit user information

\- Delete users

\- Manage user roles

\- Change passwords

\- Manage account information



3\. Category Management



The system allows users to:



\- Add product categories

\- Edit categories

\- Delete categories

\- Organize products based on categories



4\. Product Management



Products can be managed through:



\- Product name

\- Category

\- Product image

\- Buying price

\- Selling price

\- Stock quantity



Users can add, edit, search, filter, and delete products.



5\. Inventory Management



The system maintains the available quantity of each product.



Whenever a sale is recorded, the corresponding product stock is automatically reduced.



6\. Insufficient Stock Validation



The system checks the available stock before completing a sale.



For example:



Available quantity: 5

Requested quantity: 8



Result:

Insufficient stock! Available quantity: 5



This prevents the system from recording a sale greater than the available inventory.



7\. Sales Management



Users can:



\- Record new sales

\- Select products

\- Enter quantities

\- Calculate sale totals

\- View sales records

\- Edit sales

\- Delete sales



8\. Automatic Stock Update



When a sale is successfully recorded:



Available Stock

&#x20;     ↓

Sale Quantity

&#x20;     ↓

Stock Updated



Example:



Initial Stock = 50

Sale Quantity = 5

Remaining Stock = 45



9\. Low Stock Monitoring



The dashboard identifies products with low inventory.



The current low-stock threshold is:



Quantity <= 10



This helps users identify products that may need restocking.



10\. Dashboard



The dashboard provides an overview of important inventory information, including:



\- Total Products

\- Total Categories

\- Low Stock Items

\- Total Sales

\- Low Stock Alerts



11\. Sales by Date



The system provides sales records based on a selected date range.



This helps users analyze sales activity during a specific period.



12\. Daily Sales Report



The Daily Sales report provides product-wise information for a selected month.



It displays:



\- Date

\- Product Name

\- Quantity

\- Selling Price

\- Buying Price

\- Total Sale

\- Profit



The report also displays total sales and total profit at the bottom.



13\. Monthly Sales Report



The Monthly Sales report provides product-wise sales information for a selected year.



It displays:



\- Month

\- Product Name

\- Quantity

\- Selling Price

\- Buying Price

\- Total Sale

\- Profit



The report also displays total sales and total profit.



💰 Sales and Profit Calculation



Total Sale



The total sale amount is calculated using:



Total Sale = Selling Price × Quantity



Example:



Selling Price = ₹500

Quantity = 4



Total Sale = ₹500 × 4

&#x20;          = ₹2,000



Profit



Profit is calculated using:



Profit = Total Sale - Total Buying Cost



or:



Profit = (Selling Price - Buying Price) × Quantity



Example:



Selling Price = ₹500

Buying Price = ₹400

Quantity = 4



Profit = (₹500 - ₹400) × 4

&#x20;      = ₹400



🗄️ Database



The project uses a MySQL database named:



inventory\_system



The SQL database file is available in:



DATABASE FILE/inventory\_system.sql



Main Database Concepts



The database stores information related to:



\- Users

\- Products

\- Categories

\- Sales

\- User groups and permissions

\- Product images/media



Relationships between products, categories, users, and sales allow the system to maintain connected inventory information.



🏗️ Project Structure



InventorySystem\_PHP/

│

├── DATABASE FILE/

│   └── inventory\_system.sql

│

├── includes/

│   ├── config.php

│   ├── database.php

│   ├── functions.php

│   ├── load.php

│   ├── session.php

│   ├── sql.php

│   └── upload.php

│

├── layouts/

│   ├── admin\_menu.php

│   ├── footer.php

│   ├── header.php

│   ├── special\_menu.php

│   └── user\_menu.php

│

├── libs/

│   ├── css/

│   │   ├── dashboard.css

│   │   └── main.css

│   └── js/

│       └── functions.js

│

├── uploads/

│   ├── products/

│   └── users/

│

├── home.php

├── users.php

├── product.php

├── categorie.php

├── sales.php

├── daily\_sales.php

├── monthly\_sales.php

├── sales\_report.php

├── add\_product.php

├── edit\_product.php

├── add\_sale.php

├── edit\_sale.php

└── index.php



🔄 System Workflow



The basic workflow of the system is:



User Login

&#x20;   ↓

Dashboard

&#x20;   ↓

Manage Categories

&#x20;   ↓

Add / Manage Products

&#x20;   ↓

Maintain Stock

&#x20;   ↓

Record Sale

&#x20;   ↓

Check Available Stock

&#x20;   ↓

Update Product Quantity

&#x20;   ↓

Generate Sales Reports

&#x20;   ↓

Calculate Sales \& Profit



🔐 Role-Based Access



The system supports different user levels for controlling access to features.



The main roles include:



\- Administrator

\- Special User

\- Employee/User



The application uses session-based access control to restrict pages according to the user's permission level.



🧪 Validation and Testing



The system was tested for important operations including:



Login Testing



\- Valid username and password

\- Invalid login credentials

\- Logout functionality



Product Testing



\- Add product

\- Edit product

\- Delete product

\- Search products

\- Filter products

\- Stock quantity management



Sales Testing



\- Add sale

\- Calculate total

\- Update inventory

\- Prevent insufficient-stock sales

\- Edit sale

\- Delete sale



Report Testing



\- Date-based sales

\- Daily sales

\- Monthly sales

\- Product-wise quantities

\- Total sales calculation

\- Profit calculation



📈 Key Improvements Made



The original inventory system was enhanced with additional functionality and UI improvements.



Functional Improvements



\- Added insufficient-stock validation

\- Prevented sales exceeding available quantity

\- Added low-stock monitoring

\- Added daily product-wise sales report

\- Added monthly product-wise sales report

\- Added total sales calculation

\- Added total profit calculation



UI Improvements



\- Improved dashboard cards

\- Updated product management interface

\- Updated user management interface

\- Updated category management interface

\- Updated sales interface

\- Added responsive tables and forms

\- Added dashboard low-stock information



🚀 Installation and Setup



Step 1: Install XAMPP



Install XAMPP with:



\- Apache

\- MySQL



Step 2: Copy the Project



Copy the project folder into:



C:\\xampp\\htdocs\\



For example:



C:\\xampp\\htdocs\\InventorySystem\_PHP



Step 3: Start XAMPP



Open XAMPP Control Panel and start:



Apache

MySQL



Step 4: Create the Database



Open:



http://localhost/phpmyadmin



Create a database named:



inventory\_system



Step 5: Import the SQL File



Select the "inventory\_system" database and import:



DATABASE FILE/inventory\_system.sql



Step 6: Check Database Configuration



Open:



includes/config.php



The local configuration should point to:



Host: localhost

User: root

Password: blank

Database: inventory\_system



Step 7: Run the Application



Open your browser and visit:



http://localhost/InventorySystem\_PHP/



🔑 Demo Login



The project contains demo accounts for testing:



Role| Username| Password

Administrator| admin| admin

Special User| special| special

Employee/User| user| user



«These are demo credentials intended for local testing.»



⚠️ Limitations



The current version is primarily designed for local deployment and academic/resume demonstration.



Possible limitations include:



\- Local XAMPP-based deployment

\- Legacy PHP/MySQL architecture

\- Basic authentication implementation

\- No cloud deployment

\- No online payment integration

\- No advanced analytics dashboard



🔮 Future Enhancements



Future versions could include:



\- Password hashing using modern password APIs

\- Prepared SQL statements

\- CSRF protection

\- Advanced role and permission management

\- Barcode scanning

\- Product expiry tracking

\- Supplier management

\- Purchase management

\- Email notifications

\- Advanced charts and analytics

\- PDF report generation

\- Cloud deployment

\- REST API integration

\- Mobile-friendly improvements



📚 Learning Outcomes



Through this project, the following concepts can be practiced:



\- PHP web development

\- MySQL database management

\- CRUD operations

\- SQL queries

\- Database relationships

\- Session management

\- Authentication

\- Role-based authorization

\- Form validation

\- Inventory calculations

\- Sales management

\- Report generation

\- Git and GitHub

\- Front-end UI development



👨‍💻 Project Purpose



This project was developed as a practical software development project to demonstrate skills in:



PHP + MySQL + HTML + CSS + JavaScript + Bootstrap



It demonstrates how a real-world inventory and sales workflow can be implemented using a relational database and a web-based interface.



📌 GitHub Repository



This repository contains the complete source code, database SQL file, UI files, and supporting project resources required to run the Inventory Management System locally.



📄 License



This project includes the license file provided with the project source.



\---



Inventory Management System — PHP \& MySQL

