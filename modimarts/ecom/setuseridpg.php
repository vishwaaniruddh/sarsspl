<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php');
if($_SESSION['gid']=="")
{
$errs=0;
mysqli_query($con1,"BEGIN");
mysqli_autocommit($con1, FALSE);
//echo "INSERT INTO `Registration`(`id`) values ('')";
//echo "INSERT INTO `Registration`(`id`) values ('')";
$qryid=mysqli_query($con1,"INSERT INTO `Registration`(`id`) values ('')");
if($qryid=="")
{
    //echo mysqli_error($con3);
$errs++;
}
$usrid=mysqli_insert_id($con1);
$_SESSION['gid']=$usrid;
//echo "rammmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm".$usrid;
if($errs==0)
{
    
    mysqli_query($con1,"COMMIT");
     mysqli_commit($con1);
 echo $usrid;
}
else
{
      mysqli_rollback($con1) ;
    mysqli_query($con1,"ROLLBACK");
    echo 2;
}

}
else
{
    
    echo 3;
}
     
     

?>
