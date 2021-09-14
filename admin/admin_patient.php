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
if (isset($_POST["add_patient"])) {
    $servername = "localhost";
    $username = "root";
    $db = "online_doctor_appointment";

    //Taking Data from Form
    $email = $_POST['patient_email_address'];
    $password = $_POST['patient_password'];
    $fname = $_POST['patient_first_name'];
    $lname = $_POST['patient_last_name'];
    $address =  $_POST['patient_address'];
    $gender = $_POST['patient_gender'];
    $dob = $_POST['patient_date_of_birth'];
    $contact = $_POST['patient_phone_no'];
    $marital = $_POST['patient_maritial_status'];
    //Taking Current Time and Date
    $date = date('Y-m-d H:i:s');

    $conn = mysqli_connect($servername, $username, "", $db);
    if (!$conn) {
        die("Connection Failed:" . mysqli_connect_error() . "<br>");
    }
    // echo ("Connected Successfully<br>");


    //INSERT
    $query = " INSERT INTO patient_table ( patient_email_address, patient_password, patient_first_name,patient_last_name, patient_date_of_birth, patient_gender, patient_address, patient_phone_no, patient_maritial_status, patient_added_on )
                   VALUES (  '$email','$password','$fname','$lname','$dob', '$gender','$address','$contact','$marital','$date' ) ";

    $result = mysqli_query($conn, $query);

    // var_dump($query);
    if ($result) {
?>
        <script type="text/javascript">
            alert('Patient Added');
            window.location.href = 'admin_patient.php';
        </script>
    <?php

    } else {
    ?>
        <script type="text/javascript">
            alert('Registration Failed. This email has been already registered');
        </script>
<?php

        // <!-- echo ("Error: " . $query . "<br>" . mysqli_error($conn)); -->
    }
}


?>


<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Patient</title>
    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" /> -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal" />
    <link rel="stylesheet" type="text/css" href="../css/admin.css" />


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        /* .sidebar {
			background-color: #3c4b64 !important;
			float: left;
			position: relative;
			margin-right: -100%;
		} */
        .hidetext {
            -webkit-text-security: disc;
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

        .dataTables_filter {
            text-align: right;
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


                ?>

                <!-- Nav Item - User Information -->
                <li class="nav-item" id="top-nav">
                    <span id="user_profile_name"><?php echo $admin_name; ?></span><br>
                    <a href="admin_logout.php" id="admin_logout"><span>Logout</span></a>

                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="row" class="sidebar">
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
                            <h1 class="h3 mb-4 text-gray-800">Patients</h1>


                            <!-- DataTales Example -->
                            <span id="message"></span>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary">Patient List</h6>
                                        </div>
                                        <div class="col" align="right">
                                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addPatient"> <i class="fas fa-user-plus"></i></button>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="doctor_table_filter" class="dataTables_filter">
                                        <label for="search" style="display: inline-block; margin-bottom: .5rem;">
                                            Search: <input type="search" class="form-control form-control-md" placeholder="Type Patient Name" aria-controls="patient_table" name="patient_search" id="search_patient" style="margin-left: 0.5em; display: inline-block; width: auto;">
                                        </label>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="patient_table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Email Address</th>
                                                    <th>Password</th>
                                                    <th>Gender</th>
                                                    <th>Blood Type</th>
                                                    <th>Contact No.</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $limit = 5;
                                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                $start = ($page - 1) * $limit;

                                                $query = "SELECT * FROM patient_table LIMIT $start, $limit";

                                                $result1 = $conn->query("SELECT count(patient_id) AS id FROM patient_table");

                                                $patientCount = $result1->fetch_all(MYSQLI_ASSOC);
                                                $total = $patientCount[0]['id'];
                                                $pages = ceil($total / $limit);

                                                $previous = $page - 1;
                                                $next = $page + 1;


                                                $result = $conn->query($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>	
                                <td>" . $row["patient_first_name"] . " " . $row["patient_last_name"] . "</td>
                                <td>" . $row["patient_email_address"] . "</td>
                                <td class='hidetext'>"  . $row["patient_password"] . "</td>
                                <td>" . $row["patient_gender"] . "</td>
                                <td>" . $row["patient_blood_type"] . "</td>
                                <td>" . $row["patient_phone_no"] . "</td>
                                <td> <a href='admin_update_patient.php?id={$row['patient_id']}' title='Update Profile'><i class='far fa-edit'></i></a>&nbsp;&nbsp;<a href='patient_delete.php?id={$row['patient_id']}' title='Delete Profile'><i class='fas fa-trash'></i></a>
                                </td>
                                    </tr>";
                                                    }
                                                    echo "</tbody>
                                </table>";
                                                }

                                                ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="admin_patient.php?page=<?php echo $previous ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="admin_patient.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="admin_patient.php?page=<?php echo $next ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>



    </div>

    <!-- Add modal -->
    <div class="row">
        <div class="col-md-4">
            <!-- Modal -->
            <div class="modal fade" id="addPatient">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="myModalLabel">Add Patient</h4>
                        </div>
                        <div class="modal-body">
                            <!-- form start -->

                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                <div class="form-group">
                                    <label>Patient Email Address<span class="text-danger">*</span></label>
                                    <input type="email" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus />
                                </div>
                                <div class="form-group">
                                    <label>Patient Password<span class="text-danger">*</span></label>
                                    <input type="password" name="patient_password" id="patient_password" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name<span class="text-danger">*</span></label>
                                            <input type="text" name="patient_first_name" id="patient_first_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name<span class="text-danger">*</span></label>
                                            <input type="text" name="patient_last_name" id="patient_last_name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth<span class="text-danger">*</span></label>
                                            <input type="date" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender<span class="text-danger">*</span></label>
                                            <select name="patient_gender" id="patient_gender" class="form-control" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Blood Type<span class="text-danger">*</span></label>
                                        <select name="patient_blood_type" id="patient_blood_type" class="form-control" required>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact No.<span class="text-danger">*</span></label>
                                            <input type="text" name="patient_phone_no" id="patient_phone_no" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maritial Status<span class="text-danger">*</span></label>
                                            <select name="patient_maritial_status" id="patient_maritial_status" class="form-control" required>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Complete Address<span class="text-danger">*</span></label>
                                    <textarea name="patient_address" id="patient_address" class="form-control" required></textarea>
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <button type="submit" name="add_patient" id="patient_register_button" class="btn btn-primary"> Register</button>
                                </div>

                            </form>

                            <!-- form end -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {

            $("#search_patient").keyup(function() {
                var search = $(this).val();
                $.ajax({
                    url: 'search_admin.php',
                    method: 'POST',
                    data: {
                        query: search,
                        action: 'patient_search'
                    },
                    success: function(response) {
                        $("#patient_table").html(response);
                    }

                });
            });
        });
    </script>

</body>


<!-- <script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->

</html>