<?php
//include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$id=$_GET['id'];
?>




<!--<h2 align="center">Updates <a href="#" onclick="closepopup('<?php echo $id; ?>');"><span class="close_button">X</span></a></h2>-->

<body bgcolor="#009999">
<table border="1" width="100%">
<thead>
<tr>
<th>Update</th>
<th>Date / Time</th>
<th>Branch</th>
</tr>
</thead>

<tbody>

<?php
include("config.php");
//echo "<br><br>select * from alert_updates where alert_id='".$id."' order by id DESC";
	$tab=mysqli_query($con,"select * from alert_updates where alert_id='".$id."' order by id DESC");
 while ($row=mysqli_fetch_row($tab)) {
	 
	 $qry=mysqli_query($con,"select region,location from cssbranch where id='".$row[4]."'");
	 $rw=mysqli_fetch_row($qry);
	
	  ?>
      

     

<tr>
<td><?php echo $row[2]; ?></td>
<td><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[3])); ?></td>
<td><?php if($rw[1]==''){ echo "Masteradmin";  }else{ echo $rw[1]." - ".$rw[0]; } ?></td>
</tr>
<?php } ?>
</tbody>
</table>

</body>

