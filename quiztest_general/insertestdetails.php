<?php
session_start();
include("config.php");
$err=0;
if (isset($_SESSION['test_against']) && !empty($_SESSION['test_against'])) 
{
    
    mysqli_query($con,"BEGIN");
    
    $qri="select srno,final_ans from quiztest where subject='".$_SESSION['subject']."' and std='".$_SESSION["std"]."'";
    $topic=$_SESSION["topic"];
    if($topic!="")
    {
      $qri=$qri." and topic in ($topic)";  
        
    }else
    {
      $topic=0;  
        
    }
    
    $qri=$qri." limit 0,".$_SESSION["totqtns"];
    //echo $qri;
      $msqry=mysqli_query($con,$qri);
  
$nmr=mysqli_num_rows($msqry);
$_SESSION["totqtns"]=$nmr;



if($_POST["reqid"]!="")
        {
        
        
        $getfrid=mysqli_query($con,"select * from quiz_requests where id='".$_POST["reqid"]."'");
        $frws=mysqli_fetch_array($getfrid);
       $_SESSION["test_against_id"]=$frws["friend_id"];
        
        
        }

if($nmr>0)
{
    
    $qr=mysqli_query($con,"INSERT INTO `quiztest_test_appeared`( `testby`, `test_against`, `test_against_type`, `test_against_id`, `std`, `subject`, `topic`, `subtopic`, `to_ques`, `tot_tym`, `test_datetym`,reqid) values('".$_SESSION['userid']."','".$_SESSION['test_against']."','".$_SESSION['test_against_type']."','".$_SESSION['test_against_id']."','".$_SESSION['std']."','".$_SESSION['subject']."','".$topic."','0','".$nmr."','".$_SESSION["allowtym"]."','".date("Y-m-d H:i:s")."','".$_POST["reqid"]."')");
    
    
    if(!$qr)
    {
        
        $err++;
    }
    $idd=mysqli_insert_id($con);
    unset($_SESSION['rtest_id']);

    $_SESSION['test_id']=$idd;
    
    while($frow=mysqli_fetch_array($msqry))
    {
        
       $insqr=mysqli_query($con,"INSERT INTO `quiztest_qids_details`(`test_id`, `qid`, `correct_option`) VALUES ('".$idd."','".$frow[0]."','".$frow[1]."')");
       
       
       if(!$insqr)
       {
           $err++;
           
       }
    }
    
    
      
        if($_POST["reqid"]!="")
        {
        $updtreq=mysqli_query($con,"update quiz_requests set player1_avail='1',test_id='".$idd."' where id='".$_POST["reqid"]."'");
        if(!$updtreq)
        {
            $err++;
        }
            
        }
    
    
    
    
    
    if($err==0)
    {
        
    mysqli_query($con,"COMMIT");
        echo "1";
    }
    else
    {
        
        
    mysqli_query($con,"ROLLBACK");
    echo "0";
    
    }
}else
{
    
    echo "20";
}
}else
{

echo "10";
}
?>