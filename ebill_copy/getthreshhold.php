<?php

	include('config.php');
mysqli_
	//emysqli_ELECT threshhold FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['bank']."' and bank='".$_REQUEST['proj']."'";

	$chck_qmysqli_ql_query("SELECT threshhold FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['proj']."' and bank='".$_REQUEST['bank']."'");

	if(mysql_num_rows($chck_qry)>0)

	{

		$chck=mysql_fetch_array($chck_qry);

		echo "y###$$$".$chck[0];

	}

	else

		echo "n";

?>