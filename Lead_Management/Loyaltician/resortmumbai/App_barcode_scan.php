<?php include('config.php');
$Value= $_REQUEST['QRCode'];

/*$run1=mysqli_query($conn, "SELECT * FROM POS_table WHERE CertificateNumber ='".$Value."'");
$fetch_value1=mysqli_fetch_array($run1);
$num1=mysqli_num_rows($run1);*/

$usedDate=date('Y-m-d H:i:s');

$run=mysqli_query($conn, "SELECT * FROM BarcodeScan WHERE Voucher_id ='".$Value."'");
$fetch_value=mysqli_fetch_array($run);
$num=mysqli_num_rows($run);
//if($num>0 && $num1>0)
if($num>0 )
{
                                if($fetch_value['Available']=="0"){
                                $Q=mysqli_query($conn, "update BarcodeScan set Available='1',usedDate='".$usedDate."' where Voucher_id='".$fetch_value['Voucher_id']."' ");
                                if($Q){ echo "0";}// 0-means unused
                                }else {
                                    echo "1";//1-means used
                                }
    
}
else
{  
     echo "2"; //2-means Invalid
}


?>