<?php
include 'includes/auth.php';
requireRole(['admin']);
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $status = $_POST['status'];

    $img = null;
    if (!empty($_FILES['image']['name'])) {
        $img = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$img");
    }

    $stmt = $pdo->prepare("INSERT INTO users 
        (first_name, last_name, email, password, role, status, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$fname, $lname, $email, $password, $role, $status, $img]);

    header("Location: users.php");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
  <input name="first_name" placeholder="First Name" required>
  <input name="last_name" placeholder="Last Name" required>
  <input name="email" type="email" placeholder="Email" required>
  <input name="password" type="password" placeholder="Password" required>
  <select name="role">
    <option value="customer">Customer</option>
    <option value="employee">Employee</option>
    <option value="admin">Admin</option>
  </select>
  <select name="status">
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
  </select>
  <input type="file" name="image">
  <button type="submit">Add User</button>
</form>
