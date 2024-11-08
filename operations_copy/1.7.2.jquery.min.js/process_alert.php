<?php

session_start();

$atm=$_POST['ref_id'];

$cust=$_POST['cust'];

$bank=$_POST['bank'];

$state=$_POST['state'];

$city=$_POST['city'];

$area=$_POST['area'];

$add=$_POST['address'];

$pin=$_POST['pin'];

$adate=$_POST['adate'];

///$cdate=$_GET['cdate'];

$prob=$_POST['prob'];

$cname=$_POST['cname'];

$cphone=$_POST['cphone'];

$cemail=$_POST['cemail'];

$call=$_POST['call'];

$cdate = date('Y-m-d H:i:s');

$po=$_POST['po'];

$asset=$_POST['asset'];

$qty=$_POST['qty'];

//echo $_SESSION[user];
mysqli_query($con,
//$by=
mysqli_query($con,


include('class_files/insert.php');

$in_obj=new insert();

includemysqli_query($con,");

$buy=0;

$bdesc='';

if(isset($_POST['buybk']))

{mysqli_query($con,

$buy=1;


mysqli_query($con,
if (preg_match('/[\'^�$%&*()}{@#~?><>,|=_+�-]/', $_POST['buybkdesc']))

{
mysqli_query($con,
   $bdesc=str_replace("'","\'",$_POST['buybkdesc']);

}

else

$bdesc=$_POST['buybkdesc'];

}





//echo "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`) Values('".$cust."','".$atm."','".$bank."','".$area."','".$add."','".$city."','".$state."','".$pin."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$adate."','Pending','new','".$cdate."','".$po."')";

$qry2=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

$qrr=mysqli_query($con,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");

	$num=mysqli_num_rows($qrr);

	$num2=$num+1;

	if($num2>0 && $num2<=9)

	$num3="0".$num2;

	else

	$num3=$num2;

$query=mysqli_query($con,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`buyback`,`createdby`) Values('".$cust."','".$atm."','".$bank."','".$area."','".$add."','".$city."','".$state."','".$pin."','".$prob."','".$cname."','".$cphone."','".$cemail."',STR_TO_DATE('".$adate."','%d/%m/%Y'),'Pending','new','".$cdate."','".$po."','".$state."','".$buy."','".$qry2ro[0]."_".date("Ymd").$num3."')");



if(!$query)

echo "failed".mysqli_error();



/*$tab=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert',array("cust_id","atm_id","bank_name","area","address","city","state","pincode","problem","caller_name","caller_phone","caller_email","alert_date","call_status","alert_type","entry_date","po"),array($cust,$atm,$bank,$area,$add,$city,$state,$pin,$prob,$cname,$cphone,$cemail,$adate,'Pending','New Installation',$cdate,$po));*/

$id=mysqli_insert_id();

if($buy=='1')

$buyback=mysqli_query($con,"INSERT INTO `satyavan_accounts`.`buyback` (`id`, `alertid`, `desc`, `status`) VALUES (NULL, '".$id."', '".$bdesc."', '0')");



//echo "INSERT INTO `satyavan_accounts`.`buyback` (`id`, `alertid`, `desc`, `status`) VALUES (NULL, '".$id."', '".$bdesc."', '0')";



//echo "Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$id."' where alert_id='".$id."'";

//$up=mysqli_query($con,"Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$id."' where alert_id='".$id."'");





//echo "Update alert set `createdby`='".$_SESSION[user]."'_'".$id."' where alert_id='".$id."'";

//$sq=mysqli_query($con,"select max(alert_id) from alert");

//$ro=mysqli_fetch_row($sq);



for($i=0;$i<count($asset);$i++){

echo "<br>".$asset[$i]." ".$qty[$i];

$tab1=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert_assets',array("alert_id","po","assets","qty"),array($id,$po,$asset[$i],$qty[$i]));

}



if($query)

{

//echo $atm;

?>

<script type="text/javascript">

alert("Alert created successfully and complaint number is <?php echo $qry2ro[0]."_".date("Ymd").$num3; ?>");

window.location='newalert.php';

</script>

<?php

	//header('Location:newalert.php');

}

else

echo "Error Creating Alert".mysqli_error();

?>