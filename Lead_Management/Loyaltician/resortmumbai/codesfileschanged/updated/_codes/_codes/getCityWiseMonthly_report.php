<?php
include ('config.php');

$fdate=$_POST['fdate'];
$toDate=$_POST['toDate'];
 
$fdate1= date('Y-m', strtotime($fdate));
$todate1= date('Y-m', strtotime($toDate));

$fdate2= date('m', strtotime($fdate));
$todate2= date('m', strtotime($toDate));

$fdate3= date('Y', strtotime($fdate));
$todate3= date('Y', strtotime($toDate));

$data=array();

   
$from_padded = sprintf("%02d", $fdate2);
$to_padded = sprintf("%02d", $todate2);

    
    $fdate4=$fdate3."-".$from_padded;
    $todate4=$todate3."-".$to_padded;
    
    $sql1="SELECT COUNT(City) as c,city FROM Leads_table where Status='5' and date_format(Creation, '%Y-%m' ) between  '".$fdate4."' and '".$todate4."' GROUP BY City order by c DESC LIMIT 3  ";
    $result1=mysqli_query($conn,$sql1);
    while($row1=mysqli_fetch_array($result1)){
   
    $data[]=['City'=>$row1[1],'Count'=>$row1[0]];

    }



echo json_encode($data);
?>