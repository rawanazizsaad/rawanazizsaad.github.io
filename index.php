<?php
// Autoload classes
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $productType = $_POST['productType'];

    try {
        // Determine the product type and create an instance
        switch ($productType) {
            case 'DVD':
                $size = $_POST['size'];
                $product = new DVD($sku, $name, $price, $size);
                break;
            case 'Book':
                $weight = $_POST['weight'];
                $product = new Book($sku, $name, $price, $weight);
                break;
            case 'Furniture':
                $height = $_POST['height'];
                $width = $_POST['width'];
                $length = $_POST['length'];
                $product = new Furniture($sku, $name, $price, $height, $width, $length);
                break;
            default:
                throw new Exception("Invalid product type!");
        }

        // Save the product
        $product->save();

        // Redirect to product list
        header('Location: product_list.html');
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}
?>
