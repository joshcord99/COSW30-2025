<?php
function getUserName($pdo, $userId) {
    $stmt = $pdo->prepare('SELECT first_name, last_name FROM users WHERE user_id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user ? $user['first_name'] . ' ' . $user['last_name'] : 'Unknown';
}
function getProductName($pdo, $productId) {
    $stmt = $pdo->prepare('SELECT product_name FROM products WHERE product_id = ?');
    $stmt->execute([$productId]);
    $product = $stmt->fetch();
    return $product ? $product['product_name'] : 'Unknown';
}
?>