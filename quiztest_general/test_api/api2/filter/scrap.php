<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// For Test Response
// 1 or for all
// time 2 for current month

$time='2';
$std=8;
// $subject=302;

// For Live Response
// $time=$_POST['durationid'];
// $std=$_POST['std'];
$subject=$_POST['subjectid'];

if($time == 6){
    $time = 1;
}

// FOR CUMULATIVE LEADERBOARD eg. overalll leaderboard

if($time==1 && $subject>0){
    
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and p2<>'AI' and subject='".$subject."' GROUP BY p1 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and p2<>'AI' GROUP BY p1 ORDER BY points DESC LIMIT 10";
    }


// FOR MONTHLY LEADERBOARD

if($time==2 && $subject>0){

    $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and p2<>'AI' and subject='".$subject."' GROUP BY p1 ORDER BY points DESC LIMIT 10";
    
    
}


      if($time==2 && $subject==0){

        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and p2<>'AI' GROUP BY p1 ORDER BY points DESC LIMIT 10";
     }
     
     
     



// echo $time;

echo $sql;

// return;
$sql=mysql_query($sql,$con);


// echo $sql;

while($sql_result=mysql_fetch_assoc($sql)){

$p1=$sql_result['p1'];
    
 $points1=$sql_result['points'];

    $p1=$sql_result['p1'];
    $sqla=mysql_query("SELECT * from quiz_regdetails where id='".$p1."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
 
 
 // FOR CUMULATIVE LEADERBOARD eg. overalll leaderboard

if($time==1 && $subject>0){
    
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and standard='".$std."' and subject='".$subject."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and standard='".$std."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
    }


// FOR MONTHLY LEADERBOARD

if($time==2 && $subject>0){

    $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and subject='".$subject."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
    
    
}


      if($time==2 && $subject==0){

        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
     }
     
        
echo ';'.$sql2;
    
$sql3=mysql_query($sql2,$con);
    
    while($sql2_result=mysql_fetch_assoc($sql3)){
        
        
        
        $p2=$sql2_result['p2'];
  $points2=$sql2_result['points'];
     if($p1 != $p2){
     $points=$points1;         
     }
     if($p1 == $p2){
     $points=$points1+$points2;
     
        
        
    }
// echo $p1;
// echo $p2;
     
  
     
}
     $data[]=['id'=>$p1,'name'=>$name,'points'=>$points.'"'.$points1.'+'.$points2.'"'];   

    
}
// }


// sort the array by points in desc order
if($data){
foreach ($data as $key => $row)
{
	$vc_array_name[$key] = $row['points'];
}

array_multisort($vc_array_name, SORT_DESC, $data);


$newdata=json_encode($data);    

echo $newdata;
    
}

else{
    echo json_encode('no Records');
}



?>


























return;

echo json_encode(array_merge(json_decode($json2, true)));


return;

























// sort the array by points in desc order
if($data){
foreach ($data as $key => $row)
{
	$vc_array_name[$key] = $row['points'];
}

array_multisort($vc_array_name, SORT_DESC, $data);


$newdata=json_encode($data);    

echo $newdata;
    
}

else{
    echo json_encode('no Records');
}



return; 
 // FOR CUMULATIVE LEADERBOARD eg. overalll leaderboard

if($time==1 && $subject>0){
    
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and standard='".$std."' and subject='".$subject."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and standard='".$std."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
    }

$sql3=mysql_query($sql2,$con);
    
    while($sql2_result=mysql_fetch_assoc($sql3)){
        
        
        
        $p2=$sql2_result['p2'];
  $points2=$sql2_result['points'];
    
     $points=$points1+$points2;
     
        
        
    
// echo $p1;
// echo $p2;
     
  
     
}
     $data[]=['id'=>$p1,'name'=>$name,'points'=>$points.'"'.$points1.'+'.$points2.'"'];   

    

// }


