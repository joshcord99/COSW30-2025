<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "indus.webdevlearning.org";
$username = "uql0gwg3affoo";
$password = "cosw30!2025";
$dbname = "dbg3rggzgivk5u";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, first_name, last_name, email, role, created_date, updated_date FROM users_tbl";
$result = $conn->query($sql);

echo "<h1>List of Users</h1>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created Date</th>
            <th>Last Updated</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['role']}</td>
                <td>{$row['created_date']}</td>
                <td>{$row['updated_date']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No users found or query failed.";
}

$conn->close();
?>
