<?php
session_start();
if (!isset($_SESSION['patient_email'])) {
    header("Location: patient_login.php");
}
?>


<?php

$servername = "localhost";
$uname = "root";
$pass = "";
$db = "online_doctor_appointment";

$conn = mysqli_connect($servername, $uname, $pass, $db);

if (!$conn) {
    die("Connection Failed");
}
?>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    //  echo $id;
    $status = "Cancelled";
    //  echo $status;

    $sql = "UPDATE appointment_table SET status = '" . $status . "' WHERE appointment_id = '" . $id . "' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        header("location:my_appointment.php");
        // echo '<div class="alert alert-success">Your Appointment has been Cancelled</div>';
    } else {
        echo ('error');
    }
    mysqli_close($conn);
}
?>