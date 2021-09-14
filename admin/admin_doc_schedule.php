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
    $query = " INSERT INTO doctor_schedule_table (doctor_id, doctor_schedule_date, doctor_schedule_day, doctor_schedule_start_time, doctor_schedule_end_time, average_consulting_time, doctor_schedule_status)
                   VALUES (  '$doctorID','$doc_date','$doc_day','$doctor_start_time','$doctor_end_time', '$avg_time', '$status') ";

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
    <title>Admin - Doctor Schedule</title>
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
                                            <button type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#exampleModal' title='Add Schedule'><i class="far fa-calendar-plus"></i></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div id="doctor_table_filter" class="dataTables_filter">
                                        <label for="search" style="display: inline-block; margin-bottom: .5rem;">
                                            Search: <input type="search" class="form-control form-control-md" placeholder="Type Doctor Name" aria-controls="schedule_table" name="schedule_search" id="search_schedule" style="margin-left: 0.5em; display: inline-block; width: auto;">
                                        </label>
                                        </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="schedule_table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Doctor</th>
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
                                                ON doctor_table.doctor_id = doctor_schedule_table.doctor_id 
                                                LIMIT $start, $limit";


                                                $result1 = $conn->query("SELECT count(doctor_schedule_id) AS id FROM doctor_schedule_table 
                                                INNER JOIN doctor_table 
                                                ON doctor_table.doctor_id = doctor_schedule_table.doctor_id");

                                                $scheduleCount = $result1->fetch_all(MYSQLI_ASSOC);
                                                $total = $scheduleCount[0]['id'];
                                                $pages = ceil($total / $limit);

                                                $previous = $page - 1;
                                                $next = $page + 1;

                                                $result = $conn->query($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>	
                                                    <td>" . $row["doctor_name"] . "</td>
                                                    <td>" . $row["doctor_schedule_date"] . "</td>
                                                    <td>" . $row["doctor_schedule_day"] . "</td>
                                                    <td>" . $row["doctor_schedule_start_time"] . "</td>
                                                    <td>" . $row["doctor_schedule_end_time"] . "</td>
                                                    <td>" . $row["average_consulting_time"] . "</td>
                                                    <td>" . $row["doctor_schedule_status"] . "</td>
                                                    <td> <a href='admin_update_schedule.php?id={$row['doctor_schedule_id']}' title='Edit Schedule'><i class='far fa-edit'></i></a>&nbsp;&nbsp;<a href='schedule_delete.php?id={$row['doctor_schedule_id']}' title='Delete Schedule'><i class='fas fa-trash'></i></a>
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
                            <a class="page-link" href="admin_doc_schedule.php?page=<?php echo $previous ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="admin_doc_schedule.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="admin_doc_schedule.php?page=<?php echo $next ?>" aria-label="Next">
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
                                    <label>Select Doctor<span class="text-danger">*</span></label>
                                    <select name="doctor_id" id="doctor_id" class="form-control" required>
                                        <option value="">Select Doctor</option>
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
                                </div>
                            <?php
                                        }
                            ?>
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
                                    <!-- <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div> -->
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

    <script type="text/javascript">
        $(document).ready(function() {

                $("#search_schedule").keyup(function() {
                    var search = $(this).val();
                    $.ajax({
                        url: 'search_admin.php',
                        method: 'POST',
                        data: {query: search , action:'schedule_search'},
                        success: function(response) {
                            $("#schedule_table").html(response);
                        }

                    });
                });
            });
       
    </script>

</body>


<script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>