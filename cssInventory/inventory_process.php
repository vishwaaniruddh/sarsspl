<?php
include 'config.php';
?>
<html>
    <head>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>

<?php
$qty1=$_POST['demo2'];

$srno=$_POST['srno'];
$count =count($srno);
//echo $count;
$modelno=$_POST['modelno'];

$mol="select modelno from model_no where id='".$modelno."'";
$runmol=mysqli_query($conn,$mol);
$femol=mysqli_fetch_array($runmol);

$material=$_POST['material'];
//$companyname=$_POST['companyname'];
$vendorname=$_POST['vendorname'];

$van="select Name from vendor where id='".$vendorname."'";
$runvan=mysqli_query($conn,$van);
$fetvan=mysqli_fetch_array($runvan);
//$qty1=$_POST['qty'];


$mname="select Name from material where id='".$material."'";
$runmname=mysqli_query($conn,$mname);
$ros=mysqli_fetch_array($runmname);
$mate=$ros[0];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

if(isset($_POST['submit']))
{

$sql="insert into Inventory_IN(vendorname,material,modelno,qty,entrydate)values('".$fetvan[0]."','".$mate."','".$femol[0]."','".$qty1."','".$date."')";
$result=mysqli_query($conn,$sql);
//echo $sql;
$last=mysqli_insert_id($conn);
//echo $last;
}
if($last){
                        for($i=0;$i<$count;$i++)
                        { 
                         $qry1="INSERT INTO enventory_Stock(srno,Status,date,InventoryIN,material) VALUES('".$_POST['srno'][$i]."','Active','".$date."','".$last."','".$mate."')";
                         $runquer1=mysqli_query($conn,$qry1);
                         //echo $qry1;
                         
                         $qry2="INSERT INTO enventory_Transfer_log(srno,Status,date,InventoryIN,material,Vendor,qty,Model) VALUES('".$_POST['srno'][$i]."','Active','".$date."','".$last."','".$mate."','".$fetvan[0]."','".$qty1."','".$femol[0]."')";
                         $runquer2=mysqli_query($conn,$qry2);
                         
                         if($runquer1){
                             ?>
                            
                            <script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("inventory.php","_self");

</script> 
                             
                         <? }else{?>
                             
                             <script>


swal({
  title: "Error!",
  text: "done!",
  icon: "error",
  button: "OK",
});
window.open("inventory.php","_self");

</script> 
                             
                        <?php     
                         }
                         
                         
                         
                         
                         }
        
}

?>
<script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("inventory.php","_self");

</script> 

</body>
</html>