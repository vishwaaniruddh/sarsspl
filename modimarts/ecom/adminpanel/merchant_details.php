<?php
session_start();
?>
<?php 
//ini_set( "display_errors", 0);
include('config.php');
//$sql="select id ,user_id,date,amount from Orders";

include('header.php'); 
$mrc_name=$_POST['mrc_name'];	
	$product_name=$_POST['product_name'];	
	$order_id=$_POST['order_id'];
		//echo "oid=".$order_id;
	$ordstatus=$_POST['ordstatus'];
 // echo "ram".$ordstatus;
	$fdate=$_POST['rdate'];	
	$fromdate=date("Y-m-d", strtotime($fdate) );
	
	$tdate=$_POST['tdate'];
	$todate=date("Y-m-d", strtotime($tdate) );

	$sql="select * from Orders where 1=1";
	if($order_id!="")
	{
	    $sql.= " and id ='".$order_id."'";
	}
		
	if($fdate && $tdate!=""){
        //$abc.=" and date(createtime)='".$newDate."'";
        $sql.=" and date between '".$fromdate . " 00:00:00" ."' and '".$todate. " 23:59:59" ."'";
        echo $sql;
    }
	/*
	if($fdate!="")
	{
	    $dt=str_replace("/","-",$fdate);
        $newDate = date("Y-m-d", strtotime($dt));
		$sql.= " and oid in (select id from `Orders` where date(date) >= '".$newDate."')";
	}
	if($tdate!="")
	{
	    //echo $sql_statement; 
        $dt1=str_replace("/","-",$tdate);
        $Date=date('Y-m-d', strtotime($dt1));
			    
	    $sql.= " and oid in (select id from `Orders` where date(date) <= '".$Date."')";
	}
	*/	
			
    //echo $sql_statement;	
	//run the mysql query
	$result=mysql_query($sql);
	//$num_Array = mysql_query($result);
	
	//total records
	$total_records = mysql_num_rows($result);
	
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
		<h1>Order details</h1>
	</div>
	<!-- end page-heading -->
	<table aling="center" style="margin-left:100px; margin-bottom:10px; padding:30px;">
	<tr height="30" >
        <td> <input type="text" name="order_id" id="order_id" class="inp-form" size="50" placeholder="Order id"/>
        <!--<td>
            <select id="ordstatus" name="ordstatus" class="inp-form">
                <option value="">Order Status</option>
                <option value="Pending">Pending for approval</option>
                <option value="Accept">Approved</option>
                <option value="rej">Rejected</option>
                <option value="c">Completed</option>
            </select>
        </td>-->
    <!--</tr>  <tr> -->
        <td><input type="text" name="rdate" id="rdate"  class="inp-form" placeholder="from date" /></td>
        <td><input type="text" name="tdate" id="tdate"  class="inp-form" placeholder="to date"/></td>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="datepc/dcalendar.picker.js"></script>
        <script>
        $('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
        $('#tdate').dcalendarpicker({format: 'dd-mm-yyyy'});
        </script>
	    <td><input type="submit" class="btn" name="search" value="Search"/></td>
	  </tr>
	</table>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
    	<tr>
    		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
    		<th class="topleft"></th>
    		<td id="tbl-border-top">&nbsp;</td>
    		<th class="topright"></th>
    		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
    	</tr>
	    <tr>
	        <td id="tbl-border-left"></td>
	        <td ></td>
	        <td id="tbl-border-right"></td>
	    </tr>
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
					
                    <th class="table-header-repeat line-left"><p style="font-size:14px; color:#FFF;min-width: 50px;" >Sr. No.</p>	</th>
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;min-width: 50px;">Order ID</p>	</th>
				<!--	<th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">Merchant ID</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">Merchant Name</p>	</th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">Client Name</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">client Address</p></th>
					<!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">Product Image</p></th>-->
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">Total Amount</p></th>
				   <th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">Date</p></th>
				   <th class="table-header-repeat line-left minwidth-1"><p style="font-size:14px; color:#FFF;">view</p></th>
					
					
				</tr>
                <?php
$i1=1;
$row_number = $from + 1;
//$sn=1;


while($row=mysql_fetch_array($result)){
    $query="select Firstname,Lastname,address from Registration where id='".$row[1]."'";
    $result1=mysql_query($query);
    $row1=mysql_fetch_array($result1);
    ?>
    <tr><td><?php echo $i1; ?></td>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row1[0].' '.$row1[1]; ?></td>
        <td><?php echo $row1[2]; ?></td>
        
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[2]; ?></td>
            <td> <a href="viewmerchant.php?cmp=<?php echo $row['id']; ?>">view</a></td>
    </tr>
   <?php $i1++; } 
   ?>
			
                               <tr>
        	<td align="center" colspan="9" class="white">
        	<?PHP
				//Lets add the paging here
				doPages($offset, 'merchant_details.php', '', $total_records); 
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