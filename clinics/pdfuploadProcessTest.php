<?php
// Database connection setup
include 'config.php';

// Base directory for all uploads
$base_dir = 'assets/pdfs';

// Function to handle file uploads
function handle_file_upload($file_field, $target_dir)
{
    if (isset($_FILES[$file_field]['name']) && $_FILES[$file_field]['error'] == UPLOAD_ERR_OK) {
        $filename = basename($_FILES[$file_field]['name']);
        $tempname = $_FILES[$file_field]['tmp_name'];
        $target_file = $target_dir . '/' . $filename;

        // Create the directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($tempname, $target_file)) {
            return true;
        } else {
            echo "<script>
                alert('There was an error uploading the file $filename.');
                document.getElementById('loader').style.display = 'none';
            </script>";
            return false;
        }
    } elseif (isset($_FILES[$file_field]['name']) && $_FILES[$file_field]['error'] != UPLOAD_ERR_NO_FILE) {
        echo "<script>
            alert('There was an upload error for $file_field.');
            document.getElementById('loader').style.display = 'none';
        </script>";
        return false;
    }
    return null; // Return null if no file was uploaded
}

// Mapping file fields to target directories
$upload_mappings = [
    'ecg' => 'ecg_pdf',
    'audio' => 'audio_pdf',
    'eye' => 'eye_pdf',
    'spiro' => 'spiro_pdf',
    'x_ray' => 'xray_pdf',
    'lab_invest' => 'lab_invest_pdf',
];

// Flag to track if all files were uploaded successfully
$all_uploaded = true;

if (isset($_POST['submit_all'])) {
    foreach ($upload_mappings as $file_field => $folder) {
        $target_dir = $base_dir . '/' . $folder;
        $upload_result = handle_file_upload($file_field, $target_dir);
        if ($upload_result === false) {
            $all_uploaded = false;
        }
    }

    if ($all_uploaded) {
        // All files were successfully uploaded, insert into the report table
        $sql = "INSERT INTO pdfreport (isUpload) VALUES (1)";

        if (mysqli_query($con,$sql)) {
            echo "<script>
                alert('All files uploaded successfully, and the report status has been updated.');
                window.location = 'pdf_upload.php';
                document.getElementById('loader').style.display = 'none';
            </script>";
        } else {
            echo "<script>
                alert('Files uploaded, but there was an error updating the report status.');
                window.location = 'pdf_upload.php';
                document.getElementById('loader').style.display = 'none';
            </script>";
        }
    } else {
        echo "<script>
            alert('Some files failed to upload. Please try again.');
            window.location = 'pdf_upload.php';
            document.getElementById('loader').style.display = 'none';
        </script>";
    }
} else {
    echo "<script>
        alert('No valid form submission detected.');
        window.location = 'pdf_upload.php';
        document.getElementById('loader').style.display = 'none';
    </script>";
}

// Close the database connection
// $conn->close();
?>
