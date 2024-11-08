<?php 
session_start();
include ("config.php");
//include("access.php");


//$ctid=$_POST['ctid'];

//$txt=$_POST['txtc'];
$strPage = $_POST['Page'];

$View="SELECT * FROM `ads_upload`";
//$qrrs=mysqli_query($con3,"select * from upload_only_movies");



$table=mysqli_query($con3,$View);

$Num_Rows = mysqli_num_rows($table);

//echo $Num_Rows;
?>
<div align="center" >
 Records Per Page :<select name="perpg" id="perpg" onChange="funcs('1','perpg');"><br>
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
<?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
$Page = $strPage;
if($strPage=="")
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
	


//$View.=" ORDER BY cust ASC ";
	
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con3,$View);
	//echo $View;	
	
	






//echo mysql_error();
//$nrs1=mysqli_num_rows($View);
?>
<table class="table table-striped m-b-none" border="2" style="width:500px;">
<tr>
      <th align="center" style="width:20px;">Sr No.</th>
	  <th align="center" style="width:400px;">Ad Name</th>
      <th align="center" style="width:50px;">Duration</th>       
<th align="center" style="width:50px;">Select</th>       
    </tr>
<?php	

 $cnt=1;
while($rws=mysqli_fetch_array($qrys))
{
	
 ?>
<tr>
 

	<td align="center"><?php echo $cnt;?></td>
       <td align="center"><?php echo $rws[1];?></td>         
	<td align="center"><?php echo $rws[4]." sec."; ?></td>
<td>
<input type="button" id="chk<?php echo $cnt;?>" onclick="addtoschedule1('<?php echo $rws[1];?>','<?php echo $rws[0]; ?>',this.id)" value="Add">

<!--<input type="checkbox" id="chk<?php echo $cnt;?>" onchange="addtoschedule('<?php echo $rws[1];?>','<?php echo $rws[0]; ?>',this.id)">-->
</td>
       <!--<td align="center"><input type="button" id="Edit<?php echo $cnt; ?>" value="Edit" onclick="window.open('Edit_upload_movie.php?id=<?php echo $rws[0];?>','_self')" ></td>-->

       <!--<td align="center"> <input type="button" id="del<?php echo $cnt; ?>" value="Delete" onclick="deletefun(<?php echo $rws[0];?>)" ></td>-->



			</tr>
			
<?php  $cnt++; } ?>
</table>

											

<div class="pagination" style="width:100%;" align="center"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:funcs('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:funcs('$Next_Page','perpg')\">Next >></a> ";
}
?>
	
	</div>
