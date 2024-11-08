<?php

include("access.php");

include("config.php");

$reqid=$_GET['reqid'];



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
mysqli_query($con,
<title>Feedback</title>

<linkmysqli_query($con,.css" rel="stylesheet" type="text/css" />

</head>



<body>

<table border="1" >

<tr><th>Sr No</th><th>From</th><th>Time</th><th>Remarks</th></tr>

<?php

$i=0;

//echo "select * from  reversal_update where reqid='".$reqid."' order by id DESC";

$conf=mysqli_query($con,"select * from  reversal_update where reqid='".$reqid."' order by id DESC");

while($row=mysqli_fetch_array($conf))

{

	$sr=mysqli_query($con,"select username from login where srno='".$row['upby']."'");

	$srno=mysqli_fetch_row($sr);

?>

<tr><td><?php echo $i=$i+1; ?></td><td><?php echo $srno[0]; ?></td><td><?php echo $row['entrydt']; ?></td><td><?php echo $row['remarks']; ?></td></tr>

<?php

}

?></table>

</body>

</html>

