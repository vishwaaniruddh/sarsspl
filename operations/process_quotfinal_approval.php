<?php

include("access.php");
include("config.php");

$Expectappamt=$_POST['Expectappamt'];

$rem=$_POST['rem'];
$appby=$_POST['approvby'];
$qid=$_POST['qid'];
$appamt=$_POST['appamt'];
$wbs=$_POST['wbs'];
$vpr=$_POST['vpr'];
$jid=$_POST['jid'];
$pcode=$_POST['pcode'];

$reqamt=$_POST['reqamt'];
$tno=$_POST['tno'];
$refno=$_POST['refno'];
$svn=$_POST['svn'];

$appdate="0000-00-00";
if($_POST['date1']!="")
{
$sdate=str_replace("/","-",$_POST['date1']);
$appdate=date("Y-m-d",strtotime($sdate));
}

//echo $qid;
//echo $appamt."-".$wbs."-".$vpr."-".$jid."-".$pcode;

$error=0;

$image_name='';
$maxsize='2140';

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




mysqli_query($con,"BEGIN");


if($Expectappamt==""){
    $qryup=mysqli_query($con,"UPDATE quotation_approve_details set app_amt='".$appamt."',wbs='".$wbs."',vpr='".$vpr."',job='".$jid."',prime='".$pcode."',req_amt='".$reqamt."',ticket_no='".$tno."',ref_no='".$refno."' where qid='".$qid."'");

}else{
    $qryup=mysqli_query($con,"UPDATE quotation_approve_details set app_amt='".$appamt."',wbs='".$wbs."',vpr='".$vpr."',job='".$jid."',prime='".$pcode."',req_amt='".$reqamt."',ticket_no='".$tno."',ref_no='".$refno."',filename='".$image_name."',`remark`='".$rem."',approved_date='".$appdate."',app_by='".$appby."' where qid='".$qid."'");

}


if(!$qryup)
{
$error++;
}

if($wbs!="" || $vpr!="" || $jid!="" || $pcode!="" || $tno!="" || $refno!="" )
{
$qryup2=mysqli_query($con,"UPDATE quotation1 set status='app' where id='".$qid."'");
if(!$qryup2)
{
$error++;
}
}

if($svn!=-1)
{
$qryup3=mysqli_query($con,"UPDATE quotation1 set supervisor='".$svn."' where id='".$qid."'");
if(!$qryup3)
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