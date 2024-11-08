<?php

$seriano="12000001001";
$seriano1="12000001";
 $remaining1=substr($seriano,8);
 var_dump($remaining1);
 echo "<br/>";
 $readyToUse=sprintf("%03s", $remaining1);
 var_dump($readyToUse);
 echo"<br/>";
 $newdat=$seriano1.$remaining1;
 echo $newdat;
 
?>