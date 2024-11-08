<?php

include('config.php');

//$_GET['i'] is reference id and $_GET['j'] is weather it is amc or site

 $id=$_GET['id'];

$po=$_GET['j'];

//echo $ref." ".$po;

$today=new DateTime(date("Y-m-d"));

//echo $today->format("Y-m-d");

$cnt=0;

$pcb=mysqli_query($con,

?>

<table border="1" width="100%">
mysqli_query($con,
<tr><th>Sr No</th><th>Assests with specification</th><th>Warranty</th></tr>

<?phpmysqli_query($con,

//echo "SELECT * FROM amcassets where amcpoid='".$ref."'";
mysqli_query($con,
//echo "SELECT * FROM atm where ref_id='$po'";

if($po=="amc")

{

$res=mysqli_query($con,"SELECT * FROM amcassets where siteid='".$id."'");

//echo "SELECT * FROM amcassets where siteid='".$id."'";



while($atmrow=mysqli_fetch_array($res)){ 

//echo "select * from assets_specification where ass_spc_id='".$atmrow[2]."'";

$qry2=mysqli_query($con,"select * from assets_specification where ass_spc_id='".$atmrow[2]."'");

$row=mysqli_fetch_row($qry2);

//echo "select * from assets where assets_id='".$row[1]."'";

$qry3=mysqli_query($con,"select * from assets where assets_id='".$row[1]."'");

$row2=mysqli_fetch_row($qry3);

//echo mysqli_query($con,om amcpurchaseorder where amcsiteid='".$id."'";

$qry=mysqli_query($con,"select * from amcpurchaseorder where amcsiteid='".$id."'");

$row3mysqli_query($con,_row($qry);

//echo "exp".$row3[4];

 $expdtmysqli_query($con,e($row3[4]);

 //echmysqli_query($con,rmat("Y-m-d"); 

?>



<tr><td><?php echo $cnt+1; ?></td>

<td><input type="checkbox" name="assets[]" id="assets[]" onClick="astselect('assets<?php echo $cnt ?>');"  />

<input type="hidden" name="assid[]" value="<?php echo $row[0]; ?>" /><?php echo $row2[1]." (".$row[2].")"; ?></td>

<td><?php if($expdt->format("Y-m-d")>=$today->format("Y-m-d")) { echo "Under AMC<input type='hidden' name='pcb[]' value='' id='pcb[]'>"; } else {

 if($pcb!='pcb')

 $pcb='pcb';

echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; } ?></td></tr>



<?php

$cnt=$cnt+1;

}

?>

<input type="hidden" name="type" value="amc" id="tp" />

<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />

<?php

}

elseif($po=="site")

{

//echo "hi";

//echo "select atm_id from atm where track_id='".$id."'";

	$qry4=mysqli_query($con,"select atm_id1 from sites where id='".$id."'");

	$ro4=mysqli_fetch_row($qry4);

	//echo "select * from installed_sites where Ref_id='".$ro4[0]."'";

//echo "select * from installed_sites where Ref_id='".$ref."'";

$qry=mysqli_query($con,"select * from installed_sites where Ref_id='".$ro4[0]."'");	

while($row=mysqli_fetch_array($qry))

{

	

	$qry2=mysqli_query($con,"select * from assets_specification where ass_spc_id='".$row[5]."'");

$ro=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con,"select * from assets where assets_id='".$ro[1]."'");

$row2=mysqli_fetch_row($qry3);

 $expdt=new DateTime($row[7]);

 

?>

<tr><td><?php echo $cnt+1; ?></td><td><input type="checkbox" name="assets<?php echo $cnt ?>" id="assets<?php echo $cnt ?>" onClick="approval('pcb',this.id);" value="<?php echo $row[0]; ?>"  />

<input type="hidden" name="assid<?php echo $cnt ?>" value="<?php echo $row[0]; ?>" />

<?php echo $row2[1]." (".$ro[2].")"; ?></td><td><?php if($expdt->format("Y-m-d")>=$today->format("Y-m-d")) { echo "UW<input type='hidden' name='pcb[]' value='' id='pcb[]'>"; } else {

if($pcb!='pcb')

 $pcb='pcb'; 

echo "PCB<input type='hidden' name='pcb[]' value='pcb' id='pcb[]'>"; } 



?></td></tr>

<?php

$cnt=$cnt+1;

}

?>

<input type="hidden" name="type" value="site" id="tp" />



<input type="hidden" name="cnt" value="<?php echo $cnt; ?>" id="cnt" />

<?php

}

?>

</table>