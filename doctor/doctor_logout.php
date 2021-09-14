<?php

session_start();

if (!isset($_SESSION['type']) == 'doctor') {
    unset($_SESSION['doctor_id']);
    unset($_SESSION['doctor_name']);
    unset($_SESSION['email']);
    unset($_SESSION['type']); 
}
session_destroy();

header("Location: ../index.php");
die;


?>

<html>

</html>