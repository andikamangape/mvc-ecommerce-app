-- 1. Buat database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- 2. Tabel customers
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    billing_address TEXT,
    default_shipping_address TEXT,
    country VARCHAR(50),
    phone VARCHAR(20)
);

-- 3. Tabel categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    thumbnail VARCHAR(255)
);

-- 4. Tabel products
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(50) UNIQUE,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    weight DECIMAL(10,2),
    descriptions TEXT,
    thumbnail VARCHAR(255),
    image VARCHAR(255),
    category VARCHAR(100),           -- opsional, karena sudah ada relasi many-to-many
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    stock INT DEFAULT 0
);

-- 5. Tabel options
CREATE TABLE options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    option_name VARCHAR(100) NOT NULL
);

-- 6. Tabel product_options (relasi many-to-many products <-> options)
CREATE TABLE product_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    option_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (option_id) REFERENCES options(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- 7. Tabel product_categories (relasi many-to-many products <-> categories)
CREATE TABLE product_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- 8. Tabel orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    shipping_address TEXT,
    order_address TEXT,
    order_email VARCHAR(100),
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    order_status ENUM('pending','processing','shipped','completed','cancelled') DEFAULT 'pending',
    FOREIGN KEY (customer_id) REFERENCES customers(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- 9. Tabel order_details
CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    sku VARCHAR(50),
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
