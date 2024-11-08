<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');


$email=$_POST['email'];    
$pwd=$_POST['password'];





$url = 'http://sarmicrosystems.in/quiztest/process_login.php';
$data = array('email' => $email, 'pwd' => $pwd);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { 
    
    echo '0';
    
}
else{

$result=json_decode($result);



$_SESSION['email'] = $result->email;
$_SESSION['userid'] = $result->userid;
$_SESSION['std'] = $result->std;
$_SESSION['name'] = $result->name;

$myclass=$result->std;
?>
<script>
        localStorage.setItem("std","<?php echo $result->std ?>");
        localStorage.setItem("userid","<?php echo $result->userid ?>");
</script>
<?php

if($_SESSION['email'] && $_SESSION['userid']){
    


//accept friend request

$friend_id=$_GET['rg'];

$oppclass=get_student_class($friend_id);


if($myclass==$oppclass && !empty($oppclass) && $oppclass!=0){

// $myclass



    $sql="INSERT into quiz_friends(user_id,friend_id) VALUES('".$_SESSION['userid']."','".$friend_id."')";
    $sql_reverse="INSERT into quiz_friends(user_id,friend_id) VALUES('".$friend_id."','".$_SESSION['userid']."')";

    if(mysql_query($sql,$con) && mysql_query($sql_reverse,$con)){
      $_SESSION['status']='2';
      ?>
    <script>
        		alert('successfully added friend !!');
                
                setTimeout(function(){
                    window.top.location='http://sarmicrosystems.in/quiztest/web'; 
                
                }, 1000);
        
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


<?  }  
}
else{
    echo 'connot be friends with other class';
}
?>
<!--end accept friend request-->




    <script type='text/javascript'>
        setTimeout(function(){ window.top.location='http://sarmicrosystems.in/quiztest/web'; }, 1000);
    </script>
<?
}

}
?>
