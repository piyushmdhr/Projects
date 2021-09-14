<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $db = "online_doctor_appointment";

    //Taking Data from Form
    $email = $_POST['patient_email_address'];
    $password = $_POST['patient_password'];
    $fname = $_POST['patient_first_name'];
    $lname = $_POST['patient_last_name'];
    $address =  $_POST['patient_address'];
    $dob = $_POST['patient_date_of_birth'];
    $gender = $_POST['patient_gender'];
    $contact = $_POST['patient_phone_no'];
    $martial = $_POST['patient_maritial_status'];
    //Taking Current Time and Date
    $date = date('Y-m-d H:i:s');

    $conn = mysqli_connect($servername, $username, "", $db);
    if (!$conn) {
        die("Connection Failed:" . mysqli_connect_error() . "<br>");
    }
    // echo ("Connected Successfully<br>");


    //INSERT
    $query = " INSERT INTO patient_table (  patient_email_address, patient_password, patient_first_name, patient_last_name, patient_date_of_birth, patient_gender,  patient_address, patient_phone_no, patient_maritial_status, patient_added_on )
                   VALUES (  '$email','$password','$fname',' $lname','$dob','$gender','$address','$contact','$martial','$date' ) ";

    $result = mysqli_query($conn, $query);

    // var_dump($query);
    if ($result) {
?>
        <script type="text/javascript">
            alert('Registration Successful');
        </script>
    <?php
        header("Location: patient_login.php");
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/register.css">

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
            margin-top: 20px;
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
                    <img src="../img/medical-logo.png" class="img-responsive" style="width: 140px; margin-top: 0px;">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php#service">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php#contact">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="patient_login.php"><i class="fas fa-user-injured"></i> Patient Login</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../doctor_login.php"><i class="fas fa-hospital-user"></i> Hospital Login</a></li>

                        </ul>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <span id="message"></span>
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">


                        <form method="POST" id="patient_register_form">
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
                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked required> <label class="form-check-label" for="flexCheckChecked" style="color: black;"> I accept that the details provided by me are all valid. </label> </div>
                            <div class="form-group text-center">
                                <button type="submit" name="submit" id="patient_register_button" class="btn btn-primary"> Register</button>
                            </div>

                            <div class="form-group text-center">
                                <p><a class="login" href="patient_login.php">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <br />
                <br />
            </div>
        </div>
    </div>

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>



</body>

</html>