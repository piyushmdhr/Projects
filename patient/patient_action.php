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

if ($_POST["action"] == 'appointment_button') {

    $appointment_id = $_POST['id'];
    $appointment_status = $_POST['next_status'];
    // echo  $appointment_id;
    // echo $appointment_status;
    $query = "UPDATE appointment_table SET appointment_table.status = '$appointment_status' WHERE appointment_id =  $appointment_id ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        //     echo  $appointment_id;
        // echo $appointment_status;
        // echo $query;

        echo '<div class="alert alert-success">Appointment status changed to ' . $_POST['next_status'] . '</div>';
    }
}

?>