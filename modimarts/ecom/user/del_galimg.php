<?php 
session_start();
$cid=$_GET['cid'];
include('config.php');
$id=$_GET['imgid'];

$fetchqry=mysqli_query($con1,"select image from gallery where img_id='$id'");
$res=mysqli_fetch_row($fetchqry);
$delqry=mysqli_query($con1,"delete from gallery where img_id='$id'");
if($delqry)
{
	unlink('gallery/'.$cid."/".$res[0]);?>
    <script>
	document.location='view_gallery.php';	</script>
<?php }
else
{
	echo "error in deletion : ".mysql_error();
	}

?>