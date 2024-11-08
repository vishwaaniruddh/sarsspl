<?php
	$client=$_GET['client'];
	$clients=mysqli_query($con,"select distinct(csslocalbranch) from csslocalbranch order by csslocalbranch ASC");
	while($localbrro=mysqli_fetch_array($localbr))
	{
		<option value="<?php echo $localbrro[0]; ?>"><?php echo $localbrro[0]; ?></option>
	}
?>