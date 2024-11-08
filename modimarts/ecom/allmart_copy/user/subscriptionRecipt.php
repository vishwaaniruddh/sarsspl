 <?php include('config.php');
 var_dump($_GET);
 ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        $Q="select *  from clients where code='".$_GET["mid"]."'";
        $ret = mysqli_query($con1,$Q);
        $row = mysqli_fetch_array($ret);
        //echo($row['email']);
        $mont=$_GET["mo"];
        $effectiveDate = strtotime("+$mont months",strtotime(date("y-m-d")));
        $tilldt = date("d-m-y",$effectiveDate);
    ?>
<script>
 
function paymethodop_test()
{
    $.ajax({
        url: 'payumoney/pay.php?mid=<?php echo $_GET["mid"]; ?>&id=<?php echo $_GET["id"]; ?>',
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

<div class="container">
  <h2 align="center" style="margin-top: 120px;">Subscription Package :</h2>
  <!--<p>Subscription Package :</p>-->          
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Merchant Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['email'];?></td>
      </tr>
    </tbody>
  </table>
    <input type="button" class="btn-success" style="border-radius: 6px;margin-left: 42%;" value="Make Payment" onclick="paymethodop_test()" style="margin-left:45%;"/>
    <div class="panel panel-default">
      <div class="panel-collapse collapse" id="collapse-payment-method" style="display:none">
        <div class="panel-body" style="padding-top: 3px;background-color:white"></div>
      </div>
    </div>
</div>
</body>
</html>
