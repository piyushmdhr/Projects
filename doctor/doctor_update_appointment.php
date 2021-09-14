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
if (isset($_GET["id"])) {
    $appointment_id = $_GET["id"];
    $sql = "SELECT * FROM appointment_table  
    INNER JOIN doctor_table 
    ON doctor_table.doctor_id = appointment_table.doctor_id 
    INNER JOIN doctor_schedule_table 
    ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
    INNER JOIN patient_table 
    ON patient_table.patient_id = appointment_table.patient_id
    WHERE appointment_id='" . $appointment_id . "' ";
    $q = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($q);

    $data = mysqli_fetch_array($q);
    $appNo = $data['appointment_number'];
    $patientName = $data['patient_first_name'] ." ". $data['patient_last_name'];
    $appointment_date = $data['doctor_schedule_date'];
    $appointment_time = $data['doctor_schedule_start_time'] ."  -  ". $data['doctor_schedule_end_time'];   
    $doctor_cmt = $data['doctor_comment'];
}
?>

<?php
if (isset($_POST['edit_appointment'])) {
  
    $doc_cmt =    $_POST["doctor_comment"];
  
    $sql = "UPDATE appointment_table SET doctor_comment='$doc_cmt' WHERE appointment_id='" . $appointment_id . "' ";
    $q = mysqli_query($conn, $sql);
    if ($q) {
        header('Location:doctor_appointment.php');
    } else {
        echo ('error');
    }
}

?>




<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Appointment</title>


    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->

    <!-- <link href="../datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="../datatables/jquery.dataTables.min.js"></script>
    <script src="../datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" /> -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal" />
    <link rel="stylesheet" type="text/css" href="../css/doctor.css" />

    <style>
        /* .sidebar {
			background-color: #3c4b64 !important;
			float: left;
			position: relative;
			margin-right: -100%;
		} */


        #doc_logout {

            text-decoration: none;
        }

        .sidebar-brand-text {
            height: 4.375rem;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 800;
            padding: 1.5rem 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            z-index: 1;
            color: lightgray;

        }

        .navbar {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding-top: 0rem;
            padding-bottom: 0.5rem;

        }

        .nav-item {
            padding-top: 20px;
            margin-left: 10px;
            padding-bottom: 20px;

        }

        .nav-link {
            color: #fff;
            font-weight: 600;

        }

        .nav-link:hover {
            color: darkgrey;

        }

        .col-sm-3 {
            -ms-flex: 0 0 18%;
            flex: 0 0 18%;
            max-width: 20%;
            background-color: #3c4b64;
            margin-top: 0px;
            background-size: cover;
            border-radius: 5px;
        }

        .navbar {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding-top: 0rem;
            padding-bottom: 0.5rem;
        }

        #top-nav {

            margin-left: 1100px;
        }
    </style>




</head>


<body>
    <!-- Page Wrapper-->
    <div id="wrapper">
        <!-- Topbar -->
        <nav class="navbar topbar mb-4 static-top shadow">

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <?php
                $user_name = '';

                $query = "SELECT * FROM doctor_table WHERE doctor_id = '" . $_SESSION['doctor_id'] . "' ";
                $q = mysqli_query($conn, $query);
                $row = mysqli_num_rows($q);
                $data_doctor = mysqli_fetch_array($q);

                $doctor_name = $data_doctor['doctor_name'];

                ?>

                <!-- Nav Item - User Information -->
                <li class="nav-item" id="top-nav">
                    <span id="user_profile_name"><?php echo $doctor_name; ?></span><br>
                    <a href="doctor_logout.php" id="doc_logout"><span>Logout</span></a>

                </li>

            </ul>

        </nav> <!-- End of Topbar -->


        <div class="row" class="sidebar">
            <div class="col-sm-3">
                <!-- Sidebar -->
                <ul class="navbar-nav">

                    <!-- Sidebar - Brand -->
                    <div class="sidebar-brand-icon rotate-n-15">

                    </div>

                    <div class="sidebar-brand-text mx-3"><i class="fas fa-stethoscope"></i> Doctor</div>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <!-- <li class="nav-item">
						<a class="nav-link" href="admin_patient.php">
							<i class="fa fa-procedures"></i>
							<span>Patient</span></a>
					</li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="doctor_doc_schedule.php">
                            <i class="far fa-calendar-check"></i>
                            <span>Doctor Schedule</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="doctor_appointment.php">
                            <i class="fa fa-notes-medical"></i>
                            <span>Appointment</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_profile.php">
                            <i class="fa fa-id-card"></i>
                            <span>Profile</span></a>
                    </li>
                </ul>
                <!-- End of Sidebar -->
            </div>
            <div class="col-sm-9">
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <!-- Main Content -->
                    <div id="content">
                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <h1 class="h3 mb-4 text-gray-800">Edit Doctor</h1>
                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <th class>Appointment ID</th>
                                            <td><?php echo $appointment_id; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td>
                                                <?php echo $patientName; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Appointment Date</th>
                                            <td><?php echo $appointment_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Appointment Time</th>
                                            <td><?php echo $appointment_time; ?></td>
                                        </tr>
                                        <tr>
                                        <th>Doctor Comment</th>
                                        <td><textarea name="doctor_comment" id="doctor_comment" class="form-control" ><?php echo $doctor_cmt; ?></textarea></td>
                                        </tr>
                                             
                                        <tr>
                                            <td>
                                                <button type="submit" name="edit_appointment" id="appointment_edit_button" class="btn btn-primary"> Update </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary" onclick="backTo()">Close</button>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                               

                            </form>

                            <!-- DataTales Example -->
                            <span id="message"></span>

                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <script>
    function backTo() {
        window.location.href = 'doctor_appointment.php';
    }
</script>

</body>

</html>