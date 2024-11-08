<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<?php 
//	ini_set( "display_errors", 0);
include('header.php'); 
include('config.php');



$sql_statement = 'SELECT * FROM areas where 1 ';
	$searchtxt=$_POST['searchtxt'];	
	$cityname=$_POST['cityname'];	
	
	
		if($cityname!="")
			{
			    	$querycity1 = "SELECT code FROM cities where name like '".$cityname."%' or keywords like '".$cityname."%'";
$resultcity1= mysql_query($querycity1);
$rowcity1=mysql_fetch_row($resultcity1);
			    $sql_statement.= " and city ='".$rowcity1[0]."'";
			}	
	
	if($searchtxt!="")
			{
			    
			    $sql_statement.= " and name like '".$searchtxt."%'";
			}
			
	//	echo $sql_statement;	
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
    
    function deletefunc(delid)
 {
	//alert(delid);
	if (confirm("Are you sure, you want to delete?")) {
	
	  $.ajax({
             type: "POST",
             url: "deleteAreas.php",
			
             data: 'cmp='+delid,
			
             success: function(msg){
              
             // alert(msg);
			   if(msg!=1)
			   {
				   
				   alert("Error");
			   }
			   else
			   {
				   alert("Delete Succsess");
				   //func('','');
				   
				   window.location.reload();
			   }
			   
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
			   
             },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
	} return false;
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
		<h1>Locations</h1>
	</div>
	<!-- end page-heading -->
	
	
		<table width="50%" align="center" border="0" id="id-form" >
 <tr height="30" ><td>
     <input type="text" style="margin-left:20px;" name="searchtxt" class="inp-form" size="50" placeholder="Area name" />
     <input type="text" style="margin-left:20px;" name="cityname" class="inp-form" placeholder="City name"  />
    
     <input type="submit" class="btn-form" name="search" value="Search"/></td></tr>
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
				<tr>
					<td class="green-left"  height="40px;" valign="middle"> <a href="addArea.php">Add new one Location.</a></td>
					
				</tr>
				</table>
				</div>
				<!--  end message-green -->

			  <!--  start product-table ..................................................................................... -->
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">City</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Area Name</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Area Code</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Keyword</p></th>
					
					
					<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options</p></th>
				</tr>
                <?php
				
				$query = "SELECT * FROM areas where 1";
				
				
				if($searchtxt!="")
			{
			    
			    $query.= " and name like '".$searchtxt."%'";
			}
					if($cityname!="")
			{
			    	$querycity = "SELECT code FROM cities where name like '".$cityname."%' or keywords like '".$cityname."%'";
$resultcity= mysql_query($querycity);
$rowcity=mysql_fetch_row($resultcity);
			    $query.= " and city ='".$rowcity[0]."'";
			}	
				
				$query.= " order by name  ASC LIMIT " . $from . "," . $offset;
				
				//echo $query;
$result = mysql_query($query);

$i1=1;
$row_number = $from + 1;
while($row=mysql_fetch_row($result)){
	$query1 = "SELECT * FROM cities where code='$row[0]'";
$result1 = mysql_query($query1);
$row1=mysql_fetch_row($result1);

				?>
				<tr class="alternate-row">
					
					<td><?php echo $row1[2]; ?></td>
                    <td><?php echo $row[2]; ?></td>
					<td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[3]; ?></td>
					<td class="options-width">
					<a href="editArea.php?cmp=<?php echo $row[1]; ?>"  title="Edit" class="icon-1 info-tooltip"></a>
					<a href="javascript:void(0);" title="Delete" onclick="deletefunc('<?php echo $row[1]; ?>');" class="icon-2 info-tooltip"></a>
				
					
					</td>
				</tr>
                <?php $i1++; } ?>
                <tr>
        	<td align="center" colspan="6" class="white">
        	<?PHP
				//Lets add the paging here
				doPages($offset, 'location.php', '', $total_records); 
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