<?php session_start();
include('config.php');

$contact=$_POST['contact'];

  if($_SESSION['usertype']=='Admin' || $_SESSION['usertype']=='Fulfillment Team'  ){ 
      $QuryGetLead=mysqli_query($conn,"select * from Leads_table where MobileNumber='".$contact."' and Status!='3' ");

  }else{
      $QuryGetLead=mysqli_query($conn,"select * from Leads_table where MobileNumber='".$contact."' and leadEntryef='".$_SESSION['id']."' and Status!='3' ");

  }

//echo "select * from Leads_table where LeadSource='".$Leadid."' and leadEntryef='".$_SESSION['id']."'  ";
$array=array();

while($fetchLead=mysqli_fetch_assoc($QuryGetLead)){
 $array[]=  $fetchLead; 
}

$myJSON=json_encode($array);
echo $myJSON;

?>