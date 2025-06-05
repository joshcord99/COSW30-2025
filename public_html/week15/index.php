<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: view_users.php");
} else {
    header("Location: login.php");
}
exit();
