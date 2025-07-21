# 🧾 Inventory API – PHP + MySQL + XAMPP

This project provides a simple RESTful API for managing a product inventory using **PHP**, **MySQL**, and **XAMPP**. The API supports full CRUD operations, filtering, sorting, search, pagination, and basic authentication.

---

## 🚀 Features

- ✅ Create, Read, Update, Delete (CRUD) operations
- 🔍 Filter by category and stock quantity
- 📊 Sort by price (ascending/descending)
- 🔎 Search by name or category
- 📄 Pagination support
- ⚙️ Input validation and error handling
- 📫 REST API endpoints callable via Postman

---

## 🛠 Setup Instructions (Local)

### 🔧 1. Install XAMPP

If not already installed, download from:

👉 [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)

Then:

- Launch **XAMPP Control Panel**
- Start **Apache** and **MySQL**

---

### 📁 2. Place Your Project Folder

Go to your XAMPP root folder:
C:\xampp\htdocs



Create or paste your project folder (e.g., `inventory_new`) here:
C:\xampp\htdocs\inventory_new



---

### 🗄 3. Create the MySQL Database

Open in browser:

👉 [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

Create a new database:
inventory_db


Then create the `products` table with the following SQL:

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(500),
    price DECIMAL(10, 2) NOT NULL,
    stockQuantity INT NOT NULL,
    category VARCHAR(50) NOT NULL,
    isActive BOOLEAN DEFAULT 1
);
⚙️ 4. Configuration
Edit your config.php with the following settings:


define('DB_HOST', 'localhost');
define('DB_NAME', 'inventory_db');
define('DB_USER', 'root');
define('DB_PASS', '');
🧪 5. Test API with Postman
Use the following base URL:


http://localhost/inventory_new/index.php
Example – Add Product (POST):

URL: http://localhost/inventory_new/index.php

Method: POST

Body (raw JSON):


{
  "name": "Test Product",
  "description": "This is a test",
  "price": 199.99,
  "stockQuantity": 10,
  "category": "Electronics"
}
📤 Postman Collection
👉 Open Postman Collection

🧩 6. Enable Clean URLs (Optional)
To use pretty URLs like /products, create a .htaccess file in your root:


RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
Make sure mod_rewrite is enabled in Apache (see httpd.conf > LoadModule rewrite_module).

📂 Project Structure
File  Purpose
index.php Main API router and controller
db.php  PDO database connection
config.php  Database and secret configuration
.htaccess (Optional) Rewrite rules for clean URLs

📌 Notes
This project runs entirely on local setup.

API is testable via Postman using the provided collection.

Designed for demonstration and learning purposes.