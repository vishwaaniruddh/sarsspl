<?php
session_start();
include "config.php"; 
 if(isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['id'])){
    $category = $_POST['category'];
    $sub_cat = $_POST['sub_category'];
    $main_cat= $_POST['main_category']; 
    
    if(isset($_POST['tempid']) && $_POST['category']!=''){
        $qry="UPDATE `approval_category` SET `name`='$category' WHERE temp_id=".$_POST['tempid'];
        $result=mysql_query($qry);
    }
    if(isset($_POST['sub_cat_id']) && $_POST['sub_category']!=''){
        $qry="UPDATE `main_cat` SET `name`='$sub_cat' WHERE id=".$_POST['sub_cat_id'];
        $result=mysql_query($qry);
    }
    if(isset($_POST['main_cat_id']) && $_POST['main_category']!=''){
        $qry="UPDATE `main_cat` SET `name`='$main_cat' WHERE id=".$_POST['main_cat_id'];
        $result=mysql_query($qry);
    }
  
if($result){
     echo "<script>window.close();</script>";
    header('Location: category_Approval.php');
}
}
?>