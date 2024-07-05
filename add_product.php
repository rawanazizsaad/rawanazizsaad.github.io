<?php
// Database configuration
$host = 'localhost';  // Replace with your database host, e.g., 'localhost' or IP address
$dbname = 'products_db';  // Replace with your database name
$username = 'root';  // MySQL username
$password = '';  // Replace with your MySQL password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Handle PDO connection error
    echo "Connection failed: " . $e->getMessage();
    exit; // Exit script if connection fails
}

// Autoload classes (assuming your classes are in separate files named after the class)
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sku = isset($_POST['sku']) ? $_POST['sku'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $productType = isset($_POST['productType']) ? $_POST['productType'] : '';

    // Check if 'productType' is set in $_POST
    if (!empty($productType)) {
        switch ($productType) {
            case 'DVD':
                $size = isset($_POST['size']) ? $_POST['size'] : '';
                $product = new DVD($sku, $name, $price, $size);
                break;
            case 'Book':
                $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
                $product = new Book($sku, $name, $price, $weight);
                break;
            case 'Furniture':
                $height = isset($_POST['height']) ? $_POST['height'] : '';
                $width = isset($_POST['width']) ? $_POST['width'] : '';
                $length = isset($_POST['length']) ? $_POST['length'] : '';
                $product = new Furniture($sku, $name, $price, $height, $width, $length);
                break;
            default:
                echo "Invalid product type!";
                exit;
        }

        // Save the product
        if (isset($product)) {
            try {
                // Call the save method on the product instance
                $product->save();

                // Optionally, you can log or output a success message
                echo "New record created successfully";
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error saving product: " . $e->getMessage();
            }
        }

        // Redirect to product list or provide success message
        header('Location: product_list.html');
        exit;
    } else {
        echo "Product type not specified!";
        exit;
    }
}
?>
