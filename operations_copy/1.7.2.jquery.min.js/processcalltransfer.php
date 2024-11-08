<?php

if(isset($_POST['cmdsub']))

{

if(isset($_POST['branch'])&& $_POST['branch']!='0')

{

include("access.php");

inclumysqli_query($con,hp");

$state=$mysqli_query($con,h'];

$br=$_POST['br'];

$alertid=$_POST['alertid'];

$cmnt=$_POST['frmcmnt'];

//echo "hiiii";

$qry=mysqli_query($con,"INSERT INTO `satyavan_accounts`.`transfersites` (`id`, `frombranch`, `tobranch`, `alertid`, `approval`, `frmdesc`, `todesc`, `status`,`date`) VALUES (NULL, '".$br."', '".$state."', '".$alertid."', '0', '".$cmnt."', '', '0','".date('Y-m-d h:i:s')."')");

//echo "update alert set transapp='1' where alert_id='".$alertid."'";

$update=mysqli_query($con,"update alert set transapp='1' where alert_id='".$alertid."'");

if($qry)

{

?>

<script type="text/javascript">

alert("Alert transferred successfully and is waiting from approval");

window.close();

</script>

<?php

}

}

else

header('location:view_alert.php');

}

else

header('location:view_alert.php');

?>