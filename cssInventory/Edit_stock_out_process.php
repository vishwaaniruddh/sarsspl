<?php
include 'config.php';
?>
<html>
    <head>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>

<?php
$id=$_POST['id'];
$Srno=$_POST['Srno'];
$Handover=$_POST['Handover'];
$Vendor=$_POST['Vendor'];
$Material=$_POST['Material'];
$Model=$_POST['Model'];
$qty=$_POST['qty'];
$City=$_POST['City'];
$po=$_POST['po'];
$officeteam=$_POST['officeteam'];
$loc=$_POST['loc'];
$Install=$_POST['Install'];
$address=$_POST['address'];
$Sitename=$_POST['Sitename'];
$returnstock=$_POST['returnstock'];
$engname=$_POST['engname'];
$atm=$_POST['atmid'];
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

if($returnstock=="Return Stock")
{
    $abc="insert into enventory_Transfer_log(srno,Handover,Vendor,Material,Model,qty,City,PO_Number,officeteam,loc,address,Sitename,Status,date,return_eng_name,ATMID)values('".$Srno."','".$Handover."','".$Vendor."','".$Material."','".$Model."','".$qty."','".$City."','".$po."','".$officeteam."','".$loc."','".$address."','".$Sitename."','Return Stock','".$date."','".$engname."','".$atm."')";

$runabc=mysqli_query($conn,$abc);
                         
$sql="delete  from Inventory_OUT where iout='".$id."'";
$runsql=mysqli_query($conn,$sql);

if($runsql){
    $stat="update enventory_Stock set Status='Active' where srno='".$Srno."'";
    $result=mysqli_query($conn,$stat);
}
}

if($returnstock=="-1")
{
$sql="update Inventory_OUT set Handover='".$Handover."',Handover='".$Handover."',Vendor='".$Vendor."',Material='".$Material."',Model='".$Model."',qty='".$qty."',City='".$City."',PO_Number='".$po."',officeteam='".$officeteam."',loc='".$loc."',address='".$address."',Sitename='".$Sitename."' where iout='".$id."'";
$result=mysqli_query($conn,$sql);
//echo $sql;
//$last=mysqli_insert_id($conn);
}
if($result!=""){
    ?>
    <script>


swal({
  title: "Update Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("viewstockout.php","_self");

</script> 
<?php }
else { ?>
    
    swal("Error")
<? }




?>


</body>
</html>