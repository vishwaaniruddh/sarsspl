<? session_start();
include('config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>All Mart</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
<style>
    .modal{
        display:block !important;
    }
    .cust_back {
    filter: alpha(opacity=50);
    opacity: .5;
}
.cust_back {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000;
}
</style>
</head>
<body>

<?

$id = $_GET['id'];
$mem = $_GET['mem'];


if(isset($_POST['submit']) and !$mem){
    
    $password = $_POST['password'];
    
$sql = mysqli_query($con,"select * from new_waiting where id='".$id."' and password='".$password."'");
$sql_result = mysqli_fetch_assoc($sql);


// var_dump($sql_result);


if($sql_result){

$_SESSION['username'] = $sql_result['name'];

?>
   
   <script>
       alert('login Successfully !');
       setTimeout(function(){ 
           
           window.location.href="admin/waiting_edit.php?id=<? echo $id;?>";
       }, 3000);

   </script> 
<? }

}



if(isset($_POST['submit']) and isset($mem)){
    
    $password = $_POST['password'];
    
$sql = mysqli_query($con,"select * from new_member where id='".$id."' and password='".$password."'");
$sql_result = mysqli_fetch_assoc($sql);


// var_dump($sql_result);


if($sql_result){

$_SESSION['username'] = $sql_result['name'];

?>
   
   <script>
       alert('login Successfully !');
       setTimeout(function(){ 
           
           window.location.href="admin/member_edit.php?id=<? echo $id;?>";
       }, 3000);

   </script> 
<? }

}





?>

<div id="myModal" class="modal in" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
				<!--<p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>-->
                <form action="<? $_SERVER['PHP_SELF']; ?>" method="POST"> 
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="cust_back"></div>
</body>
</html>