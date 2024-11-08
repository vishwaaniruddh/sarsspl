<?php
session_start(); //Start the session
include ("config.php");
$id=$_POST['id'];
//var_dump($_FILES);
//echo $id;
$name='';
$pic='';
$sql="update member ";
if(isset($_POST['name']) &&  $_POST['name']!=''){
   $name= $_POST['name'];
   $sql.=" set name='$name'"; 
} 

if(isset($_POST['pic']) && $_POST['pic']!=''){
   $pic= $_POST['pic'];
   $location="image/".time().$pic;
    $imgdir = $location;
    //var_dump($imgdir);
    //var_dump($pic);
    if(move_uploaded_file($pic,$location)){
        $sql.=" , file='$imgdir'";
    }
   //$sql.=" and file='$pic'"; 
}
$sql.="  where id=".$id; 
echo $sql;
$runsql=mysqli_query($conn,$sql);
if($runsql){
return true;
}else{
    return false;
}



?>