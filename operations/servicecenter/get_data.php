<?php

include('config.php');

//$ref=$_GET['ref'];
$atm=$_GET['atm'];
//if($ref=="df"){

$qry="SELECT `cust_id`,`bank_name`,`state`,`city`,`address`,`pincode`,`area` FROM `atm` WHERE `atm_id`='$atm'";
$res=mysql_query($qry);
$row = mysql_fetch_row($res);
//echo $row[4];
		
$str=$row[0]."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4]."#".$row[5]."#".$row[6];

//}


/*else if($ref=="sw"){

 $qry="SELECT `CITY`,`MOBILE`, `EMAIL` FROM   `social`  WHERE `social_id`='$docref'";
 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		
		$str=$row[0]."#".$row[1]."#".$row[2];

}else if($ref=="ng"){

 $qry="SELECT `mobile`, `city`, `email`  FROM `ngo` WHERE `ngo_id`='$docref'";
 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		
		$str=$row[0]."#".$row[1]."#".$row[2];
}*/
					
echo $str;
?>