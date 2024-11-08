<?php

include("config.php");

$qry='';

 $cid=$_POST['cid'];

$bid=$_POST['bank'];



$strPage = $_REQUEST['Page'];

$sql.="select * from ebdetails where 1  ";

//$sql.="select * from ebill where ATM_ID in(select atm_id1 from sites where cust_id ='$cid')";



			//echo $sql;

			

		if(isset($_POST['cid']) && $_POST['cid']!='')

			{

			$sql.=" and cust_id = '".$cid."'";

			}

		

		if(issmysqli_OST['atm']) && $_POST['atm']!='')

			{mysqli_

			$sql.=" anmysqli_d like ('%".$_POST['atm']."%')";

			}

		if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')

			{

			$dt=str_replace("/","-",$_POST['dt']);

	$start=date('Y-m-d', strtotime($dt));

	$dt2=str_replace("/","-",$_POST['dt2']);

	$end=date('Y-m-d', strtotime($dt2));

			if($start!=$end)

			$sql.=" and entrydt Between '".$start."' and '".$end."'";

			else

			$sql.=" and entrydt Like '".$start."%'";

			}

			

			//echo $sql;

	$table=mysqli_query($sql);

if(!$table)

echo mysqli_error();

$count=0;

 $Num_Rows = mysqli_num_rows ($table);

?>

 <div align="center">

 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

 

 <?php

 for($i=1;$i<=$Num_Rows;$i++)

 {

 		if($i<=150)

 	{

 		if($i%50==0)

 		{

 		?>

 		<option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>

 		<?php

 		}mysqli_
mysqli_
	 }

 }			

if($Num_Rows<=150)

 {

 ?>

 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>

 <?php

 }			

?></select>

<!--<?php if($Num_Rows>0 && $bid!=''){  ?>

<a href="generateEbill.php?cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">generate Electric bill</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="history.php?cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>&id=<?php echo $id; ?>">Printed Electric bill</a><?php } ?>-->
mysqli_
</div>

<?phpmysqli_
mysqli_
if(isset($_POST['perpg']) && $_POST['perpg']!='0')

 $Per_Page =$_POST['perpg'];   // Records Per Page

 else

  $Per_Page ='50';

$Page = $strPage;

if(!$strPage)

{

	$Page=1;

}

 

$Prev_Page = $Page-1;

$Next_Page = $Page+1;





$Page_Start = (($Per_Page*$Page)-$Per_Page);

if($Num_Rows<=$Per_Page)

{

	$Num_Pages =1;

}

else if(($Num_Rows % $Per_Page)==0)

{

	$Num_Pages =($Num_Rows/$Per_Page) ;

}

else

{

	$Num_Pages =($Num_Rows/$Per_Page)+1;

	$Num_Pages = (int)$Num_Pages;

}

$sql.=" order by entrydt DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;



















$result = mysqli_query($sql);

		$num=mysqli_num_rows($result); ?>

		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>

<table width="800" border="1" align="center" cellpadding="4" cellspacing="0"><tr>

  <th>Atm ID</th>

    <th>Bank</th>

    <th>CSS Local Branch</th>

    <th>Zone</th>

    <th>State</th>

     <th>City</th>

    <th>Location</th>

    <th>Address</th>

    <th>Takeover Date</th>

    

    <th>Bill Date</th>

    <th>Unit </th>

    <th>Amount</th>

                <th>Start date</th>

                 <th>End date</th>

                 <th>Due Date</th>

                 <th>Opening Reading</th>

                 <th>Closing reading</th>

                 <th>Extra Charge</th></tr>

	<?php	while($row = mysqli_fetch_row($result))

		{

		//echo "select bank,csslocalbranch,zone,state,city,location,atmsite_address,takeover_date from ".$row[14]."_sites where atm_id1='".$row[1]."'<br>";

			$qry=mysqli_query($con,"select bank,csslocalbranch,zone,state,city,location,atmsite_address,takeover_date from ".$row[14]."_sites where atm_id1='".$row[1]."'");

		$ro=mysqli_fetch_row($qry);

			?>

		 <tr >

		 

        <!-- e.atmid,e.bill_date,e.unit,e.amount,e.status,e.start_date,e.end_date,e.print,e.due_date,e.opening_reading, e.closing_reading, e.extracharge, e.entrydt, e.cust_id,s.bank, s.csslocalbranch,s.zone, s.state, s.city, s.site_id,s.location,s.atmsite_address-->

		 <td><?php echo $row[1]; ?></td>

		 <td><?php echo $ro[0]; ?></td>

    <td><?php echo $ro[1]; ?></td>

    <td><?php echo $ro[2]; ?></td>

    <td><?php echo $ro[3]; ?></td>

    <td><?php echo $ro[4]; ?></td>

    <td><?php echo $ro[5]; ?></td>

    <td><?php echo $ro[6]; ?></td>

	<td><?php echo $row[7]; ?></td>	 

		    

			 <td><?php echo $row[2]; ?></td>

             <td><?php echo $row[3]; ?></td>

              <td><?php echo $row[4]; ?></td>

			 

             <td><?php echo $row[6]; ?></td>

             <td><?php echo $row[7]; ?></td>

             <td><?php echo $row[9]; ?></td>

             <td><?php echo $row[10]; ?></td>

             <td><?php echo $row[11]; ?></td>

              <td><?php echo $row[12]; ?></td>

             </tr>

           

			   			 			              

		<?php

		}

	

?>

<!--<tr><td>Total</td><td colspan='6' align="right"><?php echo $tot; ?></td></tr>-->

</table><div class="pagination" style="width:100%;"><font size="4" color="#000">

<!--Total <?php //echo $Num_Rows;?> Record : -->

<?php





if($Prev_Page) 

{

	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";

}



/*for($i=1; $i<=$Num_Pages; $i++){

	if($i != $Page)

	{

		echo " <li><a href=\"JavaScript:searchById('Listing','$i','perpg')\">$i</a> </li>";

	}

	else

	{

		echo "<li class='currentpage'><b> $i </b></li>";

	}

}*/

?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php

if($Page!=$Num_Pages)

{

	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";

}

?></font></div>