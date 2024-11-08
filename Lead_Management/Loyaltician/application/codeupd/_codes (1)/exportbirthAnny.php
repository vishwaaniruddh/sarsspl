<?php
include ('config.php');
$sqlme = $_POST['qr'];
$sqlme = $sqlme;//.' limit 400';

$table = mysqli_query($conn, $sqlme);
//echo mysql_num_rows($table);

$contents = '';
// $contents.="Sr. No. \t Card Number \t Title \t First Name \t Last Name \t Name on the Card \t Spouse Name \t  Mobile Number \t Membership Level \t Member Since \t Validity \t Mobile Number 2 \t  Contact 1 \t Contact 2 \t Contact 3 \t Email ID \t Email ID 2 (Gmail) \t Company Name \t Designation \t Address Type 1 \t Address \t City \t State \t Country \t Pin Code \t Date of Birth \t Marital Status \t";
$contents .= "Sr. No. \t Name on the Card \t Type \t Level \t Membership No.\t Expiry Date \t Booklet Number \t Type(N/R) \t Payment Mode \t Instrument No \t Authorisation \t Receipt No  \t  Amount  \t GST \t Total Amount \t Remarks \t";

// echo $contents;
$cnt = 0;

while ($_row = mysqli_fetch_array($table)) {
	$cnt++;

	$sql2 = "select * from Leads_table where Lead_id='" . $_row['Static_LeadID'] . "' ";
	//echo $sql2;
	$runsql2 = mysqli_query($conn, $sql2);
	$sql2fetch = mysqli_fetch_array($runsql2);


	$sql3 = "SELECT * FROM `Level` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ";
	$runsql3 = mysqli_query($conn, $sql3);
	$sql3fetch = mysqli_fetch_array($runsql3);




	$sql5 = "SELECT state FROM `state` where state_id='" . $sql2fetch['State'] . "' ";
	$runsql5 = mysqli_query($conn, $sql5);
	$sql5fetch = mysqli_fetch_array($runsql5);






	$R = date("M-Y", strtotime($_row['ExpiryDate']));


	$contents .= "\n" . $cnt . "\t";
	$contents .= $_row['Primary_nameOnTheCard'] . "\t";
	$contents .= '' . "\t";
	$contents .= $sql3fetch['level_name'] . "\t";
	$contents .= $_row['GenerateMember_Id'] . "\t";

	$contents .= $R . "\t";
	$contents .= $_row['booklet_Series'] . "\t";
	$contents .= 'New' . "\t";
	$contents .= $_row['MembershipDts_PaymentMode'] . "\t";
	$contents .= $_row['MembershipDts_InstrumentNumber'] . "\t";
	$contents .= '' . "\t";
	$contents .= '' . "\t";

	$contents .= $_row['MembershipDts_NetPayment'] . "\t";
	$contents .= $_row['MembershipDts_GST'] . "\t";
	$contents .= $_row['MembershipDts_GrossTotal'] . "\t";
	$contents .= $_row['MemshipDts_Remarks'] . "\t";



	/*	
		 $contents.="\n".$cnt."\t";
		 $contents.=$_row['GenerateMember_Id']."\t";
		  $contents.=$_row['Primary_Title']."\t";
		 $contents.=$sql2fetch['FirstName']."\t";
		 $contents.=$sql2fetch['LastName']."\t";
		
		 $contents.=$_row['Primary_nameOnTheCard']."\t";
		 $contents.=$_row['Spouse_FirstName']."\t";
		 $contents.=$sql2fetch['MobileNumber']."\t";
		 $contents.=$sql3fetch['level_name']."\t";
		 $contents.=$_row['entryDate']."\t";
		 $contents.=$sql4fetch['Expiry_month'].'Month'."\t";
		 $contents.=$_row['Primary_mob1']."\t";
		
		 $contents.=$_row['Primary_Contact1']."\t";
		 $contents.=$_row['Primary_Contact2']."\t";
		 $contents.=$_row['Primary_Contact3']."\t";
		 $contents.=$_row['Primary_Email_ID2']."\t";
		 $contents.=$_row['Spouse_GmailMArrid1']."\t";
		 $contents.=$sql2fetch['Company']."\t";
		 $contents.=$sql2fetch['Designation']."\t";
		 $contents.= $_row['Primary_AddressType1']."\t";
		 $contents.=$_row['Primary_BuldNo_addrss']." ".$_row['Primary_Area_addrss']." ".$_row['Primary_Landmark_addrss']."\t";
		 $contents.=$sql2fetch['City']."\t";
		
		 $contents.=$sql5fetch['state']."\t";
		 $contents.=$sql2fetch['Country']."\t";
		 $contents.=$sql2fetch['PinCode']."\t";
		 $contents.=$_row['Primary_DateOfBirth']."\t";
		 $contents.=$_row['Primary_MaritalStatus']."\t";
	*/


}

$contents = strip_tags($contents);

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
header("Content-Disposition: attachment; filename=mis.xls");
header("Content-Type: application/vnd.ms-excel");
print $contents;

?>