<? session_start();

$subject=$_POST['subjectid'];
$topic=$_POST['topicid'];
$ai_type=$_POST['ai_type'];


$_SESSION['subjectid']=$subject;
$_SESSION['topicid']=$topic;
$_SESSION['ai_type']=$ai_type;

if(isset($_SESSION['subjectid']) && isset($_SESSION['topicid'])){
    echo 1;
}
else{
    echo $_SESSION['subjectid'].'==='.$_SESSION['topicid'];
}




?>