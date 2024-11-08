<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';

$table=mysqli_query($conn,$sqlme);
//echo mysql_num_rows($table);

$contents='';
// $contents.="Sr. No. \t Card Number \t Title \t First Name \t Last Name \t Name on the Card \t Spouse Name \t  Mobile Number \t Membership Level \t Member Since \t Validity \t Mobile Number 2 \t  Contact 1 \t Contact 2 \t Contact 3 \t Email ID \t Email ID 2 (Gmail) \t Company Name \t Designation \t Address Type 1 \t Address \t City \t State \t Country \t Pin Code \t Date of Birth \t Marital Status \t";
$contents.="Sr. No. \t Name on the Card \t Type \t Level \t Membership No.\t Expiry Date \t Booklet Number \t Promotional Voucher \t Renewal Voucher \t Type(N/R) \t Payment Mode \t Instrument No \t Authorisation \t Receipt No  \t  Amount  \t GST \t Total Amount \t Remarks \t Discount Remarks \t";

// echo $contents;
 $cnt=0;



 function get_member_details($parameter,$id){
    global $conn;


    $sql = mysqli_query($conn,"SELECT * FROM `Members`,`RenewalMembersDetails` where Members.Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Members.Static_LeadID = RenewalMembersDetails.Static_LeadID and  Members.Static_LeadID='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    if($sql_result){
        return $sql_result[$parameter];
    }
    else{
        return false;
    }

}

function getNew_booklet($member_id){

    global $conn;

    $sql = mysqli_query($conn,"select * from Extension_history where member_id = '".$member_id."' order by id desc");

    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['new_booklet_series'];
}




while($_row=mysqli_fetch_array($table))
{
$cnt++;

    $member_id = $_row['Static_LeadID'];

if(get_member_details('NewGenerateMember_Id',$member_id)>0){

$type = 'Renew';

} elseif($_row['canceledMember']==1){

$type = 'Canceled';
}
else{
$type = 'New';
}


if(getNew_booklet($member_id)){
   $booklet =  getNew_booklet($member_id);
}



 	$sql2="select * from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);


	$sql3="SELECT * FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);




	$sql5="SELECT state FROM `state` where state_id='".$sql2fetch['State']."' ";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);






		 $R = date("M-Y", strtotime($_row['ExpiryDate']));


	 $contents.="\n".$cnt."\t";
     $contents.=$_row['Primary_nameOnTheCard']."\t";
      $contents.=''."\t";
	 $contents.=$sql3fetch['level_name']."\t";
	 $contents.=$_row['GenerateMember_Id']."\t";

	 $contents.=$R."\t";

	 if($booklet){
	 $contents.= $booklet."\t";

	 }
	 else{
	$contents.= $_row['booklet_Series']."\t";
	 }
	 $contents.=$_row['promotional_voucher_code']."\t";
	 $contents.=$_row['renewal_voucher_code']."\t";
	 $contents.=$type."\t";
	 $contents.=$_row['MembershipDts_PaymentMode']."\t";
     $contents.=$_row['MembershipDts_InstrumentNumber']."\t";
	 $contents.=''."\t";
	 $contents.=''."\t";

	 $contents.=$_row['MembershipDts_NetPayment']."\t";
	 $contents.=$_row['MembershipDts_GST']."\t";
	 $contents.=$_row['MembershipDts_GrossTotal']."\t";
	 $contents.=$_row['MemshipDts_Remarks']."\t";
	 $contents.=$_row['MembershipDts_Discount_Remark']."\t";



 }

$contents = strip_tags($contents);


  header("Content-Disposition: attachment; filename=dsr.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;

?>