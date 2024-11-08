<?php 
include("access.php");
include("config.php"); 
  $consumer= $_POST['consumer'];
 $trackerid= $_POST['trckid'];
  $distributor= $_POST['distri'];
   $duedate= $_POST['duedt'];
   $landlord= $_POST['land'];
   $billunit= $_POST['billunit'];
   $meter= $_POST['mtr'];
   $atm= $_POST['atm'];
   $customer= $_POST['cust'];
   $gettrckerid="";
   $bank='';
   $stadd=str_replace("'","\'",$_POST['add']);
  //echo "Select * from ".$customer."_sites where atm_id1='".$atm."'";
  
  $qry1=mysqli_query($con,"Select * from ".$customer."_sites where atm_id1='".$atm."'");
  if(mysqli_num_rows($qry1)>0)
  {
if($stadd!=''){
//echo "update ".$customer."_sites set atmsite_address='".$stadd."' where trackerid='".$trackerid."'";
$siteadd=mysqli_query($con,"update ".$customer."_sites set atmsite_address='".$stadd."' where trackerid='".$trackerid."'");
}
  $row=mysqli_fetch_row($qry1);
  $bank=$row[10];
  
  $qryup=mysqli_query($con,"Update ".$customer."_sites set ebill='Y' where atm_id1='".$atm."'");
  $gettrckerid=$row[54];
  
  $qry2=mysqli_query($con,"Select * from ".$customer."_ebill where (atm_id='".$atm."' and atmtrackid='".$gettrckerid."')"); 
  if(mysqli_num_rows($qry2)>0)
  {  
  
  if($atm!=''){
  $mst=mysqli_query($con,"select * from mastersites  where (atm_id1='".$atm."' and trackerid='".$gettrckerid."') and status='0'");
  if(mysqli_num_rows($mst)>0){
//echo "update mastersites set Consumer_No='".$consumer."',meter_no='".$meter."' where (atm_id1='".$atm."' and trackerid='".$gettrckerid."') and status='0'";
  //$upo=mysqli_query($con,"Update mastersites set status='1' where atm_id1='".$atm."'");
  $upd=mysqli_query($con,"update mastersites set Consumer_No='".$consumer."',meter_no='".$meter."' where (atm_id1='".$atm."' and trackerid='".$gettrckerid."') and status='0'");
  }
  else
  {
   $mast=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`, `status`) VALUES (NULL, '".$atm."', '".$customer."', '".$meter."', '".$consumer."', '".$gettrckerid."', '".$bank."', '0')");
  }
//echo "update ".$customer."_ebill set Consumer_No='".$consumer."',Distributor='".$distributor."',Due_date='".$duedate."',landlord='".$landlord."', billing_unit='".$billunit."',meter_no='".$meter."' where (atm_id='".$atm."' and trackerid='".$gettrckerid."')";
$qryup1=mysqli_query($con,"update ".$customer."_ebill set Consumer_No='".$consumer."',Distributor='".$distributor."',Due_date='".$duedate."',landlord='".$landlord."', billing_unit='".$billunit."',meter_no='".$meter."' where (atm_id='".$atm."' and atmtrackid='".$gettrckerid."')"); } 
if(!$qryup1)
echo mysqli_error();
  }
  else
  {
  //$upo=mysqli_query($con,"Update mastersites set status='1' where atm_id1='".$atm."'");
  $mast=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`, `status`) VALUES (NULL, '".$atm."', '".$customer."', '".$meter."', '".$consumer."', '".$gettrckerid."', '".$bank."', '0')");
  $qryup1=mysqli_query($con,"INSERT INTO ".$customer."_ebill(Consumer_No,Distributor,atm_id,landlord,billing_unit,meter_no,atmtrackid) VALUES('".$consumer."','".$distributor."','".$atm."','".$landlord."','".$billunit."','".$meter."','".$gettrckerid."')");
 
  }

if($qryup and $qryup1)
echo "Updated";
else
echo "Error Occured";
}
else
echo "Site not found in Mainsite";
?>