<?php
include('config.php');


$sql_statement = mysql_query("SELECT * FROM ads_upload where id='".$_GET['adid']."'");
$fr=mysql_fetch_array($sql_statement);

$pth=$fr['videopath'];
?>

<script>

function rtymvid(adpth,id)
{
var myVid = document.getElementById('vid');
myVid.src = 'samplevideo.php?sid='+id;  
  myVid.play();

}

</script>
<div id="content-outer">
<!-- start content -->
<div id="content">
<center>
<video width="650" height="" id="vid"  src="../videoads/2017/05/14957800430.mp4" type="video/mp4" controls autoplay></video>  
</center>
<script>
rtymvid('<?php echo  $pth?>','<?php echo $_GET['adid'];?>');
</script>
</div>
</div>