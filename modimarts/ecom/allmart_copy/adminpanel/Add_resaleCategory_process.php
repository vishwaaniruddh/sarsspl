<?php
session_start();
/*session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');
$name=$_POST['name'];
if($_POST['id']>0){
    $update_qry = mysql_query("update resale_category set name='".$name."' where id=".$_POST['id']);
    
    $message = "Category updated successfully!";
} else {
    $check_duplicate =mysql_query("SELECT * FROM resale_category where name = '".$name."'");
    if(!mysql_num_rows($check_duplicate)>0){
        $qry="insert into resale_category(`name`,status) values('".$name."',1)";
        $res=mysql_query($qry);
        $message = "Resale category Added Successfully !!";
        // echo $qry;
        $subid= mysql_insert_id();
    } else {
        $message = " Category already exist into system!";
    }
}



    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("add_resaleCategory.php", "_self");</script>';

?>
