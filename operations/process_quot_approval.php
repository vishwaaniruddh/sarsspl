<?php 
include("access.php");
include("config.php");



$qid=$_POST['qid'];
$rem=$_POST['rem'];
$appby=$_POST['approvby'];
$appamt=$_POST['appamt'];
$Expectappamt=$_POST['Expectappamt'];
$wbs=$_POST['wbs'];
$vpr=$_POST['vpr'];
$jid=$_POST['jid'];
$pcode=$_POST['pcode'];

$reqamt=$_POST['reqamt'];
$tno=$_POST['tno'];
$refno=$_POST['refno'];

$svn=$_POST['svn'];


//$dat=$_POST['date1'];
$appdate="0000-00-00";
if($_POST['date1']!="")
{
$sdate=str_replace("/","-",$_POST['date1']);
$appdate=date("Y-m-d",strtotime($sdate));
}


$error=0;

$image_name='';
$maxsize='2140';
//$_FILES['email_cpy']['name'];
$size=($_FILES['email_cpy']['size']/1024);

if($_FILES['email_cpy']['name']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{

echo "Your file size is ".$size."File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
$error++;
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['email_cpy']['name']; 

//echo $fichier;
 function getExtension1($str)
 {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
 }
	
	//echo $fichier;
if($fichier){
//echo "hi" ;
$filename = stripslashes($_FILES['email_cpy']['name']);
//echo $filename;
			//get the extension of the file in a lower case format
				$extension = getExtension1($filename);
				$extension = strtolower($extension);
				//echo $extension;
				$image_name=time().'.'.$extension;
				//echo $image_name;
$newname="../operations/quotuploads/approve/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['email_cpy']['tmp_name'], $newname);


if (!$copied) 
{
	echo "<h1>Copy unsuccessfull!</h1>";
		$error++;
}
}

//echo $newname;

}


}


$dt=date('Y-m-d H:i:s');

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);

mysqli_query($con,"BEGIN");

//echo "INSERT INTO `quotation_approve_details`(`qid`, `wbs`, `vpr`, `job`, `prime`, `remark`, `app_by`, `filename`, `app_amt`, `reqby`, `entrydate`,`approved_date`,req_amt,ticket_no,ref_no,expectedApprovalAmt) values('".$qid."','".$wbs."','".$vpr."','".$jid."','".$pcode."','".$rem."','".$appby."','".$image_name."','".$appamt."','".$srno[0]."','".$dt."','".$appdate."','".$reqamt."','".$tno."','".$refno."','".$Expectappamt."')";
$qryins=mysqli_query($con,"INSERT INTO `quotation_approve_details`(`qid`, `wbs`, `vpr`, `job`, `prime`, `remark`, `app_by`, `filename`, `app_amt`, `reqby`, `entrydate`,`approved_date`,req_amt,ticket_no,ref_no,expectedApprovalAmt) values('".$qid."','".$wbs."','".$vpr."','".$jid."','".$pcode."','".$rem."','".$appby."','".$image_name."','".$appamt."','".$srno[0]."','".$dt."','".$appdate."','".$reqamt."','".$tno."','".$refno."','".$Expectappamt."')");

if(!$qryins)
{
$error++;
}

if($wbs!="" || $vpr!="" || $jid!="" || $pcode!=""|| $tno!="" || $refno!="")
{
$qryupf=mysqli_query($con,"UPDATE quotation1 set status='app' where id='".$qid."'");
if(!$qryupf)
{
$error++;
}

}
else
{
$qryup=mysqli_query($con,"UPDATE quotation1 set status='a' where id='".$qid."'");
if(!$qryup)
{
$error++;
}
}


if($svn!=-1)
{
$qryup2=mysqli_query($con,"UPDATE quotation1 set supervisor='".$svn."' where id='".$qid."'");
if(!$qryup2)
{
$error++;
}
}



if($error==0)
{
mysqli_query($con,"COMMIT");
echo "Approved";
}
else

{
echo "error";
//echo mysqli_error();
mysqli_query($con,"ROLLBACK");
}







?>