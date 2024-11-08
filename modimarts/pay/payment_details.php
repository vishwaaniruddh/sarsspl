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
              
        $("#pay").on('click',function(){
             
            var name = document.getElementById('name').value;
            var bnk_name = document.getElementById('bank_name').value;
            var amount = document.getElementById('amnt').value;
            var transaction_id = document.getElementById('transactionId').value;
            var date = document.getElementById('date').value;
            var method = document.getElementById('method').value;
            
            if(bnk_name==''){
                alert("Enter bank name!");
            } else if (transaction_id==''){
                alert("enter transaction id!")
            } else{
                swal({
              title: "Are you sure?",
              text: "You are proceeding towards  ",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = 'response.php?method='+method+'&name='+name+'&amount='+amount+'&transaction_id='+transaction_id+'&bank_name='+bnk_name+'&date='+date;
              } else {
                swal("You Cancel To proceed Further","","error");
              }
            }); 
            }
            
                 
            
        });
              
              
              
        /*$("#pay").on('click',function(){
                 
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
        });*/
              
              
              
    });
</script>


<!--transaction_details-->

<section>
    <div class="container">
        <div class="actions">
            <form method="get" style="width:100%;">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="transactionId" class="col-sm-2 col-form-label">Transaction Id</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="transactionId" name="transactionId" placeholder="Transaction Id" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bank_name" class="col-sm-2 col-form-label">Bank Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="bank name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amnt" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="amnt" name="amnt" value="<?php echo $_SESSION['total_amount'];?>" placeholder=" ">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" id="date" name="date" placeholder="Date">
                    </div>
                </div>
                <input type="hidden" class="form-control" id="method" name="method" value="<?php echo $_GET['method'];?>" placeholder="Date">
                
  <!--bknm amt:editable date-->
                <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="button" id="pay" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include('footer.php');

?>