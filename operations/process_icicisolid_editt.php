<?php 
include("access.php");
include("config.php");

//echo "hello";


$qid=$_POST['qid'];
$updremark=$_POST['updr'];
$solid=$_POST['solid'];

$error="0";

$qry=mysqli_query($con,"select atm from quotation1 where id='".$qid."'");
$qrow=mysqli_fetch_array($qry);

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);


$qry2=mysqli_query($con,"select * from icici_quot_details where qid='".$qid."'");


$dt=date('Y-m-d H:i:s');

mysqli_query($con,"BEGIN");

$insqry=mysqli_query($con,"INSERT INTO `icici_solid_edit_history`( `qid`, `sol_id`, `reqby`, `entrydt`, `remark`) VALUES ('".$qid."','".$qrow[0]."','".$srno[0]."','".$dt."','".$updremark."')");
if(!$insqry)
{

$error++;
}


while($row=mysqli_fetch_array($qry2))
{


$insqry2=mysqli_query($con,"Insert into `icici_solid_edit_dethistory`(det_id,`qid`, `mat_grp`, `serv_no`, `mat_text`, `gprice`, `qnty`, `unit`, `amt`,remark)

values('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."',
'".$row[9]."')");
if(!$insqry2)
{

$error++;
}


}


$updqry=mysqli_query($con,"update quotation1 set atm='".$solid."' where id='".$qid."'");
if(!$updqry)
{

$error++;
}


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