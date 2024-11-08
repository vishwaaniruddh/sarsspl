<?php
include 'config.php';

// var_dump($_POST);
// die;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitize_input($data)
    {
        global $con; // Access the database connection inside the function
        return mysqli_real_escape_string($con, htmlspecialchars(trim($data)));
    }

    // Sanitize and validate the input data

    // General information
    $certifying_person_name = sanitize_input($_POST['certifying_person_name']);
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

    $created_at = date("Y-m-d H:i:s");
    // Start transaction
    mysqli_autocommit($con, false);
    $rollback = false;

    // Insert general information into form_21 table
    $sql = "INSERT INTO form_21(certifying_person_name, name, age, gender, designation, aadhar_no, esic, exam_type, last_pme_peme_date, exam_date, join_date, dept, created_at, emp_id ) VALUES ('$certifying_person_name', '$name', '$age', '$gender', '$designation', '$aadhar_no', '$esic', '$exam_type', '$last_pme_peme_date', '$exam_date', '$join_date', '$dept', '$created_at','$empid' )";
    // echo $sql.'<br><br>';

    $form_21_sql = mysqli_query($con, $sql);



    if ($form_21_sql) {
        $last_insert_id = mysqli_insert_id($con); // Get the last inserted ID
        //  echo  $last_insert_id."inserted";

        // Now insert data into respective tables based on sections

        // General Examination
        $height = sanitize_input($_POST['height']);
        $weight = sanitize_input($_POST['weight']);
        $inspiration = sanitize_input($_POST['inspiration']);
        $expiration = sanitize_input($_POST['expiration']);
        $built = sanitize_input($_POST['built']);
        $bmi = sanitize_input($_POST['bmi']);
        $throat = sanitize_input($_POST['throat']);
        $tongue = sanitize_input($_POST['tongue']);
        $tonsils = sanitize_input($_POST['tonsils']);
        $gums = sanitize_input($_POST['gums']);
        $teeth = sanitize_input($_POST['teeth']);
        $lymph_nodes = sanitize_input($_POST['lymph_nodes']);
        $additional_findings = sanitize_input($_POST['additional_findings']);

        $sql_general_exam = "INSERT INTO form_21_general_examination(id, height, weight, inspiration, expiration, built, bmi, throat, tongue, tonsils, gums, teeth, lymph_nodes, additional_findings, created_at ) VALUES ('$last_insert_id', '$height', '$weight', '$inspiration', '$expiration', '$built', '$bmi', '$throat', '$tongue', '$tonsils', '$gums', '$teeth', '$lymph_nodes', '$additional_findings', '$created_at' )";
        // mysqli_query($con, $sql_general_exam);
        
        // echo $sql_general_exam.'<br><br>';
        
        $general_exam_sql = mysqli_query($con, $sql_general_exam);
        if (!$general_exam_sql) {
            echo "Error in general exam insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Cardio-Vascular System
        $pulse = sanitize_input($_POST['pulse']);
        $pulse_type = sanitize_input($_POST['pulse_type']);
        $pher_pulse = sanitize_input($_POST['pher_pulse']);
        $bp = sanitize_input($_POST['bp']);
        $heart_rate = sanitize_input($_POST['heart_rate']);
        $murmur = sanitize_input($_POST['murmur']);
        $additional_findings_1 = sanitize_input($_POST['additional_findings_1']);

        $sql_cardiovascular = "INSERT INTO cardiovascular_system(id, pulse, pulse_type, pher_pulse, bp, heart_rate, murmur, additional_findings_1, created_at ) VALUES ('$last_insert_id', '$pulse', '$pulse_type', '$pher_pulse', '$bp', '$heart_rate', '$murmur', '$additional_findings_1', '$created_at' )";
        // echo $sql_cardiovascular.'<br><br>';
        
        // mysqli_query($con, $sql_cardiovascular);
        $cardiovascular_sql = mysqli_query($con, $sql_cardiovascular);
        if (!$cardiovascular_sql) {
            echo "Error in cardiovascular insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Respiratory System
        $chest_shape = sanitize_input($_POST['chest_shape']);
        $chest_movement = sanitize_input($_POST['chest_movement']);
        $trachea = sanitize_input($_POST['trachea']);
        $breath_sound = sanitize_input($_POST['breath_sound']);

        $sql_respiratory = "INSERT INTO respiratory_system(id, chest_shape, chest_movement, trachea, breath_sound, created_at ) VALUES ('$last_insert_id', '$chest_shape', '$chest_movement', '$trachea', '$breath_sound', '$created_at' )";
        $respiratory_sql = mysqli_query($con, $sql_respiratory);
        
        // echo $sql_respiratory.'<br><br>';
        
        if (!$respiratory_sql) {
            echo "Error in respiratory insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Gastro-Intestinal System
        $liver = sanitize_input($_POST['liver']);
        $spleen = sanitize_input($_POST['spleen']);
        $abdominal_lumps = sanitize_input($_POST['abdominal_lumps']);

        $sql_gastrointestinal = "INSERT INTO gastrointestinal_system (id, liver, spleen, abdominal_lumps, created_at ) VALUES ('$last_insert_id', '$liver', '$spleen', '$abdominal_lumps', '$created_at' )";
        $gastrointestinal_sql = mysqli_query($con, $sql_gastrointestinal);
        
        // echo $sql_gastrointestinal.'<br><br>';
        
        if (!$gastrointestinal_sql) {
            echo "Error in gastrointestinal insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Examination of Eyes
        $ext_exam = sanitize_input($_POST['ext_exam']);
        $squint = sanitize_input($_POST['squint']);
        $nystagmus = sanitize_input($_POST['nystagmus']);
        $color_vision = sanitize_input($_POST['color_vision']);
        $fundus = sanitize_input($_POST['fundus']);
        $distant_vision_without_left = sanitize_input($_POST['distant_vision_without_left']);
        $distant_vision_without_right = sanitize_input($_POST['distant_vision_without_right']);
        $distant_vision_with_left = sanitize_input($_POST['distant_vision_with_left']);
        $distant_vision_with_right = sanitize_input($_POST['distant_vision_with_right']);
        $color_identify = sanitize_input($_POST['color_identify']);
        $night_blindness = sanitize_input($_POST['night_blindness']);
        $near_vision_without_left = sanitize_input($_POST['near_vision_without_left']);
        $near_vision_without_right = sanitize_input($_POST['near_vision_without_right']);
        $near_vision_with_left = sanitize_input($_POST['near_vision_with_left']);
        $near_vision_with_right = sanitize_input($_POST['near_vision_with_right']);

        $sql_eyes = "INSERT INTO examination_of_eyes (id, ext_exam, squint, nystagmus, color_vision, fundus, distant_vision_without_left, distant_vision_without_right, distant_vision_with_left, distant_vision_with_right, color_identify, night_blindness, near_vision_without_left, near_vision_without_right, near_vision_with_left, near_vision_with_right, created_at ) VALUES ('$last_insert_id', '$ext_exam', '$squint', '$nystagmus', '$color_vision', '$fundus', '$distant_vision_without_left', '$distant_vision_without_right', '$distant_vision_with_left', '$distant_vision_with_right', '$color_identify', '$night_blindness', '$near_vision_without_left', '$near_vision_without_right', '$near_vision_with_left', '$near_vision_with_right', '$created_at' )";
        $eyes_sql = mysqli_query($con, $sql_eyes);
        
        // echo $sql_eyes.'<br><br>';
        
        if (!$eyes_sql) {
            echo "Error in eyes insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Examination of Ear, Nose and Throat
        $ext_exam_ear_nose_throat = sanitize_input($_POST['ext_exam_ear_nose_throat']);

        $sql_ear_nose_throat = "INSERT INTO ent_examination (id, ext_exam_ear_nose_throat, created_at ) VALUES ('$last_insert_id', '$ext_exam_ear_nose_throat', '$created_at' )";
        $ear_nose_throat_sql = mysqli_query($con, $sql_ear_nose_throat);
        
        // echo $sql_ear_nose_throat.'<br><br>';

        if (!$ear_nose_throat_sql) {
            echo "Error in ear_nose_throat insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Genito Urinary System
        $cryptorchidism = sanitize_input($_POST['cryptorchidism']);
        $phimosis = sanitize_input($_POST['phimosis']);
        $hernia = sanitize_input($_POST['hernia']);
        $hydro_vario = sanitize_input($_POST['hydro_vario']);
        $vario_veins = sanitize_input($_POST['vario_veins']);
        $std = sanitize_input($_POST['std']);
        $menstrual_history = sanitize_input($_POST['menstrual_history']);
        $obstetric_history = sanitize_input($_POST['obstetric_history']);
        $menarche = sanitize_input($_POST['menarche']);
        $menstrual_irrregularity = sanitize_input($_POST['menstrual_irregularity']);
        $gravida = sanitize_input($_POST['gravida']);
        $para = sanitize_input($_POST['para']);
        $lmp = sanitize_input($_POST['lmp']);
        $widal = sanitize_input($_POST['widal']);
        $hep_b = sanitize_input($_POST['hep_b']);
        $sputum_for_afb = sanitize_input($_POST['sputum_for_afb']);
        $skin_diseases = sanitize_input($_POST['skin_diseases']);
        $htv = sanitize_input($_POST['htv']);
        $worm_infection = sanitize_input($_POST['worm_infection']);

        $sql_genito_urinary = "INSERT INTO genitourinary_system(id, cryptorchidism, phimosis, hernia, hydro_vario, vario_veins, std, menstrual_history, obstetric_history, menarche, menstrual_irregularity, gravida, para, lmp, widal, hep_b, sputum_for_afb, skin_diseases, htv, worm_infection, created_at ) VALUES ('$last_insert_id', '$cryptorchidism', '$phimosis', '$hernia', '$hydro_vario', '$vario_veins', '$std', '$menstrual_history', '$obstetric_history', '$menarche', '$menstrual_irrregularity', '$gravida', '$para', '$lmp', '$widal', '$hep_b', '$sputum_for_afb', '$skin_diseases', '$htv', '$worm_infection', '$created_at' )";

        // echo $sql_genito_urinary.'<br><br>';
        
        $genito_urinary_sql = mysqli_query($con, $sql_genito_urinary);
        if (!$genito_urinary_sql) {
            echo "Error in genito_urinary insert: " . mysqli_error($con);
            $rollback = true;
        }


        // Lab Investigations
        $albumin = sanitize_input($_POST['albumin']);
        $sugar = sanitize_input($_POST['sugar']);
        $miscroscopy_pus = sanitize_input($_POST['miscroscopy_pus']);
        $epith_cells = sanitize_input($_POST['epith_cells']);
        $stools = sanitize_input($_POST['stools']);
        $blood_grp = sanitize_input($_POST['blood_grp']);
        $rh_factor = sanitize_input($_POST['rh_factor']);
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
        $blood_sugar_fasting = sanitize_input($_POST['blood_sugar_fasting']);
        $blood_sugar_pp = sanitize_input($_POST['blood_sugar_pp']);
        $uric_acid = sanitize_input($_POST['uric_acid']);

        $sql_lab_investigations = "INSERT INTO lab_investigations(id, albumin, sugar, miscroscopy_pus, epith_cells, stools, blood_grp, rh_factor, hb, tlc, rbc, neutrophils, eosinophils, basophils, lymphocytes, monocytes, flatelets_count, serum_cholesterol, triglycerides, hdl, ldl, sgpt, sgot, alkaline_phosphate, blood_urea, creatinine, blood_sugar_fasting, blood_sugar_pp, uric_acid, created_at ) VALUES ('$last_insert_id', '$albumin', '$sugar', '$miscroscopy_pus', '$epith_cells', '$stools', '$blood_grp', '$rh_factor', '$hb', '$tlc', '$rbc', '$neutrophils', '$eosinophils', '$basophils', '$lymphocytes', '$monocytes', '$flatelets_count', '$serum_cholesterol', '$triglycerides', '$hdl', '$ldl', '$sgpt', '$sgot', '$alkaline_phosphate', '$blood_urea', '$creatinine', '$blood_sugar_fasting', '$blood_sugar_pp', '$uric_acid', '$created_at' )";
        $lab_investigations_sql = mysqli_query($con, $sql_lab_investigations);

// echo $sql_lab_investigations.'<br><br>';

        if (!$lab_investigations_sql) {
            echo "Error in lab_investigations insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Other Investigations
        $xray_chest = sanitize_input($_POST['xray_chest']);
        $ecg = sanitize_input($_POST['ecg']);
        $usg_whole_abdomen = sanitize_input($_POST['usg_whole_abdomen']);

        $sql_other_investigations = "INSERT INTO other_investigations(id, xray_chest, ecg, usg_whole_abdomen, created_at ) VALUES ('$last_insert_id', '$xray_chest', '$ecg', '$usg_whole_abdomen', '$created_at' )";
        $other_investigations_sql = mysqli_query($con, $sql_other_investigations);
        
        // echo $sql_other_investigations.'<br><br>';

        // Pulmonary Function Test
        $predicted_fvc = sanitize_input($_POST['predicted_fvc']);
        $predicted_fevi = sanitize_input($_POST['predicted_fevi']);
        $predicted_fvc_fevi = sanitize_input($_POST['predicted_fvc_fevi']);
        $measured_fvc = sanitize_input($_POST['measured_fvc']);
        $measured_fevi = sanitize_input($_POST['measured_fevi']);
        $measured_fvc_fevi = sanitize_input($_POST['measured_fvc_fevi']);
        $percent_fvc = sanitize_input($_POST['percent_fvc']);
        $percent_fevi = sanitize_input($_POST['percent_fevi']);
        $percent_fvc_fevi = sanitize_input($_POST['percent_fvc_fevi']);

        $sql_pulmonary_function = "INSERT INTO pulmonary_function_test(id, predicted_fvc, predicted_fevi, predicted_fvc_fevi, measured_fvc, measured_fevi, measured_fvc_fevi, percent_fvc, percent_fevi, percent_fvc_fevi,created_at) 
        values ('$last_insert_id','$predicted_fvc','$predicted_fevi','$predicted_fvc_fevi','$measured_fvc','$measured_fevi','$measured_fvc_fevi','$percent_fvc','$percent_fevi','$percent_fvc_fevi', '$created_at' )";
        $pulmonary_function_sql = mysqli_query($con, $sql_pulmonary_function);
        
        // echo $sql_pulmonary_function.'<br><br>';

        if (!$pulmonary_function_sql) {
            echo "Error in pulmonary_function insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Audiometry 

        $sql_audiometry = "INSERT INTO audiometry (id, pta_lt, pta_rc, created_at ) VALUES ('$last_inserted_id', '$pta_lt', '$pta_rc', '$created_at' );";
        $audiometry_sql = mysqli_query($con, $sql_audiometry);
        
        // echo $sql_audiometry.'<br><br>';

        if (!$audiometry_sql) {
            echo "Error in audiometry insert: " . mysqli_error($con);
            $rollback = true;
        }

        // Check all query results
        // if ($general_exam_sql === FALSE || $audiometry_sql === FALSE) {
        //     $rollback = true;
        // }
        
        //  if (!$rollback) {
        //      echo "completed";
        //  }

        // If no errors, commit transaction
        // Finalizing transaction
        if ($rollback) {
            echo "Rolling back transaction.<br>";
            mysqli_rollback($con);
            // $message = "Error in transaction. All changes were rolled back.";
        } else {
            // echo "Committing transaction.<br>";
            mysqli_commit($con);
            echo "Record saved successfully!";
            header("Location: printform21.php?id=$last_insert_id");
        }
    } else {
        echo "Error in form_21 insert: " . mysqli_error($con);
        mysqli_rollback($con);
        $message = "Error in initial insertion. All changes were rolled back.";
    }

    mysqli_close($con);

}

?>