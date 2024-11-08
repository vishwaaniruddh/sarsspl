<?php
session_start();
include("config.php");
$err=0;
$tstsc=$_POST["plscore"];
$tstsc2=$_POST["pl2score"];

$player1=$_POST["pl1id"];
$player2=$_POST["pl2id"];

$tymtakenc=$_SESSION["allowtym"]-preg_replace('/\D/', '', $_POST["tym"]);

//echo $tymtakenc;



$tymtaken= gmdate("H:i:s",$tymtakenc);
$tymalloted=$_SESSION["allowtym"];
//echo $tymtaken;
$tymallotedc="";
if(strlen($tymtakenc)=="1")
{
    
    $tymtakenc="00:00:0".$tymtakenc;
}else
{
    $tymtakenc="00:00:".$tymtakenc;
    
}

$aitym="";
if(strlen($_SESSION["aitym"])=="1")
{

$aitym="00:00:0".$_SESSION["aitym"];

}
else
{
    $aitym="00:00:".$_SESSION["aitym"];
    
}

//if(str_len($tymtakenc)=="")

//$tymtaken=10;

$updtqr=mysqli_query($con,"update quiztest_qids_details set selected_option='".$_POST["optss"]."',tym_taken='".$tymtakenc."' where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");




$st=0;
if(!$updtqr)
{
    
    $st="0";
    
}else
{
    $st="1";
}

$ansts="0";
$ansts2="0";
$qr=mysqli_query($con,"select * from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");


$farry=mysqli_fetch_array($qr);



$selop=$farry["selected_option"];
if($farry["correct_option"]==$farry["selected_option"])
{
    
 $ansts="1"; 
}


if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="4")//if AI and 100% correct
{   
    
   $ansts2="1";//AI IS ALWAYS CORRECT  
 
    
}



if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="5")//if AI and  correct MOST OF THE TIME
{   
    //AI IS  CORRECT  4 times
    $ran = array("a","b","c","d");
    $ran2 = array();
    for($a=0;$a<count($ran);$a++)
    {
        
        if($farry["correct_option"]!=$ran[$a])
        {
            $ran2[]=$ran[$a];
            
        }
        
    }
    
    if(intval($_POST["pl2score"])>=intval(4))
    {
       $randomElement = $ran2[array_rand($ran2, 1)];
  
    }
   else
   {
       $randomElement=$farry["correct_option"];
    
}

if($randomElement==$farry["correct_option"])
{
   $ansts2="1";
}
    
    
    $selop=$randomElement;
    
     
     

}


if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="6")//if AI and  i am fast but make mistakes
{   
    //AI IS  CORRECT  3 times
    $ran = array("a","b","c","d");
    $ran2 = array();
    for($a=0;$a<count($ran);$a++)
    {
        
        if($farry["correct_option"]!=$ran[$a])
        {
            $ran2[]=$ran[$a];
            
        }
        
    }
    
    if(intval($_POST["pl2score"])>=intval(3))
    {
       $randomElement = $ran2[array_rand($ran2, 1)];
  
    }
   else
   {
       $randomElement=$farry["correct_option"];
    
}

if($randomElement==$farry["correct_option"])
{
   $ansts2="1";
}
    
    $selop=$randomElement;
 
}


if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="7")//if AI and  i am unpredictable
{   
    $ran = array("a","b","c","d");
       $randomElement = $ran[array_rand($ran, 1)];
  

if($randomElement==$farry["correct_option"])
{
   $ansts2="1";
}

$selop=$randomElement;
    

}

   
$updtqr=mysqli_query($con,"update quiztest_qids_details set selected_option_p2='".$selop."',tym_taken_p2='".$aitym."' where test_id='".$_SESSION["test_id"]."' and qid='".$_POST["qsrno"]."'");

 


if($ansts=="1")
{
    
   $tstsc=$tstsc+1; 
}

if($ansts2=="1")
{
    
   $tstsc2=$tstsc2+1; 
}

//--------------------------------if it is last question then update details-----------------------------------------------------------

$lastq="";
$teststs="0";
$totymt="";
$tst=$_POST["qno"]."--------".$_SESSION["totqtns"];
if(intval($_POST["qno"])+intval(1)==$_SESSION["totqtns"])
{
$lastq="1";
 $calct=mysqli_query($con,"SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tym_taken))),SEC_TO_TIME(SUM(TIME_TO_SEC(tym_taken_p2))) As total FROM `quiztest_qids_details` WHERE `test_id` ='".$_SESSION['test_id']."'");
    $frtym=mysqli_fetch_array($calct);
    $totymt=$frtym[0];
$totymt2=$frtym[1];

$winid="";
if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="4")//if AI and 100% correct
{    
if($tstsc==$_SESSION["totqtns"])
{
    $teststs="1";
    $winid=$player1;
}

}

//--------------------i am 100% correct end--------------------------------------------------------


//--------------------i am correct most of the time start--------------------------------------------------------
if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="5")//if AI and correct most of the times
{    
    
if(intval($tstsc)>intval($tstsc2))
{
    $teststs="1";
     $winid=$player1;
}else
{
    
     $winid=$player2;
}
 
 if(intval($tstsc)==intval($tstsc2))
{
    
    
    if(strtotime($totymt)>strtotime($totymt2))
    {
        $teststs="0";
        $winid=$player2;
        
    }else if(strtotime($totymt)<=strtotime($totymt2))
    {
        
        $teststs="1";
        $winid=$player1;
    }
    
    
}


           
          
          
           
    

}

//--------------------i am correct most of the time end--------------------------------------------------------


//--------------------i am fast but make mistakes  start--------------------------------------------------------
if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="6")//if AI and correct most of the times
{    
    
if(intval($tstsc)>intval($tstsc2))
{
    $teststs="1";
     $winid=$player1;
}else
{
    
    $winid=$player2;
}
 
 if(intval($tstsc)==intval($tstsc2))
{
    
    
    if(strtotime($totymt)>strtotime($totymt2))
    {
        $teststs="0";
        
    }else if(strtotime($totymt)<=strtotime($totymt2))
    {
        
        $teststs="1";
    }
    
    
}




}

//--------------------i am correct most of the time end--------------------------------------------------------



//--------------------i am unpredictable  start--------------------------------------------------------
if($_SESSION["test_against"]=="1" &&  $_SESSION["test_against_type"]=="7")
{    
    
if(intval($tstsc)>intval($tstsc2))
{
    $teststs="1";
    $winid=$player1;
}
 else
 {
    $winid=$player2; 
     
 }
 

}


//--------------------i am unpredictable end--------------------------------------------------------


 $qrt="update quiztest_test_appeared set test_stats='".$teststs."',score='".$tstsc."',tym_taken='".$totymt."',player_won='".$winid."' where id='".$_SESSION['test_id']."'";
    $updtqr2=mysqli_query($con,$qrt);
           


//echo $teststs;
 if(trim($teststs)=="1")
           {
               
                $qrtup3="INSERT INTO `points_details`(`student_id`, `points`, `test_id`, `entrydt`,std) values('".$_SESSION['userid']."','".$tstsc."','".$_SESSION['test_id']."','".date("Y-m-d H:i:s")."','".$_SESSION['std']."')";
              //  echo $qrtup3;
               
    $updtqr3=mysqli_query($con,$qrtup3);
           
           echo mysqli_error($con);
           }
}

//-------------------------------if it is last question then update details end---------------------------------------------------------------

 $data = ['updtstats' =>$st,'answerstats' =>  $ansts,'answerstats2' =>  $ansts2,'v'=>$_POST["plscore"]."----------".$_SESSION["totqtns"],'v2'=>$qrt,'islastques'=>$lastq,'teststats'=>$teststs,"tst"=>$tst,"totymt"=>$totymt,"ftchnxt"=>1];

echo json_encode($data);
mysqli_close($con);
?>