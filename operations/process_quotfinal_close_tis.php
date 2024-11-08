<?php

include("access.php");
include("config.php");

$error=0;

$qid=$_POST['qid'];




$dt=$_POST['dt'];
$cmby=$_POST['comby'];
$rem=$_POST['rem'];
$cnt=$_POST['counts'];
//echo $qid;
//echo $qid."-".$cmby."-".$rem;






$file = $_FILES['email_cpy'.$cnt];
        $name = $file['name'];
        $mime = $file ['type'];
        $file_size = $file ['size'];
        $file_path = $file ['tmp_name'];
        $ext = $file['extension'];
       
  $fname="";
if($name!="")
{          
   //echo $mime;
$nrr=end(explode(".", $name));
//print_r($nrr);
     $fname=time().".".$nrr;

//echo $fname;


      $mv=move_uploaded_file ($file_path,"../operations/quotuploads_tis/close/".$fname);

                     if(!$mv)
                       {
       		        $error++;
                       }


}


$cldt="0000-00-00";
if($_POST['dt']!="")
{
$sdt=str_replace("/","-",$_POST['dt']);
$cldt=date("Y-m-d",strtotime($sdt));
}




//mysqli_query($con,"BEGIN");
$dt=date('Y-m-d H:i:s');

mysqli_query($con,"BEGIN");

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);


$qryc=mysqli_query($con,"insert into quotation_close_detail_tis(`qid`, `compl_date`, `compl_by`, `remark`, `entrydt`, `reqby`,filename) values('".$qid."','".$cldt."','".$cmby."','".$rem."','".$dt."','".$srno[0]."','".$fname."') ");

if(!$qryc)
{

$error++;
}
$upqr=mysqli_query($con,"update quotation1_tis set call_status='1' where id='".$qid."'");

if(!$upqr)
{

$error++;
}

if($error==0)
{
mysqli_query($con,"COMMIT");
echo " Closed";

}
else
{
mysqli_query($con,"ROLLBACK");
echo "Error";

}



?>
