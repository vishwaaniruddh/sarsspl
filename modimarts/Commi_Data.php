<?php
include 'connect.php';

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

function GetCommission($order_id)
{
    global $con1;

    $j          = 0;
    $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE id='" . $order_id . "'");

    $ttlamt = 0;
    $ttlcom = 0;

    foreach ($select_sql as $key => $order) {

        $totalCommision     = 0;
        $totalReffCommision = 0;
        $totalbillamount    = 0;
        $order_id           = $order['id'];
        $date               = date('Y-m-d', strtotime($order['date']));
        $orderdata          = mysqli_query($con1, "SELECT * FROM `order_details` WHERE oid='" . $order_id . "' AND oid<>''");
        $orderData          = array();

        $pincode       = GetUserPincode($order_id);
        $franchisedata = GetfraByPin($pincode);
        $fdecode       = json_decode($franchisedata);
        $f_id          = $fdecode->id;

        $reffid       = "0";
        $is_franchise = $order['is_franchise'];
        $ttlCommision = 0;

        foreach ($orderdata as $key => $getprodeatils) {
            $pro_amount   = $getprodeatils['rate'];
            $product_name = $getprodeatils['product_name'];
            $pro_qty      = $getprodeatils['qty'];
            $price        = number_format($pro_amount, 2, '.', '');

            $billamount = $price * $pro_qty;

            if ($getprodeatils['outside_product'] != 1) {

                $_product_id = explode('/', $getprodeatils['item_id']);
                $promotion   = $_product_id[0];

                $sql1        = mysqli_query($con1, "select allmart_commission from products where code='" . $_product_id[0] . "' and category='" . $_product_id[1] . "' and name='" . $_product_id[2] . "' order by code desc");
                $sql_result1 = mysqli_fetch_assoc($sql1);

                if (!empty($sql_result1)) {
                    $allmart_commissionp = $sql_result1['allmart_commission'];
                    $allmart_commission  = (($pro_amount / 100) * $allmart_commissionp);
                } else {
                    $allmart_commission = 0;

                }
            } else {
                $allmart_commissionp = 10;
                $allmart_commission  = (($pro_amount / 100) * $allmart_commissionp);
            }

            $reff_amount = (($pro_amount / 100) * 10);
            $reff_amount = $reff_amount * $pro_qty;

            $allmart_commission = $allmart_commission * $pro_qty;
            $commision          = $allmart_commission;
            $commision          = number_format($commision, 2, '.', '');
            $reff_amount        = number_format($reff_amount, 2, '.', '');

            $orderdata = array(
                'ProName'          => urlencode($product_name),
                'Amount'           => $price,
                'Qty'              => $pro_qty,
                'Commission'       => $allmart_commissionp,
                'RefCommission'    => '10',
                'CommissionAmount' => $commision,
                'RefAmount'        => $reff_amount,
            );
            array_push($orderData, $orderdata);

            $totalbillamount = $totalbillamount + $billamount;

            $ttlCommision       = $ttlCommision + $commision;
            $totalReffCommision = $totalReffCommision + $reff_amount;
        }

        $encoded_orderData  = json_encode($orderData);
        $totalCommision     = number_format($ttlCommision, 2, '.', '');
        $totalReffCommision = number_format($totalReffCommision, 2, '.', '');
        $totalbillamount    = number_format($totalbillamount, 2, '.', '');

        $MyFunction = DistributeCommission($order_id, $totalCommision, $f_id, $date, $encoded_orderData, $reffid, $order_id, $is_franchise, $totalReffCommision, $totalbillamount);

    }
}

function DistributeCommission($txn_id, $commision, $mem, $date, $promotion, $reffid, $order_id, $is_franchise, $reff_amount, $bill_amount)
{
    global $con;
    global $con1;
    $txn_date = date('Y-m-d H:i:s');
    if ($date == '') {
        $date     = date('Y-m-d');
        $txn_date = date('Y-m-d H:i:s');
    }
    if ($mem != '' && $mem != 0 && $commision != 0) {

        $countn = mysqli_num_rows(mysqli_query($con1, "SELECT * FROM `commission_details` WHERE order_id='" . $txn_id . "'"));

        if ($countn == 0) {

            // echo '<pre>';print_r($commision);echo '</pre>';die();

            // if user has franchisee
            $customerpincode = GetUserPincode($txn_id);
            if ($reff_amount != '' && $reff_amount != 0) {
                $ref_amt = $reff_amount;
            } else {
                $ref_amt = 0;
            }
            $Userid = GetUserId($txn_id);

            $txn_id = "txn-" . $txn_id;
            if ($is_franchise) {

                // Check Qulification for pay commision
                $totalmem         = CheckQualify($Userid);
                $getTotalPurchase = CheckTotalPurchase($Userid);
                $purcAmt          = FindSaleAmount($Userid);
                $Intro            = Get_Introducer($Userid);
                $level            = Get_Introducerlevel($Intro);
                // check Franchise First Purchase in Given Amount
                if ($getTotalPurchase <= $purcAmt) {
                    $introducer = $Intro;
                    $fisrtsale  = 1;
                    $level      = $level;
                } else {
                    $introducer = 0;
                    $fisrtsale  = 0;
                    $level      = 0;
                }

                // If franchise and Has First sale Give Commision to introducer

                if ($introducer) {
                    // 10% of commision

                    $notgive = $introducer;

                    $commision = round($commision / 2, 5, PHP_ROUND_HALF_DOWN);
                    $introcom  = $commision;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,bill_amount,level) values('" . $txn_id . "','" . $introducer . "','" . $introcom . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','1','" . $bill_amount . "','" . $level . "')");
                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $introcom . "','0','" . $introducer . "','" . $txn_date . "')");

                }

            } else {
                $notgive      = 0;
                $qulifystatus = 0;
                $introducer   = 0;
            }

            if ($is_franchise == 0) {
                if ($reffid != '' && $reffid != 0) {
                    // 10% distribut_amount to reffid
                    $notgive = $reffid;

                    $Isqulify = CheckUserStatus($reffid);
                    $hold     = ($Isqulify) ? 0 : 1;

                    $giveAmt = $ref_amt;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_referral,hold,bill_amount,level) values('" . $txn_id . "','" . $reffid . "','" . $giveAmt . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','1','" . $hold . "','" . $bill_amount . "','0')");
                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $giveAmt . "','0','" . $reffid . "','" . $txn_date . "')");

                } else {

                    // Give 10% to Village Franchise
                    $villageList = Getvillagefranchasee($customerpincode);

                    $countVill  = count($villageList);
                    $findvilage = $villageList;

                    // var_dump($findvilage);die();

                    if ($findvilage) {
                        $Villagesale = 0;
                        $arrsal      = array();
                        for ($i = 0; $i < $countVill; $i++) {
                            $villageid = $findvilage[$i];

                            $purchase    = CheckTotalPurchase($villageid);
                            $Villagesale = $Villagesale + $purchase;
                            array_push($arrsal, $purchase);
                        }

                        for ($j = 0; $j < $countVill; $j++) {

                            if ($Villagesale != 0) {
                                $distper    = $arrsal[$j] / $Villagesale * 100;
                                $distamount = $ref_amt * $distper / 100;

                                // put Amount In village Franchise

                                $Isqulify = CheckUserStatus($findvilage[$j]);
                                $hold     = ($Isqulify) ? 0 : 1;

                                mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $findvilage[$j] . "','" . $distamount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','0','" . $hold . "','" . $bill_amount . "','8')");

                                $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $distamount . "','0','" . $findvilage[$j] . "','" . $txn_date . "')");

                            } else {

                                $noofVilg = $countVill;

                                $distamount = $ref_amt / $noofVilg;

                                // put Amount In village Franchise

                                $Isqulify = CheckUserStatus($findvilage[$j]);
                                $hold     = ($Isqulify) ? 0 : 1;

                                mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $findvilage[$j] . "','" . $distamount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','0','" . $hold . "','" . $bill_amount . "','8')");
                                $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $distamount . "','0','" . $findvilage[$j] . "','" . $txn_date . "')");
                            }

                        }

                    }

                }
            }

            $distribut_amount  = $commision;
            $actual_amount     = $commision;
            $member_sql        = mysqli_query($con, "select * from new_member where id='" . $mem . "' and status=1");
            $member_sql_result = mysqli_fetch_assoc($member_sql);

            $pos_name     = $member_sql_result['star'];
            $member_level = $member_sql_result['level_id'];

            $pincode  = $member_sql_result['pincode'];
            $taluka   = $member_sql_result['taluka'];
            $district = $member_sql_result['district'];
            $division = $member_sql_result['division'];
            $state    = $member_sql_result['state'];
            $zone     = $member_sql_result['zone'];
            $country  = $member_sql_result['country'];

            $villagelist = Getvillagefranchasee($customerpincode);

            // var_dump(get_pincode($pincode));die();

            $countvillage = count($villagelist);
            $findvilage   = $villagelist;
            if ($reffid != '' && $reffid != 0) {
                if ($countvillage) {

                    $vill_amount   = round($distribut_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $vill_amount;

                    $Villagesale = 0;
                    $arrsal      = array();
                    for ($i = 0; $i < $countvillage; $i++) {
                        $villageid   = $findvilage[$i];
                        $purchase    = CheckTotalPurchase($villageid);
                        $Villagesale = $Villagesale + $purchase;
                        array_push($arrsal, $purchase);
                    }

                    for ($k = 0; $k < $countvillage; $k++) {

                        if ($Villagesale != 0) {
                            $distper    = $arrsal[$k] / $Villagesale * 100;
                            $distamount = $vill_amount * $distper / 100;

                            // put Amount In village Franchise

                            $Isqulify = CheckUserStatus($findvilage[$k]);
                            $hold     = ($Isqulify) ? 0 : 1;

                            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $findvilage[$k] . "','" . $distamount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','8')");
                            $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $distamount . "','0','" . $findvilage[$k] . "','" . $txn_date . "')");

                        } else {

                            $noofVilg = $countvillage;

                            $distamount = $vill_amount / $noofVilg;

                            // put Amount In village Franchise

                            $Isqulify = CheckUserStatus($findvilage[$k]);
                            $hold     = ($Isqulify) ? 0 : 1;

                            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $findvilage[$k] . "','" . $distamount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','8')");
                            $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $distamount . "','0','" . $findvilage[$k] . "','" . $txn_date . "')");
                        }

                    }

                } else {
                    $vill_amount = $distribut_amount;
                    // $pin_amount =  round($actual_amount /2 ,5) ;
                    $actual_amount = $distribut_amount;
                }
            } else {
                $vill_amount = $distribut_amount;
                // $pin_amount =  round($actual_amount /2 ,5) ;
                $actual_amount = $distribut_amount;

            }

            if ($pincode > 0) {

                $pin_sql = mysqli_query($con, "select * from new_member where pincode='" . $pincode . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "' and village=0 and status='1' LIMIT 0,1");
                $count   = mysqli_num_rows($pin_sql);
                if ($count) {
                    $pin_sql_result = mysqli_fetch_assoc($pin_sql);
                    $pin_mem        = $pin_sql_result['id'];

                    $pin_amount    = round($vill_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $pin_amount;
                    $is_introducer = '0';
                    $Isqulify      = CheckUserStatus($pin_mem);
                    $hold          = ($Isqulify) ? 0 : 1;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $pin_mem . "','" . $pin_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','7')");

                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $pin_amount . "','0','" . $pin_mem . "','" . $txn_date . "')");

                } else {
                    $pin_amount = $actual_amount;
                }

            } else {
                $pin_amount = $distribut_amount;
                // $pin_amount =  round($actual_amount /2 ,5) ;
                $actual_amount = $distribut_amount;
                $pin_mem       = 0;
            }

            // return;
            if ($taluka > 0) {
                $tal_sql = mysqli_query($con, "select * from new_member where taluka='" . $taluka . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "' and pincode=0 AND village=0 and status='1' LIMIT 0,1");
                $count   = mysqli_num_rows($tal_sql);
                if ($count) {
                    $tal_sql_result = mysqli_fetch_assoc($tal_sql);
                    $tal_mem        = $tal_sql_result['id'];

                    $tal_amount    = round($pin_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $tal_amount;
                    $is_introducer = '0';

                    $Isqulify = CheckUserStatus($tal_mem);
                    $hold     = ($Isqulify) ? 0 : 1;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $tal_mem . "','" . $tal_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','6')");

                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $tal_amount . "','0','" . $tal_mem . "','" . $txn_date . "')");

                } else {
                    $tal_amount = $actual_amount;
                }

            } else {
                $tal_amount    = $distribut_amount;
                $actual_amount = $distribut_amount;
                $tal_mem       = 0;
            }

            if ($district > 0) {
                $dis_sql = mysqli_query($con, "select * from new_member where district='" . $district . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "'  taluka=0 AND pincode=0 AND village=0 and status'1' LIMIT 0,1");
                $count   = mysqli_num_rows($dis_sql);
                if ($count) {
                    $dis_sql_result = mysqli_fetch_assoc($dis_sql);
                    $dis_mem        = $dis_sql_result['id'];

                    $dis_amount    = round($tal_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $dis_amount;
                    $is_introducer = '0';
                    $Isqulify      = CheckUserStatus($dis_mem);
                    $hold          = ($Isqulify) ? 0 : 1;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $dis_mem . "','" . $dis_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','5')");
                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $dis_amount . "','0','" . $dis_mem . "','" . $txn_date . "')");

                } else {
                    $dis_amount = $actual_amount;
                }

            } else {
                $dis_amount    = $distribut_amount;
                $actual_amount = $distribut_amount;
                $dis_mem       = 0;
            }

            if ($division > 0) {
                $div_sql = mysqli_query($con, "select * from new_member where division='" . $division . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "' and district=0 and taluka=0 AND pincode=0 AND village=0 and status='1' LIMIT 0,1");
                $count   = mysqli_num_rows($div_sql);
                if ($count) {
                    $div_sql_result = mysqli_fetch_assoc($div_sql);
                    $div_mem        = $div_sql_result['id'];

                    $div_amount    = round($dis_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $div_amount;
                    $is_introducer = '0';

                    $Isqulify = CheckUserStatus($div_mem);
                    $hold     = ($Isqulify) ? 0 : 1;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $div_mem . "','" . $div_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','4')");

                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $div_amount . "','0','" . $div_mem . "','" . $txn_date . "')");

                } else {
                    $div_amount = $actual_amount;
                }

            } else {
                $div_amount    = $distribut_amount;
                $actual_amount = $distribut_amount;
                $div_mem       = 0;
            }

            if ($state > 0) {

                $state_sql = mysqli_query($con, "select * from new_member where state='" . $state . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "' and division=0 and district=0 and taluka=0 AND pincode=0 AND village=0 and status='1' LIMIT 0,1");
                $count     = mysqli_num_rows($state_sql);
                if ($count) {
                    $state_sql_result = mysqli_fetch_assoc($state_sql);
                    $state_mem        = $state_sql_result['id'];

                    $state_amount  = round($div_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $state_amount;
                    $is_introducer = '0';

                    $Isqulify = CheckUserStatus($state_mem);
                    $hold     = ($Isqulify) ? 0 : 1;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $state_mem . "','" . $state_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','3')");
                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $state_amount . "','0','" . $state_mem . "','" . $txn_date . "')");

                } else {
                    $state_amount = $actual_amount;
                }

            } else {
                $state_amount  = $distribut_amount;
                $actual_amount = $distribut_amount;
                $state_mem     = 0;
            }

            if ($zone > 0) {
                $zone_sql = mysqli_query($con, "select * from new_member where zone='" . $zone . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "' and state=0 AND division=0 and district=0 and taluka=0 AND pincode=0 AND village=0 and status='1' LIMIT 0,1");
                $count    = mysqli_num_rows($zone_sql);
                if ($count) {
                    $zone_sql_result = mysqli_fetch_assoc($zone_sql);
                    $zone_mem        = $zone_sql_result['id'];

                    $zone_amount   = round($state_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $actual_amount = $zone_amount;
                    $is_introducer = '0';
                    $Isqulify      = CheckUserStatus($zone_mem);
                    $hold          = ($Isqulify) ? 0 : 1;

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,hold,bill_amount,level) values('" . $txn_id . "','" . $zone_mem . "','" . $zone_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $hold . "','" . $bill_amount . "','2')");

                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $zone_amount . "','0','" . $zone_mem . "','" . $txn_date . "')");

                } else {
                    $zone_amount = $actual_amount;
                }

            } else {
                $zone_amount   = $distribut_amount;
                $actual_amount = $distribut_amount;
                $zone_mem      = 0;
            }

            if ($country > 0) {
                $country_sql = mysqli_query($con, "select * from new_member where country='" . $country . "' and id<>'" . $reffid . "' and id<>'" . $notgive . "' and id<>'" . $Userid . "' and zone=0  and state=0 AND division=0 and district=0 and taluka=0 AND pincode=0 AND village=0 and status='1' LIMIT 0,1");
                $count       = mysqli_num_rows($country_sql);
                if ($count) {
                    $country_sql_result = mysqli_fetch_assoc($country_sql);
                    $country_mem        = $country_sql_result['id'];

                    $country_amount = round($zone_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $sar_amount     = round($zone_amount / 2, 5, PHP_ROUND_HALF_DOWN);
                    $is_introducer  = '0';

                    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer,bill_amount,level) values('" . $txn_id . "','" . $country_mem . "','" . $country_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "','" . $bill_amount . "','1')");

                    $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $country_amount . "','0','" . $country_mem . "','" . $txn_date . "')");

                } else {
                    $country_amount = $actual_amount;
                    $sar_amount     = $actual_amount;
                }

            }

            // Sar Commission
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,bill_amount,level) values('" . $txn_id . "','SAR','" . $sar_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $bill_amount . "','0')");
            $inlag = mysqli_query($con1, "INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('" . $order_id . "','','" . $sar_amount . "','0','SAR','" . $txn_date . "')");
            echo "Done";
        }
    } else {
        echo "Some Details Not Present";
        echo "<br/>";
        echo "Commission - " . $commision;
        echo "<br/>";
        echo "Member Id - " . $mem;
        echo "<br/>";

    }
}

function Get_Introducer($fran_id)
{
    global $con;

    $sql   = "SELECT intro_id FROM `new_member` WHERE `id`='" . $fran_id . "' and status=1";
    $count = mysqli_num_rows(mysqli_query($con, $sql));
    if ($count) {
        $mydata = mysqli_fetch_assoc(mysqli_query($con, $sql));
        return $mydata['intro_id'];

    } else {
        return 0;
    }
}
function Get_Introducerlevel($fran_id)
{
    global $con;

    $sql   = "SELECT level_id FROM `new_member` WHERE `id`='" . $fran_id . "' and status=1";
    $count = mysqli_num_rows(mysqli_query($con, $sql));
    if ($count) {
        $mydata = mysqli_fetch_assoc(mysqli_query($con, $sql));
        return $mydata['level_id'];

    } else {
        return 0;
    }
}

function CheckTotalPurchase($fran_id)
{
    global $con1;

    $sql    = "SELECT sum(amount) as TotalAmount FROM `Order_ent` WHERE `user_id`='" . $fran_id . "' AND `is_franchise`='1'";
    $mydata = mysqli_fetch_assoc(mysqli_query($con1, $sql));
    if ($mydata != 0) {
        $amount = $mydata['TotalAmount'];
        return $amount;

    } else {
        return 0;
    }
}

function CheckQualify($fran_id)
{
    global $con;
    global $con1;

    $sql    = "SELECT count(id) as Totalref FROM `new_member` WHERE `intro_id`='" . $fran_id . "' AND `status`='1' AND `id`<>'" . $fran_id . "'";
    $mydata = mysqli_fetch_assoc(mysqli_query($con, $sql));
    if ($mydata['Totalref'] >= 6) {
        return 1;
    } else {
        return 0;
    }
}

function FindSaleAmount($fran_id)
{
    global $con;
    global $con1;

    $sql   = "SELECT level_id FROM `new_member` WHERE `id`='" . $fran_id . "' AND `status`='1'";
    $count = mysqli_num_rows(mysqli_query($con, $sql));
    if ($count) {

        $mydata   = mysqli_fetch_assoc(mysqli_query($con, $sql));
        $level_id = $mydata['level_id'];

        if ($level_id == 1) {
            return 1;
        } else if ($level_id == 2) {
            return 1000000;
        } else if ($level_id == 3) {
            return 500000;
        } else if ($level_id == 4) {
            return 200000;
        } else if ($level_id == 5) {
            return 100000;
        } else if ($level_id == 6) {
            return 50000;
        } else if ($level_id == 7) {
            return 30000;
        } else if ($level_id == 8) {
            return 15000;
        } else {
            return 0;
        }
    } else {
        return 0;
    }

}

function Getvillagefranchasee($pincode)
{
    global $con1;
    global $con;

    $query = "SELECT id FROM `new_pincode` WHERE `pincode`='" . $pincode . "'";
    $count = mysqli_num_rows(mysqli_query($con, $query));
    if ($count) {
        $pindata = mysqli_fetch_assoc(mysqli_query($con, $query));
        $pinid   = $pindata['id'];

        $sql    = "SELECT id FROM `new_village` WHERE `pincode`='$pinid'";
        $getpin = mysqli_query($con, $sql);
        $alvlg  = array();

        while ($view_result = mysqli_fetch_assoc($getpin)) {
            $villege = $view_result['id'];
            array_push($alvlg, $villege);
        }
        // return $alvlg;
        $str = implode(", ", $alvlg);

        $getvillage = "SELECT `id` FROM `new_member` WHERE `village`IN ($str) AND status='1' AND level_id='8'  ";
        $village    = mysqli_query($con, $getvillage);
        $vfra       = array();
        while ($view_vill = mysqli_fetch_assoc($village)) {
            $vill = $view_vill['id'];
            array_push($vfra, $vill);
        }

        // $str = implode (", ", $vfra);
        return $vfra;
    } else {
        $rtn = array();
        return $rtn;
    }

}
function getMemberId($parameter, $where, $iswhere, $level)
{
    global $con;
    $sql        = mysqli_query($con, "select $parameter from new_member where $where = '" . $iswhere . "' and level_id='" . $level . "' AND status='1'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result[$parameter];

}

function GetUserPincode($order_id)
{
    global $con1;

    $sql    = "SELECT `zip` FROM `new_order` WHERE `oid`='$order_id'";
    $getpin = mysqli_fetch_assoc(mysqli_query($con1, $sql));
    $zip    = $getpin['zip'];
    if ($zip != '') {
        return $zip;

    } else {
        return 0;
    }
}

function GetUserId($order_id)
{
    global $con1;

    $sql    = "SELECT `user_id` FROM `Order_ent` WHERE `id`='$order_id'";
    $getpin = mysqli_fetch_assoc(mysqli_query($con1, $sql));
    $userid = $getpin['user_id'];
    if ($userid != '') {
        return $userid;

    } else {
        return 0;
    }
}

function GetfraByPin($pincode)
{
    global $con1;
    global $con;

    $sql1  = "SELECT id,taluka FROM `new_pincode` WHERE `pincode`='" . $pincode . "'";
    $count = mysqli_num_rows(mysqli_query($con, $sql1));
    if ($count) {
        $pinid  = mysqli_fetch_assoc(mysqli_query($con, $sql1));
        $pin_id = $pinid['id'];
        $taluka = $pinid['taluka'];
        $sql    = "SELECT id,level_id FROM `new_member` WHERE `pincode`='" . $pin_id . "' AND status='1' AND level_id='7'";
        $count  = mysqli_num_rows(mysqli_query($con, $sql));
        if ($count) {

            $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
            $f_id     = $getpin['id'];
            $level_id = $getpin['level_id'];
            $data     = array('id' => $f_id, 'level_id' => $level_id);
            return json_encode($data);

        } else {

            $sql1  = "SELECT id,district FROM `new_taluka` WHERE `id`='" . $taluka . "'";
            $count = mysqli_num_rows(mysqli_query($con, $sql1));
            if ($count) {
                $talukaid  = mysqli_fetch_assoc(mysqli_query($con, $sql1));
                $taluka_id = $talukaid['id'];
                $district  = $talukaid['district'];
                $sql       = "SELECT id,level_id FROM `new_member` WHERE `taluka`='" . $taluka_id . "'  AND status='1' AND level_id='6'";
                $count     = mysqli_num_rows(mysqli_query($con, $sql));
                if ($count) {
                    $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
                    $f_id     = $getpin['id'];
                    $level_id = $getpin['level_id'];

                    $data = array('id' => $f_id, 'level_id' => $level_id);
                    return json_encode($data);

                } else {
                    $sql1  = "SELECT id,division FROM `new_district` WHERE `id`='" . $district . "'";
                    $count = mysqli_num_rows(mysqli_query($con, $sql1));
                    if ($count) {
                        $distdata = mysqli_fetch_assoc(mysqli_query($con, $sql1));
                        $dist_id  = $distdata['id'];
                        $division = $distdata['division'];
                        $sql      = "SELECT id,level_id FROM `new_member` WHERE `district`='" . $dist_id . "'  AND status='1' AND level_id='5'";
                        $count    = mysqli_num_rows(mysqli_query($con, $sql));
                        if ($count) {
                            $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
                            $f_id     = $getpin['id'];
                            $level_id = $getpin['level_id'];

                            $data = array('id' => $f_id, 'level_id' => $level_id);
                            return json_encode($data);

                        } else {

                            $sql1 = "SELECT id,state FROM `new_division` WHERE `id`='" . $division . "'";

                            $count = mysqli_num_rows(mysqli_query($con, $sql1));
                            if ($count) {
                                $divdata = mysqli_fetch_assoc(mysqli_query($con, $sql1));
                                $div_id  = $divdata['id'];
                                $state   = $divdata['state'];
                                $sql     = "SELECT id,level_id FROM `new_member` WHERE `division`='" . $div_id . "'  AND status='1' AND level_id='4'";
                                $count   = mysqli_num_rows(mysqli_query($con, $sql));
                                if ($count) {
                                    $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
                                    $f_id     = $getpin['id'];
                                    $level_id = $getpin['level_id'];

                                    $data = array('id' => $f_id, 'level_id' => $level_id);
                                    return json_encode($data);

                                } else {

                                    $sql1  = "SELECT id,zone FROM `new_state` WHERE `id`='" . $state . "'";
                                    $count = mysqli_num_rows(mysqli_query($con, $sql1));
                                    if ($count) {
                                        $statedata = mysqli_fetch_assoc(mysqli_query($con, $sql1));
                                        $state_id  = $statedata['id'];
                                        $zone      = $statedata['zone'];
                                        $sql       = "SELECT id,level_id FROM `new_member` WHERE `state`='" . $state_id . "'  AND status='1' AND level_id='3'";
                                        $count     = mysqli_num_rows(mysqli_query($con, $sql));
                                        if ($count) {
                                            $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
                                            $f_id     = $getpin['id'];
                                            $level_id = $getpin['level_id'];

                                            $data = array('id' => $f_id, 'level_id' => $level_id);
                                            return json_encode($data);

                                        } else {
                                            $sql1  = "SELECT id,country FROM `new_zone` WHERE `id`='" . $zone . "'";
                                            $count = mysqli_num_rows(mysqli_query($con, $sql1));
                                            if ($count) {

                                                $statedata = mysqli_fetch_assoc(mysqli_query($con, $sql1));
                                                $zone_id   = $statedata['id'];
                                                $country   = $statedata['country'];
                                                $sql       = "SELECT id,level_id FROM `new_member` WHERE `zone`='" . $zone_id . "'  AND status='1' AND level_id='2'";
                                                $count     = mysqli_num_rows(mysqli_query($con, $sql));
                                                if ($count) {
                                                    $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
                                                    $f_id     = $getpin['id'];
                                                    $level_id = $getpin['level_id'];

                                                    $data = array('id' => $f_id, 'level_id' => $level_id);
                                                    return json_encode($data);

                                                } else {

                                                    $sql      = "SELECT id,level_id FROM `new_member` WHERE `country`='" . $country . "'  AND status='1' AND level_id='1'";
                                                    $getpin   = mysqli_fetch_assoc(mysqli_query($con, $sql));
                                                    $f_id     = $getpin['id'];
                                                    $level_id = $getpin['level_id'];

                                                    $data = array('id' => $f_id, 'level_id' => $level_id);
                                                    return json_encode($data);

                                                }
                                            }

                                        }
                                    }

                                }
                            }
                        }
                    }

                }
            }
        }
    }

}

function CheckUserStatus($Userid)
{
    global $con1;
    
    $totalmem         = CheckQualify($Userid);
    $getTotalPurchase = CheckTotalPurchase($Userid);
    $purcAmt          = FindSaleAmount($Userid);

    // Check Qulify Or Not
    if ($totalmem || $getTotalPurchase >= $purcAmt) {
        return 1;
    } else {
        return 0;
    }
}

function get_zone($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_zone where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_state($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_state where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}

function get_division($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_division where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['division'];
}

function get_district($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_district where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}

function get_taluka($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_taluka where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}

function get_pincode($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_pincode where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}

function get_pincode_id($pincode)
{

    global $con;

    $sql        = mysqli_query($con, "select id from new_pincode where pincode='" . $pincode . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['id'];
}

function get_village($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_village where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['village'];
}

function GetzoneByState($id)
{
    global $con;
    $mystate        = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new_state` WHERE id='$id'"));
    return $zone_id = $mystate['zone'];
}

function GetStateBydivision($id)
{
    global $con;
    $mystate        = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new_division` WHERE id='$id'"));
    return $zone_id = $mystate['state'];
}

function GetdivisionBydistrict($id)
{
    global $con;
    $mystate        = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new_district` WHERE id='$id'"));
    return $zone_id = $mystate['division'];
}
function GetdistrictBytaluka($id)
{
    global $con;
    $mystate        = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new_taluka` WHERE id='$id'"));
    return $zone_id = $mystate['district'];
}

function GettalukaBypincode($id)
{
    global $con;
    $mystate        = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new_pincode` WHERE id='$id'"));
    return $zone_id = $mystate['taluka'];
}

function GetTotalEntry($order_id)
{
    global $con1;
    $sql   = mysqli_query($con1, "SELECT id FROM `commission_details` WHERE order_id='" . $order_id . "' Group BY commission_to");
    $count = mysqli_num_rows($sql);
    return $count;
}

function GetTotalLevel($order_id)
{
    global $con1;
    $sql   = mysqli_query($con1, "SELECT id FROM `commission_details` WHERE order_id='" . $order_id . "' AND is_introducer='NULL' Group BY level");
    $count = mysqli_num_rows($sql);
    return $count;
}

function CheckEntry($order_id, $level)
{
    global $con1;
    $sql   = mysqli_query($con1, "SELECT id FROM `commission_details` WHERE order_id='" . $order_id . "' AND level='" . $level . "'");
    $count = mysqli_num_rows($sql);
    return $count;
}
function checkintro($order_id)
{
    global $con1;
    $sql   = mysqli_query($con1, "SELECT id FROM `commission_details` WHERE order_id='" . $order_id . "' AND is_introducer='1' AND level='0'");
    $count = mysqli_num_rows($sql);
    return $count;
}

function getComAmount($order_id, $amount, $level)
{
    global $con1;

    // $Gettoalenty=GetTotalEntry($order_id);
    $Gettoallevel = GetTotalLevel($order_id);
    $is_intro     = checkintro($order_id);
    // echo $is_intro;
    if ($is_intro) {$amount = round($amount / 2, 3, PHP_ROUND_HALF_DOWN);}

    $resultval = 0;
    $amt       = $amount;
    for ($i = 8; $i > 0; $i--) {
        $checkenty = CheckEntry($order_id, $i);
        if ($checkenty) {
            // $resultval=number_format($amt/2,2, '.', '');
            $resultval = round($amt / 2, 3, PHP_ROUND_HALF_DOWN);
            $amt       = $resultval;

        } else {
            $resultval = $amt;

        }

        if ($i == $level) {
            return $resultval;
        }

    }

}
