<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');



$username=$_POST['username'];
$password=$_POST['password'];



$sql=mysql_query("select * quiz_login where username='".$username."' and pass='".$password."'",$con);

$sql_result=mysql_fetch_assoc($sql);


if($sql_result){
     $_SESSION['status']='1';
    ?>
   

<? 
}
else{
     $_SESSION['status']='0';
    ?>
   


<? 
} ?>

