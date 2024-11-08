<?php
session_start();
//var_dump($_SESSION);
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
include('access.php');
include('header.php'); 

/* Ruchi */
/*
$isSubAdmin = false;
$querySubAdmin=mysqli_query($con1,"SELECT * FROM subAdminLogin where email='".$_SESSION['email']."'");

if(mysqli_num_rows($querySubAdmin)>0){
    echo 'y';
   $isSubAdmin = true; 
} else {
    echo 'n';
}*/

$sql_statement = 'SELECT * FROM Productviewtable where 1';

$adstats=$_REQUEST['adstatus'];

if($adstats=="")
{
   $adstats="0"; 
    
}
$sql_statement.=" and  status='".$adstats."' ";

if($_REQUEST['uplaodby']!="")
{
  $sql_statement.=" and  ccode='".$_REQUEST['uplaodby']."' ";
}

//	echo $sql_statement;	
	//run the mysql query
	$num_Array = mysqli_query($con1,$sql_statement);
	
	//total records
	$total_records = mysqli_num_rows($num_Array);
	
	//get the page number from the REQUEST / GET
	if(isset($_POST['submit']))
	{
	    $page=1;
	}else{
	$page = $_REQUEST['page'];
	}
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
<link rel="stylesheet" href="pop.css">
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

function fnc(id,cid)
{
    try
    {
    var left = (screen.width/2)-(850/2);
    var top = (screen.height/2)-(650/2);
    
    window.open('viewproductimg.php?adid='+id+"&cid="+cid,'parentcon',"scrollbars=yes, resizable=no,width=750, height=400, top="+top+", left="+left);
    }catch(exc)
    {
        alert(exc);
    }
}

function srfn()
{
    var uplaodby= document.getElementById("uplaodby").value;
    var adstatus= document.getElementById("adstatus").value;
    window.open("productapproval.php?page=1&adstatus="+adstatus+"&uplaodby="+uplaodby,"_self");
}

function approvefunc(tempid,btnid,stts)
{
    //alert('status : '+stts);
    try
    {
        if(stts==1)
        {
            var conf=confirm("Are you sure you want to Approve");
        }else{
             var conf=confirm("Are you sure you want to Reject");
        }
        /*if(conf)
        {
            $.ajax({
                type: 'POST',    
                url:'processcategoryapprove.php',
                data:'tempid='+tempid+'&stts='+stts,
                success: function(msg){
                    //alert(msg)
                    if(msg==1)
                    {
                        if(stts==1)
                        {
                            alert("Category approved!!app"+stts);
                             document.getElementById("app"+stts).value="APPROVED";
                             document.getElementById("app"+stts).disabled = true;
                        }else{
                        	document.getElementById("app"+stts).value="REJECTED";
                        	 document.getElementById("app"+stts).disabled = true;
                          // Get the modal
                        }
                    }
                }
            });
        }*/
        
        if(conf)
        {
            $.ajax({
                type: 'POST',    
                url:'processcategoryapprove.php',
                data:'tempid='+tempid+'&stts='+stts,
               /* beforeSend: function() {
            	document.getElementById(btnid).disabled=true; 
    		},*/
            success: function(msg){
            alert(msg);
            if(msg==1)
            {
                if(stts==1)
                {
                    alert("Category approved!!");
                    document.getElementById(btnid).value="APPROVED";
                }else{
                     //alert("Product Rejected!!");
                     
                    $("#app1").hide();
                   // document.getElementById(app).style.visibility="hidden";
                    document.getElementById(btnid).value="REJECTED";
                      
                    // Get the modal
                    var modal = document.getElementById('myModal');
                    
                    // Get the button that opens the modal
                    //btn = document.getElementById("myBtn");
                    btn=btnid;
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];
                    modal.style.display = "block";
                    // When the user clicks on <span> (x), close the modal
                     /*span.onclick = function() {
                        modal.style.display = "none";
                    }
               */ 
            }
            }else
            {
                //document.getElementById("app"+stts).disabled=false;
                //document.getElementById(btnid).value="Approve";
            }
        }
         });
    }
    } catch(exdce)
    {
        //alert(exdce);
    }
}

/* Ruchi */
function editCategory(tempid,main_cat,sub_cat,cat)
{
    try
    {
        var left = (screen.width/2)-(850/2);
        var top = (screen.height/2)-(650/2);
        window.open('view_category.php?tempid='+tempid+"&main_cat="+main_cat+"&sub_cat="+sub_cat+"&cat="+cat,'parentcon',"scrollbars=yes, resizable=no,width=750, height=400, top="+top+", left="+left);
    }catch(exc)
    {
        alert(exc);
    }
}
</script>
<body> 
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
     <!-- <span id="ad" class="close">&times;</span>-->
      <h2>Reason</h2>
    </div>
    <div class="modal-body">
    <textarea rows="4" id="txtreason" name="txtreason" cols="50"></textarea>
    <input type="button"  value="Submit" onclick="reason()" />
    </div>
  </div>
</div>
<script>
    function reason(){
      var re=document.getElementById("txtreason").value;
      if(re!=""){
        var cod= document.getElementById("rhd").value;
        var em= document.getElementById("em").value;
        $.ajax({
            type: 'POST',    
            url:'processcategoryapprove.php',
            data:'re='+re+'&cod='+cod+'&em='+em+'&sttss=reasn',
        
            success: function(msg){
            //alert(msg);
               if(msg=='1'){
                    alert("Category rejected and Mail Send Successfully");
                    var modal = document.getElementById('myModal');
                    modal.style.display = "none";
                    document.getElementById('txtreason').value = "";
               }
            }
        });
    }
}

/*
var btn;
function a1(id){
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
 //btn = document.getElementById("myBtn");
btn=id;

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

 
    modal.style.display = "block";

// When the user clicks on <span> (x), close the modal

 span.onclick = function() {
    modal.style.display = "none";
}



 // When the user clicks anywhere outside of the modal, close it

/*window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}}*/
</script>
<form action="" method="post">
<!-- Start: page-top-outer --><!-- End: page-top-outer -->
<div class="clear">&nbsp;</div>
<div class="clear"></div>
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">
	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Category Approval</h1>
	</div>
	<!-- end page-heading -->
<!--<b>Product  Status</b>
<select name="adstatus" id="adstatus">
    <option value="0" <?php if($adstats=="0"){ echo "selected";}?>>Pending for approval</option>
     <option value="1" <?php if($adstats=="1"){ echo "selected";}?>>Approved</option>
    <option value="2" <?php if($adstats=="2"){ echo "selected";}?>>Rejected</option>
</select>
<b>Merchant Name</b>
<?php
$ftarr=array();
$getuplby=mysqli_query($con1,"SELECT distinct(ccode) FROM Productviewtable");
while($clde=mysqli_fetch_array($getuplby))
{
    $ftarr[]=$clde[0];
}
?>

<select name="uplaodby" id="uplaodby" >
    <option value="">Select Upload By</option>
<?php
if(count($ftarr)>0)
{
    
    $query1234 =mysqli_query($con1,"SELECT * FROM clients where code in (".join(",",$ftarr).") order by name asc");
    if($nrt=mysqli_num_rows($query1234)>0)
    {
       while($qr12134rws=mysqli_fetch_array($query1234))
        {
    ?>
        <option value="<?php echo $qr12134rws[0];?>" <?php if($_REQUEST["uplaodby"]==$qr12134rws[0]){ echo "selected";}?>><?php echo $qr12134rws[1];?></option>
        <?php 
        }
    }
}
?>
</select>
<input type="button" name="submit" action="" method="post" value="Search" onclick="srfn();">
-->
</form>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	    <tr>
    		<td id="tbl-border-left"></td>
    		<td>
		<!--  start content-table-inner ....... START ------------------------->
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
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Uploaded By</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Main Category</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sub Category</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Category</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Options</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">View</p></th>
					<!--<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options</p></th>-->
					
				</tr>
                <?php
				/* Ruchi : 29 aug 
				$query = "SELECT * FROM `approval_category`";*/
				$query = "SELECT * FROM `approval_category` where status=0 or status=2";
				//echo "SELECT * FROM `approval_category` where status=0";
                $result = mysqli_query($con1,$query);
            $i1=1;
            while($row=mysqli_fetch_array($result)){
                $approve =true;
                  if($row['status']==2){
                    $reject = 'Rejected';
                    $disable = 'disabled';
                    
                   	if(!isset($_SESSION['designation']) || (trim($_SESSION['designation']) == 1)){
                       $approve = false;
                   } 
                    
                } else {
                    $reject = 'Reject';
                    $disable = '';
                }
            $QClientCode = mysqli_query($con1,"SELECT ccode FROM `Approval_products` where code='".$row['Product_id']."'");
            $FetchClientCode=mysqli_fetch_array($QClientCode);
            
        	$query1 = mysqli_query($con1,"SELECT code,name,category,email FROM clients where code='".$FetchClientCode['ccode']."'");
        	$fetchClienName=mysqli_fetch_array($query1);
 
        //--========================query for get category which is under "0" ======
        $qrya="select * from main_cat where id='".$row['base_cat']."'";
        $resulta=mysqli_query($con1,$qrya);
        $rowa = mysqli_fetch_row($resulta);
        $aa=$rowa[2];
        
         $qrya2="select * from main_cat where under='".$row['under']."'";
         $resulta2=mysqli_query($con1,$qrya2);
         $rowa2 = mysqli_fetch_row($resulta2);
        //	==============================================================
		?>
				<tr class="alternate-row">
					<td><?php echo $i1; ?></td>
					<td><?php echo $fetchClienName['name']; ?></td>
					<td><?php echo $rowa[1]; ?></td>
					<td><?php echo $rowa2['1']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><input type="button" onclick="editCategory('<?php echo $row['temp_id'];?>');" value="Edit ">&nbsp;&nbsp;
					<td>
					    <?php //var_dump($row);?>
					    <?php if($adstats==2) {
                         ?>
					    <input type="button" id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'1','app<?php echo $i1;?>','<?php echo $row['category']?>');" value="Approve" >
					    <?php }elseif($adstats==1){
					     ?>
				    	<input type="button" id="apps<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'2','app<?php echo $i1;?>','<?php echo $row['category']?>');" value="Reject" >
				        <?php }else{
				            /* Ruchi */
				            if($approve) { 
				         ?>
				        <input type="button"   id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['temp_id']; ?>',this.id,'1')" value="Approve" >
				        <?php } ?>
				        <input type="button" id="apps<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['temp_id']; ?>',this.id,'2','app<?php echo $i1;?>','<?php echo $row['category']?>');" value="<?php echo $reject; ?>" <?php echo $disable; ?>>
        				<?php } ?>
        				<input type="hidden" id="em" name="em" value="<?php echo $fetchClienName['email']; ?>" />
        			    <input type="hidden" id="rhd" name="rhd" value="<?php echo $fetchClienName['code']; ?>" />
    				</td>
    			</tr>
                <?php $i1++; } ?>
                <tr>
        	<td align="center" colspan="9" class="white">
        	<?PHP
				//Lets add the paging here
				doPages($offset, 'category_Approval.php', '', $total_records); 
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
        $index_limit = "10";

        //set the query string to blank, then later attach it with $query_string
        $query='';
        
        if(strlen($query_string)>0) {
            $query = "&amp;".$query_string;
        }
        
        //get the current page number example: 3, 4 etc: see above method description
        $current = get_current_page();
        global $adstats;
        global $uploadby;

        $total_pages=ceil($total/$page_size);
        $start=max($current-intval($index_limit/2), 1);
        $end=$start+$index_limit-1;

        echo '<div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'&adstatus='.$adstats.'&uplaodby='.$_REQUEST["uplaodby"].'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }

        if($start > 1) {
            $i = 1;
            echo '<a href="'.$thepage.'?page='.$i.$query.'&adstatus='.$adstats.'&uplaodby='.$_REQUEST["uplaodby"].'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$thepage.'?page='.$i.$query.'&adstatus='.$adstats.'&uplaodby='.$_REQUEST["uplaodby"].'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }

        if($total_pages > $end){
            $i = $total_pages;
            echo '<a href="'.$thepage.'?page='.$i.$query.'&adstatus='.$adstats.'&uplaodby='.$_REQUEST["uplaodby"].'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $total_pages) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$thepage.'?page='.$i.$query.'&adstatus='.$adstats.'&uplaodby='.$_REQUEST["uplaodby"].'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
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

</body>
</html>