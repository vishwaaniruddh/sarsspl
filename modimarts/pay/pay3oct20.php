<? session_start();
include('site_header.php');

$sql = mysqli_query($con1,"select count(id) as c from cart where user_id ='".$_SESSION['gid']."'");


$sql_result = mysqli_fetch_assoc($sql);

$count = $sql_result['c'];
if($count <= 0){ ?>
   
   <script>
      window.location.href="https://allmart.world/new_paymentProcess.php";
   </script> 
<? }

?>

<style>
    .actions{
        display: flex;
    justify-content: center;
    margin: 10% auto;
}

.actions a{
    color: white;
    margin: auto 1%;
}

</style>


<script>
   $(document).ready(function(){
      
      $("#cod").on('click',function(){
         
          swal({
  title: "Are you sure?",
  text: "You are proceeding towards cash on delivery ( COD ) ",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {

    window.location = 'response.php?method=cod';
  } else {
    swal("You Cancel To proceed Further","","error");
  }
}); 
      });
      
      
      
      $("#pay").on('click',function(){
         
          swal({
  title: "Are you sure?",
  text: "You are paying through online banking methods",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location = 'response.php?method=pay';
    } else {
    swal("You Cancel To proceed Further","","error");
  }
}); 
      });
      
      
      
   });
</script>

<section>
    
    <div class="container">
   
   <div class="actions">
       
       <a class="btn btn-danger" id="pay" href="#">Demo Pay</a>
       
       <a class="btn btn-danger" id="cod" href="#">Cash On Delivery</a>

   </div>
   
   
    </div>
</section>



<? include('footer.php');

?>