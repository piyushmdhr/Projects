<?php

session_start();
if (!$_SESSION['type'] == 'admin') {
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
  if(isset($_GET["id"]))
 {
	 $id=$_GET["id"];
    //  echo $id;
    //  $status = "Cancel";
    //  echo $status;

	$sql="DELETE FROM doctor_table WHERE doctor_id = '" . $id. "' ";
	$result= mysqli_query($conn,$sql);
    if ($result){

         header("location:admin_doctor.php");
        // echo '<div class="alert alert-success">Your Appointment has been Cancelled</div>';
    }
   else{
       echo ('error');
   }
   mysqli_close($conn);
 }
?>