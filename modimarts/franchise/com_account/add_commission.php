<? session_start();
include('../config.php');

if(!isset($_SESSION["username"])) {
	header("Location: login_form.php");
}


?>

<!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
    section.content{
        margin:0;
    }
</style>
    
    

    <style>

        input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

form{
    background: white;
    padding-top: 5%;
    font-size: 16px;
    padding-left: 5%;
    padding-right: 5%;
    padding-bottom: 5%;
}
*{
    font-size:12px;
}

input , select {
    border: 1px solid !important;
}
    </style>    
    </head>
    
 
    

<script>
    function submitfun(){
        
   var date = document.getElementById("date").value;
   var amount= document.getElementById("amount").value;
   var member_id = document.getElementById("member").value ;
   var promotion = document.getElementById("promotion").value;
     
     
           $.ajax({
                   type: 'POST',    
                   url:'custom_commission.php',
                   data:'date='+date+'&amount='+amount+'&member='+member+'&promotion='+promotion,
                   async: false,
                   success: function(msg){
                       
 if(msg> 0){
        
        swal(" Thank You !", "Successfully Added Commission !", "success");
        
        setTimeout(function(){
                    $('#content').load( 'add_commission.php');
        }, 3000);


     

   
 }else{
             swal(" Error !", "Error in Adding Commission  !", "error");


 }
   
   
} })
            }


</script>


    <form action="custom_commission.php" method="post">
            
        <div class="row">


        <div class="col-md-9">
            <label for="amount">Franchise Name</label>
                <input list="items" id="item" class="form-control" required>
                
                <datalist id="items">
                <?  $sql = mysqli_query($con,"select * from new_member where status=1");
                
                while($sql_result = mysqli_fetch_assoc($sql)){ 
                
                $name = $sql_result['name'];
                $id = $sql_result['id']; ?>
                
                <option value="<? echo $name; ?>"  data-xyz = "<? echo $id; ?>" >
                
                <? } ?>
                
                </datalist>
                

          </div>
          
          
            <div class="col-md-3">
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" onchange="setTwoNumberDecimal" step="any" required />
            </div>
            </div>
          
            
        
        </div>
              
          
        <div class="row">
            

          <div class="col-md-4">
            <label for="franchise">Product</label>
            <select name="promotion" class="form-control" id="promotion" required>
                <option value="">Select Product</option>
                <?
                
                $pro_sql = mysqli_query($con,"select * from promotions where status=1 order by promotions");
                
                while($pro_sql_result = mysqli_fetch_assoc($pro_sql)){ ?>
                    
                    <option value="<? echo $pro_sql_result['id'];?>"><? echo $pro_sql_result['promotions'];?></option>
                <? } ?>
            </select>
          </div>
          
          
          <div class="col-md-4">
            <label for="franchise">Franchise Mobile</label>
            <input type="text" id="mobile" name="mobile" class="form-control" readonly>
          </div>
          

          <div class="col-md-4">
            <label for="franchise">Franchise ID</label>
            <input type="number" id="member" name="member" class="form-control" readonly>
          </div>
          






          </div>
<br>
          
          <div class="form-group">
            <label for="amount">Order Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
          </div>
          
        <button type="button" class="btn btn-primary" id="submitbtn" name="submitbtn" onclick="submitfun()">Submit</button>
        </form>
        

    <script>
    $("#loading").hide();
    
    $('document').ready(function(){

       $(function() {

        $("#item").on('change',function() {
            var val = $('#item').val()
            var xyz = $('#items option').filter(function() {
                return this.value == val;
            }).data('xyz');
            $("#member").val(xyz);
            
            
                    $.ajax({
                url: "../../mem_info.php",
				data: 'id=' + xyz,
                type: "POST",
                success: function (data) {
                    
                    
                var obj = JSON.parse(data);
                var mobile = obj['mobile'];
                $("#mobile").val(mobile);
                
                }
                    });


        })

});    

});

    </script>
    </body>
</html>