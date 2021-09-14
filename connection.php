<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "online_doctor_appointment";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
