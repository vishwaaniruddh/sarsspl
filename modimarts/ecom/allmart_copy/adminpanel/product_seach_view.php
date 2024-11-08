<?php session_start(); ?>
<?php 
include('config.php');

$searchtxt=$_POST['searchtxt'];
$searchcat=$_POST['searchcategory'];
// $sql_statement = 'select * from Productviewtable where ccode=0';
$sql_statement = 'select * from Productviewtable';
	
	if($searchtxt!="" && $searchcat!="")
	{
	    $sql_statement.= " and name like '%".$searchtxt."%' and category like '%".$searchcat."%'";
	}
	else if($searchtxt!="")
	{
	    $sql_statement.= " and name like '%".$searchtxt."%'";
	}
		else if($searchcat!="")
			{
			    
			    $sql_statement.= " and category like '%".$searchcat."%'";
			}
	
// echo $sql_statement;
	//run the mysql query
	$num_Array = mysql_query($sql_statement);
	
	//total records
	$total_records = mysql_num_rows($num_Array);
	
	//get the page number from the REQUEST / GET
	$page = $_REQUEST['page'];
	
	//numbers of rows to show on page
	$offset = 20;
	
	//lets calculate the LIMIT for SQL, and save it $from
	if ($page!=""){
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
  
  
 
  
</script>
<body> 
<form id="frmsrch" action="" method="POST">
<!-- Start: page-top-outer --><!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Your Products</h1>
	</div>
	<!-- end page-heading -->
	
	
		<table width="50%" align="center" border="0" id="id-form" >
 <tr height="30" ><td>
     <input type="text" style="margin-left:20px;" name="searchtxt" class="inp-form" size="50" value="<?php echo $searchtxt;?>" placeholder="Product name" />
     
     <input type="text" style="margin-left:20px;" name="searchcategory" class="inp-form" size="50" value="<?php echo $searchcat;?>" placeholder="Product category" />
     
     <input type="button" class="btn-form" name="search" value="Search" onclick="shwsrch(1);"/></td></tr>
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
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				  <!--  start message-green -->
				<div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
			
				</table>
				</div>
				<!--  end message-green -->

			  <!--  start product-table ..................................................................................... -->
					<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><p style="font-size:16px; color:#FFF;">Sr No</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Image</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Product Name</p></th>
						<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">category</p></th>
					
					<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Price</p></th>
					<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Select</p></th>
				</tr>
                <?php
			
            // 			$query = "select * from Productviewtable where ccode=0";
            $query = "select * from Productviewtable";
			
		
				if($searchtxt!="" && $searchcat!="")
	{
	    $query.= " and name like '%".$searchtxt."%' and category like '%".$searchcat."%'";
	}
	
	else if($searchtxt!="")
			{
			    
			    $query.= " and name like '%".$searchtxt."%'";
			}
		else if($searchcat!="")
			{
			    
			    $query.= " and category like '%".$searchcat."%'";
			}
	
			
			
			
			 $query.= " order by name ASC LIMIT " . $from . "," . $offset;
			 //	echo $query;
$result = mysql_query($query);
			
		
			
	//$query = "select  from cities order by name";
//$result = mysql_query($query);

//$numcalc=$Page*$offset;

			//	$i=($offset+1)-$numcalc;


	if($page=="1" or $page=="")
	{
	$i1="1";
	}else
	{
	    
	   $i1=($offset* $page)-$offset;
	   
	   $i1=$i1+1;
	}

while($row=mysql_fetch_array($result)){
    
    $rt=mysql_query("select * from Productviewimg where product_id='".$row[0]."' and category='".$row['category']."' limit 0,1");
$ftyr=mysql_fetch_array($rt);
				?>
				<tr class="alternate-row">
					<td><?php echo $i1; ?></td>
					<td align="center"><img src="../<?php echo $ftyr["img"]; ?>" alt="image" height="150" ></td>
					
					<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["category"]; ?></td>
					<td><?php echo $row["total_amt"]; ?></td>
					<td class="options-width">
					<button type="button" onclick='saleupdtfn("<?php echo $row["code"]; ?>","<?php echo $row["category"]; ?>")'>Select</button>
					</td>
				</tr>
                <?php $i1++; } ?>
                
                 <tr>
        	<td align="center" colspan="6" class="white">
        	<?PHP
				//Lets add the paging here
				doPages($offset, 'product_seach_view.php', '', $total_records); 
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
            echo '<a href="javascript:void(0);" onclick="shwsrch('.$i.$query.');" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }

        if($start > 1) {
            $i = 1;
            echo '<a href="javascript:void(0);" onclick="shwsrch('.$i.$query.');" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a <a href="javascript:void(0);" onclick="shwsrch('.$i.$query.');" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }

        if($total_pages > $end) {
            $i = $total_pages;
            echo '<a href="javascript:void(0);" onclick="shwsrch('.$i.$query.');" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $total_pages) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="javascript:void(0);" onclick="shwsrch('.$i.$query.');" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($total != 0) {
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