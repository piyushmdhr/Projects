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

$output = "";

if (isset($_POST['query'])) {
    if ($_POST["action"] == 'schedule_search') {
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM doctor_schedule_table 
        INNER JOIN doctor_table 
        ON doctor_table.doctor_id = doctor_schedule_table.doctor_id
        WHERE doctor_name LIKE CONCAT('%',?,'%') ");
        $stmt->bind_param("s", $search);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $output = "<thead>
        <tr>
        <th>Doctor Name</th>
        <th>Speciality</th>
        <th>Schedule Date</th>
        <th>Schedule Day</th>
        <th>Schedule Time</th>
        <th>Action</th>
        </tr>
    </thead>
    
    <tbody>";
            while ($row = $result->fetch_assoc()) {
                $output .= "
        <tr>
            <td>" . $row["doctor_name"] . "</td>
		    <td>" . $row["doctor_expert_in"] . "</td>
		    <td>" . $row["doctor_schedule_date"] . "</td>
		    <td>" . $row["doctor_schedule_day"] . "</td>
		    <td>" . $row["doctor_schedule_start_time"] . " - " . $row["doctor_schedule_end_time"] . "</td>
		    <td> 
		        <form method='POST' id='patient_register_form'>
		            <input type='hidden' name='hidden_doctor_id' id='hidden_doctor_id' value= " . $row['doctor_id'] . " />
		            <input type='hidden' name='hidden_doctor_schedule_id' id='hidden_doctor_schedule_id' value= " . $row['doctor_schedule_id'] . " />
		            <button type='submit' name='get_appointment' class='btn btn-dark btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' onCick='Generate_appointment_no()' >
		            Get Appointment </button></form>                 
		    </td>
        </tr>";
            }
            $output .= "</tbody>";
            echo $output;
        } else {
            echo ("<div class='alert alert-danger'>No Records Found!</div>");
        }
    }

    if ($_POST["action"] == 'appointment_search') {
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM appointment_table 
        INNER JOIN doctor_table ON doctor_table.doctor_id = appointment_table.doctor_id 
        INNER JOIN doctor_schedule_table ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id
        WHERE appointment_table.patient_id='" . $_SESSION["patient_id"] . "' 
        AND doctor_table.doctor_name LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("s", $search);
       
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $output = "<thead>
        <tr>
        <th>Appointment No.</th>
        <th>Doctor Name</th>
        <th>Appointment Date</th>
        <th>Appointment Day</th>
        <th>Appointment Time</th>
        <th>Appointment Status</th>
        </tr>
    </thead>
    
    <tbody>";
            while ($row = $result->fetch_assoc()) {
                $appointmentStatus = '';
                                    if ($row["status"] == 'Booked') {
                                        $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-warning btn-sm appointment_button" data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . '">Booked</button>';
                                    } else if ($row["status"] == 'Completed') {
                                        $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-success btn-sm appointment_button" disabled data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . ' ">Completed</button>';
                                    } else {
                                        $appointmentStatus = '<button type="button" name="appointment_button" class="btn btn-danger btn-sm appointment_button" data-id="' . $row["appointment_id"] . '" data-appointmentstatus="' . $row["status"] . '">Cancelled</button>';
                                    }
                $output .= "
        <tr>
        <<td>" . $row["appointment_number"] . "</td>
        <td>" . $row["doctor_name"] . "</td>
        <td>" . $row["doctor_schedule_date"] . "</td>
        <td>" . $row["doctor_schedule_day"] . "</td>
        <td>" . $row["doctor_schedule_start_time"] . "-" . $row["doctor_schedule_end_time"] . "</td>
        <td>" . $appointmentStatus . "</td>
        </tr>";
            }
            $output .= "</tbody>";
            echo $output;
        } else {
            echo ("<div class='alert alert-danger'>No Records Found!</div>");
        }
    }




}
?>