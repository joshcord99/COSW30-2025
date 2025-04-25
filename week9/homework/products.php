<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "uql0gwg3affoo";
$password = "cosw30!2025";
$dbname = "dbg3rggzgivk5u";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$createProductsTable = "
CREATE TABLE IF NOT EXISTS products_tbl (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(30) NOT NULL,
    color VARCHAR(20),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conn->query($createProductsTable);

$checkProducts = $conn->query("SELECT COUNT(*) AS count FROM products_tbl");
$row = $checkProducts->fetch_assoc();
if ($row['count'] == 0) {
    $conn->query("
    INSERT INTO products_tbl (product_name, color) VALUES
    ('T-shirt', 'Red'),
    ('Sneakers', 'White'),
    ('Backpack', 'Black'),
    ('Notebook', 'Blue'),
    ('Water Bottle', 'Green'),
    ('Sunglasses', 'Brown'),
    ('Watch', 'Silver'),
    ('Jacket', 'Gray'),
    ('Hat', 'Beige'),
    ('Scarf', 'Pink')
    ");
}

$result = $conn->query("SELECT * FROM products_tbl");

echo "<h1>Product List</h1>";
if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Color</th><th>Created</th><th>Updated</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['color']}</td>
                <td>{$row['created_date']}</td>
                <td>{$row['updated_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}
$conn->close();
?>
