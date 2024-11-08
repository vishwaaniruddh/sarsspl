<?php

include("config.php");

$amcid=$_GET['ref'];

$typemysqli_query($con,'];

if($type=='amc')

{

$qry=mysqli_query($con,"select * from Amc where amcid='".$amcid."'");

$amcrmysqli_query($con,ch_row($qry);

echo $amcrow[1]."***".$amcrow[2]."***".$amcrow[3]."***".$amcrow[4]."***".$amcrow[8]."***".$amcrow[7]."***".$amcrow[9]."***".$amcrow[6]."***".$amcrow[5];

}

if($type=='site')

{

//echo "select site_id,atm_id1,bank,state,city,atmsite_address,location from sites where id='".$amcid."'";

	//echo "select * from atm where track_id='".$amcid."'";

$qry=mysqli_query($con,"select cust_name,atm_id1,bank,state,city,atmsite_address,location from sites where id='".$amcid."'");

if(!$qry)

echo mysqli_error();

$amcrow=mysqli_fetch_row($qry);

echo $amcrow[0]."***"." "."***".$amcrow[1]."***".$amcrow[2]."***".$amcrow[3]."***".$amcrow[4]."***".$amcrow[5]."***"."0"."***".$amcrow[6];

}

?>