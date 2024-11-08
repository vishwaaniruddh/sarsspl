<?php
session_start();
include ('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
       
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shyam Committee Member Receipt Form</title>

     
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   
   
  <!-- Font Icon -->
<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
 <link rel="stylesheet" href="css/reciptStyle.css">
   
   <style>
       select {
  
  border: 1px solid #ccc;
   border-radius: 50px;
  font-size: 16px;
  height: auto;

  
  padding: 9px;
 width: 100%;
  
  box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
  margin-bottom: 30px;
}

*{
    color:black;
}


   </style>
   
  </head>
<body>
 
 
 
 
 
<?php include 'menu.php'?>

    <div class="main">

        <div class="container" style="width: 1230px;margin-left: 7%;">
            <form method="POST" action="Recipt_Process.php"  class="appointment-form" id="appointment-form" style="padding-top: 10px;padding-bottom: 10px; ">
                <h2 style="text-align: center;">Donation form</h2>
               
                
                
<h4>       Hello ! <?php echo $_SESSION['email']; ?></h4>
                
                
                <div class="row">
                <div class="col-md-6">
                <div >
                    <h4 style="text-align: center;color:black">Your Details</h4>
                    <input type="text" name="name" id="name" placeholder="Name" required />
                     <input type="text" name="CompanyName" id="CompanyName" placeholder="Company name" required />
                      <input type="email" name="email" id="email" placeholder="Email" required />
                         <input type="number" name="Mobile" id="Mobile" placeholder="Mobile No." onKeyPress="if(this.value.length==10) return false;"  required />
                     <input type="text" name="Youremember" id="Youremember" placeholder="In memory of" required />
                 
                  <hr style="border-top: 1px solid #211f1f;">
                  <div class="">
                        <select name="PayMode" id="PayMode" required>
                            <option seleected value="">Payment mode</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Cash">Cash</option>
                            <option value="RTGS">RTGS</option>
                            <!--<option value="PAYTM">PAYTM</option>
                            <option value="Google Pay">Google Pay</option>
                            <option value="Bank Transfer">Bank Transfer</option>-->
                            <option value="CreditCard">Credit card</option>
                        </select>
                    </div>
                  
                  
                 
                <div class="form-submit">
                    <input type="submit" name="submit" id="submit" style="width: 100%;padding: 12px 17px;margin-left: 50%;" class="submit" value="Submit" />
                </div>
               
                </div>
                
                </div>
                <div class="col-md-6">
                <div >
                    <h4 style="text-align: center;color:black">Donation For</h4>
                    <input type="number" name="Fund" id="Fund" placeholder="Corpus Fund"  onblur="totalAmount()" required />
                     <input type="number" name="Room" id="Room" placeholder="For Room"  onblur="totalAmount()" required />
                     <input type="number" name="cow" id="cow" placeholder="For cow" onblur="totalAmount()" required />
                     <input type="number" name="Tree" id="Tree" placeholder="For Tree" onblur="totalAmount()" required />
                    
                         <input type="number" name="Amount" id="Amount" placeholder="Amount" readonly required />
               
                     <hr style="border-top: 1px solid #211f1f;">
                    
                     <input type="number" name="CardNo" id="CardNo" placeholder="Instrument No." required />
                     
                   
              </div>
                </div>
                    </div>
               
            </form>
        </div>

    </div>
     
    <!-- JS -->
   
  
     
   <script src="vendor/jquery/jquery.min.js"></script>
        
    <script src="js/main.js"></script>
<script>
    function totalAmount(){
        var Fund=document.getElementById("Fund").value;
        var Room=document.getElementById("Room").value;
        var cow=document.getElementById("cow").value;
        var Tree=document.getElementById("Tree").value;
        
        Var TotalAmt=Fund+Room+cow+Tree;
         
        
    }
</script>
    
</body>
</html>




