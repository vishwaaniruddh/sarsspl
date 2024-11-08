<?php

date_default_timezone_set('Asia/Kolkata');

$dbhost = "localhost";
 $dbuser = "sarmicrosystems_prabir";
 $dbpass = "prabir@1986";
 $db = "sarmicrosystems_website";
 $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $con -> error);



?>