<?php

include('config.php');
//if($con){ echo "con"."<br>";}

// var_dump($_POST); die; 

$heading = mysqli_real_escape_string($con,$_POST['heading']);
$category = $_POST['category'];
$content = mysqli_real_escape_string($con,$_POST['content']);
$desc =  mysqli_real_escape_string($con,$_POST['description']);




$visible = $_POST['act_inact'];
if($visible=='active'){ $val = 1; } else { $val=0;}

$created_at = date('Y-m-d H:i:s');
// echo $desc; 

$year = date('Y');      
$month = date('m'); 
$date = date('Y-m-d');
                          

if (!is_dir('blog_images/'.$year  .'/'.$month.'/'.$date)) {
    mkdir('blog_images/'.$year.'/'.$month.'/'.$date, 0777, true);
}        

$target_dir = 'blog_images/'.$year.'/'.$month.'/'.$date;


$file1=$_FILES["image1"]["name"];
$file2=$_FILES["image2"]["name"];


if($file1){
    $file_tmp=$_FILES["image1"]["tmp_name"];
    $file1 = str_replace(" ","",$file1);
    move_uploaded_file($file_tmp=$_FILES["image1"]["tmp_name"],$target_dir.'/'.$file1);
    $attach1 =  $target_dir.'/'.$file1;
}

if($file2){
    $file_tmp=$_FILES["image2"]["tmp_name"];
    $file2 = str_replace(" ","",$file2);
    move_uploaded_file($file_tmp=$_FILES["image2"]["tmp_name"],$target_dir.'/'.$file2);
    $attach2 =  $target_dir.'/'.$file2;
}


echo "insert into blog_details_insert(heading,category,listing_content,description,listing_images,image1,image2,visible,created_at) 
    values('".$heading."','".$category."','".$content."','".$desc."','".$attach1."','".$attach2."','".$attach3."','".$val."','".$created_at."')"; 
    // die;

$uploadsql = mysqli_query($con,"insert into blog_details_insert(heading,category,listing_content,description,listing_images,image1,image2,visible,created_at) 
    values('".$heading."','".$category."','".$content."','".$desc."','".$attach1."','".$attach1."','".$attach2."','".$val."','".$created_at."') ");
    

    if($uploadsql){
        echo "<script> alert('Data Inserted ');
            window.location.href='insertblog.php';
        </script>";     
    }
     else{
          echo "Error: " . mysqli_error($con);
         
     }

?>