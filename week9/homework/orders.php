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

$createOrdersTable = "
CREATE TABLE IF NOT EXISTS orders_tbl (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NULL,
    user_id INT NULL,
    order_status VARCHAR(20) DEFAULT 'Pending',
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conn->query($createOrdersTable);

$checkOrders = $conn->query("SELECT COUNT(*) AS count FROM orders_tbl");
$row = $checkOrders->fetch_assoc();
if ($row['count'] == 0) {
    $conn->query("
    INSERT INTO orders_tbl (product_id, user_id) VALUES
    (1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
    (6, 6), (7, 7), (8, 8), (9, 9), (10, 10)
    ");
}

$result = $conn->query("SELECT * FROM orders_tbl");

echo "<h1>Order List</h1>";
if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Order ID</th><th>Product ID</th><th>User ID</th><th>Status</th><th>Created</th><th>Updated</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['order_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['order_status']}</td>
                <td>{$row['created_date']}</td>
                <td>{$row['updated_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No orders found.";
}
$conn->close();
?>
