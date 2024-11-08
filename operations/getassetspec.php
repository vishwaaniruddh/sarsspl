<?php

include("config.php");
mysqli_query($con,
$id=$_GET['id'];

$qry=mysqli_query($con,"select * from assets_specification where assets_id='".$id."'");



while($row=mysqli_fetch_array($qry))

{

	?>

    <option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>

    <?php

}

?>