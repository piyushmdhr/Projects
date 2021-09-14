

<?php

session_start();

if(isset($_SESSION['patient_email']))
{
	unset($_SESSION['patient_email']);

}
session_destroy();

header("Location: ../index.php");
die;


?>

<html>

</html>