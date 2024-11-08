<?php

include("config.php");

$cid=$_mysqli_cid'];
mysqli_
$atm=$_POST['atmid'];
mysqli_
$query=mysql_query("select bank,projectid,housekeeping,caretaker,maintenance,ebill,csslocalbranch,site_id,site_type,atmsite_address,state,city,zone,region,location,takeover_date,hsupervisor_name,super_contact,cust_remarks,trackerid from ".$cid."_sites where atm_id1='".$atm."'");

if(mysql_num_rows($query)>0)

{

$row=mysql_fetch_row($query);

echo $row[0]."****".$row[1]."****".$row[2]."****".$row[3]."****".$row[4]."****".$row[5]."****".$row[6]."****".$row[7]."****".$row[8]."****".$row[9]."****".$row[10]."****".$row[11]."****".$row[12]."****".$row[13]."****".$row[14]."****".date('d/m/Y',strtotime($row[15]))."****".$row[16]."****".$row[17]."****".$row[18]."****".$row[19];





}

else

echo "0";

?>