<?php 
include("access.php");
include("config.php");

//echo "hello";



$qid=$_POST['qid'];
$detailid=$_POST['detailid'];
$updremark=$_POST['updremark'];
$tqtamt=$_POST['tqtamt'];








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



//echo $qid.$detailid;

$qry=mysqli_query($con,"select * from icici_quot_details_tis where id='".$detailid."' and qid='".$qid."'");
$num=mysqli_num_rows($qry);

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);

$dt=date('Y-m-d H:i:s');
if($num>0)
{
$row=mysqli_fetch_array($qry);
mysqli_query($con,"BEGIN");






$updremark=$_POST['updremark'];
$tqtamt=$_POST['tqtamt'];



$insqry=mysqli_query($con,"Insert into `quotation_iciciedit_history_tis`(det_id,`qid`,`mat_grp`, `serv_no`, `mat_text`, `gprice`, `qnty`, `unit`, `amt`, `quot_tot_amt`, `remark`, `reqby`, `entrydt`,update_remark,status,filename)

values('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$tqtamt."',
'".$row[9]."','".$srno[0]."','".$dt."','".$updremark."','d','".$image_name."')");
if(!$insqry)
{

$error++;
}




$upqry=mysqli_query($con,"DELETE FROM icici_quot_details_tis where id='".$detailid."' and qid='".$qid."'");
if(!$upqry)
{

$error++;
}
  
  
  
  
    if($error==0)
     {
     mysqli_query($con,"COMMIT");
    echo "Record Deleted";

    }
   else
   {
    mysqli_query($con,"ROLLBACK");
    echo "error";

    }
}
else
{
echo "No such record";
}



?>