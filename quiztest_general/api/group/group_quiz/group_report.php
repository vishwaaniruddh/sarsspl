<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$groupid=$_POST['groupid'];
$testid=$_POST['testid'];


// $groupid=48;
// $testid=3590;


$sql=mysqli_query($con,"select * from group_result where groupid='".$groupid."' and testid='".$testid."'");


$totaltime=0;
$count=0;
while($sql_result=mysqli_fetch_assoc($sql)){
    
    
    $time=$sql_result['timetaken'];

    
       if($sql_result['point']){
        $points=$points+1;
        $totaltime=$totaltime+$time;
        $count++;
        
    }


    
}



$sql1=mysqli_query($con,"select * from quiz_result where id='".$testid."'");
$sql1_result=mysqli_fetch_assoc($sql1);



        $group1=$sql1_result['p1'];
        $group2=$sql1_result['p2'];
        
         $group1 = preg_replace('/[^0-9]/', '', $group1);
         $group2 = preg_replace('/[^0-9]/', '', $group2);
        
    

if($groupid==$group1){
    
    $update=mysqli_query($con,"update quiz_result set p1_correct_count='".$count."' , p1_time_taken='".$totaltime."' where id='".$testid."'");
    
    
}
else{
    
        $update=mysqli_query($con,"update quiz_result set p2_correct_count='".$count."', p2_time_taken='".$totaltime."' where id='".$testid."'");
        
}



?>