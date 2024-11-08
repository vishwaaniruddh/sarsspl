<?php
include "../config.php";

$certificate_no = $_POST['certificate_no'];
$date = $_POST['date'];
$name = $_POST['name'];
$relative_name = $_POST['relative_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$employee_no = $_POST['employee_no'];
// $photo = $_POST['passport_photo'] ;
$passport_photo = $_FILES['passport_photo']['name'];
$identification_mark = $_POST['identification_mark'];
$remark = $_POST['remark'];

//  A. General Examination
$pulse = $_POST['pulse'];
$bp = $_POST['bp'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$pallor = $_POST['pallor'];
$edema = $_POST['edema'];
$hb = $_POST['hb'];
$blood_grouping_factor = $_POST['blood_grouping_factor'];
$blood_sugar = $_POST['blood_sugar'];
$sickling = $_POST['sickling'];
$ge_other1 = $_POST['ge_other1'];
$urina_rm = $_POST['urina_rm'];
$xray_chest = $_POST['xray_chest'];
$ecg = $_POST['ecg'];
$ge_other2 = $_POST['ge_other2'];
//  B. Systemic Examination
$eye = $_POST['eye'];
$vision = $_POST['vision'];
$colour_vision = $_POST['colour_vision'];
$se_other1 = $_POST['se_other1'];
$ent = $_POST['ent'];
$hearing = $_POST['hearing'];
$se_other2 = $_POST['se_other2'];
$orthopedic = $_POST['orthopedic'];
$gait = $_POST['gait'];
$abnormality = $_POST['abnormality'];
$medical = $_POST['medical'];
$gynae = $_POST['gynae'];
$surgical = $_POST['surgical'];
$dental = $_POST['dental'];
$se_other3 = $_POST['se_other3'];

$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');

// crete folder for saving uploaded image
$target_dir = './assets/image_server';

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$filename = $_FILES["passport_photo"]["name"];
$tempname = $_FILES["passport_photo"]["tmp_name"];
$folder =  $target_dir . '/' . $filename;

if (move_uploaded_file($tempname, $folder)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}


$sql =  "INSERT INTO emp_cert_details(cert_date,name,relative_name,age,gender,address,emp_id,image,sign,identification_mark,remark,medical_officer_sign,created_at,updated_at) VALUES 
('" . $date . "','" . $name . "','" . $relative_name . "','" . $age . "','" . $gender . "','" . $address . "','" . $employee_no . "','" . $folder . "','','" . $identification_mark . "','" . $remark . "','','" . $created_at . "','" . $updated_at . "')  ";

$sql_qry = mysqli_query($con, $sql);

if ($sql_qry) {
    $last_id = mysqli_insert_id($con);

    $ge_sql =  "INSERT INTO general_examination(cert_id,pulse,bp,height,weight,pallor,edema,hb,blood_grouping_rh_factor,blood_sugar,sickling,other_1,urina_rm,xray_chest,ecg,other_2,created_at,updated_at) VALUES 
    ('" . $last_id . "','" . $pulse . "','" . $bp . "','" . $height . "','" . $weight . "','" . $pallor . "','" . $edema . "','" . $blood_grouping_factor . "','" . $hb . "','" . $blood_sugar . "','" . $sickling . "','" . $ge_other1 . "','" . $urina_rm . "','" . $xray_chest . "','" . $ecg . "','" . $ge_other2 . "','" . $created_at . "','" . $updated_at . "')  ";
    $ge_sql_qry = mysqli_query($con, $ge_sql);

    $se_sql =  "INSERT INTO systemic_examination(cert_id,eye,vision,colour_vision,other_1,ent,hearing,other_2,orthopedic,gait,abnormality,medical,gynae,surgical,dental,other_3,created_at,updated_at) VALUES 
    ('" . $last_id . "','" . $eye . "','" . $vision . "','" . $colour_vision . "','" . $se_other1 . "','" . $ent . "','" . $hearing . "','" . $se_other2 . "','" . $orthopedic . "','" . $gait . "','" . $abnormality . "','" . $medical . "','" . $gyne . "','" . $surgical . "','" . $dental . "','" . $se_other3 . "','" . $created_at . "','" . $updated_at . "')  ";
    $se_sql_qry = mysqli_query($con, $se_sql);

    echo '<script>alert("Data Inserted")</script>';
    header("location: medical_fitness_certificate.php?id=" . $last_id);
} else { ?>
    <script>
        alert("Something Went Wrong");
        history.back();
    </script>

<?php } ?>