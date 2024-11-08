<?php

inclumysqli_nfig.php");

$qry=mysql_query("Select distinct(bank) from ".$_GET['cid']."_sites where projectid='".$_GET['proj']."'");

?>mysqli_

<option value="">Select Bank</option>

<?php

while($row=mysql_fetch_array($qry))

{

?>

<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>

<?php

}

?>

<option value="">All</option>