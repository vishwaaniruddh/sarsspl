<? session_start();
include('../config.php');

if(!isset($_SESSION["username"])) {
	header("Location: login_form.php");
}


?>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
        <link href="css/themes/all-themes.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
  
    <style>
    .container{
            height: 100%;
    position: relative;
    }
        form{
                width: 50%;
    margin: auto;
    position: absolute;
    top: 20%;
    left: 25%;
        }
        input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
    </style>    
    </head>
    
    <body class="theme-red">
        <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href="http://www.allmart.world/franchise/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://allmart.world/assets/allmart.2png" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <? include('../menu.php');?>
                
            </div>
        </div>
    </nav>
    
    <div class="container">



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
                <input type="number" name="amount" class="form-control" onchange="setTwoNumberDecimal" step="any" required />
            </div>
            </div>
          
            
        
        </div>
              
          
        <div class="row">
            

          <div class="col-md-4">
            <label for="franchise">Product</label>
            <select name="promotion" class="form-control" required>
                <option value="">Select Product</option>
                <?
                
                $pro_sql = mysqli_query($con,"select * from promotions where status=1");
                
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

          
          <div class="form-group">
            <label for="amount">Order Date</label>
            <input type="date" name="date" class="form-control" required>
          </div>
          
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div> 
    <script>
    
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