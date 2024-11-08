<?php
session_start(); //Start the session
include ("config.php");
//var_dump( $_POST);exit;
$id=$_POST['id'];
//echo $id;
if(isset($_POST['remove']) && $_POST['remove']==1){
     $sql="update member set status= 3 where id=".$id;
    //echo $sql;
    $runsql=mysqli_query($conn,$sql);
    if($runsql){
    return true;
    }else{
        return false;
    }
} else if(isset($_POST['shift']) && $_POST['shift']==1){
    $sql="update member set status= 0 where id=".$id;
    //echo $sql;
    $runsql=mysqli_query($conn,$sql);
    if($runsql){
        return true;
    }else{
        return false;
    }
}

?>