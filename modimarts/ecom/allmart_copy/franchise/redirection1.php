<?php
session_start();
include ('config.php');

//echo $_SESSION['designation'];
if($_SESSION['usertype']=="Admin")
{

//header('Location:dashboard_temp/index.php');
header('Location:member1.php');
}
else if($_SESSION['usertype']=="SUB ADMIN")
{

//header('Location:teacherpanel.php');
header('Location:dashboard_temp/index.php');
}
else if($_SESSION['usertype']=="sales Associate")
{

header('Location:leadupdatebysales.php');
}

else{
header('Location:member1.php');   
    
}


?>