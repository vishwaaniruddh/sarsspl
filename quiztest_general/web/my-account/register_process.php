<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');



$name=$_POST['name'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$schname=$_POST['schname'];
$class=$_POST['class1'];
$mobile=$_POST['mobile'];

$password=$_POST['password'];


$id=$_GET['rg'];


if(!$id){
$sql="INSERT INTO quiz_regdetails(name,lname,emailid,school,class,mobile) VALUES('".$name."','".$lname."','".$email."','".$schname."','".$class."','".$mobile."')";




if (mysql_query($sql,$con) === TRUE) {

    $userid = mysql_insert_id();

}

$sql_login="INSERT INTO quiz_login(user_id,email,pass) VALUES('".$userid."','".$email."','".$password."')";



if(mysql_query($sql_login,$con)===TRUE){
   $_SESSION['status']='1';
    ?>
    <script>
        alert('successfully registered !!');
    </script>
<? }
else{
    $_SESSION['status']='0';
    
    ?>
    <script>
    	setTimeout(function() { 
      	window.history.back();
    		}, 2000);
        		alert('Please try again !!');
    </script>


<?
}
return;
}


else{
    
$oppclass=get_student_class($id);

if($class==$oppclass && !empty($oppclass) && $oppclass!=0){
  
$sql="INSERT INTO quiz_regdetails(name,lname,emailid,school,class,mobile) VALUES('".$name."','".$lname."','".$email."','".$schname."','".$class."','".$mobile."')";

    if (mysql_query($sql,$con) === TRUE) {
        $userid = mysql_insert_id();
    }

$sql_login="INSERT INTO quiz_login(user_id,email,pass) VALUES('".$userid."','".$email."','".$password."')";



if(mysql_query($sql_login,$con)===TRUE){
    ?>
    <script>
       setTimeout(function(){ window.top.location='http://sarmicrosystems.in/quiztest/web'; }, 1000);
        		alert('successfully registered !!');
    </script>


<?
}
else{
     $_SESSION['status']='0';
    
    ?>
    <script>
    	setTimeout(function() { 
       	window.history.back();
    		}, 2000);
        		alert('Failed !!');
    </script>


<?
}



if($_GET['rg']){

$friend_id=$_GET['rg'];





 $sql="INSERT into quiz_friends(user_id,friend_id) VALUES('".$userid."','".$friend_id."')";
    
    $sql_reverse="INSERT into quiz_friends(user_id,friend_id) VALUES('".$friend_id."','".$userid."')";

    if(mysql_query($sql,$con) && mysql_query($sql_reverse,$con)){
          ?>
    <script>
       setTimeout(function(){ window.top.location='http://sarmicrosystems.in/quiztest/web'; }, 1000);
        		alert('successfully added friend !!');
    </script>


<?
    }
    else{
         $_SESSION['status']='0';
        
        ?>
    <script>
    	setTimeout(function() { 
       	window.history.back();
    		}, 2000);
        		alert('Failed !!');
    </script>


<?
    }    

}



  
}

else{
    
    echo 'cannot be friends with other class';

    
}

}



?>