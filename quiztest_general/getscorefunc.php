<?php
session_start();
include 'config.php';


$sts=$_POST["sts"];

$player1=$_POST["pl1id"];
$player2=$_POST["pl2id"];

/*$_SESSION["reqidts"]=41;
$_SESSION['test_id']=25;
$player1=8;
$player2=7;
$sts=2;*/

$gtyrs=mysqli_query($con,"select * from quiz_requests where id='".$_SESSION["reqidts"]."'");
$gtyrsfrws=mysqli_fetch_array($gtyrs);

$dbplayer1=$gtyrsfrws["user_id"];
$dbplayer2=$gtyrsfrws["friend_id"];


    $data=array();
    $pl1score=0;
    $pl2score=0;
 $winid=0;
 $tststats=0;

if($sts==1)// calculate score 
{
        if($player1==$dbplayer1)
        {
            
            $qr=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option and tym_taken!='00:00:00'");
            $getrws=mysqli_fetch_array($qr);

            if($getrws[0]!=0)
            {
                
                $pl1score=$getrws[0];
            }
            
            
            $qr2=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option_p2 and tym_taken_p2!='00:00:00'");
$getrws2=mysqli_fetch_array($qr2);

            if($getrws2[0]!=0)
            {
                
                $pl2score=$getrws2[0];
            }
            
        }

if($player1==$dbplayer2)
        {
            
            $qr=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option_p2 and tym_taken_p2!='00:00:00'");
$getrws=mysqli_fetch_array($qr);

            if($getrws[0]!=0)
            {
                
                $pl1score=$getrws[0];
            }
            
            
            $qr2=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option and tym_taken!='00:00:00'");
$getrws2=mysqli_fetch_array($qr2);

            if($getrws2[0]!=0)
            {
                
                $pl2score=$getrws2[0];
            }
            
        }

$data=["pl1score"=>$pl1score,"pl2score"=>$pl2score];

echo json_encode($data);

}
//echo $sts;
if($sts==2)// calculate win or lose 
{
        if($player1==$dbplayer1)
        {
            
            $qr=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option and tym_taken!='00:00:00'");
            $getrws=mysqli_fetch_array($qr);

            if($getrws[0]!=0)
            {
                
                $pl1score=$getrws[0];
            }
            
            
            $qr2=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option_p2 and tym_taken_p2!='00:00:00'");
$getrws2=mysqli_fetch_array($qr2);

            if($getrws2[0]!="0")
            {
                
                $pl2score=$getrws2[0];
            }
            
        
            
            if(intval($pl1score)>intval($pl2score))
            {
                
                $tststats=1;
                $winid=$player1;
            }
            
            if(intval($pl1score)<intval($pl2score))
            {
                
                $tststats=0;
                $winid=$player2;
            }
            
            if(intval($pl1score)==intval($pl2score))
            {
            
            
             $calct=mysqli_query($con,"SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tym_taken))),SEC_TO_TIME(SUM(TIME_TO_SEC(tym_taken_p2))) As total FROM `quiztest_qids_details` WHERE `test_id` ='".$_SESSION['test_id']."'");
            $frtym=mysqli_fetch_array($calct);
            $totymtp1=$frtym[0];
            $totymtp2=$frtym[1];
                
                
           if(strtotime($totymtp1)>strtotime($totymtp2))
            {
                $teststs="1";
                $winid=$player1;
                
            }
             
             if(strtotime($totymtp1)<strtotime($totymtp2))
            {
                $teststs="0";
                $winid=$player2;
                
            } 
              
                
            }
            
            
            
            
        }
        
        if($player1==$dbplayer2)
        {
            
            $qr=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option_p2 and tym_taken_p2!='00:00:00'");
            $getrws=mysqli_fetch_array($qr);

            if($getrws[0]!=0)
            {
                
                $pl1score=$getrws[0];
            }
            
            
            $qr2=mysqli_query($con,"select count(id) from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and correct_option=selected_option and tym_taken!='00:00:00'");
$getrws2=mysqli_fetch_array($qr2);

            if($getrws2[0]!="0")
            {
                
                $pl2score=$getrws2[0];
            }
            
            
            if(intval($pl1score)>intval($pl2score))
            {
                
                $tststats=1;
                $winid=$player1;
            }
            
            if(intval($pl1score)<intval($pl2score))
            {
                
                $tststats=0;
                $winid=$player2;
            }
            
            if(intval($pl1score)==intval($pl2score))
            {
            
            
             $calct=mysqli_query($con,"SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tym_taken_p2))),SEC_TO_TIME(SUM(TIME_TO_SEC(tym_taken))) As total FROM `quiztest_qids_details` WHERE `test_id` ='".$_SESSION['test_id']."'");
            $frtym=mysqli_fetch_array($calct);
            $totymtp1=$frtym[0];
            $totymtp2=$frtym[1];
                
                
           if(strtotime($totymtp1)>strtotime($totymtp2))
            {
                $teststs="1";
                $winid=$player1;
                
            }
             
             if(strtotime($totymtp1)<strtotime($totymtp2))
            {
                $teststs="0";
                $winid=$player2;
                
            } 
              
                
            }
            
            
            
            
        }
        
       
$result2 = mysqli_query($con,"update  quiztest_test_appeared set player_won='".$winid."' where id='".$_SESSION['test_id']."'",$con);

$data=["tststats"=>$tststats];

echo json_encode($data); 
 
}

?>