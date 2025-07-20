Here we have php code for the apis that we can call from postman.

# code is not on any server it's all with local setup.
🔧 1. Install XAMPP
If not already installed, download from:
👉 https://www.apachefriends.org/index.html

Then:

Launch XAMPP Control Panel

Start Apache and MySQL

📁 2. Place your Project Folder
Go to: C:\xampp\htdocs
Create or paste your project folder (e.g. inventory-api) here.

Example: C:\xampp\htdocs\inventory-api

🛠 3. Create the MySQL Database
Open your browser:
👉 http://localhost/phpmyadmin

Create a database:
inventory_db
Create the products table using this SQL:

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(500),
    price DECIMAL(10, 2) NOT NULL,
    stockQuantity INT NOT NULL,
    category VARCHAR(50) NOT NULL,
    isActive BOOLEAN DEFAULT 1
);


🧠 5. Set Up Config Files
Ensure your config.php has:

define('DB_HOST', 'localhost');
define('DB_NAME', 'inventory_db');
define('DB_USER', 'root');
define('DB_PASS', '');


🧪 6. Test API Endpoints via Postman
Example: Add product (POST)
URL: http://localhost/inventory-api/index.php
Method: POST

Body (raw JSON):

{
  "name": "Test Product",
  "description": "This is a test",
  "price": 199.99,
  "stockQuantity": 10,
  "category": "Electronics"
}
🧩 7. .htaccess for Clean URLs (Optional)
If you want to use routes like /products instead of index.php, add a .htaccess file:

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
And make sure mod_rewrite is enabled in Apache.


✅ Summary of Project Files
File	                              Purpose
index.php	              API router and main controller
db.php	                PDO database connection
config.php	            DB and secret config
.htaccess	              Clean URLs
