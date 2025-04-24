<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("indus.webdevlearning.org", "uql0gwg3affoo", "cosw30!2025", "dbg3rggzgivk5u");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT o.order_id, o.order_status, o.created_date, o.last_updated,
               p.product_name, u.first_name, u.last_name
        FROM orders o
        LEFT JOIN products p ON o.product_id = p.product_id
        LEFT JOIN users_tbl u ON o.user_id = u.id";

$result = $conn->query($sql);

echo "<h1>Order List</h1>";
echo "<table border='1'>
        <tr><th>Order ID</th><th>Product</th><th>User</th><th>Status</th><th>Created</th><th>Updated</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['order_id']}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['first_name']} {$row['last_name']}</td>
            <td>{$row['order_status']}</td>
            <td>{$row['created_date']}</td>
            <td>{$row['last_updated']}</td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
