<?php
session_start(); //Start the session
include ("config.php");

$strPage = $_POST['Page'];

$strdt=$_POST['strdt'];
//echo $strdt;

$endt=$_POST['endt'];

$fname=$_POST['fname'];
$cname=$_POST['cname'];
$Mobile=$_POST['Mobile'];
$calltype=$_POST['calltype'];
if($calltype==""){
    $calltype="asc";
    $orderby="Recipt_id";
}else{
     $orderby="Amount";
}

$Paymentmode=$_POST['Paymentmode'];



    $View="select * from Recipt where 1=1";
    //echo $View;
       if($_POST['strdt']!="" & $_POST['endt']!="")
	{

	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
 

	$View.=" and entryDate between '".$start."' and '".$end."'";
//	echo $View;
}
         
         
         if($_POST['typeoftest']!="")
         {
             	$View.=" and testtype='".$_POST['typeoftest']."'";
         }

//echo $View;
if($fname!=""){
  $View.=" and Name='".$fname."'";  
  
}
if($cname!=""){
  $View.=" and CompanyName='".$cname."'";  
}
if($Mobile!=""){
  $View.=" and Mobile LIKE '%".$Mobile."%'";  
}


if($Paymentmode!=""){
  $View.=" and PayMode='".$Paymentmode."'";  
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

$View.=" ORDER BY $orderby $calltype ";
//$View.=" Name LIKE '%".$Name."%' ";
	$View.=" LIMIT $Page_Start , $Per_Page";
//	echo $View;
	$qrys=mysqli_query($conn,$View);
//	echo $qry;	
//echo $View;
	?>
	<div class="container">
	<form  method="post" action="delegation.php">
	<div class="table-responsive">
	<table align="center" class="table table-bordered table-striped"  style="font-size:80%">
			
			<tr >
			    <th class="th-prop">Sr No</th>
				<th class="th-prop">Recipt Number</th>
				<th class="th-prop">Name</th>
				<th class="th-prop">CompanyName</th>
				<th class="th-prop">Corpus fund</th>
			
				<!--<th class="th-prop">Fund</th> -->
				<th class="th-prop">Room</th>
				<th class="th-prop">cow</th>
				<th class="th-prop">Tree</th>
				<th class="th-prop">PayMode	</th>
				<th class="th-prop">CardNo</th>
                <th class="th-prop">Amount</th>
        		<th class="th-prop">Mobile</th>
			</tr>
			<?php 
		
			while($_row=mysqli_fetch_array($qrys)){

  ?>
	<tr style="background-color: #ffebeb;">
	<td class="th-prop"><?php echo $srn; ?></td>
	<td class="th-prop"><?php echo $_row['Recipt_id']; ?></td>
	<td class="th-prop"><?php echo $_row['Name']; ?></td>
	<td class="th-prop"><?php echo $_row['CompanyName']; ?></td>
	<td class="th-prop"><?php echo $_row['Youremember']; ?></td>

	<td class="th-prop"><?php echo $_row['Fund']; ?></td>
	
	<td class="th-prop"><?php echo $_row['Room']; ?></td>
	<td class="th-prop"><?php echo $_row['cow']; ?></td>
	<td class="th-prop"><?php echo $_row['Tree']; ?></td>
	<td class="th-prop"><?php echo $_row['PayMode']; ?></td>
	<td class="th-prop"><?php echo $_row['CardNo']; ?></td>
   	<td class="th-prop"><?php echo $_row['Amount']; ?></td>
	<td class="th-prop"><?php echo $_row['Mobile']; ?></td>


	
	
	
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
		</table>
		</div>
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

</div>

	