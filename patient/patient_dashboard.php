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

// error_reporting(0);
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
	<title>Get Appointment</title>


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
		<div class="card-header">
			<h4>Doctor Schedule List</h4>
		</div>
		<div class="card-body">
			<div id="schedule_table_filter" class="dataTables_filter">
				<label for="search" style="display: inline-block; margin-bottom: .5rem;">
					Search: <input type="search" class="form-control form-control-md" placeholder="Type Doctor Name" aria-controls="schedule_table" name="schedule_search" id="search_schedule" style="margin-left: 0.5em; display: inline-block; width: auto;">
				</label>
			</div>
			<div class="table-responsive">

				<table class="table table-striped table-bordered" id="schedule_list_table">
					<thead>
						<tr>
							<th>Doctor Name</th>
							<th>Speciality</th>
							<th>Schedule Date</th>
							<th>Schedule Day</th>
							<th>Schedule Time</th>
							<th>Action</th>
						</tr>
					</thead>

					<?php

					$limit = 10;
					$page = isset($_GET['page']) ? $_GET['page'] : 1;
					$start = ($page - 1) * $limit;

					$sql = "SELECT * FROM doctor_schedule_table 
								INNER JOIN doctor_table 
								ON doctor_table.doctor_id = doctor_schedule_table.doctor_id
								WHERE doctor_schedule_table.doctor_schedule_status = 'Available'
								ORDER BY doctor_schedule_table.doctor_schedule_date DESC
								
								LIMIT $start, $limit";

					$result1 = $conn->query("SELECT count(doctor_schedule_id) AS id FROM doctor_schedule_table
					INNER JOIN doctor_table 
					ON doctor_table.doctor_id = doctor_schedule_table.doctor_id");

					$scheduleCount = $result1->fetch_all(MYSQLI_ASSOC);
					$total = $scheduleCount[0]['id'];
					$pages = ceil($total / $limit);

					$previous = $page - 1;
					$next = $page + 1;

					$result = $conn->query($sql);
					if ($result->num_rows > 0) {

						while ($row = $result->fetch_assoc()) {

							echo "<tr>	
										<td>" . $row["doctor_name"] . "</td>
										<td>" . $row["doctor_expert_in"] . "</td>
										<td>" . $row["doctor_schedule_date"] . "</td>
										<td>" . $row["doctor_schedule_day"] . "</td>
										<td>" . $row["doctor_schedule_start_time"] . " - " . $row["doctor_schedule_end_time"] . "</td>
										<td> 
										<form method='POST' id='patient_register_form'>
										<input type='hidden' name='hidden_doctor_id' id='hidden_doctor_id' value= " . $row['doctor_id'] . " />
										<input type='hidden' name='hidden_doctor_schedule_id' id='hidden_doctor_schedule_id' value= " . $row['doctor_schedule_id'] . " />
										<button type='submit' name='get_appointment' class='btn btn-info btn-sm' onCick='Generate_appointment_no()' >
										Get Appointment </button></form> 
										
										</td>
									</tr>";
						}
						echo "</table>";
					}
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$doc_id = $_POST['hidden_doctor_id'];
						$doc_schedule_id = $_POST['hidden_doctor_schedule_id'];

						$sql = "SELECT * FROM patient_table WHERE patient_email_address='" . $_SESSION["patient_email"] . "'";
						$q = mysqli_query($conn, $sql);
						$row = mysqli_num_rows($q);

						$data_patient = mysqli_fetch_array($q);
						$patient_id = $data_patient[0];
						$pname = $data_patient[3] . " " . $data_patient[4];
						$paddress = $data_patient[7];
						$contact = $data_patient[8];


						$sql = "SELECT * FROM doctor_schedule_table INNER JOIN doctor_table ON doctor_table.doctor_id = doctor_schedule_table.doctor_id WHERE  doctor_schedule_table.doctor_schedule_id = " . $doc_schedule_id . ";";
						$q = mysqli_query($conn, $sql);
						$row = mysqli_num_rows($q);
						$data_doctor = mysqli_fetch_array($q);
						$dname = $data_doctor[11];
						$appdate = $data_doctor[2];
						$appday = $data_doctor[3];
						$status = 'Booked';

						$error = "";

						$appointment_number = Generate_appointment_no();

						$query = "INSERT INTO appointment_table (doctor_id, patient_id, doctor_schedule_id, appointment_number,status) 
						VALUES ('$doc_id', '$patient_id', '$doc_schedule_id', '$appointment_number', '$status'); ";
						$result = mysqli_query($conn, $query);
						if ($result) {
							$error = '<div class="alert alert-success">Your Appointment has been <b>' . $status . '</b> with Appointment No. <b>' . $appointment_number . '</b>. Please arrive 30 minutes before the appointed time. </div>';
						} else {
							$error = '<div class="alert alert-danger">Failed to book appointment, please try again later.</div>';
						}
						echo $error;
					}

					function Generate_appointment_no()
					{
						$servername = "localhost";
						$uname = "root";
						$pass = "";
						$db = "online_doctor_appointment";
						$conn = mysqli_connect($servername, $uname, $pass, $db);

						$query = "SELECT MAX(appointment_number) as appointment_number FROM appointment_table";

						$result = mysqli_query($conn, $query);

						$appointment_number = 0;

						foreach ($result as $row) {
							$appointment_number = $row["appointment_number"];
						}

						if ($appointment_number > 0) {
							return $appointment_number + 1;
						} else {
							return '1000';
						}
					}
					?>

			</div>

			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-end">
					<li class="page-item">
						<a class="page-link" href="patient_dashboard.php?page=<?php echo $previous ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<?php for ($i = 1; $i <= $pages; $i++) : ?>
						<li class="page-item"><a class="page-link" href="patient_dashboard.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
					<?php endfor; ?>
					<li class="page-item">
						<a class="page-link" href="patient_dashboard.php?page=<?php echo $next ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>


		</div>
	</div>



	<?php

	mysqli_close($conn);
	// }


	?>


	<script type="text/javascript">
		$(document).ready(function() {

			$("#search_schedule").keyup(function() {
				var search = $(this).val();
				$.ajax({
					url: 'search_patient.php',
					method: 'POST',
					data: {
						query: search,
						action: 'schedule_search'
					},
					success: function(response) {
						$("#schedule_list_table").html(response);
					}

				});
			});
		});
	</script>








</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>








</html>