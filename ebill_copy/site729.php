<?php

	includemysqli_ig.php");
mysqli_
	/*$qry=mysql_query("SELECT * FROM `site729r`");
mysqli_
	while($row=mysql_fetch_array($qry))

	{mysqli_

		$qry1mysqli__query("update site729 set inv_date='".$row['inv_date']."' where `Sr. No` ='".$row['sr_no']."' and sned_id='".$row['inv_no']."'");

	}

	*/mysqli_

	$qry=mysql_query("SELECT distinct(sned_id),inv_date FROM `site729` order by sned_id");

	if(!$qry)

		echo mysql_error();

	$i=1;

	$k=1;

	

	while($row=mysql_fetch_array($qry))

	{

		/*$j=1;

		$id=$row[0];

		if($i==1)

			$id1=$row[0];

		elsemysqli_
mysqli_
		{

			if($id==$id1)

			{

				$j++;

			}

			else

			{

				$id1=$row[0];

				$j=1;

			}

		}

		if($j==2)

		{

			echo $k." id : ".$row[0]."  Date : ".$row[1]." - ".$j."<br/>";

			//echo $row[0].",";

			$k++;

		}

		$i++;*/

		echo "update send_bill set date='".$row['inv_date']."', entrydt='".$row['inv_date']." 00:00:00' where `send_id` ='".$row[0]."'<br/>";

		$qry1=mysql_query("update send_bill set date='".$row['inv_date']."' ,entrydt='".$row['inv_date']." 00:00:00' where `send_id` ='".$row[0]."'");

		//$qry1=mysql_query("update site729 set inv_date='".$row['inv_date']."' where `Sr. No` ='".$row['sr_no']."' and sned_id='".$row['inv_no']."'");

	}

?>