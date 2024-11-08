<?php
session_start();
include("config.php");
$frmdt=date("Y-m-d",strtotime($rwsc2["entrydt"]));

$num_Array = mysqli_query($con,"SELECT * FROM `quiztest_test_appeared` where testby='".$_SESSION['userid']."'");

	//total records
	$total_records = mysqli_num_rows($num_Array);
	
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
 
            <?php
			
		$qr="SELECT * FROM `quiztest_test_appeared` where testby='".$_SESSION['userid']."' order by test_datetym asc";
$tstdets=mysqli_query($con,$qr);
$nmrws=mysqli_num_rows($tstdets);
$hexs=0;
    
    
    
    
		

	if($page=="1" or $page=="")
	{
	$i1="1";
	}else
	{
	    
	   $i1=($offset* $page)-$offset;
	   
	   $i1=$i1+1;
	}
?>
 <div class="container" >
     <div class="row" >
         <div class="col-md-2"></div>
         <div class="col-md-8 div3" >
       
<table border="1" class="table" style=" ">
<?php
while($rwsf=mysqli_fetch_array($tstdets))
{
    ?>
<tr>
<td>
<?php echo date("d-F-Y",strtotime($rwsf["test_datetym"]));?>
</td>

<td>
    <?php
$testagnst="";
if($rwsf["test_against"]=="1")
{
  $testagnst="Artificial Inelligence"; 
}
?>

<?php echo $testagnst;?>

</td>

<td>
<?php echo $rwsf["score"];?>

</td>
</tr>
<?php
}

?>

<tr>
    <td>
<?php
doPages($offset, 'product_seach_view.php', '', $total_records); 
	?>
	</td>
	</tr>
	
	</table>
	</div>
	  <div class="col-md-2"></div>
     </div>
	</div>
	<?php
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
            echo '<a href="javascript:void(0);" onclick="gethis('.$i.$query.');" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }

        if($start > 1) {
            $i = 1;
            echo '<a href="javascript:void(0);" onclick="gethis('.$i.$query.');" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a <a href="javascript:void(0);" onclick="gethis('.$i.$query.');" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }

        if($total_pages > $end){
            $i = $total_pages;
            echo '<a href="javascript:void(0);" onclick="gethis('.$i.$query.');" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $total_pages) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="javascript:void(0);" onclick="gethis('.$i.$query.');" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
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