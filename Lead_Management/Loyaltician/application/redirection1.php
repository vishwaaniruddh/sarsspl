<?php
session_start();
include ('config.php');

// echo $_SESSION['usertype'];
if($_SESSION['usertype']=="Admin")
{

header('Location:dashboard_admin.php');
//header('Location:viewlead.php');
//header('Location:testscheduleviewadmin.php');
}

else if($_SESSION['usertype']=="Sales Associate")
{

header('Location:leadupdatebysales.php');
}
else if($_SESSION['usertype']=="HOTEL MANGER")
{

header('Location:dashboard_HotelManager.php');
}
else //if($_SESSION['usertype']=="SUB ADMIN")
{

header('Location:dashboard.php');
}
/*else{
header('Location:index.php');   
    
}*/


?>