<?php
abstract class Product {
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attribute;

    public function __construct($sku, $name, $price, $attribute) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attribute = $attribute;
    }

    public function getSku() { return $this->sku; }
    public function getName() { return $this->name; }
    public function getPrice() { return $this->price; }
    public function getAttribute() { return $this->attribute; }

    abstract public function save();
}
?>
