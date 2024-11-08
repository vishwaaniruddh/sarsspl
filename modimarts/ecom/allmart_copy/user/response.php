
<?php
include('config.php');
if (isset($_POST ['key'])) {
  $key        =   $_POST['key'];
  $salt       =   $_POST['salt'];
  $txnid        =   $_POST['txnid'];
    $amount         =   $_POST['amount'];
  $productInfo      =   $_POST['productinfo'];
  $firstname        =   $_POST['firstname'];
  $email            = $_POST['email'];
  $mobile           = $_POST['phone'];
  $udf5       =   $_POST['udf5'];
  $mihpayid     = $_POST['mihpayid'];
  $status       =   $_POST['status'];
  $resphash     =   $_POST['hash'];
  //Calculate response hash to verify 
  $keyString        =   $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
  /*$keyString      =   $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.'|||||'.$udf5.'|||||';*/
  $keyArray         =   explode("|",$keyString);
  $reverseKeyArray  =   array_reverse($keyArray);
  $reverseKeyString = implode("|",$reverseKeyArray);
  $CalcHashString   =   strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
  
  $pinfo = explode(',',$productInfo);
    if($pinfo[0]=='sb') {
      $qry =mysqli_query($con1,"SELECT s.id as sid,s.period,s.type,sd.rate,sd.discount,sd.grace_type,sd.grace_period FROM subscriptions s join subscription_details sd on s.id=sd.subscription_id where sd.status!=2 and sd.id = ".$pinfo[1]);
        $result = mysqli_fetch_assoc($qry);
        $sid=$result['sid'];
        $type=$result['type'];
        $period=$result['period'];
        $gtype=$result['grace_type'];
        $gperiod=$result['grace_period'];
        $rate=$result['rate'];
        $discount=$result['discount'];
        $sstatus=$result['status'];
        
        //get completion date 
        $sdate = date('Y-m-d');
      $date=date_create($sdate);  
      date_add($date,date_interval_create_from_date_string($period.$type));
      $sub_completion_date = date_format($date,"Y-m-d");
      
      if($gtype!='' && $gperiod!='')
      {
          //grace starts date
          $gdate=date_create($sub_completion_date);  
          date_add($gdate,date_interval_create_from_date_string('1 day'));
          $grace_start_date = date_format($gdate,"Y-m-d");
        
            //grace end  date
          $g_end_date=date_create($grace_start_date);  
          date_add($g_end_date,date_interval_create_from_date_string($gperiod.$gtype));
          $grace_end_date = date_format($g_end_date,"Y-m-d");
      } else {
          $grace_start_date = '';
          $grace_end_date = '';
      }
    }
  
  /*if ($status == 'success'  && $resphash == $CalcHashString) {*/
  if ($status == 'success' ) {
        $subscribe_done=mysqli_query($con1,"update `clients` set subscribe ='Active' WHERE `code` = ".$pinfo[2]);
        if($pinfo[0]=='sb') {
            $Q="Insert into transaction_log (transaction_id,amount,name,email,mobile,status,mid,transaction_for,tr_data_id) values('".$txnid."',$amount,'".$firstname."','".$email."',$mobile,'".$status."',$pinfo[2],'".$pinfo[0]."','".$pinfo[1]."')";
            $result = mysqli_query($con1,$Q);
            $sub_details="Insert into Subscription (mid,sid,sdate,tilldate,grace_start_date,grace_end_date,s_purchase_date,status) values($pinfo[2],$pinfo[1],'".$sdate."','".$sub_completion_date."','".$grace_start_date."','".$grace_end_date."','".$sdate."','1')";
        $result = mysqli_query($con1,$sub_details);
        //echo $sub_details;
      } else if($pinfo[0]=='sl'){
          $Q="Insert into transaction_slot_log (transaction_id,amount,status,mid,slot_id,slot_pos) values('".$txnid."',$pinfo[0],'".$status."',$pinfo[2],'".$pinfo[1]."','".$pinfo[3]."')";
            $result = mysqli_query($con1,$Q);
      } else if($pinfo[0]=='ofr'){
          $Q="Insert into transaction_log (transaction_id,amount,name,email,mobile,status,mid,transaction_for,tr_data_id) values('".$txnid."',$amount,'".$firstname."','".$email."',$mobile,'".$status."',$pinfo[2],'".$pinfo[0]."','".$pinfo[1]."')";
            $result = mysqli_query($con1,$Q);
            
            //id of_id mid of_date tilldate of_purchase_date status
          $ofr_details="Insert into merchant_purchased_offers(mid,of_id,of_date,tilldate,of_purchase_date,status) values($pinfo[2],$pinfo[1],'".$sdate."','".$sub_completion_date."','".$sdate."','1')";
        $result = mysqli_query($con1,$ofr_details);
      } else if($pinfo[0]=='ad') {
          $Q="Insert into transaction_log (transaction_id,amount,name,status,mid,transaction_for,tr_data_id,orderid) values('".$txnid."',$amount,'".$firstname."','".$status."',$pinfo[2],'".$pinfo[0]."','".$pinfo[1]."','".$pinfo[1]."')";
            $result = mysqli_query($con1,$Q);  
      } 
      else {
          
      }
    $msg = "Transactions Successful!";
  }
  else {
    //tampered or failed  Subscription
    $msg = "Payment failed for Hasn not verified...";
  } 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
<title>Merabazar</title>
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
  .hide{
      display : none;
  }
</style>
<body>
<div class="main">
  <div>
      <img src="images/payumoney.png" />
    </div>
    <div>
      <h3>Merabazar</h3>
    </div>
    <div class="dv hide">
    <span class="text"><label>Merchant Key:</label></span>
    <span><?php echo $key; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Merchant Salt:</label></span>
    <span><?php echo $salt; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Transaction/Order ID:</label></span>
    <span><?php echo $txnid; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Amount:</label></span>
    <span><?php echo $amount; ?></span>    
    </div>
    <div class="dv hide">
    <span class="text"><label>Product Info:</label></span>
    <span><?php echo $productInfo; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>First Name:</label></span>
    <span><?php echo $firstname; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Email ID:</label></span>
    <span><?php echo $email; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Mihpayid:</label></span>
    <span><?php echo $mihpayid; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Hash:</label></span>
    <span><?php echo $resphash; ?></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Transaction Status:</label></span>
    <span><?php echo $status; ?></span>
    </div>
    <div class="dv ">
    <span class="text"><label>Payment Status:</label></span>
    <span><?php echo $msg; ?></span>
    </div>
       <div class="row">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header">
                    <h3 class="text-xs-center"><strong>Order summary</strong></h3>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <td class="text-xs-center"><strong>Item Price</strong></td>
                                    <td class="text-xs-right"><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-xs-center"><?php echo $amount;?></td>
                                    <td class="text-xs-right"><?php echo $amount;?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow text-xs-right"><strong>Subtotal : </strong></td>
                                    <td class="highrow "><?php echo $amount;?></td>
                                    <td class="highrow"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <a href="<?php echo '/oc1/user/add_product.php';?>"><button type="button" class="btn btn-primary btn-md" >Back</button></a>
        </div>
    </div>
</div>
</body>
</html>