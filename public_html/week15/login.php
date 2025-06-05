<?php
require('../private/mysqli_connect.php');
include('includes/login_functions.inc.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);

    if ($check) {
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['role'] = $data['role'];
        redirect_user('view_users.php');
    } else {
        $errors = $data;
    }
}

$page_title = 'Login';
include('includes/header.html');
?>

<h2>Login</h2>

<?php if (!empty($errors)) {
    echo '<div class="alert alert-danger"><strong>Errors:</strong><br>';
    foreach ($errors as $msg) {
        echo " - $msg<br>";
    }
    echo '</div>';
} ?>

<form action="login.php" method="post">
    <p>Email: <input type="email" name="email" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <p><input type="submit" value="Login" class="btn btn-primary"></p>
</form>

<?php include('includes/footer.html'); ?>
