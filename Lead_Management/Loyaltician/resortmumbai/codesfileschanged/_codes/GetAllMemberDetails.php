<?php
include 'config.php';
$data=array();
$id=$_POST['id'];
$column=$_POST['column'];

if($column=='id'){
   $c='GenerateMember_Id' ;
}else{
     $c='Primary_nameOnTheCard' ;
}



 $result=mysqli_query($conn,"select Primary_nameOnTheCard,GenerateMember_Id,MembershipDetails_Level,entryDate,Static_LeadID,booklet_Series,ExpiryDate from Members where  $c='".$id."' and canceledMember='0'");
 $row = mysqli_fetch_array($result);



/*	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$row['MembershipDetails_Level']."' ";
  	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);*/
	
	if($row[3]=="0000-00-00" && $row[3]=="1997-01-01"){
	    $m_entrydt="00-00-0000";
	}else{
	     $m_entrydt=date('d/m/Y', strtotime($row[3]));
	}
	
	
	
	/*
	
   $dd=date('Y-m-d', strtotime($row[3]));
  
$exm="";
$exm=$sql4fetch['Expiry_month'];

if(date('d', strtotime($row['entryDate']))>="25" ){
    if(date("Y-m-d")>="2019-11-25"){$exm+=1;}
}


	 $d = strtotime("+".$exm." months",strtotime($dd));
      $expiryDt=  date("M-Y",$d);*/
 $expiryDt = date('M,Y', strtotime($row['ExpiryDate']));


  $result2=mysqli_query($conn,"select Company,Designation from Leads_table where  Lead_id='".$row[4]."'  ");
  $row2 = mysqli_fetch_array($result2);

// this Query for check Booklet voucher is used or not
  $AvailableBarcode=mysqli_query($conn,"select count(Available) from BarcodeScan where  Voucher_id LIKE  '".$row[5]."%' and Available='0' ");
  $AvailBarcode = mysqli_fetch_array($AvailableBarcode);
  
$UsedBarcode=mysqli_query($conn,"select count(Available) from BarcodeScan where  Voucher_id LIKE  '".$row[5]."%' and Available='1' ");
  $UsedBarcod = mysqli_fetch_array($UsedBarcode);
////////////////////////////////////////////////////////

$MemberLevelQ=mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$row['MembershipDetails_Level']."'");
$fetchLevel=mysqli_fetch_array($MemberLevelQ);

$l=$fetchLevel['level_name'];
 
 
    $data[]=['m_id'=>$row[1],'m_name'=>$row[0],'m_level'=>$l,'m_expiry'=>$expiryDt,'m_comp'=>$row2[0],'m_desig'=>$row2[1],'m_entrydt'=>$m_entrydt,'AvailBarcode'=>$AvailBarcode[0],'UsedBarcod'=>$UsedBarcod[0],'Booklet'=>$row[5]];
 
 echo json_encode($data) ;
?>