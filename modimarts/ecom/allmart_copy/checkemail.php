<?php
include('config.php');
$email1=$_POST['email'];
$sts=$_POST['sts'];
if(isset($_POST['sts']) & $_POST['sts']!="")
{
   $qryusr=mysqli_query($con1,"select code from clients where mobile='".$_POST['mob']."'");
$fetchusr=mysqli_num_rows($qryusr);
if($fetchusr > 0)
{
   

    echo 1;
    
}
else
{
    echo 0;
} 
}
else
{
$qryusr=mysqli_query($con1,"select code from clients where email='".$email1."'");
$fetchusr=mysqli_num_rows($qryusr);
if($fetchusr > 0)
{
   

    echo 1;
    
}
else
{
    echo 0;
}
}
?>