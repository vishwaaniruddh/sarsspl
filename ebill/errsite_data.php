<?php 

session_start();

$desg= $_SESSION['designation'];

//echo $_SESSION['custid'];

include("config.php");

 $cid=$_POST['cid'];

$bid=$_POST['bank'];



$strPage = $_REQUEST['Page'];

 ?>

<!--<form method="post" name="level1" action="processtempsitelevel1.php">-->

<table width="800" border="1">

  <tr>

    <th scope="col"><div align="center">Customer ID </div></th>

    <th scope="col"><div align="center">Customer Name </div></th>

    <th scope="col"><div align="center">Atm ID </div></th>

    <th scope="col"><div align="center">Consumer no</div></th> 

     <th scope="col"><div align="center">From Date </div></th>

      <th scope="col"><div align="center">To Date </div></th>

      <th scope="col"><div align="center">Bill Date </div></th>

     	



       <th scope="col"><div align="center">Duedate </div></th>

       <th scope="col"><div align="center">Paid Date</div></th>

       <th scope="col"><div align="center">Opening Reading</div></th>

       <th scope="col"><div align="center">Closing Reading </div></th>

       <th scope="col"><div align="center">Units </div></th>

       <th scope="col"><div align="center">Paid Amount </div></th>

       <th scope="col"><div align="center">Extra Charge </div></th>

       

    <th scope="col"><div align="center">Total Amount </div></th>

    <th scope="col"><div align="center">Error </div></th>

    

    

   <!-- <mysqli_pe="col"><div align="center">Edit</div></th>

    <mysqli_pe="col"><div align="center">Delete</div></th>-->

  </tr>mysqli_

  <?php

        $sql='';	

		$sql.= "SELECT * FROM uploadedebillerr where 1";

		

		//if($desg=='4')

		$sql.=" and (status='2')";

		

		

		      if(isset($_POST['custid']) && $_POST['custid']!='')  

		$sql.=" and cid='".$_POST['custid']."'";

			

		if(isset($_POST['consumer']) && $_POST['consumer']!='')

			{

			$sql.=" and consumerno Like ('%".$_POST['consumer']."%')";

			}

		

		if(isset($_POST['atmid']) && $_POST['atmid']!='')

			{

			$sql.=" and atm_id like ('%".$_POST['atmid']."%')";

			}

		

		

		if(isset($_POST['dt'])  && $_POST['dt']!='')

			{

			$dt=str_replace("/","-",$_POST['dt']);

	$start=date('Y-m-d', strtotime($dt));

	//$dt2=str_replace("/","-",$_POST['dt2']);

	//$end=date('Y-m-d', strtotime($dt2));

			$sql.=" and entrydt Like '".$start."%'";

			}
mysqli_
			//ecmysqli_l;			

		$table=mysql_query(mysqli_

if(!$table)
mysqli_
echo mysqmysqli_r();

$count=0;

$Num_Rows = mysql_num_rows ($table);

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

 }

 }

 }

 if($Num_Rows<=150)

 {

 ?>

 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>

 <?php

 }

 ?>

 </select>

 </div>

		

	<?php	//echo $sql;

		########### pagins

//echo $_POST['perpg'];

$Per_Page =$_POST['perpg'];   // Records Per Page

 

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

echo $sql;

	$cnt=0;		 

		$result = mysql_query($sql);

		$num=mysql_num_rows($result); ?>

		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>

		<?php while($row = mysql_fetch_row($result))

		{	

		$cnt=$cnt+1;

		$custname=mysql_query("select contact_first from contacts where short_name='".$row[15]."'");

		$cname=mysql_fetch_row($custname);

		?>

		  <tr>

    <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="cust" id="cust<?php echo $cnt-1; ?>" value="<?php echo $row[15]; ?>" readonly="readonly" /><?php }else{  echo $row[15];  } ?></div></td>

    <td scope="col"><div align="center"><?php echo $cname[0]; ?></div></td>

    <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="atm" id="atm<?php echo $cnt-1; ?>" value="<?php echo $row[1]; ?>" readonly="readonly" /><?php }else{  echo $row[1];  } ?><?php //echo $row[1]; ?></div></td> 

     <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="cons" id="cons<?php echo $cnt-1; ?>" value="<?php echo $row[2]; ?>" readonly="readonly" /><?php }else{  echo $row[2];  } ?><?php //echo $row[2]; ?> </div></td>

      <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="fdt<?php echo $cnt-1; ?>" id="fdt<?php echo $cnt-1; ?>" readonly="readonly" onclick="displayDatePicker('fdt<?php echo $cnt-1; ?>');" value="<?php echo date("d/m/Y",strtotime($row[3])); ?>" /><?php }else{  echo date("d/m/Y",strtotime($row[3]));  } ?><?php //echo $row[3]; ?> </div></td>

      <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="tdt<?php echo $cnt-1; ?>" id="tdt<?php echo $cnt-1; ?>" onclick="displayDatePicker('tdt<?php echo $cnt-1; ?>');" value="<?php echo date("d/m/Y",strtotime($row[4])); ?>" readonly="readonly" /><?php }else{  echo date("d/m/Y",strtotime($row[4]));  } ?><?php //echo $row[4]; ?></div></td>

      <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="bdt<?php echo $cnt-1; ?>" id="bdt<?php echo $cnt-1; ?>" onclick="displayDatePicker('bdt<?php echo $cnt-1; ?>');" value="<?php echo date("d/m/Y",strtotime($row[5])); ?>" readonly="readonly" /><?php }else{  echo date("d/m/Y",strtotime($row[5]));  } ?><?php //echo $row[5]; ?> </div></td>

     	



       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="ddt<?php echo $cnt-1; ?>" id="ddt<?php echo $cnt-1; ?>" onclick="displayDatePicker('ddt<?php echo $cnt-1; ?>');" value="<?php echo date("d/m/Y",strtotime($row[6])); ?>" readonly="readonly" /><?php }else{  echo date("d/m/Y",strtotime($row[6]));  } ?><?php //echo $row[6]; ?> </div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="pdt<?php echo $cnt-1; ?>" id="pdt<?php echo $cnt-1; ?>" onclick="displayDatePicker('pdt<?php echo $cnt-1; ?>');" value="<?php echo date("d/m/Y",strtotime($row[7])); ?>" readonly="readonly" /><?php }else{  echo date("d/m/Y",strtotime($row[7]));  } ?><?php //echo $row[7]; ?></div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="openr" id="openr<?php echo $cnt-1; ?>" value="<?php echo $row[8]; ?>" readonly="readonly" /><?php }else{  echo $row[8];  } ?><?php //echo $row[8]; ?></div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="closer" id="closer<?php echo $cnt-1; ?>" value="<?php echo $row[9]; ?>" readonly="readonly" /><?php }else{  echo $row[9];  } ?><?php //echo $row[9]; ?> </div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="unit" id="unit<?php echo $cnt-1; ?>" value="<?php echo $row[10]; ?>" readonly="readonly" /><?php }else{  echo $row[10];  } ?><?php //echo $row[10]; ?> </div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="pamt" id="pamt<?php echo $cnt-1; ?>" value="<?php echo $row[11]; ?>" readonly="readonly" /><?php }else{  echo $row[11];  } ?><?php //echo $row[11]; ?> </div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="xtra" id="xtra<?php echo $cnt-1; ?>" value="<?php echo $row[12]; ?>" readonly="readonly" /><?php }else{  echo $row[12];  } ?><?php //echo $row[12]; ?> </div></td>

       <td scope="col"><div align="center"><?php if($desg=='4' && $row[17]<'2'){ ?><input type="text" name="tamt" id="tamt<?php echo $cnt-1; ?>" value="<?php echo $row[13]; ?>" readonly="readonly" /><?php }else{  echo $row[13];  } ?><?php //echo $row[13]; ?> </div></td>

       

       <td scope="col"><div align="center"><?php echo $row[14]; ?> </div></td>

    

  

    

    

   <td scope="col" id="edt<?php echo $cnt-1; ?>"><div align="center">

  <?php 

  //for Vaibhav

  if($desg=='3-2' && $row[17]=='2'){ ?> <input type="button" value="Save" onclick="saveedt('<?php echo $cnt-1; ?>','<?php echo $row[0]; ?>','3');" id="save<?php echo $cnt-1; ?>" /><?php }

  else

  {

  

  if($desg=='13' && $row[17]=='3'){

  ?> <!--<input type="button" value="Approve" onclick="approve('<?php echo $cnt-1; ?>','<?php echo $row[0]; ?>','4');" id="save<?php echo $cnt-1; ?>"  />--><?php  }

  }

   ?>

  

  </div></td>

    <!-- <td scope="col"><div align="center">Delete</div></td>--></tr>

		<?php

		}

?>

</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">





<!--<input type="submit" name="cmdsub" value="Approve" style="width:100px; height:30px">-->

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



<?php  ?><!--</form>-->

<!--<p>&nbsp;<a href="excel.php?id=<?php echo $cid; ?>&bid=<?php echo $bid; ?>" >Export To Excel</a></p>-->