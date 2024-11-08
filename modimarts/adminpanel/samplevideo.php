<?php
        include("config.php");
        include ("../VideoStream.php");

 $sql_statement = mysql_query("SELECT * FROM ads_upload where id='".$_GET['sid']."'");
$fr=mysql_fetch_array($sql_statement);

$pth="../".$fr['videopath'];
 
     // echo "media-".$media[0]."<br>";
        $stream = new VideoStream($pth);
        $stream->start();exit;

?>