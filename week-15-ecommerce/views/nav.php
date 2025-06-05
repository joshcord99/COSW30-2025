<nav>
  <a href="products.php">Products</a>
  <?php if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'employee') : ?>
    <a href="users.php">Users</a>
    <a href="orders.php">Orders</a>
  <?php endif; ?>
  <a href="dashboard.php">Dashboard</a>
  <a href="logout.php">Logout</a>
</nav>
