<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// for test reponse
// $player1=85;
// $player2=13;
// $testid=816;
// end test response


// enable for live response
$player2=$_POST['userid'];
$testid=$_POST['testid'];

$check_sql=mysql_query("SELECT * from friend_initiate where testid='".$testid."'",$con);



 $check_sql_result=mysql_fetch_assoc($check_sql);

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



if($minutes==0){

$sql="UPDATE friend_initiate set is_accepted=1 WHERE testid='".$testid."' and friend_id='".$player2."'";
   
   if(mysql_query($sql,$con)){
       echo 1;
   }
   else{
       echo 0;
   }
}
else{
    echo 0;
}
   

    
?>