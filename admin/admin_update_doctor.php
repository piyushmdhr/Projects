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
    $doc_id = $_GET["id"];
    $sql = "SELECT * FROM doctor_table WHERE doctor_id = '" . $doc_id . "' ";
    $q = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($q);

    $data = mysqli_fetch_array($q);

    $name = $data[3];
    $dob = $data[6];
    $gender = $data[6];
    $address = $data[5];
    $contact = $data[4];
    $email = $data[1];
    $password = $data[2];
    $speciality = $data[7];
}

    // //variables
    // $doctorFirstName = $_POST['doctor_first_name'];
    // $doctorLastName = $_POST['doctor_last_name'];
    // $doctorMaritialStatus = $_POST['doctor_maritial_status'];
    // $doctorDOB = $_POST['doctor_date_of_birth'];
    // $doctorGender = $_POST['doctor_gender'];
    // $doctorAddress = $_POST['doctor_address'];
    // $doctorPhone = $_POST['doctor_phone_no'];
    // $doctorPass = $_POST['doctor_password'];
    // // $doctorEmail = $_POST['doctor_email_address'];
    // $doctorId = $_POST['doctor_id'];
    // $sql = "UPDATE doctor_table SET patient_first_name='$patientFirstName', patient_last_name='$patientLastName', patient_password= '$patientPass', patient_maritial_status='$patientMaritialStatus', patient_date_of_birth='$patientDOB', patient_gender='$patientGender', patient_address='$patientAddress', patient_phone_no=$patientPhone WHERE patient_email_address='" . $_SESSION["email"] . "'";
    // $q = mysqli_query($conn, $sql);
    // header('Location: patient_profile.php');

?>

<?php
if (isset($_POST['edit_doctor'])) {
    //variables
    $doctorName = $_POST['doctor_name'];
    $doctorSpeciality = $_POST['doctor_expert_in'];
    $doctorDOB = $_POST['doctor_date_of_birth'];
    $doctorAddress = $_POST['doctor_address'];
    $doctorPhone = $_POST['doctor_phone_no'];
    $doctorPass = $_POST['doctor_password'];
    // $doctorEmail = $_POST['doctor_email_address'];
    // $doctorId = $_POST['doctor_id'];



    $sql = "UPDATE doctor_table SET doctor_name='$doctorName',  doctor_password= '$doctorPass', doctor_expert_in='$doctorSpeciality', doctor_date_of_birth='$doctorDOB', doctor_address='$doctorAddress', doctor_phone_no=$doctorPhone WHERE doctor_id='" . $doc_id . "'";
    $q = mysqli_query($conn, $sql);
    if ($q){
        header('Location:admin_doctor.php');
    }else{
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
                            <h1 class="h3 mb-4 text-gray-800">Edit Doctor</h1>
                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td class="table_head">Doctor ID</td>
                                            <td><?php echo $doc_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Email Address<span class="text-danger">*</span></td>
                                            <td><?php echo $email; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Password<span class="text-danger">*</span></td>
                                            <td><input type="password" name="doctor_password" id="doctor_password" class="form-control" value="<?php echo $password;
                                                                                                                                                ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Full Name<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="doctor_name" value="<?php echo $data[3];
                                                                                                                        ?>" required /></td>
                                        </tr>
                                        <!-- radio button -->
                                        <tr>
                                            <td class="table_head">Speciality<span class="text-danger">*</span></td>
                                            <td>
                                                <select name="doctor_expert_in" id="doctor_expert_in" class="form-control" value="<?php echo $speciality; ?>" required>
                                                    <option value="General Physician">General Physician</option>
                                                    <option value="Cardiology">Cardiology</option>
                                                    <option value="Neurology">Neurology</option>
                                                    <option value="Hepatology">Hepatology</option>
                                                    <option value="Pediatrics">Pediatrics</option>
                                                    <option value="Ophthalmology">Ophthalmology</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <!-- radio button end -->
                                        <tr>
                                            <td class="table_head">DOB<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar">
                                                            </i>
                                                        </div>
                                                        <input class="form-control" id="doctor_date_of_birth" name="doctor_date_of_birth" type="date" value="<?php echo $dob; ?>" required />
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="table_head">Phone Number<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="doctor_phone_no" value="<?php echo $contact;
                                                                                                                        ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Address<span class="text-danger">*</span></td>
                                            <td><textarea class="form-control" name="doctor_address"><?php echo $address;
                                                                                                        ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" name="edit_doctor" id="doctor_add_button" class="btn btn-primary"> Update </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                <!-- <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked required> <label class="form-check-label" for="flexCheckChecked" style="color: black;"> I accept that the details provided by me are all valid. </label> </div> -->

                            </form>

                            <!-- DataTales Example -->
                            <span id="message"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>








</body>


<script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>