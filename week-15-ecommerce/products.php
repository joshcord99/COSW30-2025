<?php
include "includes/db.php";
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();

foreach ($products as $product) {
    echo "<div style='margin-bottom: 20px'>";
    echo "<h3>{$product['brand']} {$product['product_name']}</h3>";
    echo "<p>Size: {$product['size']} | Gender: {$product['gender']}</p>";
    echo "<p>Price: $ {$product['cost']}</p>";
    echo "<p>In Stock: {$product['stock']}</p>";
    if ($product['image']) echo "<img src='uploads/{$product['image']}' width='100'>";
    echo "</div>";
}
?>