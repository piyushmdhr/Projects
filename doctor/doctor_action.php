<?php

session_start();
if (!isset($_SESSION['type']) == 'doctor') {
    header("Location: ../doctor_login.php");
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

if ($_POST["action"] == 'status_button') {

    $doctor_schedule_id = $_POST['id'];
    $doctor_schedule_status = $_POST['next_status'];
    $query = "UPDATE doctor_schedule_table SET doctor_schedule_status = '$doctor_schedule_status' WHERE doctor_schedule_id =  $doctor_schedule_id ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        //     echo $doctor_schedule_id;
        // echo $doctor_schedule_status;

        echo '<div class="alert alert-success">Schedule status changed to ' . $_POST['next_status'] . '</div>';
    }
}

?>

<?php

if ($_POST["action"] == 'appointment_button') {

    $appointment_id = $_POST['id'];
    $appointment_status = $_POST['next_status'];
    // echo  $appointment_id;
    // echo $appointment_status;
    $query = "UPDATE appointment_table SET appointment_table.status = '$appointment_status', patient_come_into_hospital='Yes'  WHERE appointment_id =  $appointment_id ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        //     echo  $appointment_id;
        // echo $appointment_status;
        // echo $query;

        echo '<div class="alert alert-success">Appointment status changed to ' . $_POST['next_status'] . '</div>';
    }
}

?>