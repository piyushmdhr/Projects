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
    if ($_POST["action"] == 'doctor_search') {
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM doctor_table WHERE doctor_name LIKE CONCAT('%',?,'%') ");
        $stmt->bind_param("s", $search);
        // }
        // else{
        //     $stmt = $conn->prepare("SELECT * FROM doctor_table");
        // }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $output = "<thead>
        <tr>
            <th>Doctor Name</th>
            <th>Email Address</th>
            <th>Password</th>
            <th>Doctor Speciality</th>
            <th>Doctor Phone No.</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>";
            while ($row = $result->fetch_assoc()) {
                $output .= "
        <tr>
        <td>" . $row["doctor_name"] . "</td>	
        <td>" . $row["doctor_email_address"] . "</td>
        <td>" . $row["doctor_password"] . "</td>
        <td>" . $row["doctor_expert_in"] . "</td>
        <td>" . $row["doctor_phone_no"] . "</td>
        
        <td> <a href='admin_update_doctor.php?id={$row['doctor_id']}' title='Update Profile'><i class='far fa-edit'></i></a>&nbsp;&nbsp;<a href='doctor_delete.php?id={$row['doctor_id']}' title='Delete Profile'><i class='fas fa-trash'></i></a>
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
        INNER JOIN doctor_table 
        ON doctor_table.doctor_id = appointment_table.doctor_id 
        INNER JOIN doctor_schedule_table 
        ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
        INNER JOIN patient_table 
        ON patient_table.patient_id = appointment_table.patient_id 
        WHERE doctor_table.doctor_name LIKE CONCAT('%',?,'%') OR patient_table.patient_first_name LIKE CONCAT('%',?,'%') OR patient_table.patient_last_name LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("sss", $search, $search, $search);
        // }
        // else{
        //     $stmt = $conn->prepare("SELECT * FROM doctor_table");
        // }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $output = "<thead>
        <tr>
        <th>Appointment ID</th>
        <th>Appointment No.</th>
        <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Appointment Date</th>
        <th>Appointment Time</th>
        <th>Appointment Day</th>
        <th>Appointment Status</th>
        </tr>
    </thead>
    
    <tbody>";
            while ($row = $result->fetch_assoc()) {
                $output .= "
        <tr>
        <td>" . $row["appointment_id"] . "</td>
                                                    <td>" . $row["appointment_number"] . "</td>
                                                    <td>" . $row["patient_first_name"] . " " . $row["patient_last_name"] . "</td>
                                                    <td>" . $row["doctor_name"] . "</td>
                                                    <td>" . $row["doctor_schedule_date"] . "</td>
                                                    <td>" . $row["doctor_schedule_start_time"] . "-" . $row["doctor_schedule_end_time"] . "</td>
                                                    <td>" . $row["doctor_schedule_day"] . "</td>
                                                    <td>" . $row["status"] . "</td>
        </tr>";
            }
            $output .= "</tbody>";
            echo $output;
        } else {
            echo ("<div class='alert alert-danger'>No Records Found!</div>");
        }
    }

    if ($_POST["action"] == 'schedule_search') {
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM doctor_schedule_table 
        INNER JOIN doctor_table 
        ON doctor_table.doctor_id = doctor_schedule_table.doctor_id 
        WHERE doctor_table.doctor_name LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("s", $search);
        // }
        // else{
        //     $stmt = $conn->prepare("SELECT * FROM doctor_table");
        // }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $output = "<thead>
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
    
    <tbody>";
            while ($row = $result->fetch_assoc()) {
                $output .= "
        <tr>
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
            $output .= "</tbody>";
            echo $output;
        } else {
            echo ("<div class='alert alert-danger'>No Records Found!</div>");
        }
    }

    if ($_POST["action"] == 'patient_search') {
        $search = $_POST['query'];
        $stmt = $conn->prepare("SELECT * FROM patient_table 
        WHERE patient_first_name LIKE CONCAT('%',?,'%') OR patient_last_name LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("ss", $search, $search);
        // }
        // else{
        //     $stmt = $conn->prepare("SELECT * FROM doctor_table");
        // }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $output = "<thead>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Password</th>
        <th>Gender</th>
        <th>Contact No.</th>
        <th>Action</th>
        </tr>
    </thead>
    
    <tbody>";
            while ($row = $result->fetch_assoc()) {
                $output .= "
        <tr>
        <td>" . $row["patient_first_name"] . "</td>
        <td>" . $row["patient_last_name"] . "</td>
        <td>" . $row["patient_email_address"] . "</td>
        <td>" . $row["patient_password"] . "</td>
        <td>" . $row["patient_gender"] . "</td>
        <td>" . $row["patient_phone_no"] . "</td>
        <td> <a href='admin_update_patient.php?id={$row['patient_id']}' title='Update Profile'><i class='far fa-edit'></i></a>&nbsp;&nbsp;<a href='patient_delete.php?id={$row['patient_id']}' title='Delete Profile'><i class='fas fa-trash'></i></a>
        </td>
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