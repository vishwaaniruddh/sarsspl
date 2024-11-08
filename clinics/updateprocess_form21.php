<?php
// session_start();
include 'config.php';

$sess_userid = $_SESSION["SESS_MEMBER_ID"];
$sess_username = $_SESSION["SESS_USER_NAME"];

// var_dump($sess_username);
// die;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize_input($data) {
        global $con;
        return mysqli_real_escape_string($con, htmlspecialchars(trim($data)));
    }

    $idd = $_POST['idd'];
    $surgeon_name = sanitize_input($_POST['certifying_person_name']);
    $name = sanitize_input($_POST['name']);
    $age = sanitize_input($_POST['age']);
    $gender = sanitize_input($_POST['gender']);
    $designation = sanitize_input($_POST['designation']);
    $aadhar_no = sanitize_input($_POST['aadhar_no']);
    $esic = sanitize_input($_POST['esic']);
    $exam_type = sanitize_input($_POST['exam_type']);
    $last_pme_peme_date = sanitize_input($_POST['last_pme_peme_date']);
    $exam_date = sanitize_input($_POST['exam_date']);
    $join_date = sanitize_input($_POST['join_date']);
    $dept = sanitize_input($_POST['dept']);
    $empid = sanitize_input($_POST['empid']);

    $pulse = sanitize_input($_POST['pulse']);
    $bp = sanitize_input($_POST['bp']);
    
    $height = sanitize_input($_POST['height']);
    $weight = sanitize_input($_POST['weight']);
    $bmi = sanitize_input($_POST['bmi']);

    $distant_vision_without_left = sanitize_input($_POST['distant_vision_without_left']);
    $distant_vision_without_right = sanitize_input($_POST['distant_vision_without_right']);
    $distant_vision_with_left = sanitize_input($_POST['distant_vision_with_left']);
    $distant_vision_with_right = sanitize_input($_POST['distant_vision_with_right']);

    $near_vision_without_left = sanitize_input($_POST['near_vision_without_left']);
    $near_vision_without_right = sanitize_input($_POST['near_vision_without_right']);
    $near_vision_with_left = sanitize_input($_POST['near_vision_with_left']);
    $near_vision_with_right = sanitize_input($_POST['near_vision_with_right']);

    $menstrual_history = sanitize_input($_POST['menstrual_history']);
    $obstetric_history = sanitize_input($_POST['obstetric_history']);
    $menarche = sanitize_input($_POST['menarche']);
    $menstrual_irreg = sanitize_input($_POST['menstrual_irregularity']);
    $gravida = sanitize_input($_POST['gravida']);
    $para = sanitize_input($_POST['para']);
    $lmp = sanitize_input($_POST['lmp']);
    $widal = sanitize_input($_POST['widal']);
    $hep_b = sanitize_input($_POST['hep_b']);
    $sputum = sanitize_input($_POST['sputum_for_afb']);
    $skin_diseases = sanitize_input($_POST['skin_diseases']);
    $hiv = sanitize_input($_POST['hiv']);
    $worm_infection = sanitize_input($_POST['worm_infection']);

    $usg_whole_abdomen = sanitize_input($_POST['usg_whole_abdomen']);
    $ecg = sanitize_input($_POST['ecg']);
    
    $pta_lt = sanitize_input($_POST['pta_lt']);
    $pta_rc = sanitize_input($_POST['pta_rc']);

    $predicted_fvc = sanitize_input($_POST['predicted_fvc']);
    $predicted_fevi = sanitize_input($_POST['predicted_fevi']);
    $predicted_fvc_fevi = sanitize_input($_POST['predicted_fvc_fevi']);
    $measured_fvc = sanitize_input($_POST['measured_fvc']);
    $measured_fevi = sanitize_input($_POST['measured_fevi']);
    $measured_fvc_fevi = sanitize_input($_POST['measured_fvc_fevi']);
    $percent_fvc = sanitize_input($_POST['percent_fvc']);
    $percent_fevi = sanitize_input($_POST['percent_fevi']);
    $percent_fvc_fevi = sanitize_input($_POST['percent_fvc_fevi']);
    
    $hb = sanitize_input($_POST['hb']);
        $tlc = sanitize_input($_POST['tlc']);
        $rbc = sanitize_input($_POST['rbc']);
        $neutrophils = sanitize_input($_POST['neutrophils']);
        $eosinophils = sanitize_input($_POST['eosinophils']);
        $basophils = sanitize_input($_POST['basophils']);
        $lymphocytes = sanitize_input($_POST['lymphocytes']);
        $monocytes = sanitize_input($_POST['monocytes']);
        $flatelets_count = sanitize_input($_POST['flatelets_count']);
        $serum_cholesterol = sanitize_input($_POST['serum_cholesterol']);
        $triglycerides = sanitize_input($_POST['triglycerides']);
        $hdl = sanitize_input($_POST['hdl']);
        $ldl = sanitize_input($_POST['ldl']);
        $sgpt = sanitize_input($_POST['sgpt']);
        $sgot = sanitize_input($_POST['sgot']);
        $alkaline_phosphate = sanitize_input($_POST['alkaline_phosphate']);
        $blood_urea = sanitize_input($_POST['blood_urea']);
        $creatinine = sanitize_input($_POST['creatinine']);
        
         $miscroscopy_pus = sanitize_input($_POST['miscroscopy_pus']);
         $uric_acid = sanitize_input($_POST['uric_acid']);
         $blood_sugar_fasting = sanitize_input($_POST['blood_sugar_fasting']);
        $blood_sugar_pp = sanitize_input($_POST['blood_sugar_pp']);

    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
    
    mysqli_autocommit($con, false);
    $rollback = false;

    $sql = "UPDATE report SET 
            `hb`='$hb',
            `tlc`='$tlc',
            `rbc`='$rbc',
            `neutrophils`='$neutrophils',
            `eosinophils`='$eosinophils',
            `basophils`='$basophils',
            `lymphocytes`='$lymphocytes',
            `monocytes`='$monocytes',
            `patelets_count`='$flatelets_count',
            `serum_cholesterol`='$serum_cholesterol',
            `striglycerides`='$triglycerides',
            `hdl`='$hdl',
            `ldl`='$hdl',
            `sgpt`='$sgpt',
            `sgot`='$sgot',
            `alkaline_phosphatase`='$alkaline_phosphate',
            `blood_urea`='$blood_urea',
            `creatinine`='$creatinine',
            `pus_cells`='$miscroscopy_pus',
            `uric_acid` = '$uric_acid',
            `blood_sugar_f` = '$blood_sugar_fasting',
            `blood_sugar_pp`='$blood_sugar_pp',
            
            `height`='$height',
            `weight`='$weight',
            `bmi` = '$bmi',
            `name`='$name',
            `age`='$age',
            `sex`='$gender',
            `pulse`='$pulse', 
            `bp`='$bp',
            `distant_vision_without_right`='$distant_vision_without_right',
            `distant_vision_without_left`='$distant_vision_without_left',
            `distant_vision_with_right`='$distant_vision_with_right',
            `distant_vision_with_left`='$distant_vision_with_left',
            `near_vision_without_right`='$near_vision_without_right',
            `near_vision_without_left`='$near_vision_without_left',
            `near_vision_with_right`='$near_vision_with_right',
            `near_vision_with_left`='$near_vision_with_left',
            `audio_pta_l`='$pta_lt',
            `audio_pta_r`='$pta_rc',
            `ecg`='$ecg',
            `predicted_fvc`='$predicted_fvc',
            `predicted_fev`='$predicted_fevi',
            `predicted_fvc_fev`='$predicted_fvc_fevi',
            `measured_fvc`='$measured_fvc',
            `measured_fev`='$measured_fevi',
            `measured_fvc_fev`='$measured_fvc_fevi',
            `predicted_perc_fvc`='$percent_fvc',
            `predicted_perc_fev`='$percent_fevi',
            `predicted_perc_fvc_fev`='$percent_fvc_fevi' 
            WHERE id='$idd'";
    
    $form_21_sql = mysqli_query($con, $sql);

    if ($form_21_sql) {
        $last_insert_id = $idd;
        
        $checkform21data = mysqli_query($con,"select * from form21_data where reports_id = '$last_insert_id' ");
        $numRows = mysqli_num_rows($checkform21data);
        
        // echo $numRows; die;
        
        if($numRows >0){
            $sql_general_exam = "UPDATE `form21_data` SET 
                    `surgeon_name` = '$surgeon_name', 
                    `empid` = '$empid', 
                    `exam_date` = '$exam_date', 
                    `designation` = '$designation', 
                    `aadhar` = '$aadhar_no', 
                    `esic` = '$esic', 
                    `exam_type` = '$exam_type', 
                    `last_pme_pmce_date` = '$last_pme_peme_date', 
                    `join_date` = '$join_date', 
                    `department` = '$dept', 
                    `menstrual_history` = '$menstrual_history', 
                    `menarch_at` = '$menarche', 
                    `obsteric_history` = '$obstetric_history', 
                    `para` = '$para', 
                    `menstual_irreg` = '$menstrual_irreg', 
                    `lmp` = '$lmp', 
                    `gravida` = '$gravida', 
                    `widal` = '$widal', 
                    `hepb` = '$hep_b', 
                    `sputum` = '$sputum', 
                    `skin_disease` = '$skin_diseases', 
                    `hiv` = '$hiv', 
                    `worm-infection` = '$worm_infection', 
                    `usg` = '$usg_whole_abdomen', 
                    `updated_at` = '$updated_at' 
                    WHERE `reports_id` = '$last_insert_id'";

        } else {
            $sql_general_exam = "INSERT INTO `form21_data` (
                    `reports_id`, 
                    `surgeon_name`, 
                    `empid`, 
                    `exam_date`, 
                    `designation`, 
                    `aadhar`, 
                    `esic`, 
                    `exam_type`, 
                    `last_pme_pmce_date`, 
                    `join_date`, 
                    `department`, 
                    `menstrual_history`, 
                    `menarch_at`, 
                    `obsteric_history`, 
                    `para`, 
                    `menstual_irreg`, 
                    `lmp`, 
                    `gravida`, 
                    `widal`, 
                    `hepb`, 
                    `sputum`, 
                    `skin_disease`, 
                    `hiv`, 
                    `worm-infection`, 
                    `usg`, 
                    `created_at`, 
                    `updated_at`
                ) 
                VALUES (
                    '$last_insert_id', 
                    '$surgeon_name', 
                    '$empid', 
                    '$exam_date', 
                    '$designation', 
                    '$aadhar_no', 
                    '$esic', 
                    '$exam_type', 
                    '$last_pme_peme_date', 
                    '$join_date', 
                    '$dept', 
                    '$menstrual_history', 
                    '$menarche', 
                    '$obstetric_history', 
                    '$para', 
                    '$menstrual_irreg', 
                    '$lmp', 
                    '$gravida', 
                    '$widal', 
                    '$hep_b', 
                    '$sputum', 
                    '$skin_diseases', 
                    '$hiv', 
                    '$worm_infection', 
                    '$usg_whole_abdomen', 
                    '$created_at', 
                    '$updated_at'
                )";

        }
        
        
        

        // $sql_general_exam = "INSERT INTO `form21_data`
        // (`reports_id`, `surgeon_name`, `empid`, `exam_date`, `designation`, `aadhar`, `esic`, `exam_type`, `last_pme_pmce_date`, `join_date`, `department`, `menstrual_history`, `menarch_at`, `obsteric_history`, `para`, `menstual_irreg`, `lmp`, `gravida`, `widal`, `hepb`, `sputum`, `skin_disease`, `hiv`, `worm-infection`, `usg`, `created_at`, `updated_at`) 
        // VALUES 
        // ('$last_insert_id', '$surgeon_name', '$empid', '$exam_date', '$designation', '$aadhar_no', '$esic', '$exam_type', '$last_pme_peme_date', '$join_date', '$dept', '$menstrual_history', '$menarche', '$obstetric_history', '$para', '$menstrual_irreg', '$lmp', '$gravida', '$widal', '$hep_b', '$sputum', '$skin_diseases', '$hiv', '$worm_infection', '$usg_whole_abdomen', '$created_at', '$updated_at')";

        $general_exam_sql = mysqli_query($con, $sql_general_exam);
        if (!$general_exam_sql) {
           
            echo "Error in INsert/Update: " . mysqli_error($con);
            $rollback = true;
        }

        if ($rollback) {
            mysqli_rollback($con);
        } else {
             mysqli_query($con,"insert into audit_log(report_id,patient_name,created_at,updated_by) values ('$idd','$name','$created_at','$sess_username') ");
            mysqli_commit($con);
            header("Location: updatedbillprint21.php?id=$last_insert_id");
            exit(); // Ensure that no further code runs after header redirect
        }
    } else {
        echo "Error in form_21 insert: " . mysqli_error($con);
        mysqli_rollback($con);
    }

    mysqli_close($con);
}
?>
