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
          text: "You are proceeding towards payments !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
        
            window.location = 'payment_details.php?method=cod';
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
                window.location = 'payment_details.php?method=pay';
            } else {
                swal("You Cancel To proceed Further","","error");
            }
        }); 
    });
});
</script>

<section>
    <div class="container">
        <br><br>
        <div style="margin-left: 30%;">
            <h4 style="color:gray">Allmart Ecommerce LLP Bank Details</h4>
            <h5>You can Start Payment in this account.</h5><br>
            
            <h6><strong>Name : </strong>&nbsp;&nbsp;Allmart Ecommerce LLP</h6>
            <h6><strong> Account No:</strong>&nbsp;&nbsp;4445071298</h6>
            <h6><strong> IFSC:  </strong> &nbsp;&nbsp; KKBK0000665</h6>
            <h6><strong> Bank : </strong> &nbsp;&nbsp; Kotak Mahindra Bank</h6>
            <h6><strong> Branch : </strong> &nbsp;&nbsp; Kandivali West</h6>
            <h6><strong> Acct Type : </strong> &nbsp;&nbsp; Current Account</h6>
            
            <!--<p><strong>Bank Name : </strong>Kotak Mahindra Bank &nbsp;&nbsp; 
            <strong>Account No : </strong> 5013315448 &nbsp;&nbsp;
            <strong>IFSC Code : </strong>KKBK0000665</p>-->
            
        </div>
        <div class="actions">
            <!--<p>Kindly do the payment for Modi Enterprizes</p>-->
           <a class="btn btn-danger" id="pay" href="#">Dummy Pay</a>
           <a class="btn btn-danger" id="cod" href="#">Pay to Allmart Ecommerce LLP</a>
           <a class="btn btn-danger" href="../gateway/index.php">Pay to Allmart Ecommerce LLP Online</a>
           
        </div>
    </div>
</section>



<? include('footer.php');

?>