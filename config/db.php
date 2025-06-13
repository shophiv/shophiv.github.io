<?php


// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Setting up the time zone
date_default_timezone_set('Asia/Karachi');


$host = "localhost";
$db = "ecommerce";
$user = "root";
$pass = "";

try {
    // 1. Connect without specifying the database
    $pdo = new PDO("mysql:host=$host", $user, $pass);               // DSN - Data Source Name
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enable Exceptions 

    // 2. Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`");

    // 3. Connect to the newly created database
    $pdo->exec("USE `$db`");

    // 4. Create TABLE if not exist (add your full CREATE TABLE statements here)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS
        Customer (
            customer_id INT PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(50),
            lastname VARCHAR(50),
            email VARCHAR(100) UNIQUE,
            password VARCHAR(255),
            phone VARCHAR(20),
            street VARCHAR(100),
            city VARCHAR(50),
            state VARCHAR(50),
            zip_code VARCHAR(10)
        );


        CREATE TABLE IF NOT EXISTS
        Cart (
            cart_id INT PRIMARY KEY AUTO_INCREMENT,
            customer_id INT UNIQUE,
            FOREIGN KEY (customer_id) REFERENCES Customer (customer_id)
        );


        CREATE TABLE IF NOT EXISTS
        Product (
            product_id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100),
            description TEXT,
            price DECIMAL(10, 2),
            category VARCHAR(100),
            stock INT,
            seller_id INT,
            FOREIGN KEY (seller_id) REFERENCES Seller (seller_id)
        );


        CREATE TABLE IF NOT EXISTS
        Seller (
            seller_id INT PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(50),
            lastname VARCHAR(50),
            email VARCHAR(100) UNIQUE,
            password VARCHAR(255),
            customer_id INT UNIQUE,
            phone VARCHAR(20),
            street VARCHAR(100),
            city VARCHAR(50),
            state VARCHAR(50),
            zip_code VARCHAR(10),
            FOREIGN KEY (customer_id) REFERENCES Customer (customer_id)
        );


        CREATE TABLE IF NOT EXISTS
        CartItem (
            cart_item_id INT PRIMARY KEY AUTO_INCREMENT,
            cart_id INT,
            product_id INT,
            quantity INT,
            FOREIGN KEY (cart_id) REFERENCES Cart (cart_id),
            FOREIGN KEY (product_id) REFERENCES Product (product_id)
        );


        CREATE TABLE IF NOT EXISTS
        Orders (
            order_id INT PRIMARY KEY AUTO_INCREMENT,
            customer_id INT,
            order_date DATE,
            total_amount DECIMAL(10, 2),
            order_status VARCHAR(50) DEFAULT 'placed',
            FOREIGN KEY (customer_id) REFERENCES Customer (customer_id)
        );


        CREATE TABLE IF NOT EXISTS
        OrderItem (
            order_item_id INT PRIMARY KEY AUTO_INCREMENT,
            order_id INT,
            product_id INT,
            seller_id INT,
            unit_price DECIMAL(10, 2),
            quantity INT,
            order_item_status VARCHAR(50) DEFAULT 'placed',
            FOREIGN KEY (order_id) REFERENCES Orders (order_id),
            FOREIGN KEY (product_id) REFERENCES Product (product_id),
            FOREIGN KEY (seller_id) REFERENCES Seller (seller_id)
        );


        CREATE TABLE IF NOT EXISTS
        Payment (
            payment_id INT PRIMARY KEY AUTO_INCREMENT,
            order_id INT,
            amount DECIMAL(10, 2),
            method VARCHAR(50),
            payment_status VARCHAR(50),
            payment_date DATE,
            FOREIGN KEY (order_id) REFERENCES Orders (order_id)
        );
        

        CREATE TABLE IF NOT EXISTS
        Review (
            review_id INT PRIMARY KEY AUTO_INCREMENT,
            customer_id INT,
            product_id INT,
            rating INT CHECK (rating BETWEEN 1 AND 5),
            comments TEXT,
            review_date DATE,
            FOREIGN KEY (customer_id) REFERENCES Customer (customer_id),
            FOREIGN KEY (product_id) REFERENCES Product (product_id)
        );
    ");

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
