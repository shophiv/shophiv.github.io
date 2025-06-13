-- Customer Table
CREATE TABLE
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

-- Cart Table
CREATE TABLE
   Cart (
      cart_id INT PRIMARY KEY AUTO_INCREMENT,
      customer_id INT UNIQUE,
      FOREIGN KEY (customer_id) REFERENCES Customer (customer_id)
   );

-- Product Table
CREATE TABLE
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

-- Seller Table
CREATE TABLE
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

-- Cart Item Table (Many-to-One with Cart and Product)
CREATE TABLE
   CartItem (
      cart_item_id INT PRIMARY KEY AUTO_INCREMENT,
      cart_id INT,
      product_id INT,
      quantity INT,
      FOREIGN KEY (cart_id) REFERENCES Cart (cart_id),
      FOREIGN KEY (product_id) REFERENCES Product (product_id)
   );

-- Order Table
CREATE TABLE
   Orders (
      order_id INT PRIMARY KEY AUTO_INCREMENT,
      customer_id INT,
      order_date DATE,
      total_amount DECIMAL(10, 2),
      order_status VARCHAR(50) DEFAULT 'placed',
      FOREIGN KEY (customer_id) REFERENCES Customer (customer_id)
   );

-- OrderItem Table (N-to-1 with Product and Order)
CREATE TABLE
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

-- Payment Table (Optional for an Order)
CREATE TABLE
   Payment (
      payment_id INT PRIMARY KEY AUTO_INCREMENT,
      order_id INT,
      amount DECIMAL(10, 2),
      method VARCHAR(50),
      payment_status VARCHAR(50),
      payment_date DATE,
      FOREIGN KEY (order_id) REFERENCES Orders (order_id)
   );

-- Review Table (Customer writes review for Product)
CREATE TABLE
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