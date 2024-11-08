<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$sql=mysql_query("SELECT sum(points1) as points,p1 from quiz_result where points1>0 GROUP BY p1 ORDER BY points DESC",$con);

while ($sql_result=mysql_fetch_assoc($sql)) {
    
    $points=$sql_result['points'];
    $p1=$sql_result['p1'];
    $sqla=mysql_query("SELECT * from quiz_regdetails where id='".$p1."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
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