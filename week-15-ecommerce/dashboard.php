<?php
include 'includes/auth.php';
include 'views/header.php';

echo "<h1>Welcome, {$_SESSION['user']['name']}</h1>";
echo "<p>Your role is: {$_SESSION['user']['role']}</p>";

include 'views/footer.php';
?>