<?php 
include ('config.php');
$Title=$_POST['Title'];
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$mcode1=$_POST['mcode1'];
$mob1=$_POST['mob1'];
$Contact1code=$_POST['Contact1code'];
$Contact1=$_POST['Contact1'];
$Contact2code=$_POST['Contact2code'];
$Contact2=$_POST['Contact2'];
$Contact3code=$_POST['Contact3code'];
$Contact3=$_POST['Contact3'];
$Country=$_POST['Country'];
$state=$_POST['state'];
$City=$_POST['City'];
$Nationality=$_POST['Nationality'];
$Company=$_POST['Company'];
$Designation=$_POST['Designation'];
$Gmail=$_POST['Gmail'];
$Relationship=$_POST['Relationship'];
$Facebook=$_POST['Facebook'];
$source=$_POST['Source'];


date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');


$sql="insert into Leads_table(Title,FirstName,LastName,MobileNumber,ContactNo1,ContactNo2,ContactNo3,EmailId,FacebookId,Country,State,City,Nationality,Company,Designation,DelegationStatus,Creation,LeadSource,Status) values('".$Title."','".$FirstName."','".$LastName."','".$mcode1."-".$mob1."','".$Contact1code."-".$Contact1."','".$Contact2code."-".$Contact2."','".$Contact3code."-".$Contact3."','".$Gmail."','".$Facebook."','".$Country."','".$state."','".$City."','".$Nationality."','".$Company."','".$Designation."','".$Relationship."','".$dates."','".$source."','0')";
$runsql=mysqli_query($conn,$sql);

//echo $sql;
if($runsql){
   echo '1';
}else{
    echo '0';
}
?>