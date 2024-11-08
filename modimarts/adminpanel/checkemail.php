<?php
include('config.php');
$email1=$_POST['email'];
//echo $email1;
$sts=$_POST['sts'];
echo $sts;
if(isset($_POST['sts']) & $_POST['sts']!="")
{
   $qryusr=mysql_query("select code from clients where mobile='".$_POST['mob']."'");
$fetchusr=mysql_num_rows($qryusr);
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
$qryusr=mysql_query("select code from clients where email='".$email1."'");
$fetchusr=mysql_num_rows($qryusr);
if($fetchusr > 0)
{
   

    echo 1;
    
}
else
{
    echo 0;
}
}

