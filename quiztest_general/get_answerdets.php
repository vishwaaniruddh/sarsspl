<?php
session_start();

include "config.php";

$player1=$_POST["pl1id"];
$player2=$_POST["pl2id"];


$gtyrs=mysqli_query($con,"select * from quiz_requests where id='".$_SESSION["reqidts"]."'");
$gtyrsfrws=mysqli_fetch_array($gtyrs);

$dbplayer1=$gtyrsfrws["user_id"];
$dbplayer2=$gtyrsfrws["friend_id"];


$qr=mysqli_query($con,"select * from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");
$farry=mysqli_fetch_array($qr);
$ftchnxt=0;


$ftchnxt=0;
if($player1==$dbplayer1)
{
if($farry["tym_taken_p2"]!="00:00:00")
{
    
    $ftchnxt=1;
}else
{
    $ftchnxt=0;
}

}

if($player1==$dbplayer2)
{
if($farry["tym_taken"]!="00:00:00")
{
    $ftchnxt=1;
}else
{
    $ftchnxt=0;
}

}
echo $ftchnxt;

?>