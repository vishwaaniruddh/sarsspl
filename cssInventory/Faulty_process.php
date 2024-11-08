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
$Material=$_POST['Material'];
$Model=$_POST['Model'];
$Vendor=$_POST['Vendor'];
$qty=$_POST['qty'];

$City=$_POST['City'];
$loc=$_POST['loc'];
$address=$_POST['address'];
$remark=$_POST['remark'];

$mname="select Name from material where id='".$Material."'";
$runmname=mysqli_query($conn,$mname);
$ros=mysqli_fetch_array($runmname);
$mate=$ros[0];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

if(isset($_POST['submit']))
{

$sql="insert into faulty(Material,Model,Vendor,qty,City,loc,address,remark,entrydate)values('".$mate."','".$Model."','".$Vendor."','".$qty."','".$City."','".$loc."','".$address."','".$remark."','".$date."')";
$result=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);
}
if($last){
                        for($i=0;$i<$count;$i++)
                        { 
                         $qry1="INSERT INTO faulty_details(srno,Material,Status,entrydate,faulty_id) VALUES('".$_POST['srno'][$i]."','".$mate."','pending','".$date."','".$last."')";
                         $runquer1=mysqli_query($conn,$qry1);
                         //echo $qry1;
                         
                          $sql2="update InventoryOUT_Stock set Status='faulty' where srno='".$_POST['srno'][$i]."' ";
    $result2=mysqli_query($conn,$sql2);
   // echo  $sql2;
                         }
                         ?>
                         <script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("Faulty.php","_self");

</script> 
   <?php                      
        
}


?>


</body>
</html>