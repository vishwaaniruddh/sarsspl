<?php include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

function delete_from_cart($userid){
    
    global $con1;
    $delete="delete from cart where user_id='".$userid."'";
    mysqli_query($con1,$delete);
}


function get_cart_info($cartid,$parameter){
    global $con1;

    $sql = mysqli_query($con1,"select $parameter from cart where id='".$cartid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result[$parameter];
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
    

    $sql=mysqli_query($con1,"select * from cart where user_id='".$userid."'");
    
    while($sql_result=mysqli_fetch_assoc($sql)){
        $cart_id[]=$sql_result['id'];
    }
    return $cart_id;
}

function get_cart_quantity($cartid){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from cart where id='".$cartid."'");
    
    while($sql_result=mysqli_fetch_assoc($sql)){
        
        $cart_quantity=$sql_result['qty'];
        
    }
    
    return $cart_quantity;
    
}


function get_product_amt_by_cart_id($cartid){

    global $con1;
    
    $sql=mysqli_query($con1,"select * from cart where id='".$cartid."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    $cart_total=$sql_result['p_price'];
    
    return $cart_total;
}

function get_product_from_cart_by_cartid($cartid){
    global $con1;
    $sql=mysqli_query($con1,"select pid from cart where id='".$cartid."'");
    $sql_result=mysqli_fetch_assoc($sql);
    $product_id=$sql_result['pid'];
    return $product_id;
}

function total_amt($userid){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select sum(total_amt) as total_amount from cart where user_id='".$userid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['total_amount'];
}

function user($userid , $parameter){

    global $con1;
    $user_sql = mysqli_query($con1,"select $parameter from Registration where id='".$userid."'");
    $user_sql_result = mysqli_fetch_assoc($user_sql);
    
    return $user_sql_result[$parameter];
}


$userid = $_REQUEST['userid'];

$amount=total_amt($userid);
$shipping_charges = get_shipping_charges($amount);
$total_amount = $amount + $shipping_charges;

$email = user($userid,'email');
$firstname = user($userid,'Firstname');

$status = 'success';
$date = date('Y-m-d H:i:s');
$pmode = $_GET['method'];


function get_txn_id(){
    
    global $con1;
    $txnid =   'dummy-'.rand(10,10000);    
    
    $sql = mysqli_query($con1,"select * from Order_ent where transaction_id='".$txnid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    if($sql_result){
        $txnid = get_txn_id();
        if($txnid){
            return $txnid;
        } else {
            $txnid = get_txn_id();
        }
        
    } else {
        return $txnid;
    }
}


$txnid = get_txn_id();

if($amount > 0 && $txnid && $userid > 0 && $status=='success'){
    
    $select_sql=mysqli_query($con1,"select * from Order_ent where transaction_id='".$txnid."'");
    
    $select_sql_result=mysqli_fetch_assoc($select_sql);
    
            $crtids=get_cart_ids($userid);
            $json_cart = json_encode($crtids);
            $json_cart=str_replace( array('[',']','"') , ''  , $json_cart);
            $arr=explode(',',$json_cart);
            $json_cart = implode ( ",", $arr );
            

     $insert="insert into Order_ent(user_id,date,amount,status,pmode,pdfpath,cmplt_status,transaction_stats,transaction_id,cartids_inorder,shipping_charges) values('".$userid."','".$date."','".$amount."','0','".$pmode."','','','".$status."','".$txnid."','".$json_cart."','".$shipping_charges."')";
        
        
        mysqli_query($con1,$insert);
        
        $order = $con1->insert_id;
        

        foreach($crtids as $key => $val) {
            
            $qty = get_cart_quantity($val);
            $product_amt = get_product_amt_by_cart_id($val);
            
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
            
    if(mail($email, "Message", $link, $headers)){
        // mail('kvaljani@gmail.com', "Message", $link, $headers);
        mail('visshwaaniruddh@gmail.com', "Message", $link, $headers);
        mail('lanwan151@gmail.com', "Message", $link, $headers);
        // mail('satyendra1111@gmail.com', "Message", $link, $headers);
    }
// End Mail Send       
        

































$sql=mysqli_query($con1,"select * from Order_ent where transaction_id='".$txnid."'");
$sql_result=mysqli_fetch_assoc($sql);
    
    $order_id=$sql_result['id'];
    $date = $sql_result['date'];
    $total = $sql_result['amount'];




$show_order_sql=mysqli_query($con1,"select * from order_details where oid='".$order_id."'");

    while($show_order_sql_result=mysqli_fetch_assoc($show_order_sql)){ 
        $pro_image = $show_order_sql_result['image'];
        $pro_name = $show_order_sql_result['product_name'];
        $pro_qty = $show_order_sql_result['qty'];
        $single_price = $show_order_sql_result['rate'];
        $total_amt = $single_price*$pro_qty;
        
    $product[] = ['image'=>$pro_image,'name'=>$pro_name,'quantity'=>$pro_qty,'single_price'=>$single_price,'total_amount'=>$total_amt];
} 

$data = ['order_id'=>$order_id,'date'=>$date,'email'=>$email,'total'=>$total,'product'=>$product];



echo json_encode($data);





























}
else{
    echo 0;
}
?>