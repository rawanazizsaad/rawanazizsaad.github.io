<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = json_decode(file_get_contents('php://input'), true)['ids'];

    if (!empty($ids)) {
        $pdo = new PDO('mysql:host=localhost;dbname=products_db;charset=utf8', 'username', 'password');
        $placeholders = rtrim(str_repeat('?, ', count($ids)), ', ');
        $stmt = $pdo->prepare("DELETE FROM products WHERE id IN ($placeholders)");
        $stmt->execute($ids);

        echo "Products deleted successfully.";
    } else {
        echo "No products selected for deletion.";
    }
} else {
    echo "Invalid request method.";
}
?>
