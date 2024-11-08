<?php 
include('../config.php');
$name=$_GET['name'];
$phne=$_GET['phone'];
$center=$_GET['branch'];


//$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
//$max12=mysql_fetch_row($sq12);
$ini=substr($center,0,1);
//till here
$sq=mysql_query("select max(no) from `patient` where area='$center'");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;

$newsrno=$ini."-".$newpatid;

$d=date("Y-m-d");
//$sql="INSERT INTO `satyavan_clinicmgt`.`patient` (`no`,`srno`,`name`,`birth`, `sex`, `telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`refemail`,`reftel`,`refcity`,`specialist`,`tos`,`toscity`,`tostel`,`tosemail`,`paed`,`paedcity`,`paedtel`,`paedemail`,`phys`,`physcity`,`phystel`,`physemail`,`neu`,`neucity`,`neutel`,`neuemail`,`sw`,`swcity`,`swtel`,`swemail`,`ng`,`ngcity`,`ngtel`,`ngemail`,`area`,`remarks`,`reference`,`mobile2`,`photo`,`type`)values('$newpatid','$newsrno','$fname','$dob','$gender','$con12','$con22','$city','$address','$ref','$d','$email1','$email2','$email3','$cn','$city1','$spl','$tos','$toscity','$tostel','$tosemail','$paed','$paedcity','$paedtel','$paedemail','$phys','$physcity','$phystel','$physemail','$neu','$neucity','$neutel','$neuemail','$sw','$swcity','$swtel','$swemail','$ng','$ngcity','$ngtel','$ngemail','$center','$rem','$docref','$mob2','$newname','".$_POST['pattype']."')";
$sql="INSERT INTO `patient`(`no`,`srno`,`name`,`mobile`,`date`,`type`,`area`)values('$newpatid','$newsrno','$name','$phne','$d','nr','$center')";
//echo $sql;
$result=mysql_query($sql);
if($result)
{
$str=$newsrno;
}
else
$str=0;
echo json_encode($str);


?>