<?php

include("config.php");

$stat=$_GET['stat'];

$id=mysqli_'id'];
mysqli_
if($stat=='3')
mysqli_
{mysqli_

$qr=mymysqli_ery("select * from uploadedebillerr where id='".$id."'");
mysqli_
$qrro=mysqli_fetch_row($qr);



$cl=mysqli_query($con,"select short_name from contacts where short_name='".$qrro[15]."'");

if(mysql_num_rows($cl)>0)

{mysqli_

$clro=mysql_fetch_row($cl);

$qry=mysql_query("INSERT INTO `ebdetails` (`bill_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `print`, `due_date`, `opening_reading`, `closing_reading`, `extracharge`, `entrydt`, `cust_id`) VALUES (NULL, '".$qrro[1]."', '".$qrro[5]."', '".$qrro[10]."', '".$qrro[11]."', 'paid', '".$qrro[6]."', '".$qrro[7]."', 'w', '".$qrro[9]."', '".$qrro[10]."', '".$qrro[11]."', '".$qrro[12]."', CURRENT_TIMESTAMP, '".$clro[0]."')");

$ebid=mysql_insert_id();

if($qry)

{



$up=mysql_query("update uploadedebillerr set `status`='".$stat."',ebid='".$ebid."' where id='".$id."'");

echo "1";

}

else

echo "0".mysql_error();

}

else

echo "Customer ID invalid";

}



?>