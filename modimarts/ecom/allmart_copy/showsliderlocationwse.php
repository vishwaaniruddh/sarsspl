<?php 
include("config.php");
include "getlocationforsearch.php";
$maketempf = "CREATE TEMPORARY TABLE merchantdetsfm(merchant_id int,distance float(10,2),code int,name varchar(550),description varchar(250),category varchar(500),category_name varchar(500), price float(10,2),discount float(10,2),total_amt float(10,2),photo varchar(500))"; 

$execf=mysqli_query($con1,$maketempf);
 if(!$execf)
{
echo "2".mysqli_error();
//echo mysql_error();
}
if($_POST["latitude"]!="")
{
 
 $PublicIP = get_client_ip(); 
 //echo "ram".$PublicIP;
// $json2  = file_get_contents("https://freegeoip.net/json/$PublicIP");
$json2  = file_get_contents("http://api.ipstack.com/$PublicIP?access_key=dfa87815354a6f7c6ada50d045cb4ed6");

 $json2  =  json_decode($json2 ,true);

echo $json2;
$livecityid=0;
$livecitynm=$json2["city"]; 


$gtstateid=mysqli_query($con1,"select code FROM `cities` where name='".$livecitynm."'");
//echo "ok4";
 
$nrtm=mysqli_num_rows($gtstateid);
if($nrtm>0)
{
    
    $frtrs=mysqli_fetch_array($gtstateid);
    $livecityid=$frtrs["code"];
}
    $maketemp1 = "CREATE TEMPORARY TABLE merchantdetsm(merchant_id int,distance float(10,2),latitude varchar(500),longitude varchar(500))"; 

 $exec1=mysqli_query($maketemp1);
 if(!$exec1)
{
 echo "1".mysqli_error();
}
$lat1 = $_POST['latitude'];
$lon1= $_POST['longitude'];
 $gtallprdshwn=mysqli_query($con1,"select pid from slider_location_dets where  slot_id='".$sliderid."' and sts=0");
// echo "ok7";
 if(!$gtallprdshwn)
{
 echo "3".mysqli_error();
}
    $gtallprdnr=mysqli_num_rows($gtallprdshwn);
    if($gtallprdnr<8)
    {
        $cidsarry=array();
        //echo "select code from clients where city='".$livecityid."'";
        $notreqsusdid="";
         $gtallprdshwn=mysqli_query($con1,"select user_id from slider_location_dets where  slot_id='".$sliderid."' and sts=0 and entrydt='".$todaysdtt."'");
         //echo "ok45";
     if(!$gtallprdshwn)
    {
     echo "4".mysqli_error();
    }
    $gtallprdnr=mysqli_num_rows($gtallprdshwn);
    $ntpids="";
    if($gtallprdnr>0)
    {
        while($cdsrws=mysqli_fetch_array($gtallprdshwn))
        {
           if($notreqsusdid=="")
           {
               $notreqsusdid=$cdsrws[0];
               
           }else
           {
               $notreqsusdid=$notreqsusdid.",".$cdsrws[0];
           }
        }
    }

if($notreqsusdid!="")
{
$gtcls=mysqli_query($con1,"select code,Latitude,Longitude from clients where code not in($notreqsusdid) and city='".$livecityid."' and Latitude!=''");
}else
{
    $gtcls=mysqli_query($con1,"select code,Latitude,Longitude from clients where city='".$livecityid."' and Latitude!=''");
}
 if(!$gtcls)
{
echo "5".mysqli_error();
//echo "ok6";
}
$nrtss=mysqli_num_rows($gtcls);
if($nrtss>0)
{
    while($frclts=mysqli_fetch_array($gtcls))
    {
    $lat2=$frclts["Latitude"];
    $lon2=$frclts["Longitude"];
    //echo $lat1."---".$lon1."---".$lat2."---".$lon2."</br>";
    $dist=distance($lat1, $lon1, $lat2, $lon2, "K");
    if($dist<=3)
    {
        $insr=mysqli_query($con1,"insert into merchantdetsm(merchant_id,distance,latitude,longitude) values ('".$frclts["code"]."','".$dist."','".$lat2."','".$lon2."')");
        if(!$insr)
        {
            echo "7".mysqli_error();
        }
    }
    // echo mysql_error();
    }
}
$getall=mysqli_query($con1,"select * from merchantdetsm order by distance asc");
 if(!$getall)
{
    echo "8".mysqli_error();
}
while($re=mysqli_fetch_array($getall))
{
    $gtnotrqids=mysqli_query($con1,"select pid,category from slider_location_dets where city_id='".$livecityid."' and user_id='".$re["merchant_id"]."' and sts=0 and entrydt='".$todaysdtt."' ");
    $ntrds="";
     if(!$gtnotrqids)
    {
        echo "9".mysqli_error();
    }
    while($gtftchr=mysqli_fetch_array($gtnotrqids))
    {
     if($ntrds=="")
     {
         $ntrds=$gtftchr[0];
     }else
     {
         $ntrds=$ntrds.",".$gtftchr[0];
     }
    }
    $strrr="";
    if($ntrds=="")
    {
        $strrr="select * from Productviewtable where ccode='".$re["merchant_id"]."'  ORDER BY rand() limit 0,1";
        $gtallrds=mysqli_query($con1,$strrr);
    }else
    {
     $strrr="select * from Productviewtable where ccode='".$re["merchant_id"]."'  and code not in($ntrds) ORDER BY rand() limit 0,1";
     $gtallrds=mysqli_query($strrr);
    }
//echo "select * from products where ccode='".$re["merchant_id"]."'  and code not in($ntrds) ORDER BY rand() limit 0,9";
if(!$gtallrds)
{
echo "10".mysqli_error();
}
     while($prrws=mysqli_fetch_array($gtallrds))
    {
    
    $gtcatnm=mysqli_query($con1,"select * from main_cat where id='".$prrws["category"]."'");
    if(!$gtcatnm)
{
    echo "11".mysqli_error();
}
   $ftchnmer=mysqli_fetch_array($gtcatnm);
   $insr=mysqli_query($con1,"insert into merchantdetsfm(merchant_id,distance,code,name,category,category_name,price,discount,total_amt,photo,description) values ('".$re["merchant_id"]."','".$re["distance"]."','".$prrws["code"]."','".mysqli_real_escape_string($prrws["name"])."','".mysqli_real_escape_string($prrws["category"])."','".mysqli_real_escape_string($ftchnmer["name"])."','".$prrws["price"]."','".$prrws["discount"]."','".$prrws["total_amt"]."','".$prrws["photo"]."','".mysqli_real_escape_string($prrws["description"])."')");
 if(!$insr)
 {
     echo mysqli_error()."</br>";
 }
}
}
}
}

?>