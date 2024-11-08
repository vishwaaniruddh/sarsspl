<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
if(isset($_POST['submit'])){
include("config.php");
$cid=$_POST['cid'];
 $atm=$_POST['atm'];
 $newrate=$_POST['rate'];
 $citycat2=$_POST['citycat2'];
 $service=$_POST['service'];
 $newsub=$_POST['newsubcat'];
$atm2=explode("\n",$atm);
$atmid='';
for($i=0;$i<count($atm2);$i++)
{
if($atm2[$i]!='' && $atm2[$i]!='-' && $atm2[$i]!='Not Live' && $atm2[$i]!='Under Construction'){
if($i==0)
{
$atmid=trim($atm2[$i]);
}
else
{

$atmid=$atmid.",".trim(strtoupper($atm2[$i]));
}
}
}
//echo $atmid;
$atmid=str_replace(",","','",$atmid);
$atmid="'".$atmid."'";
//echo $_POST['rtdt']." ".$_POST['chngrate']." ".$service." ".$_POST['oldsubcat'];
if($_POST['rtdt']!="00/00/0000" && $_POST['rtdt']!="" && $_POST['chngrate']!="" && $service!='-1' && $_POST['oldsubcat']!="-1")
{
$rtdt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['rtdt'])));
for($i=0;$i<count($atm2);$i++)
{
//echo "select trackerid from ".$cid."_sites where atm_id1='".trim($atm2[$i])."' or atm_id2='".trim($atm2[$i])."' or atm_id3='".trim($atm2[$i])."'";
$site=mysqli_query($con,"select trackerid from ".$cid."_sites where atm_id1='".trim($atm2[$i])."' or atm_id2='".trim($atm2[$i])."' or atm_id3='".trim($atm2[$i])."'");
if(!$site)
echo mysqli_error();
if(mysqli_num_rows($site)>0){
//echo "hi<br>";
$sitero=mysqli_fetch_row($site);
//echo "select * from ratechngsite where custid='".$cid."' and trackerid='".$sitero[0]."' and stdt='".$rtdt."' and service='".$service."' and subcat='".$_POST['oldsubcat']."'<br>";
$srch=mysqli_query($con,"select * from ratechngsite where custid='".$cid."' and trackerid='".$sitero[0]."' and stdt='".$rtdt."' and service='".$service."' and subcat='".$_POST['oldsubcat']."'");
if(mysqli_num_rows($srch)>0)
{
$srchro=mysqli_fetch_row($srch);
//echo "update ratechngsite set rate='".$_POST['chngrate']."',stdt='".$rtdt."',subcat='".$_POST['oldsubcat']."' where id='".$srchro[0]."'<br>";
$upp=mysqli_query($con,"update ratechngsite set rate='".$_POST['chngrate']."',stdt='".$rtdt."',subcat='".$_POST['oldsubcat']."' where id='".$srchro[0]."'");
}
else{
//echo "INSERT INTO `ratechngsite` (`id`, `stdt`, `atmid`,`trackerid`, `custid`, `service`, `rate`, `status`,`subcat`) VALUES (NULL, '".$rtdt."', '".$atm2[$i]."', '".$sitero[0]."', '".$cid."','".$service."', '".$_POST['chngrate']."', '0','".$_POST['oldsubcat']."')";
$ratechng=mysqli_query($con,"INSERT INTO `ratechngsite` (`id`, `stdt`, `atmid`,`trackerid`, `custid`, `service`, `rate`, `status`,`subcat`) VALUES (NULL, '".$rtdt."', '".$atm2[$i]."', '".$sitero[0]."', '".$cid."','".$service."', '".$_POST['chngrate']."', '0','".$_POST['oldsubcat']."')");
if(!$ratechng)
echo mysqli_error();
}
}
}
}
//echo $atmid;
$str="update ".$cid."_sites set cust_id='".$cid."'";
if($citycat2!='-1')
$str.= ", city_category='".$citycat2."'";
if($newsub!='-1')
$str.= ", subcat='".$newsub."'";
if($_POST['project']!='-1')
$str.= ", projectid='".$_POST['project']."'";
if($_POST['zone']!='-1')
$str.= ", zone='".$_POST['zone']."'";
if($service!='-1' &&  $_POST['act']!='-1')
{
$str.=", ".$service."= '".$_POST['act']."'";
}
if( $newrate!='')
$str.=", ".$service."_rate='".$newrate."'";
if($_POST['tkdt']!="00/00/0000" && $_POST['tkdt']!="")
{
$st=date('Y-m-d',strtotime(str_replace("/","-",$_POST['tkdt'])));
if($service=='caretaker')
$str.=", takeover_date='".$st."'";
else
$str.= ", ".$service."_tkdt='".$st."'";
}
if($_POST['hodt']!="00/00/0000" && $_POST['hodt']!="")
{

$st2=date('Y-m-d',strtotime(str_replace("/","-",$_POST['hodt'])));
if($service=='caretaker')
$str.=", handover_date='".$st2."'";
else
$str.=", ".$service."_hodt='".$st2."'";
}




$str.=" where atm_id1 in (".$atmid.")";
//echo $str;
$qry=mysqli_query($con,$str);
if($qry)
{
//echo "done";
?>
<script type="text/javascript">
alert("sites updated successfully");
window.location="ratechange.php";
</script>
<?php
}
else
{
echo mysqli_error();
?>
<script type="text/javascript">
alert("Updation Failed");
window.location="ratechange.php";
</script>
<?php
}
}
?>