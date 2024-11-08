<?php
include("config.php");
$err=0;

for($i=0;$i<count($_POST["slot"]);$i++)
{
$qr="insert into ads_slot_amount(`slot_type`, `amount`,date_time) values('".$_POST["slot"][$i]."','".$_POST["amt"][$i]."','".date("Y-m-d H:i:s")."')";
$exwcq=mysql_query($qr);
if(!$exwcq)
{
    
  $err++;  
    
}

}

if($err==0)
{
?>
<script>
alert("Successful");
window.open("slot_amount.php","_self");
</script>
<?php
}
else
{
?>
<script>
alert("Error");
window.open("slot_amount.php","_self");
</script>
<?php
}

?>