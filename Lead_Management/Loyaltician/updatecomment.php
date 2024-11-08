<?php
include 'config.php';

$lid=$_REQUEST['ids'];
$sql="select * from LeadUpdates where LeadId='".$lid."' order by UpdateId desc";
$sqlrun=mysqli_query($conn,$sql);
?>
<table align="center" class="table" style="width:80%" border='1'>
			
			<tr>
			    <th>Sr No</th>
				<th>Comments</th>
				<th>Update Time</th>
				<th>Next Update</th>
				
				
			</tr>
			<?php
			$srn='1';
while($row=mysqli_fetch_array($sqlrun)){?>
<tr>
	<td><?php echo $srn; ?></td>

	<td><?php echo $row['Comments']; ?></td>
	<td><?php echo $row['UpdateTime']; ?></td>
	<td><?php echo $row['NextUpdate']; ?></td>    
    
    </tr>
<?php 
    $srn++;
    
}

?>