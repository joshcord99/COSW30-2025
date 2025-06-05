<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$page_title = 'User Dashboard';
include('includes/header.html');
?>

<h2>Welcome, <?php echo $_SESSION['first_name']; ?>!</h2>
<p>Your role is: <?php echo $_SESSION['role']; ?></p>
<p><a href="logout.php" class="btn btn-danger">Logout</a></p>

<?php include('includes/footer.html'); ?>
