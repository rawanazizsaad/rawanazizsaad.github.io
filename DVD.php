<?php

class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function save()
    {
        global $pdo; // Access the global PDO instance
        $stmt = $pdo->prepare('INSERT INTO products (sku, name, price, type, attribute) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$this->getSku(), $this->getName(), $this->getPrice(), 'DVD', 'Size: ' . $this->size]);
    }
}

?>
