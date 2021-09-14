<?php
session_start();
if (!isset($_SESSION['patient_email'])) {
    header("Location: patient_login.php");
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "online_doctor_appointment";

$conn = mysqli_connect($servername, $username, "", $db);
if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error() . "<br>");
}


?>


<?php

$sql = "SELECT * FROM patient_table WHERE patient_email_address='" . $_SESSION["patient_email"] . "'";
$q = mysqli_query($conn, $sql);
$row = mysqli_num_rows($q);

$data = mysqli_fetch_array($q);
$name = $data[3] . " " . $data[4];
$dob = $data[5];
$gender = $data[6];
$address = $data[7];
$contact = $data[8];
$email = $data[1];
$password = $data[2];
$marital = $data[9];
$blood = $data['patient_blood_type'];
?>

<!-- update -->
<?php


if (isset($_POST['submit'])) {
    //variables
    $patientFirstName = $_POST['patient_first_name'];
    $patientLastName = $_POST['patient_last_name'];
    $patientMaritialStatus = $_POST['patient_maritial_status'];
    $patientDOB = $_POST['patient_date_of_birth'];
    $patientGender = $_POST['patient_gender'];
    $patientAddress = $_POST['patient_address'];
    $patientPhone = $_POST['patient_phone_no'];
    $patientPass = $_POST['patient_password'];
    // $patientEmail = $_POST['patient_email_address'];
    $patientId = $_POST['patient_id'];
    $sql = "UPDATE patient_table SET patient_first_name='$patientFirstName', patient_last_name='$patientLastName', patient_password= '$patientPass', patient_maritial_status='$patientMaritialStatus', patient_date_of_birth='$patientDOB', patient_gender='$patientGender', patient_address='$patientAddress', patient_phone_no=$patientPhone WHERE patient_email_address='" . $_SESSION["patient_email"] . "'";
    $q = mysqli_query($conn, $sql);
    header('Location: patient_profile.php');
}
?>



<html>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="../css/patient.css">

    <style>
        .table_head {
            font-weight: bold;
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
        <span class="navbar-brand">Hello <?php echo $data[3]; ?></span>

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
    <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">

            <!-- start -->
            <!-- USER PROFILE ROW STARTS-->
            <div class="row">
                <div class="col-md-3 col-sm-3">

                    <div class="user-wrapper">
                        <div class="description">
                            <h3><?php echo $name;
                                ?> </h3>

                            <hr />
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#updateProfile"> Update Profile </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9  user-wrapper">
                    <div class="description">
                        <h3> PROFILE </h3>


                        <div class="panel panel-default">
                            <div class="panel-body">


                                <table class="table table-user-information" align="center">
                                    <tbody>


                                        <tr>
                                            <td class="table_head">Name</td>
                                            <td><?php echo $name;
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Email</td>
                                            <td><?php echo $email;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Password</td>
                                            <td><?php echo $password;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Blood Group</td>
                                            <td><?php echo $blood;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Phone</td>
                                            <td><?php echo $contact;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">DOB</td>
                                            <td><?php echo $dob;
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Gender</td>
                                            <td><?php echo $gender;
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Marital Status</td>
                                            <td><?php echo $marital;
                                                ?></td>
                                        </tr>


                                        <tr>
                                            <td class="table_head">Address</td>
                                            <td><?php echo $address;
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <!-- ROW END -->
        </section>
        <!-- SECTION END -->
    </div>


    <div class="row">
        <div class="col-md-4">
            <!-- Modal -->
            <div class="modal fade" id="updateProfile">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                        </div>
                        <div class="modal-body">
                            <!-- form start -->
                            <form action="<?php $_PHP_SELF ?>" method="POST">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td class="table_head">Patient ID</td>
                                            <td><?php echo $data[0]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Email Address<span class="text-danger">*</span></td>
                                            <td><?php echo $email; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Password<span class="text-danger">*</span></td>
                                            <td><input type="password" name="patient_password" id="patient_password" class="form-control" value="<?php echo $password;
                                                                                                                                                    ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">First Name<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="patient_first_name" value="<?php echo $data[3];
                                                                                                                            ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Last Name<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="patient_last_name" value="<?php echo $data[4];
                                                                                                                        ?>" required /></td>
                                        </tr>

                                        <!-- radio button -->
                                        <tr>
                                            <td class="table_head">Maritial Status<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Single" required checked>Single</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Married">Married</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Divorced">Divorced</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_maritial_status" value="Widowed">Widowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- radio button end -->
                                        <tr>
                                            <td class="table_head">DOB<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar">
                                                            </i>
                                                        </div>
                                                        <input class="form-control" id="patient_date_of_birth" name="patient_date_of_birth" type="date" value="<?php echo $data[5]; ?>" required />
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <!-- radio button -->
                                        <tr>
                                            <td class="table_head">Gender<span class="text-danger">*</span></td>
                                            <td>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_gender" value="Male" required checked> Male</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_gender" value="Female"> Female</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="patient_gender" value="Other"> Other</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- radio button end -->

                                        <tr>
                                            <td class="table_head">Phone Number<span class="text-danger">*</span></td>
                                            <td><input type="text" class="form-control" name="patient_phone_no" value="<?php echo $contact;
                                                                                                                        ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="table_head">Address<span class="text-danger">*</span></td>
                                            <td><textarea class="form-control" name="patient_address"><?php echo $address;
                                                                                                        ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="submit" class="btn btn-info" value="Update Info">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>



                            </form>
                            <!-- form end -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
<!-- <script type="text/javascript">
    $(function() {
        $('#patientDOB').datetimepicker();
    });
</script> -->


</html>