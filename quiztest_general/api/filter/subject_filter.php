<?php //include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
include('../functions.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$time='2';
$std=8;
$subjectid='501';


if($subjectid>0){
 $sub_sql=mysqli_query($con,"select name from project_catT where id='".$subjectid."'");
    
    $sub_sql_result=mysqli_fetch_assoc($sub_sql);
    
    $subject=$sub_sql_result['name'];    
}
else{
    $subject=0;
}



// $time=$_POST['durationid'];
// $std=$_POST['std'];


// week // SELECT * from quiz_result WHERE created_at < NOW() - INTERVAL 1 WEEK

if($time=='1'){
    $weektime = '1';

    $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and subject='".$sub."' GROUP BY p1 ORDER BY points DESC limit 10";
    
    
}
if($time=='2'){

    $weektime = '2';
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and subject='".$sub."' GROUP BY p1 ORDER BY points DESC limit 10";
}


//echo $sql;



$sql=mysqli_query($con,$sql);


// echo $sql;

while($sql_result=mysqli_fetch_assoc($sql)){

$p1=$sql_result['p1'];
    
 $points1=$sql_result['points'];

    $p1=$sql_result['p1'];
    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
    
    
    if($time=='1'){
    $weektime = '1';
    

    
    $sql2="SELECT sum(points2) as points,p2 from quiz_result where created_at > MONTH(created_at) = MONTH(CURRENT_DATE()) and p2='".$p1."' and standard='".$std."' and subject='".$sub."' GROUP BY p2 ORDER BY points limit 5";
    }
    
if($time=='2'){

    $weektime = '2';
    $sql2="SELECT sum(points2) as points,p2 from quiz_result where p2='".$p1."' and standard='".$std."' and subject='".$sub."' GROUP BY p2 ORDER BY points limit 5";
}

    echo $sql2;
    
$sql3=mysqli_query($con,$sql2);
    
    while($sql2_result=mysqli_fetch_assoc($sql3)){
        $p2=$sql2_result['p2'];
        $points2=$sql2_result['points'];
    }

     $points=$points1+$points2;
     $data[]=['id'=>$p1,'name'=>$name,'points'=>$points];   

    
}   
// }


// sort the array by points in desc order
foreach ($data as $key => $row)
{
	$vc_array_name[$key] = $row['points'];
}

array_multisort($vc_array_name, SORT_DESC, $data);


$newdata=json_encode($data);

echo $newdata;

?>