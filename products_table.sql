CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    type ENUM('DVD', 'Book', 'Furniture') NOT NULL,
    attribute VARCHAR(255) NOT NULL
);
