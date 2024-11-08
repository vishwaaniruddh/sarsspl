<?php
// $file = $_FILES['x_ray']['name'] ;
// echo "<pre>";
// print_r($file);
// echo "</pre>"; 

$target_dir = 'assets/pdfs';

// Create the directory if it doesn't exist
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

function handle_file_upload($file_field, $target_dir)
{
    if (!isset($_FILES[$file_field]['name']) || $_FILES[$file_field]['error'] == UPLOAD_ERR_NO_FILE) {
        header('Location:pdf_upload_form.php');
        exit;
    } elseif (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] == UPLOAD_ERR_OK) {
        $filename = basename($_FILES[$file_field]['name']);
        $tempname = $_FILES[$file_field]['tmp_name'];
        $target_file = $target_dir . '/' . $filename;

        if (move_uploaded_file($tempname, $target_file)) {
            echo "<script>alert('The file $filename has been uploaded successfully.'); window.location = 'pdf_upload_form.php';</script>";
        } else {
            echo "<script>alert('There was an error uploading the file $filename.'); 
            window.location = 'pdf_upload_form.php';
            </script>";
        }
    } else {
        echo "<script>alert('There was an upload error for $file_field.');
        window.location = 'pdf_upload_form.php';
        </script>";
    }
}

// Check which submit button was clicked and handle the corresponding file upload
if (isset($_POST['submit_ecg'])) {
    $target_dir = 'assets/ecg_pdf';
    handle_file_upload('ecg', $target_dir);
} elseif (isset($_POST['submit_audio'])) {
    $target_dir = 'assets/audio_pdf';
    handle_file_upload('audio', $target_dir);
   
} elseif (isset($_POST['submit_eye'])) {
    $folder_name = 'eye_pdf';
    $target_dir = $target_dir . '/' . $folder_name;
    // $target_dir = 'assets/eye_pdf';
    handle_file_upload('eye', $target_dir);
     echo "handle_file_upload('eye', $target_dir)";
} elseif (isset($_POST['submit_spiro'])) {
    $target_dir = 'assets/spiro_pdf';
    handle_file_upload('spiro', $target_dir);
} elseif (isset($_POST['submit_x_ray'])) {
    $target_dir = 'assets/xray_pdf';
    handle_file_upload('x_ray', $target_dir);
} elseif (isset($_POST['submit_cbc_with_fsr'])) {
    $target_dir = 'assets/cbc_with_fsr_pdf';
    handle_file_upload('cbc_with_fsr', $target_dir);
} elseif (isset($_POST['submit_blood_group'])) {
    $target_dir = 'assets/blood_group_pdf';
    handle_file_upload('blood_group', $target_dir);
} elseif (isset($_POST['submit_lipid_profile'])) {
    $target_dir = 'assets/lipid_profile_pdf';
    handle_file_upload('lipid_profile', $target_dir);
} elseif (isset($_POST['submit_ggt'])) {
    $target_dir = 'assets/ggt_pdf';
    handle_file_upload('ggt', $target_dir);
} elseif (isset($_POST['submit_stool_rm'])) {
    $target_dir = 'assets/stool_rm_pdf';
    handle_file_upload('stool_rm', $target_dir);
} else {
    echo "<script>alert('No valid form submission detected.');
    window.location = 'pdf_upload_form.php';</script>";
}
