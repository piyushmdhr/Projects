<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
	<meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
	<link href="css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<style>
		body {
			font-family: 'Open Sans', sans-serif;
			line-height: 20px;
			color: #999999;
			font-size: 300;
			font-size: 16px;
		}

		.navbar-default {
			background-color: #2a536ca8;
			border: 0px;
			padding: 10px 0;
			transition: all 0.3s;
		}

		.navbar-default .navbar-nav>li>a:hover,
		.navbar-default .navbar-nav>li>a:focus {
			color: #fff;
			text-transform: uppercase;
			font-weight: 900;
			background-color: rgba(72, 156, 206, 0.25);
			border-radius: 20px;
		}

		.bg-color {
			background-color: RGBA(14, 161, 168, 0.42);
			min-height: 650px;
		}

		.dropdown-menu {
			position: absolute;
			top: 100%;
			left: -100px;
			z-index: 1000;
			display: none;
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
	</style>






</head>

<body id="myPage" data-spy="scroll">
	<!--banner-->
	<section id="banner" class="banner">
		<div class="bg-color">


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
					<ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#service">Services</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#gallery">Gallery</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#contact">Contact</a>
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
			</nav>


			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-logo text-center">
							<img src="img/medical-logo.png" class="img-responsive">
						</div>
						<div class="banner-text text-center">
							<h1 class="white">Appointments, made effortless!!</h1>
							<p>UpHealth welcomes you to try our online appointment serivices which can book an appointment for you in a couple of clicks. No need to wait on the phone anymore.</p>
							<a href="patient/patient_login.php" class="btn btn-appoint">Make an Appointment.</a>
						</div>
						<div class="overlay-detail text-center">
							<a href="#service"><i class="fa fa-angle-down"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ banner-->
	<!--service-->
	<section id="service" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<h2 class="ser-title">Our Service</h2>
					<hr class="botm-line">

				</div>
				<div class="col-lg-3">
					<ul class="nav nav-tabs flex-column">
						<li class="nav-item">
							<a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Cardiology</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " data-bs-toggle="tab" href="#tab-2">Neurology</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#tab-3">Hepatology</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#tab-4">Pediatrics</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#tab-5">Eye Care</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-9 mt-4 mt-lg-0">
					<div class="tab-content">
						<div class="tab-pane active show" id="tab-1">
							<div class="row">
								<div class="col-lg-8 details order-2 order-lg-1">
									<h3>Cardiology</h3>
									<p class="font-italic">Cardiology is the study and treatment of disorders of the heart and the blood vessels. A person with heart disease or cardiovascular disease may be referred to a cardiologist.</p>
									<p>A cardiologist specializes in diagnosing and treating diseases of the cardiovascular system. The cardiologist will carry out tests, and they may perform some procedures, such as heart catheterizations, angioplasty, or inserting a pacemaker.</p>
								</div>
								<div class="col-lg-4 text-center order-1 order-lg-2">
									<img src="img/service/departments-1.jpg" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-2">
							<div class="row">
								<div class="col-lg-8 details order-2 order-lg-1">
									<h3>Neurology</h3>
									<p class="font-italic">Neurologists are specialists who treat diseases of the brain and spinal cord, peripheral nerves and muscles. Neurological conditions include epilepsy, stroke, multiple sclerosis (MS) and Parkinson's disease.</p>
									<p>Neurology is the branch of medicine concerned with the study and treatment of disorders of the nervous system. The nervous system is a complex, sophisticated system that regulates and coordinates body activities.</p>
								</div>
								<div class="col-lg-4 text-center order-1 order-lg-2">
									<img src="img/service/departments-2.jpg" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-3">
							<div class="row">
								<div class="col-lg-8 details order-2 order-lg-1">
									<h3>Hepatology</h3>
									<p class="font-italic">Hepatology is a branch of medicine concerned with the study, prevention, diagnosis, and management of diseases that affect the liver, gallbladder, biliary tree, and pancreas. The term hepatology is derived from the Greek words “hepatikos” and “logia,” which mean liver and study, respectively.</p>
								</div>
								<div class="col-lg-4 text-center order-1 order-lg-2">
									<img src="img/service/departments-3.jpg" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-4">
							<div class="row">
								<div class="col-lg-8 details order-2 order-lg-1">
									<h3>Pediatrics</h3>
									<p class="font-italic">Pediatrics is the branch of medicine that involves the medical care of infants, children, and adolescents. The American Academy of Pediatrics recommends people be under pediatric care through the age of 21.</p>
									<p>A pediatrician is a medical doctor who sees to the needs of infants, children, adolescents, and young adults. The word pediatrician comes from the Greek word for child. A pediatrician is often the first person parents call when their child is sick. A pediatrician in general practice must be skilled at treating common childhood ailments, from ear infections to minor injuries. </p>
								</div>
								<div class="col-lg-4 text-center order-1 order-lg-2">
									<img src="img/service/departments-4.jpg" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-5">
							<div class="row">
								<div class="col-lg-8 details order-2 order-lg-1">
									<h3>Eye Care</h3>
									<p class="font-italic">Ophthalmology is a branch of medicine and surgery that deals with the diagnosis and treatment of disorders of the eye. An ophthalmologist is a physician who specializes in ophthalmology.</p>
								</div>
								<div class="col-lg-4 text-center order-1 order-lg-2">
									<img src="img/service/departments-5.jpg" alt="" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--/ service-->
	<!-- gallery-->
	<section id="gallery" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="ser-title">Gallery</h2>
					<hr class="botm-line">
				</div>
				<div class="gallery">
					<a href="img/gallery/gallery-1.jpg" data-lightbox="mygaller"><img src="img/gallery/gallery-1-small.jpg"></a>
					<a href="img/gallery/185787060_336070994701915_5527410429438965408_n.png" data-lightbox="mygaller"><img src="img/gallery/185787060_336070994701915_5527410429438965408_n.png"></a>
					<a href="img/gallery/gallery-3.jpg" data-lightbox="mygaller"><img src="img/gallery/gallery-3-small.jpg"></a>
					<a href="img/gallery/185816539_847747685950572_1952600312580053542_n.png" data-lightbox="mygaller"><img src="img/gallery/185816539_847747685950572_1952600312580053542_n.png"></a>
					<a href="img/gallery/185321626_1455655861449604_6317316271733700918_n.png" data-lightbox="mygaller"><img src="img/gallery/185321626_1455655861449604_6317316271733700918_n.png"></a>
					<a href="img/gallery/186122779_258756439015749_8899930525085231234_n.png" data-lightbox="mygaller"><img src="img/gallery/186122779_258756439015749_8899930525085231234_n.png"></a>

					<!-- <a href = "img/gallery/gallery-5.jpg"><img src="img/gallery/gallery-5-small.jpg"></a> -->

				</div>
			</div>
		</div>
	</section>
	<!--/ gallery -->



	<!--contact-->
	<section id="contact" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="ser-title">Contact us</h2>
					<hr class="botm-line">
				</div>
			</div>
			<div id="contact" class="section">
				<br>
				<div class="row">
					<div class="col-md-6">
						<p id="p1">01/
						<p id="p1-1">GET IN TOUCH</p>
						</p>
						<p id="p1-2">We're easily approachable and would love to speak to you. Feel free to call, send an email. Tweet us or simply complete the suggestion form.</p>
						<br>
						<div id="p1-3">
							<i class="fa fa-phone call" aria-hidden="true"></i> &nbsp; +977 92138348663<br>
							<i class="fa fa-envelope call" aria-hidden="true"></i> &nbsp; CONTACTUS@ONLINEAPPO.COM<br>
							<i class="fab fa-twitter" id="twitter"></i> &nbsp; @ODAS<br>
							<i class="fab fa-facebook" id="fb"></i> &nbsp; FB.COM/ONLINE_DOC_AS
						</div>
					</div>

					<div class="col-md-6">
						<p class="p2">02/</p>
						<p class="p2-1">SEND A SUGGESTION</p>
						<br>
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="text" placeholder="Your Name" id="fname" name="fname" class="form-control" required><br>
							<input type="email" placeholder="Your Email" id="mail" name="mail" class="form-control" required><br>
							<input type="text" placeholder="Subject" id="sub" name="sub" class="form-control" required><br>
							<textarea id="msg" name="message" rows="5" data-rule="required" data-msg="Please write something" placeholder="Message" class="form-control" required></textarea><br>
							<input type="submit" id="send" value="Send Message"></input>
						</form>

					</div>


				</div>
			</div>
	</section>
	<!--/ contact-->
	<!--footer-->
	<footer id="footer">
		<div class="footer-line">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<small>© Copyright Online Doctor Appointment System 2021<br>
							<div class="credits">
								Brought To You By The Students of APEX College.
						</small>
					</div>
				</div>
			</div>
		</div>
		</div>
	</footer>
	<!--/ footer-->


	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

	<script src="js/lightbox-plus-jquery.min.js"></script>
	<script src="js/lightbox.min.js"></script>


</body>

</html>