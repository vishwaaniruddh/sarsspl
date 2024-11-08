<?php session_start();
include('../config.php');

$total_amount = $_SESSION['total_amount'];
$total_amount = sprintf("%.2f", $total_amount);
$total_amount = '1520.00';

var_dump($_SESSION);
?>


<html>
<head>
<script>

	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
</head>
<body>
	<form method="post" name="customerData" action="ccavRequestHandler.php">

			<table width="40%" height="100" border='1' align="center">

					<input type="text" name="tid" id="tid" readonly hidden>
                    <input type="text" name="merchant_id" value="283837" hidden>
                    <input type="text" name="order_id" value="123654789" hidden>
                    <input type="text" name="amount" value="<?php echo $total_amount; ?>" readonly>
                    <input type="text" name="currency" value="INR" hidden>
                    <input type="text" name="redirect_url" value="https://allmart.world/gateway/ccavResponseHandler.php" readonly hidden>
				    <input type="text" name="cancel_url" value="https://allmart.world/gateway/ccavResponseHandler.php" readonly hidden>
				    <input type="text" name="language" value="EN" readonly hidden>
				    
		     	<tr>
		     		<td colspan="2">Billing information(optional):</td>
		     	</tr>
		        <tr>
		        	<td>Billing Name	:</td><td><input type="text" name="billing_name" value="Charli"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Address	:</td><td><input type="text" name="billing_address" value="Room no 1101, near Railway station Ambad"/></td>
		        </tr>
		        <tr>
		        	<td>Billing City	:</td><td><input type="text" name="billing_city" value="Indore"/></td>
		        </tr>
		        <tr>
		        	<td>Billing State	:</td>
		        	<td>
		        	    
		        	    <select name="billing_state">
		        	        <option>Select State</option>
		        	        <?php $state_sql = mysqli_query($con1,"select * from states");
		        	        while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
		        	            
	        	            <option value="<? echo $state_sql_result['state_name'];?>">
		        	                <? echo $state_sql_result['state_name'];?>
        	                </option>
		        	            
		        	        <? } ?>
		        	    </select>
		        	    <!--<input type="text" name="billing_state" value="MP"/>-->
		        	 </td>
		        </tr>
		        <tr>
		        	<td>Billing Zip	:</td><td><input type="text" name="billing_zip" value="425001"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Country	:</td><td><input type="text" name="billing_country" value="India" readonly></td>
		        </tr>
		        <tr>
		        	<td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="9876543210"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Email	:</td><td><input type="text" name="billing_email" value="test@test.com"/></td>
		        </tr>

		        <tr>
		        	<td></td><td><INPUT TYPE="submit" value="CheckOut"></td>
		        </tr>
	      	</table>
	      </form>
	</body>
</html>


