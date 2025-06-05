<?php
include 'includes/auth.php';
requireRole(['admin']);
include 'includes/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    $img = $user['image'];
    if (!empty($_FILES['image']['name'])) {
        $img = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$img");
    }

    $stmt = $pdo->prepare("UPDATE users SET first_name=?, last_name=?, email=?, role=?, status=?, image=? WHERE user_id=?");
    $stmt->execute([$fname, $lname, $email, $role, $status, $img, $id]);

    header("Location: users.php");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
  <input name="first_name" value="<?= $user['first_name'] ?>" required>
  <input name="last_name" value="<?= $user['last_name'] ?>" required>
  <input name="email" type="email" value="<?= $user['email'] ?>" required>
  <select name="role">
    <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
    <option value="employee" <?= $user['role'] == 'employee' ? 'selected' : '' ?>>Employee</option>
    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
  </select>
  <select name="status">
    <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
    <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
  </select>
  <input type="file" name="image">
  <button type="submit">Update User</button>
</form>
