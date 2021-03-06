<?php
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "online_doctor_appointment";

	$conn = mysqli_connect($servername, $username, "", $db);
	if (!$conn) {
		die("Connection Failed:" . mysqli_connect_error() . "<br>");
	}

	$user = $_POST['email'];
	$pass = $_POST['password'];

	// echo $user;
	// echo $pass;
	$res = mysqli_query($conn, "SELECT * FROM `admin_table` where  `admin_email_address`='" . $user . "' AND  `admin_password`='" . $pass . "'");

	if (mysqli_num_rows($res) == 0) {
		$res = mysqli_query($conn, "SELECT * FROM `doctor_table` where  `doctor_email_address`='" . $user . "' AND  `doctor_password`='" . $pass . "'");
		if (mysqli_num_rows($res) == 0) {
			echo "<script>
			               alert('Invalid Username or Password!');
			               window.location.href='doctor_login.php';
			    	</script>";

			exit();
		} else {
			$row = mysqli_num_rows($res);
			$data = mysqli_fetch_array($res);
			$_SESSION['doctor_id'] = $data['doctor_id'];
			$_SESSION['doctor_name'] = $data['doctor_name'];
			$_SESSION['email'] = $user;
			$_SESSION['type'] = 'doctor';
			echo "<script>
					alert('Logged In. Welcome!');	
					window.location.href='doctor/doctor_dashboard.php';
				 </script>";

			exit();
		}
	} else {
		$row = mysqli_num_rows($res);
		$data = mysqli_fetch_array($res);
		$_SESSION['admin_id'] = $data['admin_id'];
		$_SESSION['email'] = $user;
		$_SESSION['type'] = 'admin';
		echo "<script>
				alert('Logged In. Welcome!');	
	  	 	window.location.href='admin/admin_dashboard.php';
			</script>";
		exit();
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Doctor Login</title>

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
	<link href="css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login_style.css">

	<style>
		body {
			background-color: #1f505cc4;
			font-family: "Poppins", sans-serif;
			font-weight: 300;
		}

		.navbar {
			margin-bottom: 0px;
			border: 0px;
			background-color: #183153;
		}

		.card {
			margin-top: 80px;
			margin-bottom: 0px;
			border: none;
			padding: 20px;
			background-color: #fff;
			color: rgb(11, 63, 160);
		}

		.circle {
			height: 40px;
			width: 40px;
			display: flex;
			align-items: center;
			justify-content: center;
			background-color: #094175;
			color: #fff;
			font-size: 25px;
			border-radius: 50%;
		}

		.dropdown-menu {
			position: absolute;
			top: 100%;
			left: -100px;
			z-index: 1000;
			display: none;
			float: left;
			min-width: 10rem;
			padding: .5rem 0;
			margin: .125rem 0 0;
			font-size: 1rem;
			color: #212529;
			text-align: left;
			list-style: none;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid rgba(0, 0, 0, .15);
			border-radius: .25rem;
		}

		#footer {
			padding-top: 25px;
			padding-bottom: 25px;
			margin: 0px;
			background-color: rgb(20, 52, 90);

		}
	</style>

</head>

<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-default bg-default">
		<div class="container-fluid">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/medical-logo.png" class="img-responsive" style="width: 140px; margin-top: 0px;">
				</a>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarScroll">
				<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php#service">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php#contact">Contact</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Login
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
							<li><a class="dropdown-item" href="patient/patient_login.php"><i class="fas fa-user-injured"></i> Patient Login</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="doctor_login.php"><i class="fas fa-hospital-user"></i> Hospital Login</a></li>

						</ul>
					</li>

				</ul>

			</div>
		</div>
	</nav>
	<div class="container register">
		<div class="container mt-5 mb-5">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-md-6">
					<div class="card px-5 py-5"> <span class="circle"><i class="fas fa-hospital-user"></i></span>
						<h5 class="mt-3">Admin/ Doctor Login</h5> <small class="mt-2 text-muted">
							<form class="form" role="form" method="POST">
								<div class="form-input"> <i class="fas fa-at"></i> <input type="text" class="form-control" placeholder="Email address" name="email"> </div>
								<div class="form-input"> <i class="fas fa-unlock-alt"></i> <input type="password" class="form-control" placeholder="Password" name="password"> </div>
								<div class="form-check"> <button class="btn btn-primary mt-4 signup">Login</button> </div>
							</form>
					</div>
				</div>
			</div>
			<!--footer-->
			<footer id="footer" class="page-footer font-small white fixed-bottom">

				<div class="col-md-12 text-center">
					?? Copyright Online Doctor Appointment System 2021<br>
					<div class="credits">
						Brought To You By The Students of APEX College.


			</footer>
			<!--/ footer-->


			<!-- <script src="js/jquery.min.js"></script> -->

</body>

</html>