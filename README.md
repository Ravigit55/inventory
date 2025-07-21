OPEN IN CODE MODE FOR PROPER FORMATE

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
Create or paste your project folder (e.g. inventory_new) here.

Example: C:\xampp\htdocs\inventory_new

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


🧠 4. Set Up Config Files
Ensure your config.php has:

define('DB_HOST', 'localhost');
define('DB_NAME', 'inventory_db');
define('DB_USER', 'root');
define('DB_PASS', '');


🧪 4. Test API Endpoints via Postman
Example: Add product (POST)
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

Postman collection URL -https://ravi-inventory.postman.co/workspace/Ravi-Workspace~093c5ac7-88da-4177-822e-c98b527ee032/collection/934835-4e31ba95-8f51-4762-9d0b-7e48649fecbf?action=share&creator=934835

🧩 5. .htaccess for Clean URLs (Optional)
If you want to use routes like /products instead of index.php, add a .htaccess file:

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
And make sure mod_rewrite is enabled in Apache.


✅ 6. Summary of Project Files
File	                            Purpose
index.php	              API router and main controller
db.php	                     PDO database connection
config.php	              DB and secret config
.htaccess	              Clean URLs
