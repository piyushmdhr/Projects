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


<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal"/>
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	
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

		#top-nav{

			margin-left: 1100px
		
		}

		#admin_logout{

			text-decoration: none;
		}

		
  				<?php // include "../css/fontawesome-free/all.min.css" ?>
	

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
				<li class="nav-item"  id="top-nav">
					<span id="user_profile_name"><?php echo $admin_name; ?></span><br>
					<a href="admin_logout.php"  id="admin_logout"><span>Logout</span></a>


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
							<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

							<!-- Content Row -->
							<div class="row row-cols-5">

								<div class="col mb-4">
									<div class="card border-left-primary shadow h-100 py-2">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Today Total Appointment</div>
													<div class="h5 font-weight-bold text-gray-800"><?php
																									$user_name = '';
																									$query = "SELECT * FROM appointment_table INNER JOIN doctor_schedule_table 
																										ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
																										WHERE doctor_schedule_date = CURDATE() ";

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

								<!-- Earnings (Monthly) Card Example -->
								<div class="col mb-4">
									<div class="card border-left-primary shadow h-100 py-2">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Yesterday Total Appointment</div>
													<div class="h5 font-weight-bold text-gray-800"><?php
																									$query = "SELECT * FROM appointment_table INNER JOIN doctor_schedule_table 
																										ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
																										WHERE doctor_schedule_date = CURDATE() - 1 ";

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
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Last 7 Days Total Appointment</div>
													<div class="h5 font-weight-bold text-gray-800">
														<?php
														$query = "SELECT * FROM appointment_table 
														INNER JOIN doctor_schedule_table 
														ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
														WHERE doctor_schedule_date >= DATE(NOW()) - INTERVAL 7 DAY ";

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
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Total Appointment till date</div>
													<div class="h5 font-weight-bold text-gray-800">
														<?php
														$query = "SELECT * FROM appointment_table";

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
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Total Registered Patient</div>

													<div class="h5 font-weight-bold text-gray-800">
														<?php
														$query = "SELECT * FROM patient_table";

														$q = mysqli_query($conn, $query);
														$row = mysqli_num_rows($q);
														echo $row;

														?></div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.container-fluid -->

					</div>
				</div>
			</div>
		</div>

	</div>
</body>

<script src="../js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>