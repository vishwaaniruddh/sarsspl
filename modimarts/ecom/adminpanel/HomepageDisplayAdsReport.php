<?php
session_start();
include('config.php');

?>

<script>
function showdeatis(uid)
{
  $.ajax({
   type: 'POST',    
url:'viewdetailsforHomeDispAds.php',
data:'uid='+uid,
success: function(msg){

//alert(msg);

document.getElementById('hd2').style.display='none';
document.getElementById('hd1').style.display="";
document.getElementById('show').innerHTML=msg;


         }
     });

}




    


</script>

<?php 


include('header.php'); 




$sql_statement = 'SELECT * FROM advertise_booking where 1';


if($_POST['uplaodby']!="")
{
  $sql_statement.=" and  slot='".$_POST['uplaodby']."'  ";
    
}


if($_POST['position']!="")
{
  $sql_statement.=" and  slot_pos='".$_POST['position']."'  ";
    
}

/*if($_POST['fdate']!="" && $_POST['todate']!="")
{
    $fd= date('Y-m-d', strtotime($_POST['fdate']));
    $td= date('Y-m-d', strtotime($_POST['todate']));
    
     $sql_statement.=" and  date(dt) BETWEEN '".$fd."' AND '".$td."'  ";
}

else if($_POST['fdate']!="")
{
   $fd= date('Y-m-d', strtotime($_POST['fdate']));
    
     $sql_statement.=" and  date(dt)>='".$fd."' ";
}
else if($_POST['todate']!="")
{
   $td= date('Y-m-d', strtotime($_POST['todate']));
    
     $sql_statement.=" and  date(dt)>='".$td."' ";
}
*/

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

<body> 
<form action="" method="POST">
<!-- Start: page-top-outer --><!-- End: page-top-outer -->
	<input type="hidden" id="a" name="a" />

<div class="clear">&nbsp;</div>
<div class="clear"></div>

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Ads</h1>
	
	<!-- end page-heading -->
    
<b>Section</b>
<select name="uplaodby" id="up" >
     <option value=""  >Select</option>
<?php
$getuplby=mysql_query("SELECT id,name FROM adsslotdetails");
while($clde=mysql_fetch_array($getuplby))
{
?>
    <option value="<?php echo $clde[0];?>" ><?php echo $clde[1];?></option>
<?php } ?>
</select>


<script>$("#up").change(function() { 
if($(this).data('options') == undefined){
    /*Taking an array of all options-2 and kind of embedding it on the select1*/
    $(this).data('options',$('#po option').clone());
    } 
var id = $(this).val();
//alert(id);


var d= document.getElementById('a').value=id;
k();

//var options = $(this).data('options').filter('[label=' + id + ']');
//$('#po').html(options);
 //   alert(options);
});







function k()
{
    //remove dropdown option  code start
   var select = document.getElementById("po"),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  //remove dropdown option code end
  

    var j= document.getElementById('a').value;
  // alert(j);
   $.ajax({
   type: 'POST',    
url:'dropdn.php',
data:'j='+j,
success: function(msg){

//alert(msg);


var ArrNames = msg.split(",");
var le= ArrNames.length;

//alert(le);

var a = 1;
var all = new Array();
for(i=0;i<le;i++)
{
   all[i]=ArrNames[i];
 
   //alert(all[i]);

    
  
     
      var x = document.getElementById('po');
    var option = document.createElement("option");
    option.text = all[i];
    //option.text = msg;
    
    x.add(option, x[2]);
}
         }
     });
}

</script>

<b>Position</b>
<select name="position" id="po" style="width: 100px;">
     <option value="" >Select</option>

  
</select>
    

         <!--  <b>From Date </b>
           <input type="text"   class="form-control" name="fdate" id="fdate"   class="inp-form"  />
          
           <b>To Date </b>
           <input type="text"   class="form-control" name="todate" id="todate"   class="inp-form"  />
      
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="datepc/dcalendar.picker.js"></script>
        <script>
          $('#fdate').dcalendarpicker({format: 'dd-mm-yyyy'});
           $('#todate').dcalendarpicker({format: 'dd-mm-yyyy'});
        </script>

-->

<input type="submit" action="" method="post" value="Search">
</div>

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	    
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
					<div id="table-content">
			<h3 class="widget-header-title" id="hd1" style="display:none"><strong><a href="HomepageDisplayAdsReport.php">Back</a></strong></h3>
            
              
				<div id="show"> </div>
				<div id="hd2">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr. No.</p>	</th>
                  <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Uploaded by</p>	</th>
					
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">From Date</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">To Date</p>	</th>
					
					
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Rate Total Amount</p>	</th>
				
					
				</tr>
                <?php
				
				//$query = "SELECT *  FROM slider_slot_rate where 1";
	    
	    		$sql_statement.= " LIMIT " . $from . "," . $offset; 
				
				//echo "aan".$query;
			$result = mysql_query($sql_statement);

$i1=1;
$row_number = $from + 1;
while($row=mysql_fetch_array($result)){
$qrypro=mysql_query("select name from clients where code='".$row[1]."'");
$fetchp=mysql_fetch_array($qrypro);

$qrypro1=mysql_query("select fromdt,todt from advertise_booking_dets where id='".$row[7]."'");
$fetchp1=mysql_fetch_array($qrypro1);


				?>
				<tr class="alternate-row">
					<td><?php echo $i1; ?></td>
					<td><?php echo $fetchp[0]; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($fetchp1[0])); ?></td>
				   	<td><?php echo date("d-m-Y", strtotime($fetchp1[1])); ?></td>
				   	
				   	<td><?php echo $row[6];?></td>
				</tr>
				
                <?php $i1++; } ?>
                <tr>
        	<td align="center" colspan="9" class="white">
        	<?PHP
				//Lets add the paging here
				doPages($offset, 'HomepageDisplayAdsReport.php', '', $total_records); 
			?>    
            </td>
		</tr>

				</table>
				<!--  end product-table................................... --> 
				
			</div></div>
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
           
<div id="footer">
	
	<div class="clear">&nbsp;</div>
</div>

 </form>
</body>
</html>