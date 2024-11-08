<?php 
session_start();
include('config.php');
$ordid=$_GET['oid'];
 $sql_address = mysqli_query($con1,"select * from new_order where oid='".$ordid."'");

                    $sql_address_result = mysqli_fetch_assoc($sql_address);

                    $username = $sql_address_result['name'];
                    $address = $sql_address_result['address'];
                    $city = $sql_address_result['city'];
                    $pincode = $sql_address_result['zip'];
                    $state = $sql_address_result['state'];
                    $country = $sql_address_result['country'];
                    $email = $sql_address_result['email'];
                    $phone = $sql_address_result['phone'];
                    $primary_address= $address.', '.$city.', '.$state.', '.$pincode.', '.$country ;

 ?>
 <style>
 	body
{
	font-size: 19px;
}
 </style>
 <div id="addressbox" style="width: 100%">
                                <div style="width: 50%;margin-top:8%;margin-left: 8%;">
                                     <h3 style="margin: 0;padding: 0;">To</h3>
                                <p style="margin: 0;padding: 0;"><?=$username?></p>
                                <p style="margin: 0;padding: 0;"><?=$primary_address?></p>
                                <p style="margin: 0;padding: 0;"><?=$city?> : <?=$pincode?></p>
                                <p style="margin: 0;padding: 0;">Contact :<?=$phone?></p>
                                <br/>
                                <h3 style="margin: 0;padding: 0;">From :-</h3>
                                  <p style="margin: 0;padding: 0;">Allmart Ecommerce LLP</p>
                                <p style="margin: 0;padding: 0;">Allmart Building No. 2</p>
                                <p style="margin: 0;padding: 0;">MHB Colony No. 1, Next to Pancholia School</p>
                                <p style="margin: 0;padding: 0;">Mahavir Nagar, Kandivali West</p>
                                <p style="margin: 0;padding: 0;">Mumbai - 400067, Maharashtra</p>
                                <p style="margin: 0;padding: 0;">Contact: 9892384666</p>
                                <br/>
                                <br/>
                                
                                <h3 style="margin: 0;padding: 0;">Covid-19 Essential Product</h3>
                                    
                                </div>
                               

                            </div>
                            <script>
                            	window.onload = function() { window.print(); }
                            </script>