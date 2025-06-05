<?php
include "includes/db.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['product_name'];
    $cost = $_POST['cost'];
    $desc = $_POST['description'];
    $brand = $_POST['brand'];
    $size = $_POST['size'];
    $gender = $_POST['gender'];
    $stock = $_POST['stock'];

    $img = $product['image'];
    if (!empty($_FILES['image']['name'])) {
        $img = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$img");
    }

    $stmt = $pdo->prepare("UPDATE products SET product_name=?, cost=?, description=?, brand=?, size=?, gender=?, stock=?, image=? WHERE product_id=?");
    $stmt->execute([$name, $cost, $desc, $brand, $size, $gender, $stock, $img, $id]);

    header("Location: products.php");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
  <input name="product_name" value="<?= $product['product_name'] ?>" required>
  <input name="brand" value="<?= $product['brand'] ?>" required>
  <input name="size" value="<?= $product['size'] ?>" required>
  <select name="gender">
    <option value="Men" <?= $product['gender'] == 'Men' ? 'selected' : '' ?>>Men</option>
    <option value="Women" <?= $product['gender'] == 'Women' ? 'selected' : '' ?>>Women</option>
    <option value="Unisex" <?= $product['gender'] == 'Unisex' ? 'selected' : '' ?>>Unisex</option>
  </select>
  <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
  <input name="cost" value="<?= $product['cost'] ?>" required>
  <textarea name="description"><?= $product['description'] ?></textarea>
  <input type="file" name="image">
  <button type="submit">Update Product</button>
</form>
