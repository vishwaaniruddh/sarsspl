<?php session_start();
include('config.php');
$id=$_SESSION['id'];
$gid=$_SESSION['gid'];

$price=0;
$tl=0;
if($gid!="")
{
$usrid=$gid;

}
$qryc=mysqli_query($con1,"select sum(qty) from cart where user_id='".$usrid."' and status=0");
$fetchc=mysqli_fetch_array($qryc);
$qrycart=mysqli_query("select pid,qty from cart where user_id='".$usrid."' and status=0");

while($fetchcart=mysqli_fetch_array($qrycart))
{

$qryp=mysqli_query($con1,"select total_amt from products where code='".$fetchcart[0]."'");
//echo "select price from products where code='".$fetchcart[0]."'";
$fetchp=mysqli_fetch_array($qryp);
$a=$fetchcart[1];
$b=$fetchp[0];
$price=$a * $b;
//echo $a."*".$b." ".$price."  ";
$tl=$tl+$price;

}
//echo $tl."#"."(".$fetchc[0].")";

?>