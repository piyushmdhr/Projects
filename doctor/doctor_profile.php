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

$sql = "SELECT * FROM doctor_table WHERE doctor_id = '" . $_SESSION["doctor_id"] . "'";
$q = mysqli_query($conn, $sql);
$row = mysqli_num_rows($q);

$data = mysqli_fetch_array($q);
$name = $data[3];
$contact = $data[4];
$email = $data[1];
$speciality = $data['doctor_expert_in'];
$password = $data[2];
$dob = $data[6];
$address = $data[5];

?>

<!-- update -->
<?php
if (isset($_POST['update'])) {
    //variables
    $docName = $_POST['doctor_name'];
    $doctor_expert_in = $_POST['doctor_expert_in'];
    $docPhone = $_POST['doctor_phone_no'];
    $docPass = $_POST['doctor_password'];
    $docAddress = $_POST['doctor_address'];
    $docDOB = $_POST['doctor_date_of_birth'];
    // echo $adminPhone;
    // $patientEmail = $_POST['patient_email_address'];
    // $patientId = $_POST['patient_id'];
    $sql = "UPDATE doctor_table SET doctor_name='$docName', doctor_password= '$docPass', doctor_phone_no=$docPhone, doctor_expert_in='$doctor_expert_in', doctor_address='$docAddress', doctor_date_of_birth = '$dob' WHERE doctor_id = '" . $_SESSION["doctor_id"] . "' ";
    $q = mysqli_query($conn, $sql);
    header('Location: doctor_profile.php');
}
?>


<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctor Schedule</title>
    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

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
    <!-- <link rel="stylesheet" type="text/css" href="../css/doctor.css" /> -->

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

            margin-left: 1100px
        }



        <?php // include "../css/fontawesome-free/all.min.css" 
        ?>
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
                    <span id="user_profile_name"><?php echo $doctor_name; ?></span><br>
                    <a href="doctor_logout.php" id="doc_logout"><span>Logout</span></a>


                    <!-- Dropdown - User Information -->
                    <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="profile.php">
							<i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
							Profile
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="admin_logout.php">
							<i class="fa fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Logout
						</a>
					</div> -->

                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

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

            <div class="col-md-9 col-sm-9 user-wrapper">
                <div class="description">
                    <h3> PROFILE </h3>

                    <div class="col" align="right">
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#editProfile"> <i class="fas fa-user-plus"></i></button>
                    </div>
                </div>




                <div class="panel panel-default">
                    <div class="panel-body">


                        <table class="table table-user-information" align="center">
                            <tbody>


                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $name;
                                        ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $email;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><?php echo $password;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td><?php echo $dob; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Speciality</th>
                                    <td><?php echo $speciality; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $contact; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $address; ?>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
        <!-- USER PROFILE ROW END-->
        <!-- end -->









        <!-- Add modal -->


        <div class="row">
            <div class="col-md-4">
                <!-- Modal -->
                <div class="modal fade" id="editProfile">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="<?php $_PHP_SELF ?>" method="POST">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td class="table_head">Doctor ID</td>
                                                <td><?php echo $data[0]; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_head">Email Address<span class="text-danger">*</span></td>
                                                <td><?php echo $email; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table_head">Password<span class="text-danger">*</span></td>
                                                <td><input type="text" name="doctor_password" id="doctor_password" class="form-control" value="<?php echo $password;
                                                                                                                                                ?>" required /></td>
                                            </tr>
                                            <tr>
                                                <td class="table_head">Full Name<span class="text-danger">*</span></td>
                                                <td><input type="text" class="form-control" name="doctor_name" value="<?php echo $name;
                                                                                                                        ?>" required /></td>
                                            </tr>
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
                                                <td class="table_head">Doctor Speciality<span class="text-danger">*</span></td>

                                                <td>
                                                    <select name="doctor_expert_in" id="doctor_expert_in" class="form-control" required>
                                                        <option value="General Physician">General Physician</option>
                                                        <option value="Cardiology">Cardiology</option>
                                                        <option value="Neurology">Neurology</option>
                                                        <option value="Hepatology">Hepatology</option>
                                                        <option value="Pediatrics">Pediatrics</option>
                                                        <option value="Ophthalmology">Ophthalmology</option>
                                                    </select>

                                                </td>


                                            </tr>

                                            <tr>
                                                <td class="table_head">Phone Number<span class="text-danger">*</span></td>
                                                <td><input type="text" class="form-control" name="doctor_phone_no" value="<?php echo $contact;
                                                                                                                            ?>" /></td>
                                            </tr>

                                            <tr>
                                                <td class="table_head">Address<span class="text-danger">*</span></td>
                                                <td><input type="text" class="form-control" name="doctor_address" value="<?php echo $address;
                                                                                                                            ?>" /></td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <input type="submit" name="update" class="btn btn-info" value="Update Info">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>



                                </form>
                                <!-- form end -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
<!-- <script type="text/javascript">
    $(function() {
        $('#patientDOB').datetimepicker();
    });
</script> -->


</html>