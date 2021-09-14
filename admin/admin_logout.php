<?php

session_start();

if (!isset($_SESSION['type']) == 'admin') {
    unset($_SESSION['email']);
    unset($_SESSION['type']);
    unset($_SESSION['admin_id']);
}
session_destroy();

header("Location: ../doctor_login.php");
die;


?>

<html>

</html>