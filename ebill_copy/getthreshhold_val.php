<?php

	include('config.php');

	

	$strPage = $_REQUEST['Page'];

	

	//echo "SELECT threshhold FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['bank']."' and bank='".$_REQUEST['proj']."'";

	$sql="SELECT * FROM `threshhold` WHERE 1";
mysqli_
	if($_REQUESTmysqli_]!="")

	$sql.=" and cust_id='".$_REQUEST['cid']."'";

	if($_REQUEST['bank']!="" && $_REQUEST['bank']!="-1")

	$sql.=" and bank='".$_REQUEST['bank']."'";

	if($_REQUEST['proj']!="" && $_REQUEST['proj']!="-1")

	$sql.=" and project_id='".$_REQUEST['proj']."'";

	$chck_qry=mysql_query($sql);

	$Num_Rows = mysql_num_rows ($chck_qry);

?>

 <div align="center">Total Records: <b><?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

 

 <?php

 for($i=1;$i<=$Num_Rows;$i++)

 {

 if($i%50==0)

 {

 ?>

 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>

 <?php

 }

 }

 

 ?>

 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>

 </select>&nbsp;&nbsp;&nbsp;

 
mysqli_
 </div>

 <?php

// pagins

//echo $_POST['perpg'];

$Per_Page =$_POST['perpg']; //$_POST['perpg'];   // Records Per Page

 
mysqli_
$Page = $strPage;

if(!$strPagemysqli_

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



$sql.="  order by cust_id,bank,project_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

if(mysql_num_rows($chck_qry)>0)

{

?>

<table border="1">

	<tr>

    	<th>Sr. No.</th>

        <th>Customer</th>

        <th>Bank</th>

        <th>Project Id</th>

        <th>Threshold</th>

    </tr>

<?php

$chck_qry=mysql_query($sql);

//echo $sql;

$srno=1;

while($row= mysql_fetch_array($chck_qry))

{

?>

	<tr>

    	<td align="center"><?php echo $srno; ?></td>

        <td><?php echo $row['cust_id']?></td>

        <td><?php echo $row['bank']?></td>

        <td><?php echo $row['project_id']?></td>

        <td><?php echo $row['threshhold']?></td>

    </tr>

<?php

$srno++;

}

?>

</table>

<?php

}

else

	echo "No Threshhold for current selection";

?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">

<!--Total <?php //echo $Num_Rows;?> Record : -->

<?php

if($Prev_Page) 

{

	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";

}

/*

for($i=1; $i<=$Num_Pages; $i++){

	if($i != $Page)

	{

		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";

	}

	else

	{

		echo "<li class='currentpage'><b> $i </b></li>";

	}

}*/

if($Page!=$Num_Pages)

{

	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";

}

?>

</font>

</div>