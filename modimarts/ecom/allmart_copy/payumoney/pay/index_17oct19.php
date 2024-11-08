<?php

include('../../config.php');
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
	if(strcasecmp($contentType, 'application/json') == 0){
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	echo json_encode($json);
	}
	exit(0);
}
 
function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	/*return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';*/
	return $protocol . $_SERVER['HTTP_HOST'] . '/oc1/payumoney/pay/response.php';
}

$UserQ="select *  from Registration where id='".$_GET['gid']."'";

$date = date('Y-m-d H:i:s');
    $prdid=$_GET['pid'];
    $cate_id=$_GET['cId'];
    
    $qtty=$_GET['qty']; 
       
    $cSize=$_GET['size'];
    $amt=$qtty * $prdrws['price'];
    $cCod=$_GET['color'];

    $pric=$amt;
    $cSize=$_GET['size'];
    $amt=$qtty * $prdrws['price'];
    
    $cartdets=mysql_query("select * from cart where user_id='".$_SESSION['gid']."' and status=0");
    $nrwss1=mysql_num_rows($cartdets);
    if($nrwss1>0)
    {
    $cartdets1=mysql_query("select sum(qty) from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss11=mysql_fetch_array($cartdets1);  
         
    $cartids="";
    $totfamt=0;       
while($cartdetsrw=mysql_fetch_array($cartdets))
{
    if($cartids=="")
    {
        $cartids=$cartdetsrw[0];
    }else
    {
        $cartids=$cartids.",".$cartdetsrw[0];
    }
    
}     
    //$wl=$_POST['wl'];
    //$amt=$_POST['amt'];
    $date = date('Y-m-d H:i:s');
    $errs=0;
     mysql_query("BEGIN"); 

//===================code for Round Robin (start)============================== 
$reg_query=mysql_query("SELECT pincode FROM `Registration` where id='".$id."'");
$reg_fetch=mysql_fetch_array($reg_query);

//$pname_query=mysql_query("SELECT name FROM `Productviewtable` where code='".$prdid."' and category='".$cate_id."' ");
//$pname_fetch=mysql_fetch_array($reg_query);

$client_query= mysql_query("select code from clients where pincode='".$reg_fetch[0]."' and code NOT IN(select DISTINCT mrc_id from order_details where item_id='".$prdid."' and cat_id='".$cate_id."' ) ");
$client_fetch=mysql_fetch_array($client_query);

if($client_fetch[0]==""){
    $max_query= mysql_query("select mrc_id,max(date) from order_details where mrc_id IN(select code from clients where pincode='".$reg_fetch[0]."') GROUP BY mrc_id order by  date desc");
    $client_fetch=mysql_fetch_array($max_query);
//echo "select max(date),mrc_id from order_details where mrc_id IN(select code from clients where pincode='".$reg_fetch[0]."') GROUP BY mrc_id order by date desc ";

}
 //===================code for Round Robin (End)============================== 
 
 
 if(isset($_POST['addressid']) && $_POST['addressid']=="")
 {
    $getaddr=mysql_query("select id FROM `user_address` where user_id='".$id."' "); 
    $getradd=mysql_fetch_array($getaddr);
    $addressid=$getradd[0];
 }
 
 if($prdid!="" && $cate_id!="")
 {
     $crtsrwstry=$pric;
 }
 else
 {
$qrycartsumamt=mysql_query("select sum(total_amt) from cart where user_id='".$id."' and status=0 and id in($cartids)");
$crtsrws=mysql_fetch_array($qrycartsumamt);
$crtsrwstry=$crtsrws[0];
}

$qryorder=mysql_query("INSERT INTO `Orders`(`user_id`, `date`, `amount`, `discount`, `coupon no`, `status`, `pmode`,mrc_id,address_id,color,size) VALUES ('".$id."','".$date."','".round($crtsrwstry,2)."','','','pending','".$pmode."','0','".$addressid."','".$cCod."','".$cSize."')");
if(!$qryorder)
{
  $errs++;  
}


$fetchorder=mysql_insert_id();
$insertid=$fetchorder;
$orderno=$insertid;

//$eamt=$amt/100;
//$qrywallet=mysql_query("INSERT INTO `ewallets`(`user_id`, `dt`, `type`, `amount`) VALUES ('".$id."','".$date."','".$pmode."','".$eamt."')");

 if($prdid!="" && $cate_id!="")
 {
     
         $getprdets=mysql_query("select * from Productviewtable where code='".$prdid."' and category='".$cate_id."' ");
         $prdrws=mysql_fetch_array($getprdets);
    
         $getprdets1=mysql_query("select img from Productviewimg where product_id='".$prdid."' and category='".$cate_id."' ");
         $prdrws1=mysql_fetch_array($getprdets1);
         
         $getprcolor=mysql_query("select * from fashioncolor where id='".$cCod."'");
         $pcolor=mysql_fetch_array($getprcolor);
     
 //========= Generate Random Number ============
         $a=  mt_rand(100000,999999);
 //==========================================

//======================= code for normal order==============================

//$qryorderdetails=mysql_query("INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$prdrws[2]."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."')");
//echo "INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$prdrws[2]."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."')";

//============================================================================

//======================= code for Round Robin order==============================

$qryorderdetails=mysql_query("INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size,date) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$client_fetch['code']."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."','".$date."')");
//echo "INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$client_fetch['code']."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."')";

//============================================================================



if(!$qryorderdetails)
{
  $errs++;  
}
     
     
     
     if($errs==0)
{
mysql_query("COMMIT");
echo $insertid;
}
else
{
    mysql_query("ROLLBACK");
echo 0;
}
     
     
     
     
     
}
else{

$qrycart=mysql_query("select * from cart where user_id='".$id."' and status=0 and id in($cartids)");
while($fetchcart=mysql_fetch_array($qrycart))
{
   $c= $fetchcart['cat_id'];
    //================ query for  get category which is under '0' ============

$qrya="select * from main_cat where id='".$fetchcart['cat_id']."'";

 $resulta=mysql_query($qrya);
 $rowa = mysql_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysql_query($qrya1);
 $rowa1 = mysql_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//===============================================================  
   
    if($Maincate==1){
    $qryp=mysql_query("select price,total_amt,ccode from fashion where code='".$fetchcart[2]."'");
    }
    else if($Maincate==190)
    {
       $qryp=mysql_query("select price,total_amt,ccode from electronics where code='".$fetchcart[2]."'"); 
    }
    else if($Maincate==218)
    {
       $qryp=mysql_query("select price,total_amt,ccode from grocery where code='".$fetchcart[2]."'"); 
    }
    else 
    {
        $qryp=mysql_query("select price,total_amt,ccode from products where code='".$fetchcart[2]."'");
    }
    
    
    

$fetchp=mysql_fetch_array($qryp);

//========= Generate Random Number ============
 $a=  mt_rand(100000,999999);
 //==========================================

//$qryp1=mysql_query("select code from clients where code=(select mrc_id from order_details )");
//$fetchp1=mysql_fetch_array($qryp1);

//echo "INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id) VALUES ('".$insertid."','".$fetchcart[2]."','".$fetchcart[6]."','".$fetchcart[3]."','0','".$fetchcart[10]."','".$fetchp[2]."')"; 
$qryorderdetails=mysql_query("INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$fetchcart[2]."','".$fetchcart[6]."','".$fetchcart[3]."','0','".$fetchcart[10]."','".$fetchp[2]."','".$c."','".$a."','pending','".$fetchcart['color']."','".$fetchcart['size']."')");
if(!$qryorderdetails)
{
  $errs++;  
}
}

$updtcrt=mysql_query("update cart set status='1',order_id='".$insertid."' where user_id='".$id."' and status=0 and id in($cartids)");
if(!$updtcrt)
{
  $errs++;  
}


if($errs==0)
{
mysql_query("COMMIT");
echo $insertid;
}
else
{
    mysql_query("ROLLBACK");
echo 0;
}
}

    /*$user = mysql_query($UserQ);
    $udata = mysql_fetch_array($user);
    
    $qry_data = "select pd.*,p.product_model,p.id,p.category_id,p.description as descr,p.brand_id,p.others as other,p.Long_desc as longdesc,p.status as pstatus from Productviewtable pd join product_model p on pd.name = p.id where pd.code='".$_GET["pid"]."' and p.category_id='".$_GET["cId"]."' ";
    $getprdets=mysql_query($qry_data);
    $prdrws=mysql_fetch_array($getprdets);
   
    $date = date('Y-m-d H:i:s');
    $prdid=$_GET['pid'];
    $cate_id=$_GET['cId'];
    
    $qtty=$_GET['qty']; 
       
    $cSize=$_GET['size'];
    $amt=$qtty * $prdrws['price'];
    
    //insert oredr data
	$Q="Insert into Orders (user_id,date,amount) values('".$_GET['gid']."','".$date."','".$amt."')";
    $result = mysql_query($Q);
    $oid = mysql_insert_id();
    if($result){
        $order_details="Insert into order_details (oid,item_id,rate,qty,discount,total_amt,mrc_id,cat_id,color,size,date) values('".$oid."','".$_GET['pid']."','".$prdrws['price']."','".$_GET['qty']."','".$prdrws['discount']."','".$amt."','".$prdrws['ccode']."','".$prdrws['category_id']."','".$_GET['color']."','".$_GET['sz']."','".$date."')";
        $result_data = mysql_query($order_details);
    }*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PayUmoney BOLT PHP7 Kit</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- this meta viewport is required for BOLT //-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="https://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!-- BOLT Production/Live //-->
<!--// script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script //-->

</head>
<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;
	}
</style>
<body>
<div class="main">
	<div>
    	<img src="images/payumoney.png" />
    </div>
    <div>
    	<h3>PHP7 BOLT Kit</h3>
    </div>
	<form action="#" id="payment_form">
    <!--<input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />-->
    <input type="hidden" id="udf5" name="udf5" value="<?php echo $oid; ?>" />
    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <div class="dv">
    <span class="text"><label>Merchant Key:</label></span>
    <span><input type="text" id="key" name="key" placeholder="Merchant Key" value="BhA3IR5V" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Merchant Salt:</label></span>
    <span><input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="ViHyr9bb8t" /></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Transaction/Order ID:</label></span>
    <span><input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" readonly/></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Amount:</label></span>
    <span><input type="text" id="amount" name="amount" placeholder="Amount" value="<?php echo $amt;?>" readonly/></span>    
    </div>
    
    <div class="dv">
    <span class="text"><label>Product Info:</label></span>
    <span><input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" readonly/></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>First Name:</label></span>
    <span><input type="text" id="fname" name="fname" placeholder="First Name" value="Ruchi" readonly/></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Email ID:</label></span>
    <span><input type="text" id="email" name="email" placeholder="Email ID" value="<?php echo $row['email']; ?>" readonly/></span>
    </div>
    
    <div class="dv">
        <?php  $row['MobileNumber'] =900067767; ?>
    <span class="text"><label>Mobile/Cell Number:</label></span>
    <span><input type="text" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<?php echo $row['MobileNumber']; ?>" readonly/></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Hash:</label></span>
    <span><input type="text" id="hash" name="hash" placeholder="Hash" value="" /></span>
    </div>
    <div class="dv ">
    <span class="text"><label>Category ID:</label></span>
    <span><input type="text" id="cid" name="cid"  value="<?php echo $cate_id ; ?>" /></span>
    </div>
    <div class="dv ">
    <span class="text"><label>Qty:</label></span>
    <span><input type="text" id="qty" name="qty" value="<?php echo $qtty ; ?>" /></span>
    </div>
    <div class="dv ">
    <span class="text"><label>Size:</label></span>
    <span><input type="text" id="size" name="size"  value="<?php echo $cSize ; ?>" /></span>
    </div>
    <div class="dv ">
    <span class="text"><label>city:</label></span>
    <span><input type="text" id="city" name="city" value="<?php echo $address['city'] ; ?>" /></span>
    </div>
    
    <div><input type="submit" value="Pay" onclick="launchBOLT(); return false;" /></div>
	</form>
</div>
<script type="text/javascript"><!--
function test(){
    
    $.ajax({
          url: 'index.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
		    pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			udf5: $('#udf5').val(),
			pid: $('#pid').val(),
			cid: $('#cid').val(),
			size: $('#size').val(),
			qty: $('#qty').val(),
			city: $('#city').val()
		
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
				$('#hash').val(json['success']);
            }
          }
        }); 
}
test();
/*$('#payment_form').bind('keyup blur', function(){
	$.ajax({
          url: 'index.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
		    pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			udf5: $('#udf5').val()
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
				$('#hash').val(json['success']);
            }
          }
        }); 
});*/
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	salt: $('#salt').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	pid: $('#pid').val(),
	cid: $('#cid').val(),
	size: $('#size').val(),
	qty: $('#qty').val(),
	city: $('#city').val(),
	
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
    	
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		/*'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +*/
		'<input type=\"hidden\" name=\"salt\" value=\"'+BOLT.response.salt+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'<input type=\"hidden\" name=\"pid\" value=\"'+BOLT.response.pid+'\" />' +
		'<input type=\"hidden\" name=\"cid\" value=\"'+BOLT.response.cid+'\" />' +
		'<input type=\"hidden\" name=\"size\" value=\"'+BOLT.response.size+'\" />' +
		'<input type=\"hidden\" name=\"qty\" value=\"'+BOLT.response.qty+'\" />' +
		'<input type=\"hidden\" name=\"city\" value=\"'+BOLT.response.city+'\" />' +
		
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
//--
</script>	

</body>
</html>
	
