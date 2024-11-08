<?php
include('config.php');
$email1=$_POST['email2'];

if(isset($_POST['stats']) & $_POST['stats']!="")
{
    $qryusr=mysql_query("select Mobile from Registration where Mobile='".$_POST['cont']."' and id in(SELECT regid FROM `login`)");
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
//echo "select email from Registration where email='".$email1."'";
$qryusr=mysql_query("select email from Registration where email='".$email1."' and id in(SELECT regid FROM `login`)");
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
?>