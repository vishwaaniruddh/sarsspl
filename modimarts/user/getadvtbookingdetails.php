<?php session_start(); 
// var_dump($_SESSION);
include("config.php");
$dt=date("Y-m-d");
if(isset($_SESSION['id']) & $_SESSION['id']!="")
{

function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

$topright=0;
$toprightid=0;
$onsale=0;
$onsaleid=0;
$Product=0;
$Productid=0;
$BestSeller=0;
$BestSellerid=0;
 $latestpr=0;
$latestprid=0; 
$featuredpr=0;
$featuredprid=0;
$specialpr=0;
$specialprid=0;
$topratingpr=0;
$dealspr=0;

$qrylatfbkchk=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=1");
while($rwadvbk=mysqli_fetch_array($qrylatfbkchk))
{
  // echo "123";
if(check_in_range($rwadvbk[3], $rwadvbk[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$topright=1;
$toprightid=$rwadvbk[0];
$toprightdtfrm=date("d-m-Y",strtotime($rwadvbk[3]));
$toprightdtto=date("d-m-Y",strtotime($rwadvbk[4]));
break;
}  
  
    
}



$qrylatfbkchk2=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=2");
while($rwadvbk2=mysqli_fetch_array($qrylatfbkchk2))
{
  // echo "123";
if(check_in_range($rwadvbk2[3], $rwadvbk2[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$onsale=1;
$onsaleid=$rwadvbk2[0];
$onsalefrm=date("d-m-Y",strtotime($rwadvbk2[3]));
$onsaleto=date("d-m-Y",strtotime($rwadvbk2[4]));
break;
}  
  
    
}

$qrylatfbkchk3=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=3");
while($rwadvbk3=mysqli_fetch_array($qrylatfbkchk3))
{
  // echo "123";
if(check_in_range($rwadvbk3[3], $rwadvbk3[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$Product=1;
$Productid=$rwadvbk3[0];
$Productfrm=date("d-m-Y",strtotime($rwadvbk3[3]));
$Productto=date("d-m-Y",strtotime($rwadvbk3[4]));
break;
}  
  
    
}



$qrylatfbkchk4=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=4");
while($rwadvbk4=mysqli_fetch_array($qrylatfbkchk4))
{
  // echo "123";
if(check_in_range($rwadvbk4[3], $rwadvbk4[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$BestSeller=1;
$BestSellerid=$rwadvbk4[0];
$BestSellerfrm=date("d-m-Y",strtotime($rwadvbk4[3]));
$BestSellerto=date("d-m-Y",strtotime($rwadvbk4[4]));
break;
}  
  
    
}

$qrylatfbkch5=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=5");
while($rwadvbk5=mysqli_fetch_array($qrylatfbkch5))
{
  // echo "123";
if(check_in_range($rwadvbk5[3], $rwadvbk5[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$latestpr=1;
$latestprid=$rwadvbk5[0];
$latestprfrm=date("d-m-Y",strtotime($rwadvbk5[3]));
$latestprto=date("d-m-Y",strtotime($rwadvbk5[4]));
break;
}  
  
    
}



$qrylatfbkch6=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=6");
while($rwadvbk6=mysqli_fetch_array($qrylatfbkch6))
{
  // echo "123";
if(check_in_range($rwadvbk6[3], $rwadvbk6[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$dealspr=1;
$dealsprid=$rwadvbk6[0];
$dealsfrm=date("d-m-Y",strtotime($rwadvbk6[3]));
$dealsto=date("d-m-Y",strtotime($rwadvbk6[4]));
break;
}  
 
}


$qrylatfbkch7=mysqli_query($con1,"select * from advertise_booking where merchant_id='".$_SESSION['id']."' and slot=7");
while($rwadvbk7=mysqli_fetch_array($qrylatfbkch7))
{
  // echo "123";
if(check_in_range($rwadvbk7[3], $rwadvbk7[4],$dt))
{
//$slotarr[]=$rwadvbk["slot"];
$topratingpr=1;
$topratingprid=$rwadvbk7[0];
$topratingfrm=date("d-m-Y",strtotime($rwadvbk7[3]));
$topratingto=date("d-m-Y",strtotime($rwadvbk7[4]));
break;
}  
}


}
?>