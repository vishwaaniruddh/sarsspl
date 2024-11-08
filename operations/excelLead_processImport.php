<?php session_start();?>
<html>
 <head>
    <!-- <script type="text/javascript" src="1.7.2.jquery.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
     
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  
 </head>
<body>


<?php
include("config.php");
$getqid="";
$cmnth=date('M');
	function fromExcelToLinux($excel_time) {
    return ($excel_time-25569)*86400;
}


$mnthno=date('m');

$counter=0;
require_once 'Excel/reader.php';
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

$maxsize='800';

$size=($_FILES['userfile']['size']/1024);

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
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
				
$newname="excel_img_quo/".$image_name;
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

//echo $data->sheets[0]['numRows'];die;

for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";
 
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
	
		
	}
//	echo '<pre>';print_r($ab);echo '</pre>';die;
   $exclError='2';
    $exclreason='';

 $dt=date('Y-m-d H:i:s');
$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);

$cust=$ab[1];
if($cust!=''){

if($srno[0]!="")
{
   
$yr="";
if($mnthno>=4)
{
$yr=date('Y') .'-'. (date('y')+1);
}
elseif($mnthno<4)
{

$yr=(date('Y')-1) .'-'.date('y');
}


 
    
    mysqli_query($con,"LOCK TABLES quotation1,".$cust."_sites WRITE");


$getmaxno=mysqli_query($con,"select max(qno) from quotation1 where cust='".$cust."' and month='".$cmnth."' and year='".$yr."'");
$qryr=mysqli_fetch_array($getmaxno);
$numrows=mysqli_num_rows($getmaxno);






$qno="";
if($qryr[0]!=NULL)
{

$qno=$qryr[0]+1;
}
else
{
$qno=1;

}

//echo "select cust_name from  ".$cust."_sites where cust_id='".$cust."' ";

if($ab[21]!="" ){
$app_DATE = fromExcelToLinux($ab[21]); 
$AppvDate=date("Y-m-d",$app_DATE);
}else{$AppvDate='0000-00-00';}

//$AppvDate=date("Y-m-d",strtotime($ab[21]));

if($ab[1]!=""){
               
$qrynm=mysqli_query($con,"select cust_name from  ".$cust."_sites where cust_id='".$cust."' limit 1 ");
                  $qname=mysqli_fetch_array($qrynm);

$quotid="CSS/".$qname[0]."/".sprintf("%02d", $qno)."/".$cmnth."/".$yr;


if($ab[16]!=""){

	 $result= "insert into quotation1(quot_id,cust,atm,bank,project_id,location,city,state,supervisor,reqby,entrydate,`category`, `month`,`year`, `qno`,status) values('".$quotid."','".$ab[1]."','".$ab[2]."','".$ab[3]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$ab[7]."','".$ab[8]."','".$srno[0]."','".$dt."','".$ab[9]."','".$cmnth."','".$yr."','".$qno."','app')";
}else{
    $result= "insert into quotation1(quot_id,cust,atm,bank,project_id,location,city,state,supervisor,reqby,entrydate,`category`, `month`,`year`, `qno`,status) values('".$quotid."','".$ab[1]."','".$ab[2]."','".$ab[3]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$ab[7]."','".$ab[8]."','".$srno[0]."','".$dt."','".$ab[9]."','".$cmnth."','".$yr."','".$qno."','a')";
}

	 $runresult=mysqli_query($con,$result);
	 $getqid=mysqli_insert_id($con);
  //  echo $getqid."---".$result;
	  $qryins=mysqli_query($con,"INSERT INTO `quotation_approve_details`(`qid`, `wbs`, `vpr`, `job`, `prime`, `remark`, `app_by`, `filename`, `app_amt`, `reqby`, `entrydate`,`approved_date`,req_amt,ticket_no,ref_no,expectedApprovalAmt) values('".$getqid."','','','','','".$ab[10]."','".$ab[22]."','','".$ab[16]."','".$srno[0]."','".$dt."','".$AppvDate."','".$ab[17]."','".$ab[23]."','','".$ab[24]."')");
	  

}

if($getqid!=""){
    $sql=mysqli_query($con,"INSERT INTO `quotation_details`(`qid`, `particular`, `description`, `quantity`, `rate`, `Total`,tcode,uom,ServiceTax) values('".$getqid."','".$ab[11]."','".$ab[12]."','".$ab[13]."','".$ab[14]."','".$ab[15]."','".$ab[18]."','".$ab[19]."','".$ab[20]."')");
}
  	 
	 mysqli_query($con,"UNLOCK TABLES");
}
	 
		 if(!$runresult){
		 echo "failed".mysqli_error();
		 }else{
		     ?>
		     
		     <script type="text/javascript">
		     /*
		      swal({
  title: "Success!",
  text: "Thank you, Data uploaded Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
 
    window.open("excelLeadImport.php","_self");
    
  } 
});

*/

     swal("Success!", "Thank you, Data uploaded Successfully.!", "success");
        
                   setTimeout(function(){ 
                      window.location.href="excelLeadImport.php";
                   }, 3000);
        
     
		     

</script>
		  <?   
		 }

   }
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