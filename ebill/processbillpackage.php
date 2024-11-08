<?php
session_start();
include("access.php");
include("config.php");

$atmid = $_POST['atmidf'];
$srnum= $_POST['srnof'];
$trackid=$_POST['trackerf'];
$supervisor=$_POST['supf'];
$podno=$_POST['podf'];
$name=$_POST['namef'];
$rc=$_POST['rcf'];
$dc=$_POST['dcf'];
$sd=$_POST['sdf'];
$duedtchrg=$_POST['latef'];
$amt=$_POST['amtf'];
$tamt=$_POST['tamtf'];

$pdate=$_POST['pdate'];






//print_r($pdate);

/*
echo "atmcnt=".count($atmid);
print_r($atmid);

echo "srn=".count($srnum);
print_r($srnum);

echo "track=".count($trackid);

echo "sup=".$supervisor;

echo "pod=".$podno;

echo "name=".$name;

echo "rc=".count($rc);
print_r($rc);

echo "dc=".count($dc);
print_r($dc);

echo "sc=".count($sd);
print_r($sd);

echo "late=".count($duedtchrg);
print_r($duedtchrg);

echo "amt=".count($amt);
print_r($amt);

echo "tamt=".count($tamt);
print_r($tamt);


*/



//echo "select srno from login where username='".$_SESSION['user']."'";

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_row($srqry);
			//echo $srno[0];
$dt=date('Y-m-d H:i:s');


$counter=0;

try
{


mysqli_query($con,"BEGIN");



/*echo "INSERT INTO `ebill_package` (`pod`, `received_from`, `supervisor_id`, `atm_id`, `rc`, `dc`, `sd`,`Due_date_charges`, `amount`, `total_amount`,`tracker_id`,`req_by`,`entrydate`) 
values('".$podno."','".$name."','".$supervisor."','".$atmid[$i]."','".$rc[$i]."','".$dc[$i]."','".$sd[$i]."','".$duedtchrg[$i]."','".$amt[$i]."',
'".$tamt[$i]."','".$trackid[$i]."','".$srno[0]."','".$dt."')";*/



for($i=0;$i<count($atmid);$i++)
{

if($atmid[$i]!="")
{
$pdatef="0000-00-00";
if($pdate[$i]!="")
{
$pdatearr=explode('-',$pdate[$i]);
$pdatef=$pdatearr[2]."-".$pdatearr[1]."-".$pdatearr[0];
}

$qry=mysqli_query($con,"INSERT INTO `ebill_package` (`pod`, `received_from`, `supervisor_id`, `atm_id`, `rc`, `dc`, `sd`,`Due_date_charges`, `amount`, `total_amount`,`tracker_id`,paid_date,`req_by`,`entrydate`) 
values('".$podno."','".$name."','".$supervisor."','".$atmid[$i]."','".$rc[$i]."','".$dc[$i]."','".$sd[$i]."','".$duedtchrg[$i]."','".$amt[$i]."',
'".$tamt[$i]."','".$trackid[$i]."','".$pdatef."','".$srno[0]."','".$dt."')");



//echo "times=".$i;



if(!$qry)
{
$counter++;
}


}

}
if($counter==0)
{
mysqli_query($con,"COMMIT");
echo "entry successfull";
//echo "<div align='center'>"."Entry successfull"."</div>";
//echo "<div align='center'>".'<p><a href="ebillpackageentry.php" >'.Back. '</a></p>'."</div>";

}
else
{
mysqli_query($con,"ROLLBACK");

echo "Error";
//echo "<div align='center'>"."Error"."</div>";
//echo "<div align='center'>".'<p><a href="ebillpackageentry.php" >'.Back. '</a></p>'."</div>";

}

}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}



?>