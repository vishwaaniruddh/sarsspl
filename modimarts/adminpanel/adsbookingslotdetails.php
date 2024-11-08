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
//	ini_set( "display_errors", 0);

include('config.php');

include('header.php'); 

$sql_statement = 'SELECT * FROM advertise_booking where 1';


$adstats=$_POST['adstatus'];

if($adstats=="")
{
   $adstats="1"; 
    
}
$sql_statement.=" and  status='".$adstats."' ";

if($_POST['uplaodby']!="")
{
  $sql_statement.=" and  merchant_id='".$_POST['uplaodby']."' ";
    
}





	$mrc_name=$_POST['mrc_name'];	
	$product_name=$_POST['product_name'];	
	$order_id=$_POST['order_id'];	
	$fdate=$_POST['rdate'];	
	$tdate=$_POST['tdate'];	
	
	

		//echo $sql_statement;	
	//run the mysql query
	$num_Array = mysql_query($sql_statement);
	
	//total records
	$total_records = mysql_num_rows($num_Array);
	
	//get the page number from the REQUEST / GET
	$page = $_REQUEST['page'];
	
	//numbers of rows to show on page
	$offset = 20;
	
	//lets calculate the LIMIT for SQL, and save it $from
	if ($page){
		$from 	= ($page * $offset) - $offset;
	}else{
		//if nothing was given in page request, lets load the first page
		$from = 0;	
	}
	
?>

<style>
/*---Paging specific styling----*/     
	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
	.paging.display{text-align:right;}
	.paging a, .paging span {padding:2px 8px 2px 8px; font-weight :normal}
	.paging span {font-weight:bold; color:#000; font-size:13px; }
	.paging a, .paging a:visited {color:#000; text-decoration:none; border:1px solid #dddddd;}
	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
	.paging a.prn, .paging a.prn:visited { border:2px solid #dddddd;}
	.paging a.prn:hover { border-color:#000;}
	.paging p#total_count{color:#aaa; font-size:12px; font-weight: normal; padding-left:18px;}
	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>
<script>
function fnc(id)
{

try
{
var left = (screen.width/2)-(850/2);
var top = (screen.height/2)-(650/2);

window.open('videopg.php?adid='+id,'parentcon',"scrollbars=yes, resizable=no,width=750, height=400, top="+top+", left="+left);
}catch(exc)
{
    
    alert(exc);
}
    
}


function approvefunc(adid,btnid,stts)
{
//alert("testdfsf");
try
{
    if(stts==1)
    {
     
    var conf=confirm("Are you sure you want to Approve");
    }else{
        
        var conf=confirm("Are you sure you want to Reject");
    }
    if(conf)
    {
$.ajax({
   type: 'POST',    
url:'adsbookingslotapprove.php',
data:'adid='+adid+'&stts='+stts,
beforeSend: function() {
        	document.getElementById(btnid).disabled=true;
        	
		},
success: function(msg){
alert(msg);
if(msg==1)
{
    if(stts==1)
    {
        alert("Product approved!!");
         document.getElementById(btnid).value="Approved";
    }else{
         alert("Product Rejected!!");
          document.getElementById(btnid).value="Rejected";
    }
    
    
}else
{
    
    document.getElementById(btnid).disabled=false;
    document.getElementById(btnid).value="Approve";
}
         }
     });
}
}catch(exdce)
{
    
    //alert(exdce);
}
}


</script>
<body> 
<form action="" method="POST">
<!-- Start: page-top-outer --><!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Ads slot booking approval</h1>
	
	<!-- end page-heading -->
<!--<b>Ad Status</b>
<select name="adstatus">
    <option value="1" <?php if($adstats=="1"){ echo "selected";}?>>Approved</option>
    <option value="0" <?php if($adstats=="0"){ echo "selected";}?>>Pending for approval</option>
  
    <option value="2" <?php if($adstats=="2"){ echo "selected";}?>>Rejected</option>
</select>-->	

<b>Uploaded By</b>
<select name="uplaodby">
     <option value="" >Select Upload By</option>
<?php
$getuplby=mysql_query("SELECT distinct(upload_by) FROM ads_upload");
while($clde=mysql_fetch_array($getuplby))
{

$query1234 =mysql_query("SELECT * FROM clients where code='".$clde[0]."'");
$qr12134rws=mysql_fetch_array($query1234);
?>

    <option value="<?php echo $clde[0];?>" <?php if($updby==$clde[0]){ echo "selected";}?>><?php if($clde[0]==0){echo "Admin";}else{echo $qr12134rws[1];}?></option>


<?php } ?>
</select>


<input type="submit" action="" method="post" value="Search">
</div>

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	    
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				  <!--  start message-green -->
			<!--	<div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left"  height="40px;" valign="middle"> <a href="addArea.php">Add new one Location.</a></td>
					
				</tr>
				</table>
				</div>-->
				<!--  end message-green -->

			  <!--  start product-table ..................................................................................... -->
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr. No.</p>	</th>
                   <!-- <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Ad name</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Ad descripttion</p></th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Uploaded By</p>	</th>
					<!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Slot name</p>	</th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Amount</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">From Date</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">To Date</p>	</th>
					<!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Status</p></th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">View Ad</p>	</th>
				
					<!--<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options</p></th>-->
					
				</tr>
                <?php
				
				$query = "SELECT `id`, `upload_by`, `amt`, `fromdt`, `todt`, `status` FROM `ads_upload` WHERE  status=1";
				

/*	$adstats=$_POST['adstatus'];

if($adstats!="")
{
  
    $query.=" and  status='".$adstats."' ";
}
*/


if($_POST['uplaodby']!="")
{
  $query.=" and  upload_by='".$_POST['uplaodby']."' ";
    
}
		
				$query.= " LIMIT " . $from . "," . $offset; 
				
		//	echo $query;
$result = mysql_query($query);
//echo "hii".$result;
$i1=1;
$row_number = $from + 1;
while($row=mysql_fetch_array($result)){
	$query1 = "SELECT * FROM clients where code='".$row['upload_by']."'";
$result1 = mysql_query($query1);
$row1=mysql_fetch_array($result1);

				?>
				<tr class="alternate-row">
					
					<td><?php echo $i1; ?></td>
				<!--<td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['descrtn']; ?></td>-->
					<td><?php echo $row1['name']; ?></td>
				<!--<td><?php echo $row2['name']; ?></td>-->
					<td><?php echo $row['amt']; ?></td>
					<td><?php echo date('d-m-Y',strtotime($row['fromdt'])); ?></td>
					<td><?php echo date('d-m-Y',strtotime($row['todt'])); ?></td>
				<!--	<td><?php echo $row['status']; ?></td>-->
					<td><input type="button" onclick="fnc('<?php echo $row['id']; ?>');" value="View">
					</td>
					
					
					
					
				<!--	<td>
					    <?php if($adstats==2)
                          {
                        ?>
					    <input type="button" id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['id']; ?>',this.id,'1');" value="Approve">
					<?php }elseif($adstats==1){
					?>
					<input type="button" id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['id']; ?>',this.id,'2');" value="Reject">
				<?php }else{
				
				?>
				<input type="button" id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['id']; ?>',this.id,'1');" value="Approve">
				<input type="button" id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['id']; ?>',this.id,'2');" value="Reject">
				<?php } ?>
				</td>-->
				
				
				
				
		</tr>	
				
			
                <?php $i1++; } ?>
                <tr>
        	<td align="center" colspan="9" class="white">
        	<?PHP
				//Lets add the paging here
				doPages($offset, 'adsapprovaldetails.php', '', $total_records); 
			?>    
            </td>
		</tr>

				</table>
				<!--  end product-table................................... --> 
				
			</div>
			<!--  end content-table  -->
		
			<?PHP
	//Let's close the database link pointer
	//mysql_close($link);

	function check_integer($which) {
        if(isset($_REQUEST[$which])){
            if (intval($_REQUEST[$which])>0) {
                //check the paging variable was set or not, 
                //if yes then return its number:
                //for example: ?page=5, then it will return 5 (integer)
                return intval($_REQUEST[$which]);
            } else {
                return false;
            }
        }
        return false;
    }//end of check_integer()

    function get_current_page() {
        if(($var=check_integer('page'))) {
            //return value of 'page', in support to above method
            return $var;
        } else {
            //return 1, if it wasnt set before, page=1
            return 1;
        }
    }//end of method get_current_page()

    function doPages($page_size, $thepage, $query_string, $total=0) {
        
        //per page count
        $index_limit = 10;

        //set the query string to blank, then later attach it with $query_string
        $query='';
        
        if(strlen($query_string)>0){
            $query = "&amp;".$query_string;
        }
        
        //get the current page number example: 3, 4 etc: see above method description
        $current = get_current_page();
        
        $total_pages=ceil($total/$page_size);
        $start=max($current-intval($index_limit/2), 1);
        $end=$start+$index_limit-1;

        echo '<div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }

        if($start > 1) {
            $i = 1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }

        if($total_pages > $end){
            $i = $total_pages;
            echo '<a href="'.$thepage.'?page='.$i.$query.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $total_pages) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$thepage.'?page='.$i.$query.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($total != 0){
            //prints the total result count just below the paging
            echo '<p id="total_count">(total '.$total.' records)</p></div>';
        }
        
    }//end of method doPages()
	
?>
			
			<!--  start paging..................................................... --><!--  end paging................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left
	<div id="footer-left">
	
	Admin Skin &copy; Copyright 1 Click Guide. <span id="spanYear"></span> <a href="1clickguide.org">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 </form>
</body>
</html>