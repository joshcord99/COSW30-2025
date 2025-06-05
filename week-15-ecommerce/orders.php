<?php
include "includes/db.php";

$stmt = $pdo->query("SELECT o.order_id, u.first_name, u.email, p.product_name, p.cost
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    JOIN products p ON o.product_id = p.product_id");

$orders = $stmt->fetchAll();
foreach ($orders as $order) {
    echo "<p>Order #{$order['order_id']}: {$order['first_name']} ({$order['email']}) bought {$order['product_name']} - $ {$order['cost']}</p>";
}
?>