<?php session_start();
include('config.php');

$email = $_SESSION['adminuser'];
$merchant_id = $_SESSION['id'];
$status = $_POST['status'];
$oid = $_POST['oid'];
if(isset($_POST['track_id'])){
    $track_id= $_POST['track_id'];
} else {
    $track_id = '';
}
//echo $status;
//$track_id = $_POST['track_id'];

//echo $merchant_id;

$user_sql = mysqli_query($con1, "select o.user_id from Order_ent o join order_details od on o.id=od.oid where od.id=".$oid);
$user_data = mysqli_fetch_assoc($user_sql);

//echo "select o.user_id from Order_ent o join order_details od on o.id=od.oid where od.id=".$oid;

$merchantDetails_qry = mysqli_query($con1,"select * from client where code=".$merchant_id);
$merchantDetails = mysqli_fetch_assoc($con1,$merchantDetails_qry);
$merchant_cmpname = $merchantDetails['name'];
$merchant_email = $merchantDetails['email'];
$merchant_contact_name = $merchantDetails['contact'];

$userid = $user_data['user_id'];

$userDetails_qry = mysqli_query($con1,"select * from Registration where id=".$userid);
$userDetails = mysqli_fetch_assoc($con1,$userDetails_qry); 
$user_firstname = $userDetails['Firstname'];
$useremail = $userDetails['email'];

$sql = mysqli_query($con1,"update order_details set status =".$status." , track_id = '".$track_id."' where id = ".$oid." and mrc_id=".$merchant_id);
// echo "update order_details set status =".$status." , track_id = '".$track_id."' where id = ".$oid." and mrc_id=".$merchant_id;
if($sql) {
    
    $subject = "Your order status at Allmart";
    
    $user = "<html> <head> <title>Allmart order status</title> </head> 
    <body> <table> <tr> <th>Dear '".$user_firstname."',</th> <th>Lastname</th> </tr> <tr> Your order has been processed.</td> </tr> </table> </body> </html>";
    
    $merchant = "<html> <head> <title>Allmart order status</title> </head> 
    <body> <p>Dear </p> <table> <tr> <th>'".$merchant_contact_name."',</th> </tr> <tr> <td>Your order has been processed.</td>  </tr> </table> </body> </html>";
    
    
    
    $merchant= '<html lang="en">

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
												                    Your order status information
												                </h1>
												
				                                            	<h3>Your Order status is successfully changed ! </h3>
                                                                <span> Your request is processed !</span>
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

															        <p style="margin:0 0 16px">Hi '.$email.',</p>
															        <p style="margin:0 0 16px">Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:</p><span class="im">


															        </span><h2 style="color:#96588a;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
																[Order #'.$oid.'] ('.date('Y/m/d h:i:s').')</h2>

															        <div style="margin-bottom:40px">
																        <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															                <thead>
															                    <tr>
															                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
																			        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
																			        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
																		        </tr>
																		    </thead>';
																		
                                                                            $sql=mysqli_query($conn,"select * from order_details  where id='".$oid."' ");
                                                                            while($sql_result=mysqli_fetch_assoc($sql)){
                                                                            
                                                                                $product_id=$sql_result['item_id'];
                                                                                //$type = $sql_result['product_type'];
                                                                            
                                                                                $name = $sql_result['product_name'];
                                                                                
                                                                                $quantity = $sql_result['qty'];
                                                                                $product_amt = $sql_result['total_amt']; 
                                                                                
                                                                                $merchant .=  '<tbody>
                                                                                        <tr>
                                                                                            <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                                                                            																	'.$name.'		</td>
                                                                                            <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
                                                                            															'.$quantity.'					</td>
                                                                                            <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
                                                                            																		<span><span>₹</span>'.$product_amt.'</span>		</td>
                                                                                        </tr>
                                                                            
                                                                                        </tbody>';
                                                                            }
                                                                            $merchant .= '<tfoot>

                                                                                        
															
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
                </tr>
                </tbody>
                </table>
                </td>
                </tr></tbody></table>
                    
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="yj6qo"></div>
        <div class="adL"></div>
    </div>
</body>
</html>';

    
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    $headers .= 'From: <webmaster@example.com>' . "\r\n";
    $headers .= 'Cc: myboss@example.com' . "\r\n";
    
    mail($email,$subject,$merchant,$headers);
    //mail($useremail,$subject,$user,$headers);

    echo 1;
} else {
    echo 0;
}
?>