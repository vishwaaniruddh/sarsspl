<?php
include 'config.php';
$uid=$_GET['id'];

//echo $uid;
$sql="select id from member where mailcode='".$uid."'";
$runsql=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($runsql);

if($numrow >0){
    $sql2="update member set verify='Y' where mailcode='".$uid."' ";
    $runsql2=mysqli_query($conn,$sql2);
}
if($runsql2){?>
    <script>
       alert("Your verification done successfully ,your user name and password send to your email in  after admin approval");
        window.open("http://shyambabadham.com/Committee/index.php","_self");
    </script>
<?php }else{?>
    
    <script>
       alert("oops somethings went worng!!!!");
        window.open("http://shyambabadham.com/Committee/index.php","_self");
    </script>
<?php }

?>