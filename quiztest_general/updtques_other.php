<?php
session_start();
include("config.php");
$err=0;
$tstsc=$_POST["plscore"];
$tstsc2=$_POST["pl2score"];

$player1=$_POST["pl1id"];
$player2=$_POST["pl2id"];



$gtyrs=mysqli_query($con,"select * from quiz_requests where id='".$_POST["reqidts"]."'");
$gtyrsfrws=mysqli_fetch_array($gtyrs);

$dbplayer1=$gtyrsfrws["user_id"];
$dbplayer2=$gtyrsfrws["friend_id"];



//echo $player2;
$tymtakenc=$_SESSION["allowtym"]-preg_replace('/\D/', '', $_POST["tym"]);

//echo $_SESSION["allowtym"];

$tymtaken= gmdate("H:i:s",$tymtakenc);
$tymalloted=$_SESSION["allowtym"];
if(strlen($tymtakenc)=="1")
{
    
    $tymtakenc="00:00:0".$tymtakenc;
}else
{
    $tymtakenc="00:00:".$tymtakenc;
    
}



if($player1==$dbplayer1)
{
    
$updtqr=mysqli_query($con,"update quiztest_qids_details set selected_option='".$_POST["optss"]."',tym_taken='".$tymtakenc."' where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");

}else
{
    
 $updtqr=mysqli_query($con,"update quiztest_qids_details set selected_option_p2='".$_POST["optss"]."',tym_taken_p2='".$tymtakenc."' where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");
   
}


$st=0;
if(!$updtqr)
{
    
    $st="0";
    
}else
{
    $st="1";
}

$qr=mysqli_query($con,"select * from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");


$farry=mysqli_fetch_array($qr);

$selop=$farry["selected_option"];

$ansts=0;

if($player1==$dbplayer1)
{
if($farry["correct_option"]==$farry["selected_option"])
{
    $ansts="1";
    $tstsc=$tstsc+1;
}
}

if($player1==$dbplayer2)
{
if($farry["correct_option"]==$farry["selected_option_p2"])
{
    $ansts="1";
    $tstsc=$tstsc+1;
}
}

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

$lastq="";
$teststs="0";
$totymt="";
$tst=$_POST["qno"]."--------".$_SESSION["totqtns"];
if(intval($_POST["qno"])+intval(1)==$_SESSION["totqtns"])
{
$lastq="1";



}

 $data = ['updtstats' =>$st,'answerstats' =>  $ansts,'answerstats2' =>  $ansts2,'islastques'=>$lastq,'teststats'=>$teststs,"tst"=>$tst,"totymt"=>$totymt,"ftchnxt"=>$ftchnxt,'pl1scr'=>$tstsc,'pl2scr'=>$tstsc2];

echo json_encode($data);
mysqli_close($con);
?>