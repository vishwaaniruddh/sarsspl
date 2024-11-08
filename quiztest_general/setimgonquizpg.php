<?php
session_start();
include 'config.php';

/*
function getimgpath($idd,$sts)
{
    global $con;
    
     
    $sr="select img_path,name from quiz_regdetails where id='".$idd."'";
   // echo $sr;
    $result2 = mysqli_query($con,$sr);
    
   $nrw=mysqli_num_rows($result2);
$rwsc2=mysqli_fetch_array($result2);

$mg="img/download.png";

 if($sts=="1")
    {
        if($rwsc2[0]="")
        {
        return  $mg;
        }
        else
        {
         

            return $mg=$rwsc2[0];
            
        }
        
        
    }

$nm="";
 if($sts=="2")
    {
        if($rwsc2[1]="")
        {
   
        return $nm;
        }
        else
        {
            return $nm=$rwsc2[1];
            
        }
        
        
    }


}


*/
$p1="";
 $p2="";

 $qrsgts=mysqli_query($con,"select * from quiztest_test_appeared where id='".$_SESSION['test_id']."'");
$frtreqs=mysqli_fetch_array($qrsgts);


$img1="img/download.png";
$img2="img/download.png";

$player1=$frtreqs["testby"];
$player2=$frtreqs["test_against_id"];
$nm1="";
$nm2="";
if($player1==$_SESSION["userid"])
{
$p1=$player1;
$p2=$player2;
$sr="select img_path,name from quiz_regdetails where id='".$player1."'";
$result2 = mysqli_query($con,$sr);
    
$nrw=mysqli_num_rows($result2);
$rwsc2=mysqli_fetch_array($result2);
$img1=$rwsc2[0];
$nm1=$rwsc2[1];;
 
  if($player2=="0")
 {
     
 $img2="img/Armed robot.png";
 $nm2="AI";
     
 }else
 {

 $sr="select img_path,name from quiz_regdetails where id='".$player2."'";
 $result2 = mysqli_query($con,$sr);
    
 $nrw=mysqli_num_rows($result2);
 $rwsc2=mysqli_fetch_array($result2);
 if($result2["img_path"]!="")
 {
 $img2=$rwsc2[0];
 }
 $nm2=$rwsc2[1];

 }
 }
 else
 {

$p1=$player2;
$p2=$player1;
$sr="select img_path,name from quiz_regdetails where id='".$player2."'";
$result2 = mysqli_query($con,$sr);
    
$nrw=mysqli_num_rows($result2);
$rwsc2=mysqli_fetch_array($result2);
$img1=$rwsc2[0];
$nm1=$rwsc2[1];;
 
 if($player1=="0")
 {
 $img2="img/Armed robot.png";
 $nm2="AI";
     
 }else
 {

 $sr="select img_path,name from quiz_regdetails where id='".$player1."'";
 $result2 = mysqli_query($con,$sr);
    
 $nrw=mysqli_num_rows($result2);
 $rwsc2=mysqli_fetch_array($result2);
 if($result2["img_path"]!="")
 {
 $img2=$rwsc2[0];
 }
 $nm2=$rwsc2[1];

 }
 
 
 
     
 }


$data=array();


$date=["player1id"=>$p1,"name1"=>$nm1,"img1"=>$img1,"player2id"=>$p2,"name2"=>$nm2,"img2"=>$img2];


echo json_encode($date);
mysqli_close($con);
?>