<?php //include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
include('../functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');



$sql=mysqli_query($con,"SELECT sum(points1) as points,p1 from quiz_result where points1>0 GROUP BY p1 ORDER BY points DESC limit 10");

while($sql_result=mysqli_fetch_assoc($sql)){

$p1=$sql_result['p1'];
    
 $points1=$sql_result['points'];

    $p1=$sql_result['p1'];
    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
    
    // echo "SELECT sum(points2) as points,p2 from quiz_result where p2='".$p1."' and points2>0 GROUP BY p2 ORDER BY points2 DESC;";
    // echo '<br>';
    $sql2=mysqli_query($con,"SELECT sum(points2) as points,p2 from quiz_result where p2='".$p1."' GROUP BY p2 ORDER BY points2 DESC");
    
    while($sql2_result=mysqli_fetch_assoc($sql2)){
$p2=$sql2_result['p2'];
$points2=$sql2_result['points'];
    }

    
    
    $points=$points1+$points2;
    $data[]=['id'=>$p1,'name'=>$name,'points'=>$points];

}



// foreach (data as $key => $row)
// {
// 	$vc_array_name[$key] = $row['points'];
// }
// array_multisort($vc_array_name, SORT_DESC, $data);



print_r($data);

?>