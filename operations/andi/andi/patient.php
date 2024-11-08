<?php
include("../config.php");
$qry=mysql_query("select name,srno from patient");
while($row=mysql_fetch_row($qry))
{
$str[]=array('patient'=>$row[0],'id'=>$row[1]);

}
echo json_encode($str);
?>