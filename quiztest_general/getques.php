<?
session_start();
include("config.php");

$nxt=$_POST["nxt"];

//echo "tx".$nxt;


$qri="select * from quiztest_qids_details where test_id='".$_SESSION["test_id"]."' order by id";

$qri=$qri." limit ".$nxt.",1";


$qrr=mysqli_query($con,$qri);
$frr=mysqli_fetch_array($qrr);


$qri2="select * from quiztest where srno ='".$frr[2]."'";

$qrn=mysqli_query($con,$qri2); 
$nrws2=mysqli_num_rows($qrn);
$qr=mysqli_query($con,$qri2);
$nrws=mysqli_num_rows($qr);


if($nrws>0)
{
$rw=mysqli_fetch_array($qr);


 
  
  $str=$str.'<div  class="row">
  <div class="col-md-4">
  <img src="img/7.png" id="imga" style="display:none;height:30px;width:35px;"/>
  <img src="img/being-wrong.png" id="wronga" style="display:none;height:30px;width:35px;"/>
  </div>
  <div class="col-md-8" id="diva" border="1">
  <input type="radio" name="optsv" id="optsa" value="a">'.$rw["a"].'</div>
  </div>';
    
 $str=$str.'<div  class="row">
<div class="col-md-4">
 <img id="imgb" src="img/7.png" style="display:none;height:30px;width:35px;"/>
 <img src="img/being-wrong.png" id="wrongb" style="display:none;height:30px;width:35px;"/></div>
 <div class="col-md-8" id="divb" border="1"><input type="radio" name="optsv" id="optsb" value="b">'.$rw["b"].'</div></div>';
  
  $str=$str.'<div  class="row">
  <div class="col-md-4">
  <img src="img/7.png" id="imgc" style="display:none;height:30px;width:35px;"/>
  <img src="img/being-wrong.png" id="wrongc" style="display:none;height:30px;width:35px;"/>
  </div>
  <div class="col-md-8" id="divc" border="1">
  <input type="radio" name="optsv" id="optsc" value="c">'.$rw["c"].'</div></div>';
  
  $str=$str.'<div  class="row">
  <div class="col-md-4">
  <img src="img/7.png" id="imgd" style="display:none;height:30px;width:35px;"/>
  <img src="img/being-wrong.png" id="wrongd" style="display:none;height:30px;width:35px;"/>
  </div>
  <div class="col-md-8" id="divd" >
  <input type="radio" name="optsv" id="optsd" value="d">'.$rw["d"].'</div>
  </div>';
  
 
  $str=$str.'<div><input type="hidden" id="qsrno" value="'.$rw["srno"].'">'."</div>";
  
 // echo $str;
  
  $data = ['mcq' =>$rw["mcq"],'totalrws' => $nrws2,'options' => $str ];

echo json_encode($data);

  
}
?>
