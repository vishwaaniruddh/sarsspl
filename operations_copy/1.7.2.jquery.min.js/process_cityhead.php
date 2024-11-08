<?php
include("config.php");
$subject = 'Your Login Details for CSS';
			
			$headers = "From: " .CSS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$c=0;
$name=array();
$cont=array();
$email=array();
$service='';
$servicecnt=0;
$totcnt=$_POST['cnt'];
/*for($i=0;$i<$totcnt;$i++)
{
if(isset($_POST['service']) && $_POST['service'][$i]!='')
{
if($c!=0)
$service=$service.",".$_POST['service'][$i];
else
$service=$_POST['service'][$i];

$c=$c+1;
}
}*/
 $city=$_POST['brcity'];
 $state=$_POST['state'];
 $badd=str_replace("'","\'",$_POST['bradd']);
 $bpin=$_POST['brpin'];
$id2=0;
$cnt=0;
$qry=mysqli_query($con,"INSERT INTO  `cssbranch` (`id`, `location`, `badd`, `city`, `pin`,`region`) VALUES (NULL, '".$state."', '".$badd."', '".$city."', '".$bpin."','".$_POST['st']."')");
$id=mysqli_insert_id();
for($i=0;$i<count($_POST['hname']);$i++)
{
if($_POST['hname'][$i]!='')
{

$name[]=$_POST['hname'][$cnt];
$cont[]=$_POST['cont'][$cnt];
$email[]=$_POST['email'][$cnt];
$cnt=$cnt+1;
}
}

if($cnt>0)
{
for($j=0;$j<$cnt;$j++)
{
//echo "hi";
if($j==0)
$auth='1';
else
$auth='2';
if(!preg_match('/^[0-9]{11}$/',$cont[$j]))
    {
     echo $cont[$j].' is Invalid Number! Please Insert Correct number';
    }
    else
    {
if (!filter_var($email[$j], FILTER_VALIDATE_EMAIL)) {
  echo "It Seems you Entered Invalid Email  Address ".$email[$j]." is invalid";
} else {
  $id2=0;
  unset($uname);
  $logid='';
//echo "INSERT INTO  `branch_head` (`head_id`, `head_name`, `city`, `email_id`, `phone_no1`, `phone_no2`, `state`, `add`, `pin`) VALUES (NULL, '".$name[$j]."', '".$city."', '".$email[$j]."', '".$cont[$j]."', NULL, '".$state."', '".$badd."', '".$bpin."')";
/*require_once('class_files/insert.php');
$in_obj=new insert();
$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','branch_head',array("head_name","city","email_id","phone_no1","add","state","pin"),array($name[$j],$city,$email[$j],$cont[$j],$badd,$state,$bpin));*/
$uname=explode(" ",$name[$j]);

$qr=mysqli_query($con,"select max(srno) from login");
$row=mysqli_fetch_row($qr);
//echo "<br>max id ".$row[0]." ".$uname[0];
$uid=$uname[0].($row[0]+1)."";
//echo "INSERT INTO  `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`) VALUES (NULL, '".$uid."', '".$uid."123', '".$area."', '4', '0')";
//echo "INSERT INTO  `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`) VALUES (NULL, '".$uid."', '".$uid."123', '".$state."', '3', '1')";
$login=mysqli_query($con,"INSERT INTO `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`,`serviceauth`,`deptid`) VALUES (NULL, '".$uid."', '".$uid."123', '".$id."', '11', '1','".$auth."','4')");
$message="UserID: ".$uid." Password: ".$uid."123";
$to=$email[$j];
mail($to, $subject, $message, $headers);
$logid=mysqli_insert_id();
//echo "INSERT INTO  `branch_head` (`head_id`, `branchid`, `head_name`, `email_id`, `phone_no1`, `phone_no2`,`loginid`) VALUES (NULL, '".$id."', '".$name[$j]."', '".$email[$j]."', '".$cont[$j]."', NULL,'".$logid."')";
if(!$login)
echo "".mysqli_error();
$in_obj=mysqli_query($con,"INSERT INTO  `branch_head` (`head_id`, `branchid`, `head_name`, `email_id`, `phone_no1`, `phone_no2`,`loginid`,`status`) VALUES (NULL, '".$id."', '".$name[$j]."', '".$email[$j]."', '".$cont[$j]."', NULL,'".$logid."','1')");

if($in_obj)
{
	header('Location:newcty_head.php');
}
else
echo "Error Creating Branch Head".mysqli_error();
}
}
}
header('Location:view_cityhead.php');
}
else
header('Location:view_cityhead.php');
?>