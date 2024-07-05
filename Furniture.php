<?php
require_once 'Product.php';

class Furniture extends Product {
    public function save() {
        $pdo = new PDO('mysql:host=localhost;dbname=products_db;charset=utf8', 'username', 'password');
        $stmt = $pdo->prepare('INSERT INTO products (sku, name, price, type, attribute) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$this->getSku(), $this->getName(), $this->getPrice(), 'Furniture', $this->getAttribute()]);
    }
}
?>
