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
if (isset($_POST["add_schedule"])) {
    $servername = "localhost";
    $username = "root";
    $db = "online_doctor_appointment";

    //Taking Data from Form
    $doctorID = $_POST["doctor_id"];
    $doc_date =    $_POST["doctor_schedule_date"];
    $doc_day = date('l', strtotime($_POST["doctor_schedule_date"]));
    $doctor_start_time = $_POST["doctor_schedule_start_time"];
    $doctor_end_time = $_POST["doctor_schedule_end_time"];
    $avg_time = $_POST["average_consulting_time"];

    $date = date('Y-m-d H:i:s');

    // echo $doctorID;
    // echo $doc_date;
    // echo $doc_day;
    // echo $doctor_start_time;
    // echo $doctor_end_time;
    // echo $avg_consulting_time;


    $conn = mysqli_connect($servername, $username, "", $db);
    if (!$conn) {
        die("Connection Failed:" . mysqli_connect_error() . "<br>");
    }
    // echo ("Connected Successfully<br>");


    //INSERT
    $query = " INSERT INTO doctor_schedule_table (doctor_id, doctor_schedule_date, doctor_schedule_day, doctor_schedule_start_time, doctor_schedule_end_time, average_consulting_time)
                   VALUES (  '$doctorID','$doc_date','$doc_day','$doctor_start_time','$doctor_end_time', '$avg_time' ) ";

    $result = mysqli_query($conn, $query);

    // // var_dump($query);
    if ($result) {
?>
        <script type="text/javascript">
            alert('Schedule Added');
            window.location.href = 'admin_doc_schedule.php';
        </script>
    <?php

    } else {
    ?>
        <script type="text/javascript">
            alert('Failed to add schedule.');
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
    <title>Doctor Dashboard</title>
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
            background-color: #bad6e8;

        }

        .nav-item {
            padding-top: 5px;
            margin-left: 10px;
            padding-bottom: 5px;
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
            /* background-color: #3c4b64; */
            margin-top: 0px;
            background-size: cover;
            border-radius: 5px;
        }

        .col-sm-9 {
            flex: 0 0 75%;
            max-width: 75%;

        }

        #top-nav {

            margin-left: 1000px;
            font-size: 18px;
            font-weight: 600;

        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgb(0 0 0 / 56%);
            border-radius: .25rem;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: 0px;
            margin-left: -15px;
        }

        #doc_logout {

            color: darkred;
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
                    <span id="user_profile_name"><i class="fas fa-user-md" style="font-size: 22px;"></i>&nbsp;&nbsp;<?php echo $doctor_name; ?></span><br>
                    <a href="doctor_logout.php" id="doc_logout"><span><i class="fas fa-sign-out-alt" style="font-size: 22px;"></i>&nbsp;&nbsp;Logout</span></a>

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
                            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                            <!-- Content Row -->
                            <div class="row row-cols-4">

                                <div class="col mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        Today Total Appointment</div>
                                                    <div class="h3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $user_name = '';
                                                        $query = "SELECT * FROM appointment_table INNER JOIN doctor_schedule_table 
														ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
														WHERE doctor_schedule_date = CURDATE() AND doctor_schedule_table.doctor_id = '" . $_SESSION['doctor_id'] . "'";

                                                        $q = mysqli_query($conn, $query);
                                                        $row = mysqli_num_rows($q);
                                                        echo ($row);
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        Yesterday Total Appointment</div>
                                                    <div class="h3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $query = "SELECT * FROM appointment_table INNER JOIN doctor_schedule_table 
									                    	ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
									                    	WHERE doctor_schedule_date = CURDATE() - 1 AND doctor_schedule_table.doctor_id = '" . $_SESSION['doctor_id'] . "' ";

                                                        $q = mysqli_query($conn, $query);
                                                        $row = mysqli_num_rows($q);
                                                        echo $row;
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        Last 7 Days Total Appointment</div>
                                                    <div class="h3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $query = "SELECT * FROM appointment_table 
														INNER JOIN doctor_schedule_table 
														ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
														WHERE doctor_schedule_date >= DATE(NOW()) - INTERVAL 7 DAY  AND doctor_schedule_table.doctor_id = '" . $_SESSION['doctor_id'] . "'";

                                                        $q = mysqli_query($conn, $query);
                                                        $row = mysqli_num_rows($q);
                                                        echo $row;
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        Total Appointment till date</div>
                                                    <div class="h3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $query = "SELECT * FROM appointment_table WHERE doctor_id = '" . $_SESSION['doctor_id'] . "'";

                                                        $q = mysqli_query($conn, $query);
                                                        $row = mysqli_num_rows($q);
                                                        echo $row;
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col md-12">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        Todays Appointments</div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered" id="patient_table" width="100%" cellspacing="0">
                                                            <thead style="text-align: center;">
                                                                <tr>
                                                                    <th>Appointment No.</th>
                                                                    <th>Patient Name</th>
                                                                    <th>Appointment Time</th>
                                                                    <th>Appointment Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="text-align: center;">

                                                                <?php

                                                                $limit = 5;
                                                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                                $start = ($page - 1) * $limit;



                                                                $query = " SELECT * FROM appointment_table  
                                                                INNER JOIN doctor_table 
                                                                ON doctor_table.doctor_id = appointment_table.doctor_id 
                                                                INNER JOIN doctor_schedule_table 
                                                                ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
                                                                INNER JOIN patient_table 
                                                                ON patient_table.patient_id = appointment_table.patient_id 
														WHERE doctor_schedule_date = CURDATE() AND doctor_schedule_table.doctor_id = '" . $_SESSION['doctor_id'] . "' 
                                                        LIMIT $start, $limit ";

                                                                $result1 = $conn->query("SELECT count(appointment_id) AS id FROM appointment_table  
                                                                INNER JOIN doctor_table 
                                                                ON doctor_table.doctor_id = appointment_table.doctor_id 
                                                                INNER JOIN doctor_schedule_table 
                                                                ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
                                                                INNER JOIN patient_table 
                                                                ON patient_table.patient_id = appointment_table.patient_id 
														WHERE doctor_schedule_date = CURDATE() AND doctor_schedule_table.doctor_id = '" . $_SESSION['doctor_id'] . "'");

                                                                $appointmentCount = $result1->fetch_all(MYSQLI_ASSOC);
                                                                $total = $appointmentCount[0]['id'];
                                                                $pages = ceil($total / $limit);

                                                                $previous = $page - 1;
                                                                $next = $page + 1;

                                                                $result = $conn->query($query);
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        $appointmentStatus = '';
                                                                        if ($row["status"] == 'Booked') {
                                                                            $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-warning btn-sm appointment_button" data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . '">Booked</button>';
                                                                        } else if ($row["status"] == 'Completed') {
                                                                            $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-success btn-sm appointment_button" data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . '">Completed</button>';
                                                                        } else {
                                                                            $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-danger btn-sm appointment_button" disabled data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . '">Cancelled</button>';
                                                                        }
                                                                        echo "<tr>	
                                                    <td style='font-weight:600;'>" . $row["appointment_number"] . "</td>
                                                    <td>" . $row["patient_first_name"] . " " . $row["patient_last_name"] . "</td>
                                                   
                                                    <td>" . $row["doctor_schedule_start_time"] . "-" . $row["doctor_schedule_end_time"] . "</td>
                                                   
                                                    <td>" . $appointmentStatus . "</td>
                                                        </tr>";
                                                                    }
                                                                    echo "</tbody>
                                                    </table>";
                                                                }

                                                                ?>

                                                    </div>

                                                </div>


                                            </div>
                                            <span id="message"></span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <br>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="doctor_dashboard.php?page=<?php echo $previous ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li class="page-item"><a class="page-link" href="doctor_dashboard.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link" href="doctor_dashboard.php?page=<?php echo $next ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

<script>
    $(document).ready(function() {
        $(document).on('click', '.appointment_button', function() {
            var id = $(this).data('id');
            var status = $(this).data('appointmentstatus');
            var next_status = 'Completed';
            if (status == 'Completed') {
                next_status = 'Booked';
            }

            if (confirm("Are you sure you want to " + next_status + " it?")) {

                $.ajax({

                    url: "doctor_action.php",

                    method: "POST",

                    data: {
                        id: id,
                        status: status,
                        next_status: next_status,
                        action: 'appointment_button'
                    },

                    success: function(data) {

                        $('#message').html(data);

                        setTimeout(function() {
                            window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
                        }, 350);

                        setTimeout(function() {

                            $('#message').html('');

                        }, 500);

                    }

                })

            }

        });

    });
</script>

</html>