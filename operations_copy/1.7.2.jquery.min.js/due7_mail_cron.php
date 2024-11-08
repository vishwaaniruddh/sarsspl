<?php 
include("config.php");

//====================== 1-For `DIE002_ebill`================================================================
$sql1= "SELECT * FROM `DIE002_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title> 
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='DIE002'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `DIE002_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry1=mail($to, $subject, $message, $headers);       	
	//if($mailqry1)
	//echo $tbl. "<br>";

//====================== 2-For `EUR08_ebill`================================================================
if($mailqry1){
$sql1= "SELECT * FROM `EUR08_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='EUR08'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `EUR08_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry2=mail($to, $subject, $message, $headers);       	
	//if($mailqry2)
	//echo $tbl. "<br>";
}
//====================== 3-For `FSS04_ebill`================================================================
if($mailqry2){
$sql1= "SELECT * FROM `FSS04_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='FSS04'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `FSS04_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry3=mail($to, $subject, $message, $headers);       	
	//if($mailqry3)
	//echo $tbl. "<br>";
}

//====================== 4-For `PRIZM07_ebill`================================================================
if($mailqry3){
$sql1= "SELECT * FROM `PRIZM07_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='PRIZM07'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `PRIZM07_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry4=mail($to, $subject, $message, $headers);       	
	//if($mailqry4)
	//echo $tbl. "<br>";
}
//====================== 5-For `Tata05_ebill`================================================================
if($mailqry4){
$sql1= "SELECT * FROM `Tata05_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
		$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='TATA05'");
		$emailary = array();
		
		while($emailrows = mysqli_fetch_assoc($ac_mail)) {
        $emailary[] = $emailrows['email'];
     	}
		$email_string = implode(",",$emailary);
		echo $email_string;
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `Tata05_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $email_string;	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry5=mail($to, $subject, $message, $headers);       	
	//if($mailqry5)
	//echo $tbl. "<br>";
}

//====================== 6-For `FIS03_ebill`================================================================
if($mailqry5){
$sql1= "SELECT * FROM `FIS03_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='FIS03,BTI'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `FIS03_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry6=mail($to, $subject, $message, $headers);       	
	//if($mailqry6)
	//echo $tbl. "<br>";
}

//====================== 7-For `AGS01_ebill`================================================================
if($mailqry6){
$sql1= "SELECT * FROM `AGS01_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='AGS01'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `AGS01_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry7=mail($to, $subject, $message, $headers);       	
	//if($mailqry7)
	//echo $tbl. "<br>";
}

//====================== 8-For `EPS_ebill`================================================================
if($mailqry7){
$sql1= "SELECT * FROM `EPS_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='EPS'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `EPS_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry8=mail($to, $subject, $message, $headers);       	
	//if($mailqry8)
	//echo $tbl. "<br>";
}
//====================== 9-For `NCR09_ebill`================================================================
if($mailqry8){
$sql1= "SELECT * FROM `NCR09_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='NCR09'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `NCR09_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry9=mail($to, $subject, $message, $headers);       	
	//if($mailqry9)
	//echo $tbl. "<br>";
}
//====================== 10-For `SBI_ebill`================================================================
if($mailqry9){
$sql1= "SELECT * FROM `SBI_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='SBI'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `SBI_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry10=mail($to, $subject, $message, $headers);       	
	//if($mailqry10)
	//echo $tbl. "<br>";
}
//====================== 11-For `TSIPL06_ebill`================================================================
if($mailqry10){
$sql1= "SELECT * FROM `TSIPL06_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='TSIPL06'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `TSIPL06_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry12=mail($to, $subject, $message, $headers);       	
	//if($mailqry1)
	//echo $tbl. "<br>";
}

//====================== 12-For `VS_ebill`================================================================
if($mailqry12){
$sql1= "SELECT * FROM `VS_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='VS'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `VS_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry13=mail($to, $subject, $message, $headers);       	
	//if($mailqry13)
	//echo $tbl. "<br>";
}
//====================== 13-For `Ratnakar_ebill`================================================================
if($mailqry13){
$sql1= "SELECT * FROM `Ratnakar_ebill` where `Due_Date` between ".date('d')." and ".(date('d')+7);
$res1=mysqli_query($con,$sql1);
$num=mysqli_num_rows($res1);
$tbl="<html>
<head>
<title>CNC INDIA</title>
</head>
<body>
<p><font color='blue'>ELECTRIC BILLS TO BE PAID WITHIN SEVEN (7) DAYS</font></p>
<table border='1' width='700px'>
<tr>
	<th>ATMID</th>
	<th>CONSUMER NO.</th>
	<th>DUE DATE</th>
	<th>CUSTOMER NAME</th>
	<th>BANK NAME</th>
	<th>CITY</th>
	<th>DISTRIBUTOR</th>
	<th>SUPERVISOR_NAME</th>
</tr>";
	//=select mail for A/c manager
	$ac_mail=mysqli_query($con,"select `email` from `account_manager` where `cust_id`='RATNAKAR'");
	$ac_mail1=mysqli_fetch_row($ac_mail);
	
	while($row = mysqli_fetch_row($res1)){	
	$cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `Ratnakar_sites` where `atm_id1`='".$row[3]."' and `ebill`='Y'");
	if(mysqli_num_rows($cust_detail)>0){
	$cust_detail1=mysqli_fetch_row($cust_detail);
	
	
  $tbl.="<tr>
		<td>".$row[3]."</td>
		<td>".$row[1]."</td>
		<td>".$row[4]."</td>
		<td>".$cust_detail1[0]."</td>
		<td>".$cust_detail1[2]."</td>
		<td>".$cust_detail1[1]."</td>
		<td>".$row[2]."</td>
		<td><b>".$cust_detail1[3]."</b></td>
	</tr>";	
	}
	} 
	$to = $ac_mail1[0];	
	$cc="satyendra1111@gmail.com";
	$subject = "WITHIN SEVEN DAYS ELECTRIC BILLS DUE DATE ";
	$tbl.="</table><br><br><font color='blue'>CNC INDIA </font> </body></html>";			 
	$headers = "From:<santosh@sarmicrosystems.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry14=mail($to, $subject, $message, $headers);       	
	//if($mailqry14)
	//echo $tbl. "<br>";
}

?>