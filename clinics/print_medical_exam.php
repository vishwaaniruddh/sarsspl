<?php
include 'config.php';
$sql = "SELECT * FROM form_21";
$result = mysqli_query($con,$sql);

// if (mysqli_num_rows($result) > 0) {
//     echo "<table border='1'>";
//     echo "<tr><th>ID</th><th>Name</th><th>EMP ID</th><th>Age</th><th>Sex</th><th>Date of Examination</th><th>Designation</th><th>Aadhar</th><th>ESIC</th><th>Type of Examination</th><th>Last PME Date</th><th>Date of Joining</th><th>Height</th><th>Weight</th><th>Inspiration</th><th>Expiration</th><th>Built</th><th>Throat</th><th>Tongue</th><th>Teeth</th><th>Lymph Nodes</th><th>Additional Findings</th><th>Pulse</th><th>BP</th><th>Cardio Findings</th><th>Resp Findings</th><th>Liver</th><th>Spleen</th><th>Abdominal Lumps</th><th>Eye External Exam</th><th>Eye Findings</th><th>Distant Vision Right</th><th>Distant Vision Left</th><th>Near Vision Right</th><th>Near Vision Left</th><th>Night Blindness</th><th>Ear Nose Throat</th><th>Genito Urinary</th><th>Additional Remarks</th><th>Investigations</th></tr>";

//     while($row = mysqli_fetch_assoc($result)) {
//         echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["emp_id"] . "</td><td>" . $row["age"] . "</td><td>" . $row["sex"] . "</td><td>" . $row["date_of_examination"] . "</td><td>" . $row["designation"] . "</td><td>" . $row["aadhar"] . "</td><td>" . $row["esic"] . "</td><td>" . $row["type_of_examination"] . "</td><td>" . $row["last_pme_date"] . "</td><td>" . $row["date_of_joining"] . "</td><td>" . $row["height"] . "</td><td>" . $row["weight"] . "</td><td>" . $row["inspiration"] . "</td><td>" . $row["expiration"] . "</td><td>" . $row["built"] . "</td><td>" . $row["throat"] . "</td><td>" . $row["tongue"] . "</td><td>" . $row["teeth"] . "</td><td>" . $row["lymph_nodes"] . "</td><td>" . $row["additional_findings"] . "</td><td>" . $row["pulse"] . "</td><td>" . $row["bp"] . "</td><td>" . $row["cardio_findings"] . "</td><td>" . $row["resp_findings"] . "</td><td>" . $row["liver"] . "</td><td>" . $row["spleen"] . "</td><td>" . $row["abdominal_lumps"] . "</td><td>" . $row["eye_external_exam"] . "</td><td>" . $row["eye_findings"] . "</td><td>" . $row["distant_vision_right"] . "</td><td>" . $row["distant_vision_left"] . "</td><td>" . $row["near_vision_right"] . "</td><td>" . $row["near_vision_left"] . "</td><td>" . $row["night_blindness"] . "</td><td>" . $row["ear_nose_throat"] . "</td><td>" . $row["genito_urinary"] . "</td><td>" . $row["additional_remarks"] . "</td><td>" . $row["investigations"] . "</td></tr>";
//     }
    
//     echo "</table>";
// } else {
//     echo "0 results";
// }

echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>EMP ID</th><th>Age</th><th>Sex</th><th>Date of Examination</th><th>Designation</th><th>Aadhar</th><th>ESIC</th><th>Type of Examination</th><th>Last PME Date</th><th>Date of Joining</th><th>Height</th><th>Weight</th><th>Inspiration</th><th>Expiration</th><th>Built</th><th>Throat</th><th>Tongue</th><th>Teeth</th><th>Lymph Nodes</th><th>Additional Findings</th><th>Pulse</th><th>BP</th><th>Cardio Findings</th><th>Resp Findings</th><th>Liver</th><th>Spleen</th><th>Abdominal Lumps</th><th>Eye External Exam</th><th>Eye Findings</th><th>Distant Vision Right</th><th>Distant Vision Left</th><th>Near Vision Right</th><th>Near Vision Left</th><th>Night Blindness</th><th>Ear Nose Throat</th><th>Genito Urinary</th><th>Additional Remarks</th><th>Investigations</th></tr>";

    // while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["emp_id"] . "</td><td>" . $row["age"] . "</td><td>" . $row["sex"] . "</td><td>" . $row["date_of_examination"] . "</td><td>" . $row["designation"] . "</td><td>" . $row["aadhar"] . "</td><td>" . $row["esic"] . "</td><td>" . $row["type_of_examination"] . "</td><td>" . $row["last_pme_date"] . "</td><td>" . $row["date_of_joining"] . "</td><td>" . $row["height"] . "</td><td>" . $row["weight"] . "</td><td>" . $row["inspiration"] . "</td><td>" . $row["expiration"] . "</td><td>" . $row["built"] . "</td><td>" . $row["throat"] . "</td><td>" . $row["tongue"] . "</td><td>" . $row["teeth"] . "</td><td>" . $row["lymph_nodes"] . "</td><td>" . $row["additional_findings"] . "</td><td>" . $row["pulse"] . "</td><td>" . $row["bp"] . "</td><td>" . $row["cardio_findings"] . "</td><td>" . $row["resp_findings"] . "</td><td>" . $row["liver"] . "</td><td>" . $row["spleen"] . "</td><td>" . $row["abdominal_lumps"] . "</td><td>" . $row["eye_external_exam"] . "</td><td>" . $row["eye_findings"] . "</td><td>" . $row["distant_vision_right"] . "</td><td>" . $row["distant_vision_left"] . "</td><td>" . $row["near_vision_right"] . "</td><td>" . $row["near_vision_left"] . "</td><td>" . $row["night_blindness"] . "</td><td>" . $row["ear_nose_throat"] . "</td><td>" . $row["genito_urinary"] . "</td><td>" . $row["additional_remarks"] . "</td><td>" . $row["investigations"] . "</td></tr>";
    // }
    
    echo "</table>";


?>