<?php

include("access.php");

include("config.php");

 $id=$_GET['id'];

?>

<body bgcolor="#009999"><center>
mysqli_query($con,
<h2 align="center">Transfer Alert <!--<a href="#" onclick="closepopup('<?php echo $id; ?>');"><span class="close_button">X</span></a>--></h2>

<form name="frm" method="post" action="processcalltransfer.php">

<table border="1">



<tr><td>Transfer To</td><td><?php

$qry=mysqli_query($con,"select * from state order by state ASC");



?><select name="branch"><option value="0">--Select--</option>

<?php while($row=mysqli_fetch_array($qry)){ ?>

<option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>



<?php } ?>

</select></td></tr>

<tr><td>Comment</td><td><textarea name="frmcmnt" cols="30" rows="7"></textarea></td></tr>

<tr align="center"><td colspan="2" align="center">

<input type="hidden" name="alertid" value="<?php echo $id ?>">

<input type="hidden" name="br" value="<?php echo $_SESSION['branch']; ?>">

<input type="submit" name="cmdsub" value="Transfer >> " style="background:#CCCCCC; height:40px; width:80px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="cmdcan" value="Cancel >> " style="background:#CCCCCC; height:40px; width:80px" onClick="window.close()"></td></tr>

</table>

</form></center></body>