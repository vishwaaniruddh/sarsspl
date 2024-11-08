 <?php include('config.php');?>
<!DOCTYPE html>
<html>
<head>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
<script>
function
</script>-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>
<script>
 function subspayment(m,rs)
{    
    var month=m;
    var price=rs;
$.ajax({
    type: 'POST',    
    url:  'process_subscrib.php',
    data: 'month='+month+'&price='+price, 

success: function(msg){
    alert(msg);
    //var modal = document.getElementById('myModal');
    //modal.style.display = "none";
    window.open("add_product.php", "_self");
         }
     });
}

function paymethodop_test()
{
    $.ajax({
        /*url: 'paymentMethod.php',*/
        url: 'payumoney/pay.php',
        dataType: 'html',
        success: function(html) {
            //alert(html)
            $('#collapse-payment-method').css("display","block");
            $('#collapse-payment-method .panel-body').html(html);
         	//$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;color:white"> Payment Method <i class="fa fa-caret-down"></i></a>');
    		$('a[href=\'#collapse-payment-method\']').trigger('click');
    	    //$('#collapse-checkout-confirm').parent().find('.pane-heading .panel-title').html('ORDER TRACKING');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
</script>
<?php /*
<h2 align="center" style="margin-top: 120px;">  Subscription Package :</h2>
<table align="center" style="width:44%;">
  <tr>
    <th>Merchant Name</th>
    <th>Email</th>
    <th>Package Subscription Month</th>
    <th>Expiry Date</th>
    <th>Price</th>
    
  </tr>
  <tr>
     <?php $Q="select name,email from clients where code='".$_GET["mid"]."'";
            $ret = mysql_query($Q);
            $row = mysql_fetch_array($ret);
            $mont=$_GET["mo"];
            $effectiveDate = strtotime("+$mont months", strtotime(date("y-m-d")));
            $tilldt = date("d-m-y", $effectiveDate);
      ?>
    <td><?php echo $row[0];?></td>
    <td><?php echo $row[1];?></td>
     <td><?php echo $_GET["mo"];?></td>
    <td><?php  echo $tilldt;?></td>
     <td><?php echo $_GET["pr"];?></td>
    
  </tr>
</table><br />
<input type="button" value="Make Payment" onclick="subspayment(<?php echo $_GET["mo"];?>,<?php echo $_GET["pr"];?>)" style="margin-left:45%;"/>

*/ ?>
<div class="container">
  <h2 align="center" style="margin-top: 120px;">Subscription Package :</h2>
  <!--<p>Subscription Package :</p>-->          
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Merchant Name</th>
        <th>Email</th>
        <th>Package Subscription Month</th>
        <th>Expiry Date</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <tr>
         <?php $Q="select name,email from clients where code='".$_GET["mid"]."'";
            $ret = mysql_query($Q);
            $row = mysql_fetch_array($ret);
            $mont=$_GET["mo"];
            $effectiveDate = strtotime("+$mont months", strtotime(date("y-m-d")));
            $tilldt = date("d-m-y", $effectiveDate);
        ?>
        <td><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $_GET["mo"];?></td>
        <td><?php echo $tilldt;?></td>
        <td><?php echo $_GET["pr"];?></td> 
      </tr>
    </tbody>
  </table>
  <!--<input type="button" class="btn-success" style="border-radius: 6px;margin-left: 42%;" value="Make Payment" onclick="subspayment(<?php echo $_GET["mo"];?>,<?php echo $_GET["pr"];?>)" style="margin-left:45%;"/>-->
    <input type="button" class="btn-success" style="border-radius: 6px;margin-left: 42%;" value="Make Payment" onclick="paymethodop_test()" style="margin-left:45%;"/>
    <div class="panel panel-default">
      <div class="panel-collapse collapse" id="collapse-payment-method">
        <div class="panel-body" style="padding-top: 3px;background-color:white"></div>
      </div>
    </div>
    
</div>
</body>
</html>
