<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
include 'config.php';
$fix=10;
$strPage=$_POST['Page'];
$ComponentType=$_POST['ComponentType'];
$contact=$_POST['contact'];
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
$from=$_POST['fromdt'];
$to=$_POST['todt'];

$fromdt = date("Y-m-d", strtotime($from));
$todt = date("Y-m-d", strtotime($to)); 


$query="select * from vendor where 1";

	if($vender!="")
			{
			    
			    $query.= " and Name like '".$vender."%'";
			}
					if($contact!="")
			{
                                   $query.= " and Contact like '".$contact."%'";
                                 }
			    	
			    	if($from!="" && $to!="" ){
$query.=" and date between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
}
$result=mysqli_query($conn,$query);
$Num_Rows=mysqli_num_rows($result);
$Per_Page =$_POST['perpg'];   // Records Per Page

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

$query.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$query);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   //$sr=($Page_Start* $Page)-$Page_Start;
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr+1;
	}

?>

<center><div>total records:<?php echo $Num_Rows?></div></center>

<!--=================================================-->
<center><div> Records Per Page :<select name="perpg" id="perpg" onchange="search('2','perpg');">

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
<!--=================================================-->



<table  border=1>
&nbsp;
  <tr>
      <th> sr </th>
    <th> Name </th>
    <th >Address</th>
    <th>contact</th>
      <th>email</th>
     <th>date</th>
   
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr>
     <td><?php echo $sr;?></td>
    <td><?php echo $row["Name"];?></td>
    <td><?php echo $row["Address"];?></td>
    <td><?php echo $row["contact"];?></td>
    <td><?php echo $row["email"];?></td>
    <td><?php echo $row["date"];?></td>
    
  </tr>
  
     
    <?php 
   $sr++;  
 }
    ?>
     </table>  
     <div>
 <?php 

if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:search('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:search('$Next_Page','perpg')\">Next >></a></center> ";
}
?>

</div>
<?php
}else
{ 
 header("location: login.php");
}
?>