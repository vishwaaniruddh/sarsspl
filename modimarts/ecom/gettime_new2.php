<?php
include("config.php");
$stats=$_POST['stats'];
$qrch=mysqli_query($con1,"select dt from todays_date");
$dtt="";
if($nr=mysqli_num_rows($qrch)>0)
{
    $fr=mysqli_fetch_array($qrch);
    if($fr[0]!="0000-00-00")
    {
        $dtn=date('Y-m-d',strtotime($fr[0]));
    }
}else
{
    $dtn=date('Y-m-d');
}
//echo $dtn;
$chg=date('i');
//echo $chg;
if($chg>=30)
{
    $dsf=date('i')-30;
    // echo $dsf;
    if($dsf>9)
    {
        $tym="00:".$dsf.":".date("s");
    }else
    {
        $tym="00:0".$dsf.":".date("s");
    }
}
else
{
    $tym="00:".date('i:s');
}
    $qr=mysqli_query($con1,"select * from schedule_details where date='".$dtn."' and tym<='".$tym."' and  tym_end>'".$tym."' and ad_id!=0 order by tym desc");
    //echo "select * from schedule_details where date='".$dtn."' and tym<='".$tym."' and  tym_end>'".$tym."' and ad_id!=0 order by tym desc";
    if($nr=mysqli_num_rows($qr)>0)
    {
        $nrws=mysqli_fetch_array($qr);
        $adsid=$nrws["ad_id"];
        
        $pldt=$dtn." ".$tym;
        $dt2=$dtn." ".$nrws["tym"];
        
        //$entrydt1=date("Y-m-d H:i:s",strtotime($dt2));
        
        $strtftrom=strtotime($pldt)-strtotime($dt2);//."#####".$nrws[0];
    }
else
{
/*   $qrn=mysql_query("select * from schedule_details where date='".$dtn."' and ad_id!=0 order by tym asc");
 if($nr=mysql_num_rows($qrn)>0)
{
   $nrws=mysql_fetch_array($qrn);
$adsid=$nrws["ad_id"];
 
}*/
}

$data=["startfromtym"=>$strtftrom,'adid'=>$adsid];

echo json_encode($data);
?>