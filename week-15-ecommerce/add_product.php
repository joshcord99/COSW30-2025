<?php
include "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['product_name'];
    $cost = $_POST['cost'];
    $desc = $_POST['description'];
    $brand = $_POST['brand'];
    $size = $_POST['size'];
    $gender = $_POST['gender'];
    $stock = $_POST['stock'];

    $img = null;
    if (!empty($_FILES['image']['name'])) {
        $img = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$img");
    }

    $stmt = $pdo->prepare("INSERT INTO products 
        (product_name, cost, description, brand, size, gender, stock, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $cost, $desc, $brand, $size, $gender, $stock, $img]);

    header("Location: products.php");
    exit;
}
?>
<form method="POST" enctype="multipart/form-data">
  <input name="product_name" placeholder="Shoe Name" required>
  <input name="brand" placeholder="Brand" required>
  <input name="size" placeholder="Size" required>
  <select name="gender">
    <option value="Men">Men</option>
    <option value="Women">Women</option>
    <option value="Unisex">Unisex</option>
  </select>
  <input type="number" name="stock" placeholder="Stock" required>
  <input name="cost" placeholder="Cost" required>
  <textarea name="description" placeholder="Description"></textarea>
  <input type="file" name="image">
  <button type="submit">Add Product</button>
</form>
