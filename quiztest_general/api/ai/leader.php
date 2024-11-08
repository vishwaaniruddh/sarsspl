<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$sql=mysqli_query($con,"SELECT sum(points1) as points,p1 from quiz_result where points1>0 GROUP BY p1 ORDER BY points DESC");

while ($sql_result=mysqli_fetch_assoc($sql)) {
    
    $points=$sql_result['points'];
    $p1=$sql_result['p1'];
    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
    $data[]=['name'=>$name,'id'=>$p1,'points'=>$points];
    
}
echo json_encode($data);
return;
?>
SELECT sum(points) as points from (SELECT  quiz_result.p1, quiz_regdetails.name,quiz_regdetails.lname,quiz_result.points
FROM quiz_result
INNER JOIN quiz_regdetails
ON quiz_result.p1 = quiz_regdetails.id)