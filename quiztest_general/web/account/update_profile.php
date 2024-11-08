<?php session_start(); 

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');

$userid=$_SESSION['userid'];


$fname=$_POST['fname'];
$lname=$_POST['lname'];
$school=$_POST['school'];
$class=$_POST['class1'];


$update_sql="update quiz_regdetails set name='".$fname."', lname='".$lname."', school='".$school."',class='".$class."' where id='".$userid."'";


if(mysql_query($update_sql,$con)){ ?>

           <script>window.history.back(); </script>
<? }

else { ?>
       <script>window.history.back(); </script>

<? } ?>