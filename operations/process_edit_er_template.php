<?php

session_start();

if(!$_SESSION['user'])

header('location:index.php');

include("config.php");



if(isset($_POST['Submit']))

{mysqli_query($con,

	

	$tmt_id=$_POST['tmt_id'];

	$atmid=$_POST['mysqli_query($con,

	$trackid=$_POST['trackid'];

	$amt=$_POST['amt'];

	$dt=date('Y-m-d H:i:smysqli_query($con,

	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");

	$srno=mysqli_fetch_row($sr);

	
mysqli_query($con,
	for($i=0;$i<$_POST['counter'];$i++){

		if($atmid[$i]!=""){

			//echo "<br/><br/>select * from recharge_template_details where tmt_id='".$tmt_id."' and atm_id='".$atmid[$i]."' and tracker_id='".$trackid[$i]."'";

			$ifexist_qry=mysqli_query($con,"select * from recharge_template_details where tmt_id='".$tmt_id."' and atm_id='".$atmid[$i]."' and tracker_id='".$trackid[$i]."'");

			$ifexist_row=mysqli_fetch_array($ifexist_qry);

			//echo $ifexist_row['amount']." ".$amt[$i];

			if(mysqli_num_rows($ifexist_qry)>0 ){

				if($ifexist_row['amount']!=$amt[$i]){

					//echo "<br/>UPDATE `recharge_template_details` SET `amount`='".$amt[$i]."' where tmt_id='".$tmt_id."' and atm_id='".$atmid[$i]."' and tracker_id='".$trackid[$i]."'";

					$update_qry_quot=mysqli_query($con,"UPDATE `recharge_template_details` SET `amount`='".$amt[$i]."', `updatedon` = '$dt', `updatedby`='$srno[0]' where tmt_id='".$tmt_id."' and atm_id='".$atmid[$i]."' and tracker_id='".$trackid[$i]."'");

					if(!$update_qry_quot)

						echo mysqli_error();

				}

			}

			else{

				//echo "<br/>INSERT INTO `recharge_template_details` ( `tmt_id`, `atm_id`, `tracker_id`, `amount`, `createdon`, `createdby`) VALUES ('".$tmt_id."', '".$atmid[$i]."', '".$trackid[$i]."', '".$amt[$i]."', '".$dt."', '".$srno[0]."');";

				$insert_qry_quot=mysqli_query($con,"INSERT INTO `recharge_template_details` ( `tmt_id`, `atm_id`, `tracker_id`, `amount`, `createdon`, `createdby`) VALUES ('".$tmt_id."', '".$atmid[$i]."', '".$trackid[$i]."', '".$amt[$i]."', '".$dt."', '".$srno[0]."');");

				if(!$insert_qry_quot)

					echo mysqli_error();

			}

		}

	}

	header('location:view_er_template.php');

}

?>