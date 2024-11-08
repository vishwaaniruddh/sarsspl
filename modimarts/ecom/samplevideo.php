<?php
        include("config.php");
        include ("VideoStream.php");

    
        $sid=$_GET['sid'];
   $stats=$_GET['stats']; 
   
$sqry=mysqli_query($con1,"select videopath from  ads_upload where id='".$sid."'");

if (!$sqry) {
    printf("Error: %s\n", mysqli_error($con1));
   
}
//echo mysql_error();
//$nurs=mysqli_num_rows($sqry);

//echo "rows-".$nurs."<br>"; 
  $media=mysqli_fetch_array($sqry);
 // echo "media-".$media[0]."<br>";
        $stream = new VideoStream($media[0]);
       $stream->start();exit;


?>