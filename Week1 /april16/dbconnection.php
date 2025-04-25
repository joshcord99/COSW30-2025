<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Connect to MySQL</title>
</head>
<body>
<?php
// Connection settings
$host = "localhost"; 
$user = "uql0gwg3affoo"; 
$pass = "cosw30!2025"; 
$db   = "dbg3rggzgivk5u"; 
$port = 3306;

// Try to make a database connection
ini_set('display_errors', '1');
$connection = mysqli_connect($host, $user, $pass, $db, $port);

if(mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
} else {
    echo "connection made";
}
?>
</body>
</html>
