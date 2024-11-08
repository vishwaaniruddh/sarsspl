<?php

date_default_timezone_set('Asia/Kolkata');

$dbhost = "localhost";
 $dbuser = "u444388293_website";
 $dbpass = "Prabir@1986";
 $db = "u444388293_website";
 $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $con -> error);



?>