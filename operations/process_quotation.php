<?php 
include("access.php");
include("config.php");

//echo "hello";
$ticketNo = $_POST['ticketNo'];
$categoryName = $_POST['categoryName'];
$quotationDate = $_POST['quotationDate'];

$cust=$_POST['cust'];
$bank=$_POST['bank'];
$address=addslashes($_POST['address']);
$city=$_POST['city'];
$state=$_POST['state'];
$atm=$_POST['atm'];
$proj=$_POST['proj'];
$catg=$_POST['typ'];
$sv=$_POST['sv'];
$tcode=$_POST['tcode'];
$uom=$_POST['uom'];
$svtx=$_POST['svtxarr'];

$cmnth=date('M');

$mnthno=date('m');


$particular=$_POST['partic'];
$pr=$_POST['partyp'];
$prc=$_POST['partqty'];
$rate=$_POST['partrate'];
$amt=$_POST['partamt'];

$unit = $_REQUEST['unit'];



/*
echo print_r($particular);
print_r($particular);
echo "<br>";
print_r($pr);
echo "<br>";
print_r($prc);
echo "<br>";
print_r($rate);
echo "<br>";
print_r($partamt);
*/


$errors="0";

$dt=date('Y-m-d H:i:s');

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';


try
{


$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);


if($srno[0]!="")
{



$yr="";
if($mnthno>=4)
{
$yr=date('Y') .'-'. (date('y')+1);
}
elseif($mnthno<4)
{

$yr=(date('Y')-1) .'-'.date('y');
}

//echo "select max(qno) from quotation1 where cust='".$cust."' and month='".$cmonth."'";
$getmaxno=mysqli_query($con,"select max(qno) from quotation1 where cust='".$cust."' and month='".$cmnth."' and year='".$yr."'");
$qryr=mysqli_fetch_array($getmaxno);
$numrows=mysqli_num_rows($getmaxno);

$qno="";
if($qryr[0]!=NULL)
{

$qno=$qryr[0]+1;
}
else
{
$qno=1;

}

//echo "select cust_name from  ".$cust."_sites where cust_id='".$cust."' ";
$qrynm=mysqli_query($con,"select cust_name from  ".$cust."_sites where cust_id='".$cust."' ");
                  $qname=mysqli_fetch_array($qrynm);
                 


$quotid="CSS/".$qname[0]."/".sprintf("%02d", $qno)."/".$cmnth."/".$yr;
//mysqli_query($con,"BEGIN");
mysqli_autocommit($con,FALSE);

 $qrins=mysqli_query($con,"Insert into quotation1 (`quot_id`,`cust`, `atm`, `bank`,`project_id`, `location`, `city`, `state`, `reqby`, `entrydate`,`category`, `month`,`year`, `qno`, `supervisor`,`ticketNo`,`categoryName`,`quotationDate`)
values('".$quotid."','".$cust."','".$atm."','".$bank."','".$proj."','".$address."','".$city."','".$state."','".$srno[0]."','".$dt."','".$catg."','".$cmnth."','".$yr."','".$qno."','".$sv."','".$ticketNo."','".$categoryName."','".$quotationDate."')");

if(!$qrins)
{

$errors++;
}


//$getqid=mysqli_insert_id();
$getqid=mysqli_insert_id($con);
/*$genid=$getqid.'/'.date('Y') .'-'. (date('y')+1);

//echo "Update quotation set quotation_id='".$genid."' where id='".$getqid."'";
$updqry=mysqli_query($con,"Update quotation1 set quotation_id='".$genid."' where id='".$getqid."'");
if(!$updqry)
{
$errors++;
}

*/

$a=9;
$b=0;
for($i=0;$i<count($pr);$i++)
{

 //$part="";
         $part=$particular[$b];
     

//echo "INSERT INTO `quotation_details`(`qid`, `description`, `quantity`, `rate`, `Total`) values('".$gqid."','".$part."','".$prc[$i]."','".$rate[$i]."','".$amt[$i]."')";


if($pr[$i]!="")
{
//     echo "INSERT INTO `quotation_details`(`qid`, `particular`, `description`, `quantity`, `rate`, `Total`,tcode,uom,ServiceTax,unit) 
// values('".$getqid."','".$part."','".$pr[$i]."','".$prc[$i]."','".$rate[$i]."','".$amt[$i]."','".$tcode[$i]."','".$uom[$i]."','".$svtx[$i]."','".$unit[$i]."')" ; 


// echo '<br />';
$qrins2=mysqli_query($con,"INSERT INTO `quotation_details`(`qid`, `particular`, `description`, `quantity`, `rate`, `Total`,tcode,uom,ServiceTax,unit) 
values('".$getqid."','".$part."','".$pr[$i]."','".$prc[$i]."','".$rate[$i]."','".$amt[$i]."','".$tcode[$i]."','".$uom[$i]."','".$svtx[$i]."','".$unit[$i]."')");
if(!$qrins2)
{
$errors++;
}

}

 if($i==$a)
     {
     //$part=$particular[$b];
     $b=$b+1;
      $a=$a+10;
      
      }



}

if($errors==0)
{
    mysqli_commit($con);
//mysqli_query($con,"COMMIT");
echo "Quotation Submitted..Quotation ID is-".$getqid;

}
else
{
//mysqli_query($con,"ROLLBACK");
mysqli_rollback($con);
echo mysqli_error();
//echo "Error";

}

}
else
{

?>
<script>
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}



}
catch (Exception $e) {
    echo 'exception: ',  $e->getMessage(), "\n";
}



?>