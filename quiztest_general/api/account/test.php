<?php /*include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
    

$maxCodeSqlResult = mysql_query("SELECT max(`invite_code`) as 'invite_code' FROM `quiz_regdetails`",$con);
$maxCode = mysql_fetch_assoc($maxCodeSqlResult);
if($maxCode["invite_code"] == null) {
    echo "Its null";
} else {
    echo "maxCode: ".$maxCode["invite_code"];
}*/
$t = 'AA';
echo "T = ".(strlen($t))." <br>";

?>