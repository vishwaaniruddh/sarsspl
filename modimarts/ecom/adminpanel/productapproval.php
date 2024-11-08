<?php
session_start();
    //Check whether the session variable SESS_MEMBER_ID is present or not
/*  if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
    {
        header("location: access-denied.php");
        exit();
    }*/
?>
<?php 
//ini_set( "display_errors", 0);
include('config.php');
include('access.php');
include('header.php'); 

//$sql_statement = 'SELECT * FROM Productviewtable where 1';

$sql_statement = 'SELECT * FROM Productviewtable '.
'union all select `allmart_ecommerce`.`Approval_products`.`code` AS `code`,`allmart_ecommerce`.`Approval_products`.`name` AS `name`,'.
 '`allmart_ecommerce`.`Approval_products`.`ccode` AS `ccode`,`allmart_ecommerce`.`Approval_products`.`description` AS `description`,'.
 '`allmart_ecommerce`.`Approval_products`.`category` AS `category`,`allmart_ecommerce`.`Approval_products`.`photo` AS `photo`,'.
 '`allmart_ecommerce`.`Approval_products`.`price` AS `price`,`allmart_ecommerce`.`Approval_products`.`others` AS `others`,'.
' `allmart_ecommerce`.`Approval_products`.`discount` AS `discount`,`allmart_ecommerce`.`Approval_products`.`discount_type` AS `discount_type`,'.
 '`allmart_ecommerce`.`Approval_products`.`quentity` AS `quentity`,`allmart_ecommerce`.`Approval_products`.`total_amt` AS `total_amt`,'.
 '`allmart_ecommerce`.`Approval_products`.`status` AS `status`,`allmart_ecommerce`.`Approval_products`.`thumbs` AS `thumbs`,'.
 '`allmart_ecommerce`.`Approval_products`.`midsize` AS `midsize`,`allmart_ecommerce`.`Approval_products`.`Reason` AS `Reason`,'.
' `allmart_ecommerce`.`Approval_products`.`size` AS `size`,`allmart_ecommerce`.`Approval_products`.`brand` AS `brand`,'.
' `allmart_ecommerce`.`Approval_products`.`color` AS `color`,`allmart_ecommerce`.`Approval_products`.`size_id` AS `size_id`,'.
' `allmart_ecommerce`.`Approval_products`.`product_type` AS `product_type`,`allmart_ecommerce`.`Approval_products`.`Long_desc` AS `Long_desc`,'.
' `allmart_ecommerce`.`Approval_products`.`keyword1` AS `keyword1` from `allmart_ecommerce`.`Approval_products` where 1 order by ';
                                                                        
// echo $sql_statement;
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
    //echo $sql_statement;  
    //run the mysql query
    $num_Array = mysqli_query($con3,$sql_statement);
    
    //total records
    $total_records = mysqli_num_rows($num_Array);
    //get the page number from the REQUEST / GET
    if(isset($_POST['submit']))
    {
        $page=1;
    } else {
        $page = $_REQUEST['page'];
    }
    //numbers of rows to show on page
    $offset = 20;
    //lets calculate the LIMIT for SQL, and save it $from
    if ($page){
        $from   = ($page * $offset) - $offset;
    }  else  {
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

function fncTest(id,cid,clientCode)
{
    try
    {
        var left = (screen.width/2)-(850/2);
        var top = (screen.height/2)-(650/2);
        window.open('viewproductimg.php?adid='+id+"&cid="+cid+"&ccode="+clientCode,'parentcon',"scrollbars=yes, resizable=no,width=750, height=400, top="+top+", left="+left);
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

function approvefunc(adid,btnid,stts,app,ct)
{
    try
    {
        if(stts==1)
        {
            var conf=confirm("Are you sure you want to Approve");
        } else {
             var conf=confirm("Are you sure you want to Reject");
        }
        if(conf)
        {
            $.ajax({
                type: 'POST',    
                url:'processproductapprove.php',
                data:'Status=7'+'&adid='+adid+'&stts='+stts+'&ct='+ct,
                beforeSend: function() {
                document.getElementById(btnid).disabled=true;
            },
            success: function(msg){
            // alert(msg);
            if(msg==1)
            {
                if(stts==1)
                {
                    alert("Product approved!!");
                    document.getElementById(btnid).value="APPROVED";
                } else {
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
                document.getElementById(btnid).disabled=false;
                document.getElementById(btnid).value="Approve";
            }
        }
        });
    }
    } catch(exdce)
    {
        //alert(exdce);
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
        url:'processproductapprove.php',
        data:'re='+re+'&cod='+cod+'&em='+em+'&sttss=reasn',
        success: function(msg){
        //alert(msg);
           if(msg=='1'){
                alert("Product rejected and Mail Send Successfully");
                var modal = document.getElementById('myModal');
                modal.style.display = "none";
                document.getElementById('txtreason').value = "";
           }
        }
    });
}}

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
<!--------- start content-outer ........START ----------->
<div id="content-outer">
<!-- start content -->
<div id="content">
    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Products Approval</h1>
    </div>
    <!-- end page-heading -->
<b>Product  Status</b>
<select name="adstatus" id="adstatus">
    <option value="0" <?php if($adstats=="0"){ echo "selected";}?>>Pending for approval</option>
    <option value="1" <?php if($adstats=="1"){ echo "selected";}?>>Approved</option>
    <option value="2" <?php if($adstats=="2"){ echo "selected";}?>>Rejected</option>
</select>   
<b>Merchant Name</b>
<?php
$ftarr=array();
$getuplby=mysqli_query($con3,"SELECT distinct(ccode) FROM Productviewtable");
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
        $query1234 =mysqli_query($con3,"SELECT * FROM clients where code in (".join(",",$ftarr).") order by name asc");
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
</form>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
        <tr>
            <td id="tbl-border-left"></td>
            <td>
                <!--  start content-table-inner ...................................................................... START -->
                <div id="content-table-inner">
                    <!--  start table-content  -->
                    <div id="table-content">
                        <!--  start message-green -->
                        <!--<div id="message-green">
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
                    
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Sr. No.</p> </th>
                   <!-- <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Ad name</p> </th>
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Ad descripttion</p></th>-->
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Uploaded By</p> </th>
                <!--    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">product img</p> </th>-->
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">product name</p>    </th>
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Category</p>    </th>
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Brand</p>   </th>
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Description</p> </th>
                    <!--<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">View img</p>    </th>-->
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Options</p></th>

                    <!--<th class="table-header-options line-left"><p style="font-size:16px; color:#FFF;">Options</p></th>-->
                    
                </tr>
                <?php
            
                //$query = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`,  `price`, `others`, `discount`, `discount_type`, `total_amt`, `status`,brand,Long_desc FROM `Productviewtable` WHERE 1";
                $query= "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`,  `price`, `others`, `discount`, `discount_type`, `total_amt`, `status`,brand,Long_desc  FROM `Productviewtable`union all select `code`, `name`, `ccode`, `description`, `category`, `photo`,  `price`, `others`, `discount`, `discount_type`, `total_amt`, `status`,brand,Long_desc from Approval_products WHERE 1";
    //  $query.=" and  status='0' ";

if($_REQUEST['uplaodby']!="")
{
  $query.=" and ccode='".$_REQUEST['uplaodby']."' ";
    
}
if($adstats=="")
{
   $adstats="0"; 
    
}
$query.=" and  status='".$adstats."' or status=3 ";
if($_REQUEST['uplaodby']!="")
{
  $query.=" and  ccode='".$_REQUEST['uplaodby']."' ";
}       
    $query.= " order by code LIMIT " . $from . "," . $offset;
    //echo $query;
    $result = mysqli_query($con3,$query);
    
//echo $query;
$i1=1;

    $offset = 20;
    
//  echo "pg".$page;
    if($page=="1" or $page=="")
    {
    $i1="1";
    }else
    {
        
       $i1=($offset* $page)-$offset;
       
       $i1=$i1+1;
    }

$row_number = $offset + 1;
while($row=mysqli_fetch_array($result)){
    
    $query1 = "SELECT code,name,category,email FROM clients where code='".$row['ccode']."'";
    //echo "$query1".$prod;
    

    
   $ctid=$row['category'];
//--========================query for get category which is under "0" ======
$qrya="select * from main_cat where id='".$row['category']."'";
//echo $qrya;
 $resulta=mysqli_query($con3,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];
if($aa!=0){
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con3,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
    
    
    /* Ruchi */
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
    } 

//  ==============================================================

if($Maincate==1){   
     $slting=mysqli_query($con3,"SELECT * FROM `fashion_img` where product_id='".$row[0]."' limit 0,1");
}
else if($Maincate==190)
{   
     $slting=mysqli_query($con3,"SELECT * FROM `electronics_img` where product_id='".$row[0]."' limit 0,1");
}
else if($Maincate==218)
{   
     $slting=mysqli_query($con3,"SELECT * FROM `grocery_img` where product_id='".$row[0]."' limit 0,1");
} 
else if($Maincate==482)
{   
     $slting=mysqli_query($con3,"SELECT * FROM `Resale_img` where product_id='".$row[0]."' limit 0,1");
} 
else
{   
     $slting=mysqli_query($con3,"SELECT * FROM `product_img` where product_id='".$row[0]."' limit 0,1");
}
    
$sltingf=mysqli_fetch_array($slting);
$result1 = mysqli_query($con3,$query1);
$row1=mysqli_fetch_array($result1);
$f=false;
//ruchi Get product name by id
$prod = mysqli_query($con3,"SELECT * FROM product_model where id='".$row['name']."'");
$product_details = mysqli_fetch_assoc($prod);
//ruchi Get brand name by id
$brand = mysqli_query($con3,"SELECT brand FROM brand where id='".$row['brand']."'");
$brand_name = mysqli_fetch_assoc($brand);
//var_dump($product_details);
?>
            <?php if($row['status']!=1) {?>
                <tr class="alternate-row">
                    <td><?php echo $i1; ?></td>
                    <td><?php echo $row1['name']; ?></td>
                    <?php /*<td><?php echo $row['description']; ?></td>*/?>
                    <!--    <td><img src="../<?php echo $sltingf['img']; ?>" style="height:200px; width:200px;object-fit:contain"</td>-->
                    <td><?php echo $product_details['product_model']; ?></td>
                    <td>
                        <?php   
                            $cat=mysqli_query($con3,"select name from main_cat where id='".$row['category']."'");
                            $nrs=mysqli_num_rows($cat);
                            if($nrs>0)
                            {
                                $f=true;
                                $rowr = mysqli_fetch_assoc($cat);
                                 echo $rowr['name']; 
                            } else   { 
                                $f=false;
                                $newcat=mysqli_query($con3,"select name from approval_category where product_id='".$row['code']."'");
                                $n=mysqli_num_rows($newcat);
                                if($n>0)
                                {
                                    //$f=true;
                                    $c = mysqli_fetch_assoc($newcat);
                                    echo $c['name'];
                         ?>
                    </td>
                    <?php } } ?>
                    <td><?php echo $brand_name['brand']; ?></td>
                    <?php /* <td><?php echo $row['description']; ?></td> */ ?>
                    <td><?php echo $product_details['description']; ?></td>
                    <td>
                        <!--<input type="button" onclick="fncTest('<?php echo $row['code']; ?>','<?php echo $ctid;?>',<?php echo $row['ccode']; ?>);" value=" Approve ">-->
                        <a href="EditProductApproval.php?pid=<?php echo $row['name']; ?>&bid=<?php echo $row['brand']; ?>&mid=<?php echo $Maincate;?>&uid=<?php echo $row['ccode']; ?>&pcode=<?php echo $row['code']; ?>" target="blank"><input type="button"  value=" Approve "></a>
                       <button  id="apps<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'2','app<?php echo $i1;?>','<?php echo $row['category']?>');" value="<?php echo $reject; ?>" <?php echo $disable; ?>><?php echo $reject; ?></button>
                    </td>
                    <?php 
                    /*<td>
                        <?php if($adstats==2) {
                         ?>
                        <input type="button" id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'1','app<?php echo $i1;?>','<?php echo $row['category']?>');" value=" Approve " >
                        
                        <?php }elseif($adstats==1){
                         ?>
                        <input type="button" id="apps<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'2','app<?php echo $i1;?>','<?php echo $row['category']?>');" value=" Reject ">                      <?php }else{ 
                            if($approve){
                        ?>
                        <input type="button"   id="app<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'1','app<?php echo $i1;?>','<?php echo $row['category']?>');" value=" Approve" <?php if(!$f){ echo 'disabled' ;} ?>>
                        <?php } ?>
                        <input type="button" id="apps<?php echo $i1;?>" onclick="approvefunc('<?php echo $row['code']; ?>',this.id,'2','app<?php echo $i1;?>','<?php echo $row['category']?>');" value="<?php echo $reject; ?>" <?php echo $disable; ?>>
                    <?php } 
                */?>
                <input type="hidden" id="em" name="em" value="<?php echo $row1['email']; ?>" />
                <input type="hidden" id="rhd" name="rhd" value="<?php echo $row['code']; ?>" />
                </td>
                </tr>
                <?php } ?>
                <?php $i1++; } ?>
                <tr>
            <td align="center" colspan="9" class="white">
            <?PHP
                //Lets add the paging here
                doPages($offset, 'productapproval.php', '', $total_records); 
            ?>    
            </td>
        </tr>
    </table>
    <!--  end product-table................................... --> 
    </div>
        <!--  end content-table  -->
        <?PHP
    //Let's close the database link pointer
    //mysqli_close($link);

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
        
        if(strlen($query_string)>0){
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
</body>
</html>