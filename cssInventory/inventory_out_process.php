<?php
include 'config.php';
?>
<html>
    <head>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>

<?php
$srno=$_POST['srno'];
$count =count($srno);
//echo $count;

$qty1=$_POST['demo2'];
$Handover=$_POST['Handoverr'];
$Vendor=$_POST['Vendor'];

$van="select Name from vendor where id='".$Vendor."'";
$runvan=mysqli_query($conn,$van);
$fetvan=mysqli_fetch_array($runvan);

$Material=$_POST['Material'];

$mname="select Name from material where id='".$Material."'";
$runmname=mysqli_query($conn,$mname);
$ros=mysqli_fetch_array($runmname);
$mate=$ros[0];

$Model=$_POST['Model'];
$po=$_POST['po'];
$mol="select modelno from model_no where id='".$Model."'";
$runmol=mysqli_query($conn,$mol);
$femol=mysqli_fetch_array($runmol);

$qty=$_POST['qty'];
$City=$_POST['City'];
//$officeteam=$_POST['officeteam'];
$officeteam="Filed Team";
$loc=$_POST['loc'];
$type=$_POST['type'];
$Sitename=$_POST['Sitename'];
$ATM_ID=$_POST['ATM_ID'];

$address=$_POST['address'];


date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

if(isset($_POST['submit']))
{
 for($i=0;$i<$count;$i++)
 {
//$sql="insert into Inventory_OUT(Handover,Vendor,Material,Model,qty,City,officeteam,loc,Install,address,Sitename,currentdate)values('".$Handover."','".$fetvan[0]."','".$mate."','".$femol[0]."','".$qty1."','".$City."','".$officeteam."','".$loc."','".$Install."','".$address."','".$Sitename."','".$date."')";

$sql="insert into Inventory_OUT(M_srno,Handover,Vendor,Material,Model,qty,City,PO_Number,officeteam,loc,Type,address,Sitename,ATMID,Status,currentdate)values('".$srno[$i]."','".$Handover[$i]."','".$Vendor[$i]."','".$Material[$i]."','".$Model[$i]."','".$qty[$i]."','".$City[$i]."','".$po[$i]."','".$officeteam[$i]."','".$loc[$i]."','".$type[$i]."','".$address[$i]."','".$Sitename[$i]."','".$ATM_ID[$i]."','L','".$date."')";
//echo $sql; 
$result=mysqli_query($conn,$sql);

$abc="insert into enventory_Transfer_log(srno,Handover,Vendor,Material,Model,qty,City,PO_Number,officeteam,loc,Type,address,Sitename,ATMID,Status,date)values('".$srno[$i]."','".$Handover[$i]."','".$Vendor[$i]."','".$Material[$i]."','".$Model[$i]."','".$qty[$i]."','".$City[$i]."','".$po[$i]."','".$officeteam[$i]."','".$loc[$i]."','".$type[$i]."','".$address[$i]."','".$Sitename[$i]."','".$ATM_ID[$i]."','L','".$date."')";

$runabc=mysqli_query($conn,$abc);
//echo $sql;
//$last=mysqli_insert_id($conn);
}
    
}
/*
if($last){
                        for($i=0;$i<$count;$i++)
                        { 
                         $qry1="INSERT INTO InventoryOUT_Stock(srno,Material,Status,entrydate,Inventory_OUT) VALUES('".$_POST['srno'][$i]."','".$_POST['Material']."','L','".$date."','".$last."')";
                         $runquer1=mysqli_query($conn,$qry1);
                        // echo $qry1;
                         }
        
}
*/
if($result){
    for($i=0;$i<$count;$i++)
                        {
    $sql="select * from enventory_Stock where srno='".$_POST['srno'][$i]."' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    //echo $sql;
    
    $sql2="update enventory_Stock set Status='L' where srno='".$_POST['srno'][$i]."' ";
    $result2=mysqli_query($conn,$sql2);
    //echo  $sql2;
                        }
                        ?>
                        
                        <script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("Inventory_out2.php","_self");

</script> 

<?php  } ?>



<!--<script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


//window.open("Inventory_out2.php","_self");

</script> -->

</body>
</html>