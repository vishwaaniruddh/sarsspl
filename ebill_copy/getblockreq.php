<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "0";
}
else
{
include("config.php");
 $stdt=date('Y-m-d',strtotime(str_replace("/","-",$_GET['billfrm'])));
$todt=date('Y-m-d',strtotime(str_replace("/","-",$_GET['todt'])));
$reqid=$_GET['reqid'];
//echo "select trackerid from ebillfundrequests where req_no='".$reqid."'<br>";
$eb=mysqli_query($con,"select trackerid from ebillfundrequests where req_no='".$reqid."'");
$ebr=mysqli_fetch_row($eb);
//echo "select start_date,end_date,approvedamt,req_no from ebillfundrequests where req_no<>'".$reqid."' and start_date>='".$stdt."' and end_date<='".$todt."' and trackerid='".$ebr[0]."'";
$qry=mysqli_query($con,"select start_date,end_date,approvedamt,req_no from ebillfundrequests where req_no<>'".$reqid."' and reqstatus<>0 and start_date>='".$stdt."' and end_date<='".$todt."' and trackerid='".$ebr[0]."'");
if(mysqli_num_rows($qry)>0){
?>
<table><tr><td>
<?php
echo "<h2>Following bill will be clubbed with this entry</h2>";
?>
</td></tr>
<?php
$cnt=0;
while($row=mysqli_fetch_array($qry))
{
$cnt=$cnt+1;
?>
<tr><td align="center">Request ID : <b><?php echo $row[3];  ?></b></td></tr>
<tr><td>Start Date: <?php if($row[0]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[0]));}  ?><input type="hidden" name="fundid[]" id="fundid[]" value="<?php echo $row[3]; ?>" readonly></td></tr>
<tr><td> End Date: <?php if($row[1]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[1])); } ?></td></tr>
<tr><td> Amt: <?php echo $row[2];  ?></td></tr>
<?php
}


}
else
{
echo "No Data to club";
}
}
?>