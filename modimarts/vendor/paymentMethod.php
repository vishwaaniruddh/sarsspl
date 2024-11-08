<div class="panel panel-default">
  <div class="panel-heading" style="background-image:url(images/Steps.jpg);padding:4px">
	<div class="row">                                
		
		<div class="col-md-6">  <h4 class="panel-title" style="color:white"><a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;color:white"> Payment Method <i class="fa fa-caret-down"></i></a></h4></div>
	</div>   
  </div>
  <div class="panel-collapse collapse in" id="collapse-payment-method" style="">
	<div class="panel-body" style="padding-top: 3px;background-color:white"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
   float: left;
    border: 1px solid #c5b9b9;
    background-color: #ffffff;
    width: 30%;
    height: 277px;
    border-radius: 3px;
}

/* Style the buttons inside the tab */
.tab button {
        display: block;
    background-color: inherit;
    color: black;
    padding: 6px 14px;
    width: 107%;
    border: 1;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 13px;
    font-family: Arial,Helvetica,sans-serif;

   
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
    
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: white;
    
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 277px;
    background-color:white;
    border-radius: 3px;
    
}





</style>
<style>
span.cvv{
    background-image: url("images/CVV-Cards.jpg");
    background-position: 2px 2px;
    background-repeat: no-repeat;
    width: 50px;
    height: 34px;
    display: inline-block;
   /* position: absolute;*/
    left: 55px;
    top: -8px;
    
}
span.cvv .tip-content, span.cvv span.arrow {
    display: none;
}
.radius6 {
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    
}
#creditcard_form .cvv_number {
    position: relative;
}
input.textfield-55x25 {
    width: 45px!important;
    min-height: 23px;
    padding: 0!important;
    vertical-align: middle;
}
</style>
<!--============  choose payment method ===============================-->
<div class="panel-body" style="margin-right: 75px;padding-left: 0px;padding-right: 42px;">
<div style="background-color: #e4e4e4;text-align:left;font-weight: bold;color:#2f2c2c; border: 1px solid #e6e1e1;font-size:15px;border-radius: 3px;font-family:Arial,Helvetica,sans-serif;padding-left: 11px;">Payment Information</div>
<div class="tab">
<button class="tablinks active" onclick="openPaymentSection(event, 'CreditCard')" id="defaultOpen"> Credit Card <span id="CreditCardarro" style="display: inline;"><i class="fa fa-angle-right" style="font-size:14px;    float: right;"></i> </span></button>
<button class="tablinks" onclick="openPaymentSection(event, 'DebitCards')"> Debit Cards <span id="DebitCardsarro" style="display:none"><i class="fa fa-angle-right" style="font-size:14px;    float: right;"></i> </span></button>
<button class="tablinks" onclick="openPaymentSection(event, 'NetBanking')"> Net Banking <span id="NetBankingarro" style="display:none"><i class="fa fa-angle-right" style="font-size:14px;    float: right;"></i> </span></button>
<button class="tablinks" onclick="openPaymentSection(event, 'Wallet')"> Wallet <span id="Walletarro" style="display:none"><i class="fa fa-angle-right" style="font-size:14px;    float: right;"></i> </span> </button>
<!--<button class="tablinks" onclick="openPaymentSection(event, 'COD')">Cash on delivery <span id="CODarro" style="display:none"><i class="fa fa-angle-right" style="font-size:14px;   float: right;"></i> </span></button>-->
<button class="tablinks" onclick="openPaymentSection(event, 'London')"> Merabazzar Wallet <span id="Londonarro" style="display:none"><i class="fa fa-angle-right" style="font-size:14px;    float: right;"></i> </span></button>
</div>

<div id="London" class="tabcontent" style="display:none">
  <h3>London</h3>
  <p>London is the capital city of England.</p>
</div>
  
<div id="CreditCard" class="tabcontent" style="display: block;">
  <h6>Card Number</h6>
  <input type="tel" pattern="[0-9]*" name="creditCardNumber" id="creditCardNumber" maxlength="19">
                    	
                    	<span class="icon-container">
                    	    
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
           
							
						</span>
  
  <label style="color: red">Please enter card number.</label>


<div class="row">
    <div class="col-md-6">
                	<span class="span12 content-text formText">Expiry Date</span><br>
					<span class="span12">
						<select class="select-90x25 noradius expiryMonth payoptselect" name="expiryMonthCreditCard" id="expiryMonthCreditCard">
							<option value="">Month</option>
							<option value="01">Jan (01)</option>
							<option value="02">Feb (02)</option>
							<option value="03">Mar (03)</option>
							<option value="04">Apr (04)</option>
                            <option value="05">May (05)</option>
                            <option value="06">June (06)</option>
                            <option value="07">July (07)</option>
                            <option value="08">Aug (08)</option>
                            <option value="09">Sep (09)</option>
                            <option value="10">Oct (10)</option>
                            <option value="11">Nov (11)</option>
                            <option value="12">Dec (12)</option>
						</select>
						<select class="select-90x25 noradius expiryYear payoptselect" id="expiryYearCreditCard" name="expiryYearCreditCard">
							<option value="">Year</option>
							
									<option value="2018">2018</option>
									
									<option value="2019">2019</option>
									
									<option value="2020">2020</option>
									
									<option value="2021">2021</option>
									
									<option value="2022">2022</option>
									
									<option value="2023">2023</option>
									
									<option value="2024">2024</option>
									
									<option value="2025">2025</option>
									
									<option value="2026">2026</option>
									
									<option value="2027">2027</option>
									
									<option value="2028">2028</option>
									
									<option value="2029">2029</option>
									
									<option value="2030">2030</option>
									
									<option value="2031">2031</option>
									
									<option value="2032">2032</option>
									
									<option value="2033">2033</option>
									
									<option value="2034">2034</option>
									
									<option value="2035">2035</option>
									
									<option value="2036">2036</option>
									
									<option value="2037">2037</option>
									
									<option value="2038">2038</option>
									
									<option value="2039">2039</option>
									
									<option value="2040">2040</option>
									
									<option value="2041">2041</option>
									
									<option value="2042">2042</option>
									
									<option value="2043">2043</option>
									
									<option value="2044">2044</option>
									
									<option value="2045">2045</option>
									
									<option value="2046">2046</option>
									
									<option value="2047">2047</option>
									
									<option value="2048">2048</option>
									
									<option value="2049">2049</option>
									
									<option value="2050">2050</option>
									
								
									
						</select>
                        <label id="currentMonth" style="display: none;">11</label>
					</span>
					<span class="span12 error">
                        <label for="creditCardDate" generated="true" class="error"></label>
                    </span>
                </div>
<div class="col-md-6">
 <div class="row"><div class="col-md-3" style="padding-right: 0px;padding-left: 15px;width: 115px;padding-top: 4px;">
                	<span class="span12 content-text"><span class="hidden-phone hidden-tablet">&nbsp;&nbsp;&nbsp;</span>CVV</span>
			<span class="hidden-phone hidden-tablet">&nbsp;</span><input class="" id="CVVNumberCreditCard" name="CVVNumberCreditCard" style="width: 51px;" pattern="[0-9]*" type="tel" maxlength="3">
				</div>
				
						
					<div class="col-md-5" style="padding-left: 0px;"><span class="cvv">  	</span> 
                      </div>

 </div>
 </div> </div>

<p>I agree with the <b style="color:#0f6cb2">Privacy Policy</b> by proceeding with this payment.</p> <p></p><b style="color:#0f6cb2">INR 600.00</b>  (Total Amount Payable)<p></p>

<input type="button" value="Make Payment" id="Make Payment" style="height: 29px;" data-loading-text="Loading..." class="btn btn-primary">
<input type="button" value="Cancel" id="Cancel" style="height: 29px;" data-loading-text="Loading..." class="btn btn-primary">

</div>


<div id="DebitCards" class="tabcontent" style="display:none">
  <p style="margin-top: 12px;">We Accept</p>
  <select name="debitCard" style="height: 24px; border-color: darkgray;padding: 1;width: 100%;" id="debitCard">
                      <option value="">Select Debit Card </option>
                       <option style="display: none" id="" value="MasterCard Debit Card" class="CCAvenue ACTI  N">MasterCard Debit Card</option>    	
                          <option id="" value="Suryoday Small Finance Bank Ltd" class="CCAvenue ACTI nocvv N">Suryoday Small Finance Bank Ltd</option>
                        <option id="" value="Syndicate Bank" class="CCAvenue ACTI nocvv N">Syndicate Bank</option>
                         <option id="" value="Andhra Bank" class="Service Provider ACTI  N">Andhra Bank</option>
                          <option id="" value="Citibank" class="Service Provider ACTI  N">Citibank</option>
                         <option id="" value="IOB Debit card" class="Service Provider ACTI  N">IOB Debit card</option>
                          <option id="" value="IDFC Debit Card" class="Service Provider ACTI  N">IDFC Debit Card</option>
                          <option style="display: none" id="" value="Maestro Debit Card" class="CCAvenue ACTI  N">Maestro Debit Card</option>    	
                        <option style="display: none" id="" value="RuPay" class="CCAvenue ACTI  N">RuPay</option>    	
                         <option id="" value="State Bank of India" class="CCAvenue ACTI  N">State Bank of India</option>
                      <option style="display: none" id="" value="Visa Debit Card" class="CCAvenue ACTI  N">Visa Debit Card</option>    	
                     </select>
  
  
  <div id="cardNumberDebit"><br>
                	<span>Card Number</span>
                    <div>
	                    <input style="height: 24px;padding: 1;width: 100%;" type="text" name="debitCardNumber" id="debitCardNumber" maxlength="19" pattern="[0-9]*" autocomplete="off">
	                  <p>I agree with the <b style="color:#0f6cb2">Privacy Policy</b> by proceeding with this payment.</p> <p></p><b style="color:#0f6cb2">INR 600.00</b>  (Total Amount Payable)<p></p>

<input type="button" value="Make Payment" id="Make Payment" style="height: 29px;" data-loading-text="Loading..." class="btn btn-primary">
<input type="button" value="Cancel" id="Cancel" style="height: 29px;" data-loading-text="Loading..." class="btn btn-primary">

                    </div>
  
</div></div>


<div id="NetBanking" class="tabcontent" style="display:none">
  
  <div class="span12 all-other-banks">
                	<p style="margin-top:10px">All Other Banks</p>
                    <select name="netBankingBank" id="netBankingBank" style="width:100%">
                     <option value="">Select Bank</option>
                        
                           <option id="" value="AU Small Finance Bank" class="ACTI N">AU Small Finance Bank</option>
                        
                           <option id="" value="State Bank of India" class="ACTI N">State Bank of India</option>
                        
                           <option id="" value="ICICI Bank" class="ACTI N">ICICI Bank</option>
                        
                           <option id="" value="HDFC Bank" class="ACTI N">HDFC Bank</option>
                        
                           <option id="" value="Citibank" class="ACTI N">Citibank</option>
                        
                           <option id="" value="Kotak Mahindra Bank" class="ACTI N">Kotak Mahindra Bank</option>
                        
                           <option id="" value="Axis Bank" class="ACTI N">Axis Bank</option>
                        
                           <option id="" value="Aditya Birla Payments Bank" class="ACTI N">Aditya Birla Payments Bank</option>
                        
                           <option id="" value="Airtel Payments Bank" class="ACTI N">Airtel Payments Bank</option>
                        
                           <option id="" value="Allahabad Bank" class="ACTI N">Allahabad Bank</option>
                        
                           <option id="" value="Andhra Bank" class="ACTI N">Andhra Bank</option>
                        
                           <option id="" value="Bandhan Bank" class="ACTI N">Bandhan Bank</option>
                        
                           <option id="" value="Bank of Baharin and Kuwait" class="ACTI N">Bank of Baharin and Kuwait</option>
                        
                           <option id="" value="Bank of Baroda Corporate" class="ACTI N">Bank of Baroda Corporate</option>
                        
                           <option id="" value="Bank of Baroda Retail" class="ACTI N">Bank of Baroda Retail</option>
                        
                           <option id="" value="Bank of India" class="ACTI N">Bank of India</option>
                        
                           <option id="" value="Bank of Maharashtra" class="ACTI N">Bank of Maharashtra</option>
                        
                           <option id="" value="Canara Bank" class="ACTI N">Canara Bank</option>
                        
                           <option id="" value="Catholic Syrian Bank" class="ACTI N">Catholic Syrian Bank</option>
                        
                           <option id="" value="Central Bank of India" class="ACTI N">Central Bank of India</option>
                        
                           <option id="" value="City Union Bank" class="ACTI N">City Union Bank</option>
                        
                           <option id="" value="Corporation Bank" class="ACTI N">Corporation Bank</option>
                        
                           <option id="" value="Cosmos Bank" class="ACTI N">Cosmos Bank</option>
                        
                           <option id="" value="DBS Bank Ltd" class="ACTI N">DBS Bank Ltd</option>
                        
                           <option id="" value="DCB Bank" class="ACTI N">DCB Bank</option>
                        
                           <option id="" value="Deutsche Bank" class="ACTI N">Deutsche Bank</option>
                        
                           <option id="" value="Dhanlaxmi Bank" class="ACTI N">Dhanlaxmi Bank</option>
                        
                           <option id="" value="Federal Bank" class="ACTI N">Federal Bank</option>
                        
                           <option id="" value="IDBI Bank" class="ACTI N">IDBI Bank</option>
                        
                           <option id="" value="IDFC Bank" class="ACTI N">IDFC Bank</option>
                        
                           <option id="" value="Indian Bank" class="ACTI N">Indian Bank</option>
                        
                           <option id="" value="Indian Overseas Bank" class="ACTI N">Indian Overseas Bank</option>
                        
                           <option id="" value="IndusInd Bank" class="ACTI N">IndusInd Bank</option>
                        
                           <option id="" value="Jammu and kashmir Bank" class="ACTI N">Jammu and kashmir Bank</option>
                        
                           <option id="" value="JANATA SAHAKARI BANK LTD PUNE" class="ACTI N">JANATA SAHAKARI BANK LTD PUNE</option>
                        
                           <option id="" value="Karnataka Bank" class="ACTI N">Karnataka Bank</option>
                        
                           <option id="" value="Karur Vysya Bank" class="ACTI N">Karur Vysya Bank</option>
                        
                           <option id="" value="Lakshmi Vilas Bank" class="ACTI N">Lakshmi Vilas Bank</option>
                        
                           <option id="" value="Oriental Bank Of Commerce" class="ACTI N">Oriental Bank Of Commerce</option>
                        
                           <option id="" value="Punjab And Sind Bank" class="ACTI N">Punjab And Sind Bank</option>
                        
                           <option id="" value="Punjab National Bank [Corporate]" class="ACTI N">Punjab National Bank [Corporate]</option>
                        
                           <option id="" value="Punjab National Bank [Retail]" class="ACTI N">Punjab National Bank [Retail]</option>
                        
                           <option id="" value="RBL Bank" class="ACTI N">RBL Bank</option>
                        
                           <option id="" value="Saraswat Bank" class="ACTI N">Saraswat Bank</option>
                        
                           <option id="" value="Shamrao Vithal Bank" class="ACTI N">Shamrao Vithal Bank</option>
                        
                           <option id="" value="South Indian Bank" class="ACTI N">South Indian Bank</option>
                        
                           <option id="" value="Standard Chartered Bank" class="ACTI N">Standard Chartered Bank</option>
                        
                           <option id="" value="State Bank Of Bikaner and Jaipur" class="ACTI N">State Bank Of Bikaner and Jaipur</option>
                        
                           <option id="" value="State Bank Of Hyderabad" class="ACTI N">State Bank Of Hyderabad</option>
                        
                           <option id="" value="State Bank Of Mysore" class="ACTI N">State Bank Of Mysore</option>
                        
                           <option id="" value="State Bank of Patiala" class="ACTI N">State Bank of Patiala</option>
                        
                           <option id="" value="State Bank of Travancore" class="ACTI N">State Bank of Travancore</option>
                        
                           <option id="" value="Suryoday Small Finance Bank Ltd" class="ACTI N">Suryoday Small Finance Bank Ltd</option>
                        
                           <option id="" value="Syndicate Bank" class="ACTI N">Syndicate Bank</option>
                        
                           <option id="" value="Tamilnad Mercantile Bank" class="ACTI N">Tamilnad Mercantile Bank</option>
                        
                           <option id="" value="UCO Bank" class="ACTI N">UCO Bank</option>
                        
                           <option id="" value="Ujjivan Small Finance Bank" class="ACTI N">Ujjivan Small Finance Bank</option>
                        
                           <option id="" value="Union Bank of India" class="ACTI N">Union Bank of India</option>
                        
                           <option id="" value="United Bank of India" class="ACTI N">United Bank of India</option>
                        
                           <option id="" value="Vijaya Bank" class="ACTI N">Vijaya Bank</option>
                        
                           <option id="" value="YES Bank" class="ACTI N">YES Bank</option>
                        
                    </select>
                    <label for="netBankingBank" generated="true" class="error"></label><label class="error downError"></label><label class="error fluctuateError"></label>
                    <span class="span12 content-text"><span style="font-size:11px"><strong>Note:</strong> We will redirect you to the bank you have chosen above. Once the bank verifies your net banking credentials, we will proceed with your payment.</span></span>
                </div>
              <br>
				<div id="savecard" class="span12  savecustomerCard">
					<span class="span12 content-text border radius">
							<span class="span1"><input type="checkbox" class="register-new" name="saveCard"></span>
							<span class="span11 content-text note">
								Save your bank name with CCAvenue Checkout for future payments.
							</span><span class="span12"></span>
							<!-- New User Register Panel Starts Here  -->
							 
							
					</span>			
				</div>
				<br>
				
   <p>I agree with the <b style="color:#0f6cb2">Privacy Policy</b> by proceeding with this payment.</p> <p></p><b style="color:#0f6cb2">INR 600.00</b>  (Total Amount Payable)<p></p>

<input type="button" value="Make Payment" id="Make Payment" style="height: 29px;" data-loading-text="Loading..." class="btn btn-primary">
<input type="button" value="Cancel" id="Cancel" style="height: 29px;" data-loading-text="Loading..." class="btn btn-primary">

  
  
  
</div>











<div id="Wallet" class="tabcontent" style="display:none">
  <h3 style="color: #afadad;">Wallet</h3>
   <button onclick="openPaymentSection(event, 'Paytm')"><img src="images/paytm.png" style="height: 19px;"></button>
  
   <button onclick="openPaymentSection(event, 'Tokyo')"><img src="images/bhimLogo.jpg" style="height: 19px;"></button>
  <button onclick="openPaymentSection(event, 'London')"><img src="images/pe.png" style="height: 19px;"></button>
  
</div>



<div id="Paytm" class="tabcontent" style="display:none">
 
 



<title>Merchant Check Out Page</title>
<meta name="GENERATOR" content="Evrsoft First Page">


	<h1>Merchant Check Out Page</h1>
	<pre>	</pre>
	<form method="post" action="paytm/Paytm_Web_Sample_Kit_PHP-master/PaytmKit/pgRedirect.php">
		<table border="1">
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>1</td>
					<td><label>ORDER_ID::*</label></td>
					<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="ORDS85061747">
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td><label>CUSTID ::*</label></td>
					<td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001"></td>
				</tr>
				<tr>
					<td>3</td>
					<td><label>INDUSTRY_TYPE_ID ::*</label></td>
					<td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>Channel ::*</label></td>
					<td><input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td><label>txnAmount*</label></td>
					<td><input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="1">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit" id="paytm_submit"></td>
				</tr>
			</tbody>
		</table>
		* - Mandatory Fields
	</form>


</div>

<div id="COD" class="tabcontent" style="display:none">
  <h3 style="color: #afadad;">CASH ON DELIVERY</h3>
   <p>The preferred payment method to use on this order.</p>
<!--<div class="radio">-->
<div class="">
  <label>
            <input type="radio" name="payment_method" value="cod" checked="checked">
        Cash On Delivery      </label>
       <!-- <label>
            <input type="radio" name="payment_method" value="w" >
        Ewallet   </label>-->
        
</div>

<div class="buttons">
  <div class="pull-right">I have read and agree to the <a href="http://sarmicrosystems.in/oc1/index.php?route=information/information/agree&amp;information_id=5" class="agree"><b>Terms &amp; Conditions</b></a>        <input type="checkbox" id="chagree" name="agree" value="1">
        &nbsp;
    <input type="button" value="Place Order" id="button-payment-method" data-loading-text="Loading..." class="btn btn-primary">
    
  </div>
</div>
</div>

<script>
function openPaymentSection(evt, PayMethod) {
    
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        
   
    }
    if(PayMethod+"arro"=="Walletarro"){
         document.getElementById("Walletarro").style.display = "inline";
         document.getElementById("Londonarro").style.display = "none";
        
         <!--document.getElementById("CODarro").style.display = "none";-->
         document.getElementById("CreditCardarro").style.display = "none";
         document.getElementById("DebitCardsarro").style.display = "none";
         document.getElementById("NetBankingarro").style.display = "none";
    }else if(PayMethod+"arro"=="Londonarro"){
        document.getElementById("Walletarro").style.display = "none";
         document.getElementById("Londonarro").style.display = "inline";
         
         <!--document.getElementById("CODarro").style.display = "none";-->
         document.getElementById("CreditCardarro").style.display = "none";
         document.getElementById("DebitCardsarro").style.display = "none";
         document.getElementById("NetBankingarro").style.display = "none";
    }
  
    else if(PayMethod+"arro"=="CODarro"){
        
        
       document.getElementById("Walletarro").style.display = "none";
         document.getElementById("Londonarro").style.display = "none";
         
         document.getElementById("CODarro").style.display = "inline";
         document.getElementById("CreditCardarro").style.display = "none";
         document.getElementById("DebitCardsarro").style.display = "none";
         document.getElementById("NetBankingarro").style.display = "none";
    }
    else if(PayMethod+"arro"=="CreditCardarro"){
        document.getElementById("Walletarro").style.display = "none";
         document.getElementById("Londonarro").style.display = "none";
         
         <!--document.getElementById("CODarro").style.display = "none";-->
          document.getElementById("CreditCardarro").style.display = "inline";
         document.getElementById("DebitCardsarro").style.display = "none";
         document.getElementById("NetBankingarro").style.display = "none";
    }
    else if(PayMethod+"arro"=="DebitCardsarro"){
         document.getElementById("Walletarro").style.display = "none";
         document.getElementById("Londonarro").style.display = "none";
        
         <!--document.getElementById("CODarro").style.display = "none";-->
          document.getElementById("CreditCardarro").style.display = "none";
         document.getElementById("DebitCardsarro").style.display = "inline";
         document.getElementById("NetBankingarro").style.display = "none";
    }
    else if(PayMethod+"arro"=="NetBankingarro"){
        
        
       document.getElementById("Walletarro").style.display = "none";
         document.getElementById("Londonarro").style.display = "none";
      
         document.getElementById("CODarro").style.display = "none";
          document.getElementById("CreditCardarro").style.display = "none";
         document.getElementById("DebitCardsarro").style.display = "none";
         document.getElementById("NetBankingarro").style.display = "inline";
    }
    

    
    if(PayMethod=="Paytm"){    
        $('#paytm_submit').click();
        
    }else{
    
    document.getElementById(PayMethod).style.display = "block";
    evt.currentTarget.className += " active";
    }
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
   
    
    
    
    
    
    
    
    
    
    
  <!--  <p>Please select the preferred payment method to use on this order.</p>
<div class="radio">
  <label>
            <input type="radio" name="payment_method" value="cod" checked="checked">
        Cash On Delivery      </label>
         <label>
            <input type="radio" name="payment_method" value="w" >
        Ewallet   </label>
        
</div>

<div class="buttons">
  <div class="pull-right">I have read and agree to the <a href="http://sarmicrosystems.in/oc1/index.php?route=information/information/agree&amp;information_id=5" class="agree"><b>Terms &amp; Conditions</b></a>        <input type="checkbox" id="chagree" name="agree" value="1">
        &nbsp;
    <input type="button" value="Continue" id="button-payment-method" data-loading-text="Loading..." class="btn btn-primary" >
    
  </div>
</div>-->
</div></div>
          </div>
        </div>