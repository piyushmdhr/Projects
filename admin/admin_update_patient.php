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


<!-- update -->
<?php
if (isset($_GET["id"])) {
    $patient_id = $_GET["id"];
    $sql = "SELECT * FROM patient_table WHERE patient_id = '" . $patient_id . "' ";
    $q = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($q);

    $data = mysqli_fetch_array($q);

    $name = $data[3] . " " . $data[4];
    $dob = $data[5];
    $gender = $data[6];
    $address = $data[7];
    $contact = $data[8];
    $email = $data[1];
    $password = $data[2];
    $marital = $data[9];
}



?>

<?php
if (isset($_POST['edit_patient'])) {
    //variables
    $patientFirstName = $_POST['patient_first_name'];
    $patientLastName = $_POST['patient_last_name'];
    $patientMaritialStatus = $_POST['patient_maritial_status'];
    $patientDOB = $_POST['patient_date_of_birth'];
    $patientGender = $_POST['patient_gender'];
    $patientAddress = $_POST['patient_address'];
    $patientPhone = $_POST['patient_phone_no'];
    $patientPass = $_POST['patient_password'];
    $patientBlood = $_POST['patient_blood_type'];
    // $patientEmail = $_POST['patient_email_address'];
    // $patientId = $_POST['patient_id'];


    $sql = "UPDATE patient_table SET patient_first_name='$patientFirstName', patient_last_name='$patientLastName', patient_password= '$patientPass', patient_maritial_status='$patientMaritialStatus', patient_date_of_birth='$patientDOB', patient_gender='$patientGender', patient_address='$patientAddress', patient_phone_no=$patientPhone, patient_blood_type='$patientBlood' WHERE patient_id='" . $patient_id . "'";
    $q = mysqli_query($conn, $sql);
    if ($q) {

        // echo $patientAddress;
         header('Location:admin_patient.php');
    } else {
        echo ('error');
    }
}
?>


<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal" />
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />

    <style>
        /* .sidebar {
			background-color: #3c4b64 !important;
			float: left;
			position: relative;
			margin-right: -100%;
		} */

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

        #admin_logout {

            text-decoration: none;
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

                $query = "SELECT * FROM admin_table WHERE admin_id = '" . $_SESSION['admin_id'] . "' ";
                $q = mysqli_query($conn, $query);
                $row = mysqli_num_rows($q);
                $data_admin = mysqli_fetch_array($q);

                $admin_name = $data_admin['admin_name'];

                // 	if ($_SESSION['type'] == 'Doctor') {
                // 		$object->query = "
                // SELECT * FROM doctor_table 
                // WHERE doctor_id = '" . $_SESSION['admin_id'] . "'
                // ";

                // 		$user_result = $object->get_result();

                // 		foreach ($user_result as $row) {
                // 			$user_name = $row['doctor_name'];
                // 			$user_profile_image = $row['doctor_profile_image'];
                // 		}
                // 	}


                ?>

                <!-- Nav Item - User Information -->
                <li class="nav-item" id="top-nav">
                    <span id="user_profile_name"><?php echo $admin_name; ?></span><br>
                    <a href="admin_logout.php" id="admin_logout"><span>Logout</span></a>


                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="row">
            <div class="col-sm-3">
                <!-- Sidebar -->
                <ul class="navbar-nav">

                    <div class="sidebar-brand-text mx-3"><i class="fas fa-user-tie"></i> Admin</div>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_doctor.php">
                            <i class="fa fa-user-md"></i>
                            <span>Doctor</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_patient.php">
                            <i class="fa fa-procedures"></i>
                            <span>Patient</span></a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="admin_doc_schedule.php">
                            <i class="far fa-calendar-check"></i>
                            <span>Doctor Schedule</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="admin_appointment.php">
                            <i class="fa fa-notes-medical"></i>
                            <span>Appointment</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_profile.php">
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
                            <h1 class="h3 mb-4 text-gray-800">Edit Patient</h1>
                            <!-- form start -->
                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td class="table_head">Patient ID</td>
                                            <td><?php echo $data[0]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Email Address<span class="text-danger">*</span></td>
                                            <td><?php echo $email; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Password<span class="text-danger">*</span></td>
                                            <td><input type="password" name="patient_password" id="patient_password" class="form-control" value="<?php echo $password;
                                                                                                                                                    ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">First Name<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="patient_first_name" value="<?php echo $data[3];
                                                                                                                            ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Last Name<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="patient_last_name" value="<?php echo $data[4];
                                                                                                                        ?>" required /></td>
                                        </tr>

                                        <!-- radio button -->
                                        <tr>
                                            <td class="table_head">Maritial Status<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Single" required checked>Single</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Married">Married</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Divorced">Divorced</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Widowed">Widowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- radio button end -->
                                        <tr>
                                            <td class="table_head">DOB<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fas fa-calendar">
                                                            </i>
                                                        </div>
                                                        <input class="form-control" id="patient_date_of_birth" name="patient_date_of_birth" type="date" value="<?php echo $data[5]; ?>" required />
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <!-- radio button -->
                                        <tr>
                                            <td class="table_head">Gender<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_gender" value="Male" required checked> Male</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_gender" value="Female"> Female</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_gender" value="Other"> Other</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- radio button end -->


                                        <tr>
                                            <td class="table_head">Gender<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_blood_type" value="A" required checked> A</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_blood_type" value="B" required > B</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_blood_type" value="AB" required > AB</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_blood_type" value="O" required > O</label>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="table_head">Phone Number<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="patient_phone_no" value="<?php echo $contact;
                                                                                                                        ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Address<span class="text-danger">*</span></td>
                                            <td><textarea class="form-control" name="patient_address"><?php echo $address;
                                                                                                        ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="edit_patient" class="btn btn-info" value="Update Info">
                                                <button type="button" class="btn btn-secondary" onclick="admin_patient()">Close</button>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>



                            </form>
                            <!-- form end -->



                            <!-- DataTales Example -->
                            <span id="message"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>








</body>
<script>
function admin_patient(){
    window.location.href = 'admin_patient.php';
}
</script>

<script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>