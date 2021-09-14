<?php

session_start();
if (!isset($_SESSION['patient_email'])) {
    header("Location: patient_login.php");
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

$sql = "SELECT * FROM patient_table WHERE patient_email_address='" . $_SESSION["patient_email"] . "'";
$q = mysqli_query($conn, $sql);
$row = mysqli_num_rows($q);
$data_patient = mysqli_fetch_array($q);
$patient_name = $data_patient['patient_first_name'];



?>

<html>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Appointments</title>


    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/patient.css">




    <style>
        /* #show_message ::after {

            background-color: aqua;
        } */

        .dataTables_filter {
            text-align: right;

        }

        .navbar {
			margin-bottom: 0px;
			border: 0px;
			background-color: #183153;
		}

		.navbar-brand {
			width: 30%;
			color: white;
		}

		.navbar-expand-sm .navbar-nav .nav-link {
			padding-right: 3.25rem;
			color: whitesmoke;
			padding-left: 3.25rem;
		}
    </style>


</head>


<body>

    <div class="container-fluid">
        <!--Navigation Bar-->

       
	<nav class="navbar sticky-top navbar-expand-sm ">
		<!-- Brand -->
		<span class="navbar-brand">Hello <?php echo $patient_name; ?></span>

		<!-- Links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="patient_profile.php">Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="patient_dashboard.php">Book Appointment</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="my_appointment.php">My Appointment</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="patient_logout.php">Logout</a>
			</li>
		</ul>
	</nav>
        <div class="card">
            <span id="message"></span>
            <div class="card-header">
                <h4>My Appointment List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="appointment_table_filter" class="dataTables_filter">
                        <label for="search" style="display: inline-block; margin-bottom: .5rem;">
                            Search: <input type="search" class="form-control form-control-md" placeholder="Search Doctor" aria-controls="appointmnet_table" name="appointment_search" id="search_appointment" style="margin-left: 0.5em; display: inline-block; width: auto;">
                        </label>
                    </div>
                    <table class="table table-striped table-bordered" id="appointment_list_table">
                        <thead>
                            <tr>
                                <th>Appointment No.</th>
                                <th>Doctor Name</th>
                                <th>Appointment Date</th>
                                <th>Appointment Day</th>
                                <th>Appointment Time</th>
                                <th>Appointment Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $limit = 10;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $start = ($page - 1) * $limit;

                            $query = "SELECT * FROM appointment_table INNER JOIN doctor_table ON doctor_table.doctor_id = appointment_table.doctor_id 
        INNER JOIN doctor_schedule_table ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id
        WHERE appointment_table.patient_id='" . $_SESSION["patient_id"] . "'
        ORDER BY appointment_table.appointment_number DESC
        LIMIT $start, $limit";

                            $result1 = $conn->query("SELECT count(appointment_id) AS id FROM appointment_table INNER JOIN doctor_table ON doctor_table.doctor_id = appointment_table.doctor_id 
                            INNER JOIN doctor_schedule_table ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id
                            WHERE appointment_table.patient_id='" . $_SESSION["patient_id"] . "' ");

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
                                        $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-success btn-sm appointment_button" disabled data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . ' ">Completed</button>';
                                    } else {
                                        $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-danger btn-sm appointment_button" data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . '">Cancelled</button>';
                                    }

                                    echo "<tr>	
                <td>" . $row["appointment_number"] . "</td>
                <td>" . $row["doctor_name"] . "</td>
                <td>" . $row["doctor_schedule_date"] . "</td>
                <td>" . $row["doctor_schedule_day"] . "</td>
                <td>" . $row["doctor_schedule_start_time"] . "-" . $row["doctor_schedule_end_time"] . "</td>
                <td>" . $appointmentStatus . "</td>
                </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }

                            ?>

                            <p id="demo"></p>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="my_appointment.php?page=<?php echo $previous ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="my_appointment.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="my_appointment.php?page=<?php echo $next ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#search_appointment").keyup(function() {
                var search = $(this).val();
                $.ajax({
                    url: 'search_patient.php',
                    method: 'POST',
                    data: {
                        query: search,
                        action: 'appointment_search'
                    },
                    success: function(response) {
                        $("#appointment_list_table").html(response);
                    }

                });
            });
        });
    </script>

<script>
        $(document).ready(function() {
            $(document).on('click', '.appointment_button', function() {
                var id = $(this).data('id');
                var status = $(this).data('appointmentstatus');
                var next_status = 'Cancelled';
                if (status == 'Cancelled') {
                    next_status = 'Booked';
                }

                if (confirm("Are you sure you want to " + next_status + " it?")) {

                    $.ajax({

                        url: "patient_action.php",

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


<script>
    function myFunction() {
        document.getElementById("demo").innerHTML = "<div class='alert alert-success'>Your Appointment has been cancelled</div>";
    }
</script>


</html>