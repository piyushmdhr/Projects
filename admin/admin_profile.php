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

$sql = "SELECT * FROM admin_table WHERE admin_id = '" . $_SESSION["admin_id"] . "'";
$q = mysqli_query($conn, $sql);
$row = mysqli_num_rows($q);

$data = mysqli_fetch_array($q);
$name = $data[3];
$contact = $data[4];
$email = $data[1];
$password = $data[2];

?>

<!-- update -->
<?php
if (isset($_POST['update'])) {
    //variables
    $adminName = $_POST['admin_name'];
    // $patientMaritialStatus = $_POST['patient_maritial_status'];
    $adminPhone = $_POST['admin_contact_no'];
    $adminPass = $_POST['admin_password'];

    // echo $adminPhone;
    // $patientEmail = $_POST['patient_email_address'];
    // $patientId = $_POST['patient_id'];
    $sql = "UPDATE admin_table SET admin_name='$adminName', admin_password= '$adminPass', admin_contact_no=$adminPhone WHERE admin_id='" . $_SESSION["admin_id"] . "'";
    $q = mysqli_query($conn, $sql);
    header('Location: admin_profile.php');
}
?>



<html>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>

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

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
        }

        .card-body {
            flex: 1 1 auto;
            padding: .5rem .5rem;
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
            <div class="col-md-9 col-sm-9  user-wrapper">
                <div class="description">
                    <h3> PROFILE </h3>
                    <div class="col" align="right">
                        <button type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#exampleModal' title='Update Profile'><i class="fas fa-user-edit"></i></i></button>
                    </div>
                    <hr />
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">


                        <table class="table table-user-information" align="center">
                            <tbody>


                                <tr>
                                    <td class="table_head">Name</td>
                                    <td><?php echo $name;
                                        ?></td>
                                </tr>
                                <tr>
                                    <td class="table_head">Email</td>
                                    <td><?php echo $email;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table_head">Password</td>
                                    <td><?php echo $password;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table_head">Phone</td>
                                    <td><?php echo $contact; ?>
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
        <div class="col-md-4">

            <!-- Large modal -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <td class="table_head">Admin ID</td>
                                            <td><?php echo $data[0]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Email Address<span class="text-danger">*</span></td>
                                            <td><?php echo $email; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Password<span class="text-danger">*</span></td>
                                            <td><input type="password" name="admin_password" id="admin_password" class="form-control" value="<?php echo $password;
                                                                                                                                                    ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Full Name<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="admin_name" value="<?php echo $data[3];
                                                                                                                            ?>" required /></td>
                                        </tr>

                                        <tr>
                                            <td class="table_head">Phone Number<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="admin_contact_no" value="<?php echo $contact;
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
            <br /><br />
        </div>

    </div>

    </div>



    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<!-- <script type="text/javascript">
    $(function() {
        $('#patientDOB').datetimepicker();
    });
</script> -->


</html>