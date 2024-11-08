<?php 
include 'config.php';


$dtt="2018-01-01";

$nwdt="2018-01-01 00:00:00";

$nwdt2="2018-01-01 00:00:"."18";


echo date("i:s",strtotime($nwdt2));
/*

function format_time($t,$f=':') // t = seconds, f = separator 
{
  return sprintf("%02d", $t%60);
}
echo format_time("16.456678");*/
while(date("Y-m-d H:i:s",strtotime("2018-01-01 23:00:00"))>date("Y-m-d H:i:s",strtotime($nwdt)))
{
    $nwdt = date("Y-m-d H:i:s", strtotime($nwdt."+16 seconds"));
  //  echo $nwdt."</br>";
    
    
}
?>