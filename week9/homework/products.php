<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("indus.webdevlearning.org", "uql0gwg3affoo", "cosw30!2025", "dbg3rggzgivk5u");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");

echo "<h1>Product List</h1>";
echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Flavor</th><th>Created</th><th>Updated</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['flavor']}</td>
            <td>{$row['created_date']}</td>
            <td>{$row['last_updated']}</td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
