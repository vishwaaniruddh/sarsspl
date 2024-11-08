<?php 
include("access.php");
include("config.php");

//echo "hello";



$qid=$_POST['qid'];
$detailid=$_POST['detailid'];

$pr=$_POST['pr'];
$prc=$_POST['prc'];
$amt=$_POST['amt'];
$rate=$_POST['rate'];
$rem=$_POST['rem'];
$appby=$_POST['approvby'];

$tqtamt=$_POST['tqtamt'];

$appamt=$_POST['appamt'];


$tcode=$_POST['tcode'];

$descdet=$_POST['descdet'];

/*$fichier=$_FILES['email_cpy']['name']; 
echo $fichier;*/
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
$error=1;
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
$newname="../operations/quotuploads_tis/".$image_name;
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



//echo "ram".$qid.$detailid;

//$qry=mysqli_query($con,"select * from Rnm_quotation_details where id='".$detailid."' and qid='".$qid."'");
$qry=mysqli_query($con,"select * from quotation_details_tis where id='".$detailid."' and qid='".$qid."'");
$num=mysqli_num_rows($qry);

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);

$dt=date('Y-m-d H:i:s');
if($num>0)
{
$row=mysqli_fetch_array($qry);
mysqli_query($con,"BEGIN");


$insqry=mysqli_query($con,"Insert into quotation_edit_history_tis(`qid`, `quotationdetails_id`, `particular`, `description`, `quantity`, `rate`, `total`,`Quot_amt`, `reqby`, `entrydate`, `status`,`remark`, `filename`,tcode,uom)values('".$qid."','".$detailid."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$tqtamt."','".$srno[0]."','".$dt."','u','".$rem."','".$image_name."','".$row[7]."','".$row[8]."')");
if(!$insqry)
{

$error++;
}

$upqry=mysqli_query ("Update quotation_details_tis SET `description`='".$pr."',`quantity`='".$prc."',`rate`='".$rate."',`total`='".$amt."',tcode='".$tcode."',uom='".$descdet."' where id='".$detailid."' and qid='".$qid."'");


//$upqry=mysqli_query ("Update Rnm_quotation_details SET `description`='".$pr."',`quantity`='".$prc."',`rate`='".$rate."',`total`='".$amt."',tcode='".$tcode."',uom='".$descdet."' where id='".$detailid."' and qid='".$qid."'");
if(!$upqry)
{

$error++;
}
/*  $sumoftotal=mysqli_query($con,"Select sum(Total) from Rnm_quotation_details where qid='".$qid."' ");
 $Fetchsumoftotal= mysqli_fetch_array($sumoftotal);
  echo "Update rnm_invoice_details SET `ApprovalAmount`='".$Fetchsumoftotal[0]."' where  qid='".$qid."'";
//$upqry=m
$upqry=mysqli_query ("Update rnm_invoice_details SET `ApprovalAmount`='".$Fetchsumoftotal[0]."' where  qid='".$qid."'");

 */ 
  
  
    if($error==0)
     {
     mysqli_query($con,"COMMIT");
    echo "Record Updated";

    }
   else
   {
    mysqli_query($con,"ROLLBACK");
    echo "Error";

    }
}
else
{
echo "No such record";
}



?>