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

$createTableSQL = "
CREATE TABLE IF NOT EXISTS users_tbl (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'customer',
    email VARCHAR(50),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conn->query($createTableSQL);

$checkData = $conn->query("SELECT COUNT(*) AS count FROM users_tbl");
$row = $checkData->fetch_assoc();
if ($row['count'] == 0) {
    $insertSQL = "
    INSERT INTO users_tbl (first_name, last_name, role, email) VALUES
    ('Baron', 'Munchausen', 'admin', 'baron@munchausen.org'),
    ('Jane', 'Doe', 'customer', 'jane@example.com'),
    ('John', 'Smith', 'editor', 'john@example.com'),
    ('Emily', 'Stone', 'moderator', 'emily@example.com'),
    ('Chris', 'Ray', 'customer', 'chris@example.com'),
    ('Anna', 'Lee', 'admin', 'anna@example.com'),
    ('Tom', 'Walker', 'editor', 'tom@example.com'),
    ('Sarah', 'Knight', 'customer', 'sarah@example.com'),
    ('Jake', 'Long', 'moderator', 'jake@example.com'),
    ('Laura', 'King', 'customer', 'laura@example.com');
    ";
    $conn->query($insertSQL);
}

$sql = "SELECT user_id, first_name, last_name, email, role, created_date, updated_date FROM users_tbl";
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
                <td>{$row['user_id']}</td>
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
