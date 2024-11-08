<?php session_start();
include('../config.php');
include('Crypto.php') ; 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	
	
	$workingKey='2767DEF9D0F926DEC2DC4403D962F59D';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);


	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3){
		    $order_status=$information[1];
		}	
	}
	
	
	
	
	
	
	
	
function get_shipping_charges($total){
$shipping_charges = 0;
if($total<=2000){
 $shipping_charges = 150;
} else if($total >=2001 && $total <=5000){
 $shipping_charges = 200;
} else if($total >=5001){
 $shipping_charges = 0;
}
return $shipping_charges;
}



function get_cart_ids($userid){

global $con1;


$sql=mysqli_query($con1,"select * from cart where user_id='".$userid."' and status=0");

while($sql_result=mysqli_fetch_assoc($sql)){
    $cart_id[]=$sql_result['id'];
}
return $cart_id;
}





function get_cart_quantity($cartid){

global $con1;

$sql=mysqli_query($con1,"select * from cart where id='".$cartid."' and status=0");

while($sql_result=mysqli_fetch_assoc($sql)){
    
    $cart_quantity=$sql_result['qty'];
    
}

return $cart_quantity;

}


function get_product_amt_by_cart_id($cartid){

global $con1;

$sql=mysqli_query($con1,"select * from cart where id='".$cartid."' and status=0");

$sql_result=mysqli_fetch_assoc($sql);

$cart_total=$sql_result['p_price'];

return $cart_total;
}

function get_product_from_cart_by_cartid($cartid){

global $con1;

$sql=mysqli_query($con1,"select pid from cart where id='".$cartid."' and status=0");

$sql_result=mysqli_fetch_assoc($sql);
    
$product_id=$sql_result['pid'];
    
return $product_id;

}





$total_amount   =       $_SESSION['total_amount'];
$is_same_state  =       $_SESSION['same_state'];
$email          =       $_SESSION['email'];
$firstname      =       $_SESSION['fname'];

var_dump($_SESSION);
$shipping_charges = get_shipping_charges($total_amount);
$date = date('Y-m-d H:i:s');


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if($order_status==="Success")
	{
    $select_sql=mysqli_query($con1,"select * from Order_ent where transaction_id='".$txnid."'");
    
    $select_sql_result=mysqli_fetch_assoc($select_sql);
    
    if(!mysqli_num_rows($select_sql)){ //to prevent duplicate entries
    
            $crtids=get_cart_ids($userid); 
            
            $json_cart = json_encode($crtids);
            $json_cart=str_replace( array('[',']','"') , ''  , $json_cart);
            $arr=explode(',',$json_cart);
            $json_cart = implode ( ",", $arr );
            


     $insert="insert into Order_ent(user_id,date,amount,status,pmode,pdfpath,cmplt_status,transaction_stats,transaction_id,cartids_inorder,shipping_charges) values('".$userid."','".$date."','".$amount."','0','".$pmode."','','','".$status."','".$txnid."','".$json_cart."','".$shipping_charges."')";
        
        
        mysqli_query($con1,$insert);
        
        $order = $con1->insert_id;
        

        foreach($crtids as $key => $val) {
            
            $qty=get_cart_quantity($val);
            $product_amt=get_product_amt_by_cart_id($val);
            
        $product_name = get_cart_info($val,'product_name');
        $product_image = get_cart_info($val,'image');
            
        $insert_order_details = "insert into order_details(oid,item_id,rate,qty,discount,rejected_qty,status,total_amt,mrc_id,cat_id,track_id,track_Status,color,size,date,product_name,image) values ('".$order."','','".$product_amt."','".$qty."','','','1','".$product_amt*$qty."','','','','','','','".$date."','".$product_name."','".$product_image."')";
            mysqli_query($con1,$insert_order_details);
        }
        
        
        delete_from_cart($userid);
        
        
        
        // Mail send 


    $link= '<html lang="en">

 <head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<div id="m_3716871841364271743wrapper" dir="ltr" style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
		<tbody>
		    <tr>
			 <td align="center" valign="top">
				<div id="m_3716871841364271743template_header_image"></div>
					<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
						<tbody>
							<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_header" style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
									<tbody>
										<tr>
											<td id="m_3716871841364271743header_wrapper" style="padding:36px 48px;display:block">
												<h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff">
												Thank you for your order

												</h1>
												
					<h3>Your Order is successfully placed ! </h3>
                <span> The transaction id for your reference is  '.$txnid.' </span>
                
                
												</td>
										</tr>
									</tbody>
								</table>

							</td>
							</tr>

							<tr>
							<td align="center" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_body"><tbody><tr>
										<td valign="top" id="m_3716871841364271743body_content" style="background-color:#ffffff">
												
												<table border="0" cellpadding="20" cellspacing="0" width="100%"><tbody><tr>
												<td valign="top" style="padding:48px 48px 32px">
													<div id="m_3716871841364271743body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">

															<p style="margin:0 0 16px">Hi '.$firstname.',</p>
															<p style="margin:0 0 16px">Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:</p><span class="im">


															</span><h2 style="color:#96588a;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
																[Order #'.$order.'] ('.date('Y/m/d h:i:s').')</h2>

															<div style="margin-bottom:40px">
																<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															<thead><tr>
															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
																		</tr></thead>';
																		
									
									
																		
$show_email_sql = mysqli_query($con1,"select * from order_details  where oid='".$order."' ");
while($show_order_sql_result1=mysqli_fetch_assoc($show_email_sql)){

$pro_image1 = $show_order_sql_result1['image'];
$pro_name1 = $show_order_sql_result1['product_name'];
$pro_qty1 = $show_order_sql_result1['qty'];
$single_price1 = $show_order_sql_result1['rate'];

$total_amt1 = $single_price1*$pro_qty1;


$link .=  '<tbody>
            <tr>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
				    <img src="'.$pro_image1.'" width="30%">	'.$pro_name1.'		</td>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															'.$pro_qty1.' </td>
															
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
				<span><span>₹</span>'.$total_amt1.'</span>		</td>
            </tr>

            </tbody>';
                    
}
        
															











$link .= '<tfoot>

 <tr>
															<th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Shipping:</th>
																					<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
															<span><span>₹</span>'.$shipping_charges.'</span>&nbsp;<small>via Flat rate</small>
															</td>
																				</tr>
															
															<tr>
															<th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
																					<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>₹</span>'.$total_amount.'</span></td>
																				</tr>
															</tfoot>
															</table>
															</div>




															<p style="margin:0 0 16px">We look forward to fulfilling your order soon.</p>
													</div>

												</td>
											</tr>
										</tbody>
									</table>

								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</td>
</tr>

<tr>
<td align="center" valign="top">
						
						<table border="0" cellpadding="10" cellspacing="0" width="600" id="m_3716871841364271743template_footer"><tbody><tr>
<td valign="top" style="padding:0;border-radius:6px">
									<table border="0" cellpadding="10" cellspacing="0" width="100%"><tbody><tr>
<td colspan="2" valign="middle" id="m_3716871841364271743credit" style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">
									
											</td>
										</tr></tbody></table>
</td>
							</tr></tbody></table>

</td>
				</tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div>

</body>
</html>';

    $headers .= "Reply-To: The Sender sales@allmart.world\r\n"; 
    $headers .= "Return-Path: The Sender sales@allmart.world\r\n"; 
    $headers .= "From: sales@allmart.world" ."\r\n" .
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
    // if(mail($email, "Message", $link, $headers)){
    //     mail('kvaljani@gmail.com', "Message", $link, $headers);
    //     mail('visshwaaniruddh@gmail.com', "Message", $link, $headers);
    //     mail('satyendra1111@gmail.com', "Message", $link, $headers);
    // }
    
    


// End Mail Send 

        
        
        
    }
		
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	}

	echo "<br><br>";

	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}
	

	echo "</table><br>";
	echo "</center>";
?>
<? include('site_header.php');?>

        <div class="product-model">  
     <div class="container">
        
             <div class="row ">
         <div class="col-md-12 pay-info">
    
<?php if($status='success'){
           
        echo "<h3>Thank You, " . $firstname .".Your order status is ". $status .".</h3>";
        echo "<h4>Your Transaction ID for this transaction is <span class='txn_id'>".$information[1].".</span></h4>"; ?>
     
                        
            <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
            
                        
            <article id="post-8" class="post-8 page type-page status-publish hentry">
                        <div class="entry-content">
                        <div class="woocommerce">
            <div class="woocommerce-order">




<? $sql=mysqli_query($con1,"select * from Order_ent where transaction_id='".$txnid."'");

$sql_result=mysqli_fetch_assoc($sql);

$order_id=$sql_result['id'];
$date = $sql_result['date'];


?>
            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    Order number:                   <strong><? echo $order_id; ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    Date:                   <strong><? echo $date; ?> </strong>
                </li>

                                    <li class="woocommerce-order-overview__email email">
                        Email:                      <strong><? echo $email;?></strong>
                    </li>
                
                <li class="woocommerce-order-overview__total total">
                    Total:                  <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amount ; ?></span></strong>
                </li>
                
            </ul>
            
            
            
            
            
            
        <section class="woocommerce-order-details">
    
    <h2 class="woocommerce-order-details__title">Order details</h2>

    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

        <thead>
            <tr>
                <th class="woocommerce-table__product-name product-name">Product</th>
                <th class="woocommerce-table__product-name product-name">Individual Price</th>
                <th class="woocommerce-table__product-table product-total">Total</th>
            </tr>
        </thead>

        <tbody>



<?

$show_order_sql=mysqli_query($con1,"select * from order_details where oid='".$order_id."'");

while($show_order_sql_result=mysqli_fetch_assoc($show_order_sql)){ 

$pro_image = $show_order_sql_result['image'];
$pro_name = $show_order_sql_result['product_name'];
$pro_qty = $show_order_sql_result['qty'];
$single_price = $show_order_sql_result['rate'];

$total_amt = $single_price*$pro_qty;
?>
    
    
    
    
      <tr class="woocommerce-table__line-item order_item">

    <td class="woocommerce-table__product-name product-name">
        <img src="<? echo $pro_image;?>">
        <? echo $pro_name;?> <strong class="product-quantity">×&nbsp;<? echo $pro_qty; ?></strong>   </td>
    <td class="woocommerce-table__product-total product-total">
        <? echo $single_price;?>
    </td>    

    <td class="woocommerce-table__product-total product-total">
        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amt; ?></span>   </td>

</tr>


    
    
<? } ?>


            
          










        </tbody>

        <tfoot>
                   <tr>
                        <th scope="row">Shipping:</th>
                        <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo  $shipping_charges; ?></span>&nbsp;<small class="shipped_via">via Flat rate</small></td>
                    </tr>
                               
                    <tr>
                        <th scope="row">Total:</th>
                        <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amount; ?></span></td>
                    </tr>
                                       
                                        
                                   
        </tfoot>
    </table>

    </section>


    
</div>
</div>
                    </div><!-- .entry-content -->
        </article><!-- #post-## -->
        </main><!-- #main -->
    </div>
    
    
    
    
            <? 
           
          
            
  
        // include ('avopdf/report.php');
        // include("sendmailwithattachment.php");
          // }     
          
          
           //delete everything from cart
            // delete_from_cart($userid);
            
            $_SESSION['pay_status']=true;
       }
       
       
       else{
           
              echo "<h3>Something went Wrong !! </h3>";
          echo "<h4>Please try Again !</h4>";
          
           
       }   
         
?>  
            <div >

                
                  
             </div>              
          </div>
        </div>
</div>






<!---->
<style>
    .txn_id{
        color:green;
    }
    .pay-info{
        text-align:center;
            padding: 10%;
    background: #e3e5e6;
    }
    .shoping{
        display:none;
    }
    
    @media (min-width: 768px){
        .content-area, .widget-area {
            margin-bottom: 2.617924em;
        }        
        
        .content-area {
    width: 100%;
    float: left;
    margin-right: 4.347826087%;
}
.woocommerce-cart .hentry, .woocommerce-checkout .hentry {
    border-bottom: 0;
    padding-bottom: 0;
}

    }

.hentry {
    margin: 0 0 4.235801032em;
}
ul.order_details {
    list-style: none;
    position: relative;
    margin: 3.706325903em 0;
}

.order_details {
    background-color: #000000;
}
ul.order_details li:first-child {
    padding-top: 1.618em;
}

ul.order_details li {
    padding: 1em 1.618em;
    font-size: 0.8em;
    text-transform: uppercase;
}
ul.order_details li strong {
    display: block;
    font-size: 1.41575em;
    text-transform: none;
}
b, strong {
    font-weight: 600;
}
.site-main {
    margin-bottom: 2.617924em;
}

.order_details {
    background-color: white;
}

table {
    border-spacing: 0;
    width: 100%;
    border-collapse: separate;
}
table {
    margin: 0 0 1.41575em;
    width: 100%;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
table thead th {
    padding: 1.41575em;
    vertical-align: middle;
}
table:not( .has-background ) tbody td {
    background-color: #000000;
}
table th, table tbody td, #payment .payment_methods li, #comments .comment-list .comment-content .comment-text, #payment .payment_methods > li .payment_box, #payment .place-order {
    background: #f8f8f8!important;
}
table td, table th {
    padding: 1em 1.41575em;
    text-align: left;
    vertical-align: top;
    width:50%;
}
table td img{
    width:20%;
}
.hentry .entry-content a:not(.button) {
    text-decoration: underline;
}

a {
    color: #227504;
}
b, strong {
    font-weight: 600;
}



</style>
</div> 
<? include('footer.php');?>