<?php
// Base directory for all uploads
$base_dir = 'assets/pdfs';

// Function to handle file uploads
function handle_file_upload($file_field, $target_dir)
{
    if (!isset($_FILES[$file_field]['name']) || $_FILES[$file_field]['error'] == UPLOAD_ERR_NO_FILE) {
        header('Location: pdf_upload_form.php');
        exit;
    }

    if (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] == UPLOAD_ERR_OK) {
        $filename = basename($_FILES[$file_field]['name']);
        $tempname = $_FILES[$file_field]['tmp_name'];
        $target_file = $target_dir . '/' . $filename;

        // Create the directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($tempname, $target_file)) {
            echo "<script>alert('The file $filename has been uploaded successfully.'); window.location = 'pdf_upload_form.php';</script>";
        } else {
            echo "<script>alert('There was an error uploading the file $filename.'); window.location = 'pdf_upload_form.php';</script>";
        }
    } else {
        echo "<script>alert('There was an upload error for $file_field.'); window.location = 'pdf_upload_form.php';</script>";
    }
}

// Mapping form submit buttons to target directories
$upload_mappings = [
    'submit_ecg' => 'ecg_pdf',
    'submit_audio' => 'audio_pdf',
    'submit_eye' => 'eye_pdf',
    'submit_spiro' => 'spiro_pdf',
    'submit_x_ray' => 'xray_pdf',
    'submit_cbc_with_fsr' => 'cbc_with_fsr_pdf',
    'submit_blood_group' => 'blood_group_pdf',
    'submit_lipid_profile' => 'lipid_profile_pdf',
    'submit_ggt' => 'ggt_pdf',
    'submit_stool_rm' => 'stool_rm_pdf',
    'submit_lab_invest' => 'lab_invest_pdf',
];

// Check which submit button was clicked and handle the corresponding file upload
foreach ($upload_mappings as $submit_button => $folder) {
    if (isset($_POST[$submit_button])) {
        $target_dir = $base_dir . '/' . $folder;
        handle_file_upload(str_replace('submit_', '', $submit_button), $target_dir);
        break;
    }
}

// If no valid form submission detected
if (!array_intersect(array_keys($_POST), array_keys($upload_mappings))) {
    echo "<script>alert('No valid form submission detected.'); window.location = 'pdf_upload_form.php';</script>";
}
?>
