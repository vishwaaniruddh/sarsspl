<?php session_start();

set_time_limit(3600);
ini_set('memory_limit', '-1');
?>
<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>


<?php

include("config.php");
$getqid="";

	
	function fromExcelToLinux($excel_time) {
    return ($excel_time-25569)*86400;
}



$counter=0;
require_once 'Excel/reader.php';
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

$maxsize='3000';

$size=($_FILES['userfile']['size']/1024);

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","1000"); 
 
$fichier=$_FILES['userfile']['name']; 

 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
	
if($fichier){
	
$filename = stripslashes($_FILES['userfile']['name']);

			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img_quo_transfer/".$image_name;
	///echo $newname;	

$copied = copy($_FILES['userfile']['tmp_name'], $newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;


$data->read($newname);


error_reporting(E_ALL ^ E_NOTICE);
$ab=array();
$contents='';

for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";
 
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
	
		
	}
	

if($ab[3]!="" && $ab[3]!="-"){	
$REQUEST_RECEIVED_DATE = fromExcelToLinux($ab[3]); 
$reci_date=date("Y-m-d",$REQUEST_RECEIVED_DATE);
}else{$reci_date='0000-00-00';}		
		
if($ab[4]!="" && $ab[4]!="-"){		
$SOFTWARE_ENTRY_DATE = fromExcelToLinux($ab[4]); 
$entry_date=date("Y-m-d",$SOFTWARE_ENTRY_DATE);
}else{$entry_date='0000-00-00';}

if($ab[27]!="" && $ab[27]!="-"){
$TRANSFER_DATE = fromExcelToLinux($ab[27]); 
$trans_da=date("Y-m-d",$TRANSFER_DATE);
}else{$trans_da='0000-00-00';}

if($ab[28]!="" && $ab[28]!="-"){
$RETRUNED_DATE = fromExcelToLinux($ab[28]); 
$return_dt=date("Y-m-d",$RETRUNED_DATE);
}else{$return_dt='0000-00-00';}

/*$excel_date2 = $ab[4]; //here is that value 41621 or 41631
$unix_date2 = ($excel_date2 - 25569) * 86400;
$excel_date2 = 25569 + ($unix_date2 / 86400);
$unix_date2 = ($excel_date2 - 25569) * 86400;
 gmdate("Y-m-d", $unix_date2);
	*/
	

 
	 $result= "insert into Online_TransferData(MAIL_BY,REQUEST_BY,REQUEST_RECEIVED_DATE,SOFTWARE_ENTRY_DATE,PAYMENT_IDENTIFIER,CATEGORIES,PAYEE_TYPE,PAYROLL_NO_PAYROLL,EMP_CODE,AMOUNT,BENEFICIARY_NAME,`BENE_ACCOUNT_NUMBER`, `DISCRIPTION`,`DEBIT_ACCOUNT_NUMBER`, `CSS_LOCAL_BRANCH`,IFSC_CODE,RECEIVER_AC_TYPE,SUP_NAME,VERTICAL,CUSTOMER,BANK,ATMID,MONTH,BATCH_NO,BATCH_STATUS,FINAL_STATUS,TRANSFER_DATE,`RETRUNED_DATE`,REMARK,OWNER) values('".$ab[1]."','".$ab[2]."','".$reci_date."','".$entry_date."','".$ab[5]."','".$ab[6]."','".$ab[7]."','".$ab[8]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[13]."','".$ab[14]."','".$ab[15]."','".$ab[16]."','".$ab[17]."','".$ab[18]."','".$ab[19]."','".$ab[20]."','".$ab[21]."','".$ab[22]."','".$ab[23]."','".$ab[24]."','".$ab[25]."','".$ab[26]."','".$trans_da."','".$return_dt."','".$ab[29]."','".$ab[30]."')";

//echo $result;
	 $runresult=mysqli_query($con,$result);

}


  
	 
		 if(!$runresult){
		 echo "failed".mysqli_error();
		 }else{
		     ?>
		     
		     <script type="text/javascript">
		     
		      swal({
  title: "Success!",
  text: "Thank you, Data uploaded Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
 
    window.open("excelDataImport.php","_self");
    
  } 
});
     
		     

</script>
		  <?   
		 }



 }

if(count($err)>0)
{
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=rejectedsites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  //echo "<br>";
echo "<script type='text/javascript'>window.location='excelLeadImport.php';</script>";

}
else
{
?>

<?php
}

?>