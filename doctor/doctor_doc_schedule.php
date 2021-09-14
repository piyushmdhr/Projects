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
    $doctorID = $_SESSION['doctor_id'];
    $doc_date =    $_POST["doctor_schedule_date"];
    $doc_day = date('l', strtotime($_POST["doctor_schedule_date"]));
    $doctor_start_time = $_POST["doctor_schedule_start_time"];
    $doctor_end_time = $_POST["doctor_schedule_end_time"];
    $avg_time = $_POST["average_consulting_time"];
    $status = "Available";

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
    $query = " INSERT INTO doctor_schedule_table (doctor_id, doctor_schedule_date, doctor_schedule_day, doctor_schedule_start_time, doctor_schedule_end_time, average_consulting_time, doctor_schedule_status )
                   VALUES (  '$doctorID','$doc_date','$doc_day','$doctor_start_time','$doctor_end_time', '$avg_time','$status' ) ";

    $result = mysqli_query($conn, $query);

    // // var_dump($query);
    if ($result) {
?>
        <script type="text/javascript">
            alert('Schedule Added');
            window.location.href = 'doctor_doc_schedule.php';
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
    <title>Doctor Schedule</title>
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

                ?>

                <!-- Nav Item - User Information -->
                <li class="nav-item" id="top-nav">
                    <span id="user_profile_name"><?php echo $doctor_name; ?></span><br>
                    <a href="doctor_logout.php" id="doc_logout"><span>Logout</span></a>

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
            <div class="col-sm-9">
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <h1 class="h3 mb-4 text-gray-800">Doctor Schedule</h1>


                            <!-- DataTales Example -->
                            <span id="message"></span>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-bold text-primary">Doctor Schedule List</h6>
                                        </div>
                                        <div class="col" align="right">
                                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal"><i class="far fa-calendar-plus"></i></button>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="patient_table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Schedule Date</th>
                                                    <th>Schedule Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Consulting Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $limit = 5;
                                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                $start = ($page - 1) * $limit;

                                                $query = "SELECT * FROM doctor_schedule_table 
                                                INNER JOIN doctor_table 
                                                ON doctor_table.doctor_id = doctor_schedule_table.doctor_id  WHERE doctor_table.doctor_id = '" . $_SESSION['doctor_id'] . "'
                                                LIMIT $start, $limit";

                                                $result1 = $conn->query("SELECT count(doctor_schedule_id) AS id FROM doctor_schedule_table 
                                                INNER JOIN doctor_table 
                                                ON doctor_table.doctor_id = doctor_schedule_table.doctor_id  WHERE doctor_table.doctor_id = '" . $_SESSION['doctor_id'] . "'");

                                                $scheduleCount = $result1->fetch_all(MYSQLI_ASSOC);
                                                $total = $scheduleCount[0]['id'];
                                                $pages = ceil($total / $limit);

                                                $previous = $page - 1;
                                                $next = $page + 1;

                                                $result = $conn->query($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $status = '';
                                                        if ($row["doctor_schedule_status"] == 'Available') {
                                                            $status = '<button type="button" name="status_button" class="btn btn-success btn-sm status_button" data-id="' . $row["doctor_schedule_id"] . '" data-status="' . $row["doctor_schedule_status"] . '">Active</button>';
                                                        } else {
                                                            $status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="' . $row["doctor_schedule_id"] . '" data-status="' . $row["doctor_schedule_status"] . '">Inactive</button>';
                                                        }

                                                        echo "<tr>	
                                                   
                                                    <td>" . $row["doctor_schedule_date"] . "</td>
                                                    <td>" . $row["doctor_schedule_day"] . "</td>
                                                    <td>" . $row["doctor_schedule_start_time"] . "</td>
                                                    <td>" . $row["doctor_schedule_end_time"] . "</td>
                                                    <td>" . $row["average_consulting_time"] . "</td>
                                                    <td>" . $status . "</td>
                                                    <td> <a href='doctor_update_schedule.php?id={$row['doctor_schedule_id']}' title='Edit Schedule'><i class='far fa-edit'></i></a>&nbsp;&nbsp;<a href='doc_schedule_delete.php?id={$row['doctor_schedule_id']}' title='Delete Schedule'><i class='fas fa-trash'></i></a>
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
                            <a class="page-link" href="doctor_doc_schedule.php?page=<?php echo $previous ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="doctor_doc_schedule.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="doctor_doc_schedule.php?page=<?php echo $next ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>


        <!-- Add modal -->
        <div class="col-md-4">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
                        </div>
                        <div class="modal-body">
                            <!-- form start -->

                            <form action="<?php $_PHP_SELF ?>" method="POST">



                                <div class="form-group">
                                    <label>Schedule Date</label>
                                    <div class="input-group">

                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>

                                        <input type="date" name="doctor_schedule_date" id="doctor_schedule_date" class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <div class="input-group">
                                        <input type="time" name="doctor_schedule_start_time" id="doctor_schedule_start_time" class="form-control datetimepicker-input" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>End Time</label>
                                    <div class="input-group">

                                        <input type="time" name="doctor_schedule_end_time" id="doctor_schedule_end_time" class="form-control datetimepicker-input" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Average Consulting Time</label>
                                    <div class="input-group">

                                        <span class="input-group-text"><i class="fas fa-user-clock"></i></span>

                                        <select name="average_consulting_time" id="average_consulting_time" class="form-control" required>
                                            <option value="">Select Consulting Duration</option>
                                            <?php
                                            $count = 0;
                                            for ($i = 1; $i <= 4; $i++) {
                                                $count += 5;
                                                echo '<option value="' . $count . '">' . $count . ' Minute</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">

                            <input type="submit" name="add_schedule" id="submit_button" class="btn btn-primary" value="Add" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </form>

                    <!-- form end -->



                </div>

            </div>
        </div>

    </div>


    <script>
        $(document).ready(function() {
            $(document).on('click', '.status_button', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var next_status = 'Available';
                if (status == 'Available') {
                    next_status = 'Not Available';
                }
                if (confirm("Are you sure you want to " + next_status + " it?")) {

                    $.ajax({

                        url: "doctor_action.php",

                        method: "POST",

                        data: {
                            id: id,
                            status: status,
                            next_status: next_status,
                            action: 'status_button'
                        },

                        success: function(data) {

                            $('#message').html(data);

                            setTimeout(function() {
                                window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
                            }, 2000);

                            setTimeout(function() {

                                $('#message').html('');

                            }, 5000);

                        }

                    })

                }
            });

        });
    </script>

</body>

</html>