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
    $schedule_id = $_GET["id"];
    $sql = "SELECT * FROM doctor_schedule_table INNER JOIN doctor_table 
    ON doctor_table.doctor_id = doctor_schedule_table.doctor_id 
    WHERE doctor_schedule_id='" . $schedule_id . "' ";
    $q = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($q);

    $data = mysqli_fetch_array($q);
    $docID = $data['doctor_id'];
    $name = $data['doctor_name'];
    $schedule_date = $data['doctor_schedule_date'];
    $schedule_day = $data['doctor_schedule_day'];
    $start_time = $data['doctor_schedule_start_time'];
    $end_time = $data['doctor_schedule_end_time'];
    $avg_time = $data['average_consulting_time'];
    $status = $data['doctor_schedule_status'];
}



?>

<?php
if (isset($_POST['edit_schedule'])) {
    //variables
    // $doctorID = $_POST["doctor_id"];
	$doc_date =	$_POST["doctor_schedule_date"];
	$doc_day = date('l', strtotime($_POST["doctor_schedule_date"]));
	$doctor_start_time = $_POST["doctor_schedule_start_time"];
	$doctor_end_time = $_POST["doctor_schedule_end_time"];
	$avg_time = $_POST["average_consulting_time"];
    $schedule_status = $_POST["doctor_schedule_status"];
  
    // $doctorEmail = $_POST['doctor_email_address'];
    // $doctorId = $_POST['doctor_id'];



    $sql = "UPDATE doctor_schedule_table SET doctor_id='$docID', doctor_schedule_date= '$doc_date', doctor_schedule_day='$doc_day', doctor_schedule_start_time='$doctor_start_time', doctor_schedule_end_time='$doctor_end_time', average_consulting_time='$avg_time', doctor_schedule_status='$schedule_status' WHERE doctor_schedule_id='" . $schedule_id . "'";
    $q = mysqli_query($conn, $sql);
    if ($q) {
        header('Location:admin_doc_schedule.php');
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
                            <h1 class="h3 mb-4 text-gray-800">Edit Doctor</h1>
                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <th class>Schedule ID</th>
                                            <td><?php echo $schedule_id; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Doctor<span class="text-danger">*</span></th>
                                            <td>
                                                <select name="doctor_id" id="doctor_id" class="form-control">
                                                    <option value=""><?php echo $name; ?></option>
                                                    <?php
                                                    $sql = "SELECT * FROM doctor_table 
                                        ORDER BY doctor_name ASC";
                                                    $result = $conn->query($sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '
                                <option value="' . $row["doctor_id"] . '">' . $row["doctor_name"] . '</option>';
                                                        }

                                                    ?>
                                                </select>
                                            <?php
                                                    }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Schedule Date<span class="text-danger">*</span></th>
                                            <td><input type="date" name="doctor_schedule_date" id="doctor_schedule_date" class="form-control" value="<?php echo $schedule_date;
                                                                                                                                                        ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Start Time<span class="text-danger">*</span></th>
                                            <td><input type="time" class="form-control" name="doctor_schedule_start_time" value="<?php echo $start_time;
                                                                                                                                        ?>" required /></td>
                                        </tr>
                                        <!-- radio button -->
                                        <tr>
                                            <th>End Time<span class="text-danger">*</span></th>
                                            <td><input type="time" class="form-control" name="doctor_schedule_end_time" value="<?php echo $end_time;
                                                                                                                                    ?>" required /></td>
                                        </tr>
                                        <!-- radio button end -->
                                        <tr>
                                            <th>Consulting Time<span class="text-danger">*</span></th>
                                            <td>
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                                        <select name="average_consulting_time" id="average_consulting_time" class="form-control" required>
                                                            <option><?php echo $avg_time ?> Minutes</option>
                                                            <?php
                                                            $count = 0;
                                                            for ($i = 1; $i <= 4; $i++) {
                                                                $count += 5;
                                                                echo '<option value="' . $count . '">' . $count . ' Minutes</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>Status<span class="text-danger">*</span></th>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="doctor_schedule_status" value="Available" required> Active</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="doctor_schedule_status" value="Not Available"> Inactive</label>
                                                </div>
                                                
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <button type="submit" name="edit_schedule" id="schedule_edit_button" class="btn btn-primary"> Update </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary" onclick="backTo()">Close</button>
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


<script>
function backTo(){
    window.location.href = 'admin_doc_schedule.php';
}

</script>
<script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>