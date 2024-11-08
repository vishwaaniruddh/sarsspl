<?php
session_start();
include('config.php');
include('adminaccess.php');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>merchant report</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
 
<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});


</script> 


</head>
<body> 

<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<?php include('header.php');?>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Merchants reports</h1>
	</div>
	<!-- end page-heading -->
<!--  start message-green -->


<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>

<?php
if(isset($_POST['search']))
{
    
    $code=$_POST['Battery_Vendor'];
    $method=$_POST['method'];
    $from=$_POST['from'];
    $to=$_POST['to'];
    //echo "ramshankar".$code;
    
}



?>
<form  action="" method="POST">
				<div id="message-green">
				    
				<table align="center" width="70%"   cellpadding="0" cellspacing="0">
				<tr>
					<td><leble>Merchant Report:</lable></td>
<td><select name="Battery_Vendor" id="Battery_Vendor">
     <option value="">Select Merchant Name</option>
      <?php 
         $qry="select * from clients";
         $result11=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_array($result11))
	   {  ?>
		<option value="<?php echo $row[0];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select></td>
<td><leble>Method:</lable></td>
<td><select name="method" id="method">
     <option value="">Select Method</option>
       <?php 
         $qry2="select pmode from Orders";
         $result112=mysqli_query($con1,$qry2);
         while($row2 = mysqli_fetch_array($result112))
	   { 
	   ?>
		<option value="<?php echo $row2[0];?>"/><?php echo $row2[0]; ?></option>
               <br/>
      <?php } ?>
</select></td>
<td><leble>From Date:</lable></td>
<td><input type="date" Style=line-height:16px; name="from" id="from" /></td>

<td><leble>To Date:</lable></td>
<td><input type="date" Style=line-height:16px; name="to" id="to" /></td>
     
<td><input type="submit" name="search" id="search"value="Search">
</td>
					
				</tr>
				</table>
				</div>
				</form>
				<!--  end message-green -->
	<table border="0"   width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				 
			  <!--  start product-table ..................................................................................... -->
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><p style="font-size:16px; color:#FFF;">Sr No</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Order ID</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Product Name</p></th>
				    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Price</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Quantity</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Discount</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Method</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Total Amount</p></th>
					
					</tr>
                <?php
				include('config.php');
				
				$sql_statement = "select * from order_details where mrc_id='".$code."' and status='completed' ";
               
				
				
				$pm="";
				$id=array();
if($from!="" && $to!=""){
    $filter="select id,pmode  from Orders where date between '".$from . " 00:00:00" ."' and '".$to. " 23:59:59" ."' ";
    $filrun=mysqli_query($con1,$filter);
    while($filrow=mysqli_fetch_array($filrun)){
  
   $pm= $filrow["pmode"];
  
   // $filter2="select * from order_details where status='completed' and mrc_id='".$code."' and oid IN($filrow[0])";
//    $fil2run=mysqli_query($con1,$filter2);
   
  
    $id[]=$filrow[0];
   
   //echo $pm;
			
				  
    }
    
    echo $pm;
    //echo $id[];
    $cat=implode(",",$id);
    echo $cat;
    $sql_statement .="and oid IN($cat)";
   
}   
    
     //$sql_statement .="and oid IN($filrow[0])"; 
      
     
				echo $sql_statement;
            $result = mysqli_query($con1,$sql_statement);  
$i=1;

while($row1=mysqli_fetch_array($result)){

    
    $total = mysqli_query($con1,"SELECT sum(total_amt) FROM order_details where mrc_id='".$code."' and status='completed' ");
	$rows5 = mysqli_fetch_array($total);
	
	$sql="select name from Productviewtable where code='".$row1['item_id']."' and category='".$row1['cat_id']."' ";
	$quer=mysqli_query($con1,$sql);
	$row3=mysqli_fetch_array($quer);
    
				?>
				<tr class="alternate-row">
					<td><?php echo $i;?></td>
					<td><?php echo $row1['oid']; ?></td>
					<td><?php echo $row3['name']; ?></td>
					<td><?php echo $row1['rate']; ?></td>
					<td><?php echo $row1['qty']; ?></td>
					<td><?php echo $row1['discount']; ?></td>
					<td><?php echo $pm ?></td>
					<td><?php echo $row1['total_amt']; ?></td>
					
					 
                   
                   
						
				</tr>
                <?php $i++; }  
               



	 ?>
                 
		

				</table>
				<div class="pull-right">
		<div class="span">
		    <?php
		    if($rows5['sum(total_amt)']!="")
		    {
		    ?>
				<div><h3>Total amount :- <?php echo $rows5['sum(total_amt)']; ?></h3></div>
				<?php }
				else
				{
				?>
				<div><h3>Total amount :- <?php echo 00; ?></h3></div>
				<?php
				}
				?>
						</div>
					
			</div>
				<!--  end product-table................................... --> 
				
			</div>
			<!--  end content-table  -->
		
		