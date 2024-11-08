<?php
// $target_dir = "kyc/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $temp = explode(".", $_FILES["fileToUpload"]["name"]);
// $newfilename = round(microtime(true)).'.'.end($temp);
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         $uploadOk = 1;
//     } else {
//         $uploadOk = 0;
//     }
//     if ($uploadOk == 0) {
        
//     } else {
//         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "kyc/".$newfilename)) {
            
//         } 
//         else {
            
//         }
//     }
// }
if (0 < $_FILES['file']['error']) {
    echo '0';
}
else {
    $target_dir = "offline_doc/";
    $target_file = $target_dir . basename($_FILES['file']['tmp_name']);
    $uploadOk = 1;
    $temp = explode(".", $_FILES['file']['name']);
    $newfilename = round(microtime(true)).'.'.end($temp);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['file']['tmp_name']);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo '0';
        } else {
            if (move_uploaded_file($_FILES['file']['tmp_name'], 'offline_doc/'.$newfilename)) {
                // echo '1';
                echo $newfilename;
            } 
            else {
                echo '0';
            }
    }
}
?>