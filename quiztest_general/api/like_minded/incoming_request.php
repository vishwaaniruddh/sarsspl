<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');


$player2=$_POST['userid'];
$testid=$_POST['testid'];

// $player2=85;
// $testid=2638;

$check_sql=mysqli_query($con,"SELECT * from like_minded where testid='".$testid."'");

 $check_sql_result=mysqli_fetch_assoc($check_sql);

 $date2=date('d-m-Y H:i:s') ;
 
 $date1=$check_sql_result['created_at'];
 $date1 = date("d-m-Y H:i:s", strtotime($date1));
 
// Declare and define two dates 
$date1 = strtotime($date1); 
$date2 = strtotime($date2); 

// Formulate the Difference between two dates 
$diff = abs($date2 - $date1);

// To get the year divide the resultant date into 
// total seconds in a year (365*60*60*24) 
$years = floor($diff / (365*60*60*24)); 


// To get the month, subtract it with years and 
// divide the resultant date into 
// total seconds in a month (30*60*60*24) 
$months = floor(($diff - $years * 365*60*60*24) 
							/ (30*60*60*24)); 


// To get the day, subtract it with years and 
// months and divide the resultant date into 
// total seconds in a days (60*60*24) 
$days = floor(($diff - $years * 365*60*60*24 - 
			$months*30*60*60*24)/ (60*60*24)); 


// To get the hour, subtract it with years, 
// months & seconds and divide the resultant 
// date into total seconds in a hours (60*60) 
$hours = floor(($diff - $years * 365*60*60*24 
	- $months*30*60*60*24 - $days*60*60*24) 
								/ (60*60)); 


// To get the minutes, subtract it with years, 
// months, seconds and hours and divide the 
// resultant date into total seconds i.e. 60 
$minutes = floor(($diff - $years * 365*60*60*24 
		- $months*30*60*60*24 - $days*60*60*24 
						- $hours*60*60)/ 60);

// echo $minutes;
// return;


if($minutes==30) {

     
     
     $sql1=mysqli_query($con,"select * from like_minded where testid='".$testid."' and is_accepted=1");
     
     $sql1_result=mysqli_fetch_assoc($sql1);
     
     if(!$sql1_result){
           $sql="UPDATE like_minded set is_accepted=1 WHERE testid='".$testid."' and player2='".$player2."'";
           
           if(mysqli_query($con,$sql)){
               echo 1;
           }
           else{
               echo 0;
           }
     }
     
          
       
       }
      




   $check_sql=mysqli_query($con,"SELECT * from like_minded where testid='".$testid."' and is_accepted=1");
   
   $check_sql_result=mysqli_fetch_assoc($check_sql);
   
   if($check_sql_result){
       echo 1;
   }
   else{
       echo 0;
   }


    
?>