<?php
session_start(); //Start the session
include ("config.php");

$strPage = $_POST['Page'];

$strdt=$_POST['strdt'];
//echo $strdt;

$endt=$_POST['endt'];
$status=$_POST['status'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$Mobile=$_POST['Mobile'];




    /*$View="select a.Lead_id,a.FirstName,a.LastName,a.MobileNumber,b.LeadId ,b.Comments,b.UpdateTime,b.NextUpdate from Leads_table a ,LeadUpdates b where a.Lead_id=b.LeadId";*/
 //echo $View;
 
// $View="select distinct(LeadId) from LeadUpdates where 1=1";
if($_SESSION['register_id']=='1'){
$View="select * from Leads_table where Lead_id IN(select distinct(LeadId) from LeadUpdates)";
}else{
    $data=array();
    $xyz="select distinct(LeadId) from LeadDelegation where SalesmanId='".$_SESSION['register_id']."'";
    //echo $xyz;
    $xyzruun=mysqli_query($conn,$xyz);
    while($xyzfetch=mysqli_fetch_array($xyzruun)){
        $data[]=$xyzfetch[0];
    }
    $y1=implode(',',$data);
  $View="select * from Leads_table where Lead_id IN(select distinct(LeadId) from LeadUpdates where LeadId IN($y1))"; 
  //echo $View;
}
       if($_POST['strdt']!="" & $_POST['endt']!="")
	{

	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
 

	$View.=" and b.UpdateTime between '".$start."' and '".$end."'";
//	echo $View;
}
         
 
//echo $View;
if($fname!=""){
  $View.=" and FirstName LIKE '%".$fname."%'";  
   // echo $View;
}
if($lname!=""){
  $View.=" and LastName LIKE '%".$lname."%'";  
 // echo $View;
}
if($Mobile!=""){
  $View.=" and MobileNumber LIKE '%".$Mobile."%'";  
 // echo $View;
}
if($status!=""){
  $View.=" and Status='".$status."'";  
}


$table=mysqli_query($conn,$View);

$Num_Rows = mysqli_num_rows ($table);

//echo $Num_Rows;
?>
<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');"><br>
 
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
//echo $Page_Start;
$srn=$Page_Start+1;
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
	


//$View.=" ORDER BY UpdateId  DESC ";
//$View.=" Name LIKE '%".$Name."%' ";
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($conn,$View);
//	echo $qry;	
//echo $View;
	?>
	<form  method="post" action="delegation.php">
	<table align="center" class="table" style="width:80%" border='1'>
			
			<tr>
			    <th>Sr No</th>
				<th>FirstName</th>
				<th>LastName</th>
				<th>MobileNumber</th>
				<th>Email</th>
				<th>Comment</th>
				<th>View Comments</th>
				<!--<th>UpdateTime</th>
				<th>NextUpdate</th>-->
				
				
			</tr>
			<?php 
		
			while($_row=mysqli_fetch_array($qrys))
			{
			  /*$sql="select * from Leads_table where Lead_id='".$_row['LeadId']."'";
	$runsql=mysqli_query($conn,$sql);
	$sql2fetch=mysqli_fetch_array($runsql);
	*/
	$sql2="select Comments from LeadUpdates where LeadId='".$_row['Lead_id']."' order by UpdateId desc limit 1";
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch2=mysqli_fetch_array($runsql2);
	
  ?>
	<tr>
	<td><?php echo $srn; ?></td>

	<td><?php echo $_row['FirstName']; ?></td>
	<td><?php echo $_row['LastName']; ?></td>
	<td><?php echo $_row['MobileNumber']; ?></td>
	<td><?php echo $_row['EmailId']; ?></td>
	<td><?php echo $sql2fetch2['Comments']; ?></td>
	<td><a onclick="window.open('updatecomment.php?ids=<?php echo $_row['Lead_id'];?>', '_blank', 'location=yes,height=400,width=600,left=400,scrollbars=yes,status=yes');" style='color: red;'>view</a></td>
	
	

<!--<td><input type="button" onclick="window.open('editlead.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Edit Lead">  </td>
<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Lead Update">  </td>
<td><input type="checkbox" name="check[]" value="<?php echo $_row['Lead_id'];?>"></td>-->
	
	
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
		</table>
		
	<!--<div align="center"><button id="myButtonControlID" onClick="expfunc();">Delegate</button></div>-->
	</form>
	
<div class="pagination" style="width:100%; margin:0;" align="center"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:func('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:func('$Next_Page','perpg')\">Next >></a> ";
}
?>
	</font>
	</div>


	