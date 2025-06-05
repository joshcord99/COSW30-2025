<?php
include "includes/auth.php";
requireRole(['admin', 'employee']);
include "includes/db.php";

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
foreach ($users as $user) {
    echo "<p>{$user['user_id']} - {$user['first_name']} {$user['last_name']} - {$user['email']} - {$user['role']}</p>";
    if ($user['image']) echo "<img src='uploads/{$user['image']}' width='50'>";
}
?>