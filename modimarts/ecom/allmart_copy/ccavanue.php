
   



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>CCAvenue: Billing Shipping</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="/css/allcss.css" rel="stylesheet"/>

<!--<link href="/css/transaction.css" rel="stylesheet"/> 
<link href="/css/general.css" rel="stylesheet" />
<link href="/css/media.css" rel="stylesheet" /> 
<link href="/css/common.css" rel="stylesheet" /> 
<link href="/css/responsive.css" rel="stylesheet" />
<link href="/css/easy-responsive-tabs.css" rel="stylesheet"/>-->
<style type="text/css">
 .page-bg{background-color:#f0f0f0;}
 .highlight-text{color:#259fd2;}
 .primary-button-text{background-color:;color:#ffffff;}
 .border{border-color:#d9d7d7;}
 .primary-button-bg{background-color:#0185c8;}
 .divider{border-color:#d9d7d7;}
 .content-bg {background-color:#ffffff;}
 .content-text{color:#474747;}
 .heading-text{color:#000000;}
 .primary-link{color:;}
 .innerpanel-bg{background-color:#f8f8f8;}
 .innerpanel-text{color:#292929;}
 .heading-bg{background-color:#e4e4e4;}
 .header-bg{background-color:#000000;}
 .footer-bg{background-color:#000000;}
 .highlight-text{color:#259fd2;}
 .webstore-name-text{color:#ffffff;}
 .primary-button-border{border-color:#6bbb69;}
 
.cancel-transaction { padding:0 10px 10px 10px; }
 .cancel-transaction table td.border { border-width:0 0 1px 0; }
 .cancel-transaction table td { padding:5px 0; }
 .cancel-transaction table td label {display:block; float:left;}
 .cancel-transaction table td textarea { font-size:11px; }
 .cvvnumber{
				 text-security:disc;
   				 -webkit-text-security:disc;
   				 -mox-text-security:disc;
			}
</style>
<!--[if gte IE 9]><link href="/css/ie.css" rel="stylesheet"><![endif]-->
<!--[if lte IE 8]><link href="/css/ie7.css" rel="stylesheet"><![endif]-->

<!--<script>if (top != self) top.location=location</script>-->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>


	<body class="page-bg english" style="background-image: url('https://dashboard.ccavenue.com/ImgStore/Images/');">

<form name="TransactionForm" id="TransactionForm" method="post" action="/transaction.do">
<div class="container-fluid fix-desktop">
 <input type="hidden" name="merchantId" value="49646" id="merchantId">
 <input type="hidden" name="cardType" value="" id="orderCardType">
 <input type="hidden" name="paymentOption" value="" id="paymentOption">
 <input type="hidden" name="cardName" value="" id="cardName">
 <input type="hidden" name="debitCardName" value="" id="debitCardName">
 <input type="hidden" name="cardNumber" value="" id="cardNumber">
 <input type="hidden" name="cvvNumber" value="" id="CCVNumber">
 <input type="hidden" name="emiTenureId" value="0" id="emiTenureId">
 <input type="hidden" name="emiPlanId" value="0" id="emiPlanId">
 <input type="hidden" name="expiryMonth" value="" id="expiryMonth">
 <input type="hidden" name="expiryYear" value="" id="expiryYear">
 <input type="hidden" name="grossAmt" value="600.0" id="orderAmount">
 <input type="hidden" name="pagePriButtonBkg" value="#0185c8" id="pagePriButtonBkg">
 <input type="hidden" name="pagePriButtonText" value="#ffffff" id="pagePriButtonText">
 <input type="hidden" name="pagePriButtonTextHover" value="#ffffff" id="pagePriButtonTextHover">
 <input type="hidden" name="pagePriButtonbkgRollover" value="#42b341" id="pagePriButtonbkgRollover">
 <input type="hidden" name="pageButtonOutsideBorder" value="N" id="pageButtonOutsideBorder">
 <input type="hidden" name="pageButtonInsideBorder" value="N" id="pageButtonInsideBorder">
 <input type="hidden" name="pageButtonRadius" value="N" id="pageButtonRadius">
 <input type="hidden" name="settingEditPopulatedData" value="N" id="isEditPrePopulateData">
 <input type="hidden" name="settingWebStoreName" value="Snow World Mumbai" id="settingWebStoreName">
 <input type="hidden" name="webStoreNameText" value="#ffffff" id="WebStoreNameText">
 <input type="hidden" name="currency" value="INR" id="orderCurrency">
 <input type="hidden" name="settingBillingInformation" value="Y" id="billingInformation">
 <input type="hidden" name="settingFeeCharged" value="merchant" id="settingFeeCharged">
 <input type="hidden" name="netAmt" value="600.0" id="netAmt">
 <input type="hidden" name="invoiceDiscountValue" value="0.0" id="invoiceDiscountValue">
 <input type="hidden" name="command" value="getMerchantInformation" id="command">
 <input type="hidden" name="settingSeamlessIntegration" value="N" id="seamlessIntegration">
 <input type="hidden" name="trackingId" value="107491307354" id="trackingId">
 <input type="hidden" name="device" value="PC" id="device">
 <input type="hidden" name="osGroup" value="Windows" id="osGroup">
 <input type="hidden" name="settingShippingInformation" value="N" id="settingShippingInformation">
 <input type="hidden" name="settingNotes" value="N" id="settingNotes">
 <input type="hidden" name="issuingBank" value="" id="issuingBank">
 <input type="hidden" name="dataAcceptedAt" value="CCAvenue" id="dataAcceptedAt">
 <input type="hidden" name="promoCode" value="" id="promoCode">
 <input type="hidden" name="merchantParam1" value="" id="merchantParam1">
 <input type="hidden" name="userName" value="" id="userName">
 <input type="hidden" name="userPassword" value="" id="userPassword">
 <input type="hidden" name="customerAddressId" value="0" id="customerAddressId"> 
 <input type="hidden" name="settingOneClick" value="Y" id="settingOneClick"> 
 <input type="hidden" name="orderType" value="OT-ORD" id="orderType">
 <input type="hidden" name="settingEnableMinInvAmt" value="" id="settingEnableMinInvAmt">
 <input type="hidden" name="settingEnableEditInvAmt" value="" id="settingEnableEditInvAmt">
 <input type="hidden" name="minInvoiceAmt" value="0.0" id="minInvoiceAmt">
 <input type="hidden" name="settingGtwIntegration" value="" id="settingGtwIntegration">
 <input type="hidden" name="otp" value="" id="otp">
 <input type="hidden" name="mobileNumber" value="" id="mobileNumber">
 <input type="hidden" name="siTransaction" value="false" id="siTransaction">
 <input type="hidden" name="nonSiTransaction" value="Y" id="nonSiTransaction">
 <input type="hidden" name="isSIAllow" value="N" id="isSIAllow">
  <input type="hidden" name="tcMisc" value="" id="tcMisc">
  <input type="hidden" name="dccFlag" value="N" id="dccFlag">
 <input type="hidden" name="coupenApplied" id="coupenApplied"/>
  
 <input type="hidden" id="saveAddress" name="saveAddress"/>
 <input type="hidden" id="saveBillingAddress" name="saveBillingAddress"/>
 <input type="hidden" name="accountOtp" value="N" id="accountOtp">
 <input type="hidden" name="settingMerCardBinCheck" value="N" id="settingMerCardBinCheck">
 
	 <div id="banner" class="row-fluid">
	    <div class="span12 header-bg">
	        <img class="imageHeader" src="https://dashboard.ccavenue.com/ImgStore/Images/49646_LNF_Head_Img_1505158862425.png" border="0"/>
	    </div>
	 </div>
 
 
 <!-- Logo/Banner Panel Ends -->
<div class="container-fluid content-bg content-text" id="mainDiv">
<!-- Link Panel Starts (Mobile Version) -->
    <div class="row-fluid content-bg visible-phone">
		<div class="span12 phone-links">
			
			
		</div>
    </div>
<!-- Link Panel Ends (Mobile Version) -->   
 <!-- Order Info Panel Starts -->
    
    
    
  		  <div  class="billingPage">
    	 </div>
    
    
    
<!-- Order Info Panel Ends -->
<!-- ********* Body Panel Starts ********* -->
<div class="row-fluid content-bg body-panel">
		
	<!-- ********* Language Dropdown Starts ********* -->
		
	    
		<div class="span12 content-bg multilingual">
			<select name="pagelanguage" class="select-language radius"><option value="en" selected="selected">English</option>
				<option value="hi">हिंदी</option>
				<option value="gu">ગુજરાતી</option>
				<option value="mr">मराठी</option>
				<option value="bn">বাঙালি</option>
				<option value="kn">ಕನ್ನಡ</option>
				<option value="pa">ਪੰਜਾਬੀ ਦੇ</option>
				<option value="ta">தமிழ்</option>
				<option value="te">తెలుగు</option>
				<option value="es">español</option>
				<option value="fr">français</option>
				<option value="de">Deutsch</option>
				<option value="it">italiano</option>
				<option value="pt">português</option>
				<option value="ja">日本人</option>
				<option value="zhCN">中国の簡体字</option>
				<option value="zhTW">繁体字中国語</option></select>
		</div>
		
		
		<!-- ********* Language Dropdown Ends ********* -->	
<!-- ********* Body Right Panel Starts ********* -->
<div class="overlay">
	<span class="wait-box"><img src="images/loading.gif" /><br />Your request is being processed.<br /><a href="#" class="intent-off">close</a></span>
</div>
        <div id="rightpanel" class="span4 content-bg pull-right">
        	
        	<!-- Order Total Starts -->
            <div id="ordertotal" class="span12 border innerpanel-bg innerpanel-text pull-right">
            <div class="span12 innerpanel-text order-details-title hidden-phone">Order Details</div>
			<div class="span12 innerpanel-text order-details-title visible-phone"><span class="orderTotal">INR&nbsp;600.00</span><a href="#" class="primary-link pull-right view-breakup">View Breakup</a></div>
			<div class="span12 innerpanel-text order-no"><span class="pull-left">Order&nbsp;#:</span>Snow_7824
			</div>
			
			
			
			
			
			
			
			
			
			<div class="breakup-panel span12">
				<div class="span12 divider pull-right"></div>
				<div class="span8 innerpanel-text ">
				
	            	Order
				
					
				&nbsp;Amount
				  </div>
				<div class="span4 innerpanel-text pull-right" id="orderAmt" align="right">
					600.0
				</div>
				<div class="span8 innerpanel-text discountText" style="display: none">
					 Discount
				</div>
				<div class="span4 innerpanel-text pull-right highlight-text discountText" style="display: none" align="right" id="discountAmt">
					0.0 <!-- 0.00  for multilingual-->
				</div>
				<div class="span8 innerpanel-text emidiscount emidiscountText" style="display: none;">
					EMI Discount
				</div>
				<div class="span4 innerpanel-text pull-right highlight-text emidiscount emidiscountText"  align="right" id="emidiscountText" style="display: none;">
				</div>
				
				
				
				
				
				
				
				<div class="span12 divider pull-right"></div>
				<div id="grandtotal" class="span12">
					<div class="span6 innerpanel-text ">Total Amount</div>
					<div class="span6 innerpanel-text pull-right orderTotal" id="finalTotal" align="right">INR&nbsp;600.00</div>
				</div>
				
					<div class="span12 innerpanel-text" style="display: none;" id="cashBackLabel">Cash back of INR&nbsp;<label id="cashBackValue">0.00</label>&nbsp;applies.</div>
					<div class="span12 innerpanel-text " style="display: none;" id="hdfcsurchargelabel">Internet handling fee of INR.<label id="hdfcsurchargefees"></label> will be added to the transaction amount.</div>
					<div class="span12 innerpanel-text " style="display: none;" id="hdfcsurchargelabelzero">No convenience fee or service charge is payable by the customer on Debit card / UPI transactions.</div>
					<div class="span12 innerpanel-text error" style="display: none; color:#b1111b;" id="promoError"></div>
				</div>
			</div>
			
			<!-- Login Screen Starts -->
		   
		   
           <div id="loginscreen" class="span12 content-bg border login-screen hidden-phone">
			<div class="span12 ccavenue-checkout-title border">&nbsp;</div>
			<div class="span12 login-form content-bg">
			<div class="span12 content-text title" align="left">
				<b>Checkout login for registered users only.</b>
			</div>
		   		<div class="span12">
					<span class="span12 content-text ie-visible" style="margin-top:0 !important;">Enter Username</span>
			 			<input class="span12 textfield noradius" placeholder='Enter Username' type="text" id="loginUser" name="loginUser" autocomplete="off"/>
		   		 </div>
		  		 <div class="span12 passwordfield">
			 	 	<span class="span12 content-text ie-visible" style="margin-top:0 !important;">Enter Password</span>
			  		 <input class="span12 textfield noradius" placeholder='Enter Password' type="password" id="loginPassword" name="loginPassword"/>
			  		 <span class="span12 error loginPassWordError"></span>
		   		</div>
		   		<div class="span6">
					<a href="#" class="primary-link" id="forgotPwd">Forgot Password?</a>
				</div>
		  		<div id="loginbtns" class="span6" align="right">
			 	<a href="#" class="primary-button primary-button-bg primary-button-border primary-button-border-hover" title="Login" id="userLogin"><span class="primary-button-text">Login</span></a>
				<span class="visible-phone">&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#checkoutbtn" id="cancelUserLogin" class="primary-button primary-button-bg primary-button-border primary-button-border-hover cancel-login" title="Cancel"><span class="primary-button-text">Cancel</span></a>
			</span>
		   </div>
			<div id="forgot_password_div" class="span12" style="display:none;">
			<span class="span12 innerpanel-bg innerpanel-text border">Reset password  email has been sent to your registered email ID.</span>
		   </div>
	  </div>
	</div>
			<!-- Login Screen Starts -->
			<div id="logged-in-screen" class="span12 content-bg border hidden-phone login-screen" style="display: none">
				<div class="span12 ccavenue-checkout-title border">&nbsp;</div>
    			<div class="span12 login-form content-bg">
					<div class="span12 welcome-msg content-text">
						<span class="customer-name">Welcome! <span class="highlight-text loginName"></span></span>
						<span class="message">Please review your details on the left and simply press "Make Payment" to proceed with the easy CCAvenue Checkout</span>
					</div>
					<div id="loginbtns" class="span12">
						<a href="#" class="primary-button primary-button-bg primary-button-border primary-button-border-hover" title="Logout & Pay as Guest" id="logoutCustomer"><span class="primary-button-text">Logout and Pay as Guest</span></a>
					</div>
				</div>
		</div> 
			<!-- Login Screen Ends -->
			
			
			
			<!-- Login Screen Ends --> 
		</div>
		<!-- ********* Body Right Panel Ends ********* -->
		<!-- ********* Body Left Panel Starts ********* -->
        <div class="span8 content-bg body-left-panel">
        
            <!-- Table Heading Starts -->    
             
	      	  <div id="sectionheading" class="span12 heading-bg radius4 billHeadDiv">
	      	   
	          	
	          	 <span class="heading-text">Billing Information</span>
	          	
	         	 <span class="pull-right edit editIcon" style="display: none"><a href="#" class="icon-edit icon-edit-black heading-bg edit-billing">&nbsp;</a></span>
			   	<span class="pull-right stripe content-bg editIcon" style="display: none"></span>
	      	  </div>
	         
	       
	         
            <!-- Table Heading Ends -->
            <!-- Billing Panel Starts --> 
            
            <div id="billing_form" class="span12 content-bg editPrePopulatedData billDetailDiv">
	             <div class="span12 billing-edit-form">
	              <!-- Edit Billing Address Forms Starts -->
	              <div class="span12">
	               	  <span class="span12 content-text ie-visible" style="margin-top:0 !important;">Billing Name</span>
	                  <input type="text" name="billName" value="ghfgh gg" id="orderBillName" style="margin-top:0 !important;" class="span12 textfield noradius">
	                  <label class="span12 error"></label>
	               </div>
	               <div class="span12">
	               	  <span class="span12 content-text ie-visible">Address</span>
	                  <input type="text" name="billAddress" value="ghfhfghfg" id="orderBillAddress" class="span12 textfield noradius">
	                  <label class="span12 error"></label>
	               </div>
	                 <div class="span6">
	               	  <span class="span6 content-text ie-visible">Zip Code</span>
	                  <input type="text" name="billZip" value="677" id="orderBillZip" class="span12 textfield noradius">
	                  <span class="visible-phone"><label class="error" for="orderBillZip" generated="true"></label></span>
	               </div>
	               <div class="span6 pull-right">
	               <span class="span6 content-text ie-visible">City</span>
	                  <input type="text" name="billCity" value="Nagpur" id="orderBillCity" class="span12 textfield noradius">
	                  <span class="visible-phone"><label class="error" for="orderBillCity" generated="true"></label></span>
	               </div>
	               <div class="span12 hidden-phone">
	                  <span class="span6"><label class="error" for="orderBillZip" generated="true"></label></span>
	                  <span class="span6 pull-right"><label class="error" for="orderBillCity" generated="true"></label></span>
	               </div>
	              <div class="span6">
	               	  <span class="span6 content-text ie-visible">State</span>
	                  <input type="text" name="billState" value="Maharashtra" id="orderBillState" class="span12 textfield noradius">
	                  <span class="visible-phone"><label class="error" for="orderBillState" generated="true"></label></span>
	               </div>
	               <div class="span6 pull-right">
	               	  <span class="span6 content-text ie-visible">Country</span>
	                  <select name="billCountry" id="orderBillCountry" class="span12 radius country"><option value="">Select Country</option>
	                     <option value="Afghanistan">Afghanistan</option>
<option value="Aland Islands">Aland Islands</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antarctica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Islands">Cocos Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote dIvoire">Cote dIvoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curacao">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guernsey">Guernsey</option>
<option value="Guinea">Guinea</option>
<option value="Guinea Bissau">Guinea Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
<option value="Vatican City">Vatican City</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India" selected="selected">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jersey">Jersey</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="North Korea">North Korea</option>
<option value="South Korea">South Korea</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macao">Macao</option>
<option value="Republic of Macedonia">Republic of Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Federated States of Micronesia">Federated States of Micronesia</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russian Federation">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Barthelemy">Saint Barthelemy</option>
<option value="Saint Helena">Saint Helena</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Martin">Saint Martin</option>
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Sint Maarten Dutch part">Sint Maarten Dutch part</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
<option value="South Sudan">South Sudan</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="East Timor">East Timor</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="VietNam">VietNam</option>
<option value="British Virgin Islands">British Virgin Islands</option>
<option value="United States Virgin Islands">United States Virgin Islands</option>
<option value="Wallis and Futuna">Wallis and Futuna</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option></select>
	                  <span class="visible-phone"><label class="error" for="orderBillCountry" generated="true"></label></span>
	               </div>
	               <div class="span12 hidden-phone">
	                  <span class="span6"><label class="error" for="orderBillState" generated="true"></label></span>
	                  <span class="span6 pull-right"><label class="error" for="orderBillCountry" generated="true"></label></span>
	               </div>
	               <div class="span6">
	               	  <span class="span6 content-text ie-visible">Phone Number</span>
	                  <input type="text" name="billTel" maxlength="22" value="2456789765" id="orderBillTel" class="span12 textfield noradius">
	                  <span class="visible-phone"><label class="error" for="orderBillTel" generated="true"></label></span>
	               </div>
	               <div class="span6 pull-right">
	               	  <span class="span6 content-text ie-visible">Email</span>
	                  <input type="text" name="billEmail" maxlength="70" value="hjghfh@hjgvhj.hgjh" id="orderBillEmail" class="span12 textfield noradius">
	                  <span class="visible-phone"><label class="error" for="orderBillEmail" generated="true"></label></span>                        
	               </div>
	               <div class="span12 hidden-phone">
	                  <span class="span6"><label class="error" for="orderBillTel" generated="true"></label></span>
	                  <span class="span6 pull-right"><label class="error" for="orderBillEmail" generated="true"></label></span>
	               </div>
	               
	             </div>
	             <!-- Edit Billing Address Forms Ends -->
	            <!-- Pre-populated Billing Panel Starts --> 
				<!-- Billing address starts -->
				<div class="span12 content-bg billing-pre-populate">
					
 				</div>
				 <!-- Billing address Ends -->
				 <!-- Pre-populated Billing Panel Ends -->
				</div>
			
            <!-- Billing Panel Ends -->
             <!-- Shipping Address Same Check Starts -->
            <label id="billEmailLabel" style="display:none;">hjghfh@hjgvhj.hgjh</label>
            
					<!-- Shipping Forms Ends -->
			
			
			  <div id="check_address" class="span12 content-bg">
			  </div>
			  
			
			<!-- Shipping Panel Ends -->
			<div class="content-bg span12 visible-phone">&nbsp;</div>
			
				
			<!-- Promotions and Offers Panel Ends -->           
			<!-- Payment Information Panel Starts -->
            <div id="sectionheading" class="span12 heading-bg radius4 noradius-bottomleft noradius-bottomright payInfoDiv">
				<span class="heading-text">Payment Information</span>
			</div>
			<!-- Added Payment Options Panel Starts --> 
 				<div class="span12 prepopulate-payment-option">
				 <!-- Table Heading Starts -->    
 			    
			  </div>
	<!-- Added Payment Options Panel Ends -->
            <!-- Payment Information Panel Starts --> 
			<div class="span12 border select-payment icon-arrow-black paymentinformation">
				<div id="verticalTab" class="paymentinformation">
					<ul class="resp-tabs-list span3">
					
					
						<li>
						    <div id="OPTCRDC">
       							<span class="content-text content-bg border right-arrow down-arrow paymentOption">Credit Card<span class="patch content-bg"></span></span>
								<span class="innerpanel-text innerpanel-bg border right-arrow paymentOption">Credit Card</span>
							</div>
						</li>
					
					
				    
					
					
					
                    
					
					
					
					
					
				   
					
					
						<li>
							<div id="OPTDBCRD">
								<span class="content-text content-bg border right-arrow down-arrow paymentOption">Debit Cards<span class="patch content-bg"></span></span>
								<span class="innerpanel-text innerpanel-bg border right-arrow paymentOption">Debit Cards</span>
							</div>
						</li>
					
				    
					
					
					
                    
					
					
					
					
					
				   
					
					
				    
						<li>
							<div id="OPTNBK">
							<span class="content-text content-bg border right-arrow down-arrow paymentOption">Net Banking<span class="patch content-bg"></span></span>
							<span class="innerpanel-text innerpanel-bg border right-arrow paymentOption">Net Banking</span>
							</div>
						</li>
					
					
					
					
                    
					
					
					
					
					
				   
					
					
				    
					
						<li>
							<div id="OPTCASHC">
								<span class="content-text content-bg border right-arrow down-arrow paymentOption">Cash Card<span class="patch content-bg"></span></span>
								<span class="innerpanel-text innerpanel-bg border right-arrow paymentOption">Cash Card</span>
							</div>
						</li>
					
					
					
                    
					
					
					
					
					
				   
					
					
				    
					
					
					
					 
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                        	
                     
                    
                    
					
						<li class="walletoptions">
							<div id="OPTWLT">
								<span class="content-text content-bg border right-arrow down-arrow paymentOption walletoptions">Wallet<span class="patch content-bg"></span></span>
								<span class="innerpanel-text innerpanel-bg border right-arrow paymentOption walletoptions">Wallet</span>
							</div>
						</li>
					
					
					
					
					
				   
					
					
				    
					
					
					
                    
					
					
					
						<li>
							<div id="OPTUPI">
								<span class="content-text content-bg border right-arrow down-arrow paymentOption">UPI<span class="patch content-bg"></span></span>
								<span class="innerpanel-text innerpanel-bg border right-arrow paymentOption">UPI</span>
							</div>
						</li>
					
					
					
				   
					  
					</ul>
					<div class="resp-tabs-container content-bg border span9">
					
						  
							<div class="tabcontent OPTCRDC">         
            <div id="creditcard_form" class="span12">
                <!-- Credit Card Forms Starts -->
                <div class="span12 creditCardData creditCardNumber">
                	<span class="span12 content-text formText" style="margin-top:0 !important;">Card Number</span>
                	<div class="span12 creditcards">
                    	<input class="span12 textfield noradius creditcard cardNumberC onlynumbers" type="tel" pattern="[0-9]*" name="creditCardNumber" id="creditCardNumber" maxlength="19" autocomplete="off">
                    	<label class="error promobinmessage"></label>
                    	<label class="error crditCardError"></label>
                    	<label class="error fluctuateError"></label>
                    	<span class="span12 cards">
                    	    
								<span class="MasterCard ACTI N" id="">&nbsp;</span>
							
								<span class="Amex ACTI N" id="">&nbsp;</span>
							
								<span class="Visa ACTI N" id="">&nbsp;</span>
							
						</span>
                    </div>
                    <label class="span12  error"></label>
                </div>
                <div class="span6 creditCardData expiry-date-col">
                	<span class="span12 content-text formText">Expiry Date</span>
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
							<option  value="">Year</option>
							
									<option value='2018'>2018</option>
									
									<option value='2019'>2019</option>
									
									<option value='2020'>2020</option>
									
									<option value='2021'>2021</option>
									
									<option value='2022'>2022</option>
									
									<option value='2023'>2023</option>
									
									<option value='2024'>2024</option>
									
									<option value='2025'>2025</option>
									
									<option value='2026'>2026</option>
									
									<option value='2027'>2027</option>
									
									<option value='2028'>2028</option>
									
									<option value='2029'>2029</option>
									
									<option value='2030'>2030</option>
									
									<option value='2031'>2031</option>
									
									<option value='2032'>2032</option>
									
									<option value='2033'>2033</option>
									
									<option value='2034'>2034</option>
									
									<option value='2035'>2035</option>
									
									<option value='2036'>2036</option>
									
									<option value='2037'>2037</option>
									
									<option value='2038'>2038</option>
									
									<option value='2039'>2039</option>
									
									<option value='2040'>2040</option>
									
									<option value='2041'>2041</option>
									
									<option value='2042'>2042</option>
									
									<option value='2043'>2043</option>
									
									<option value='2044'>2044</option>
									
									<option value='2045'>2045</option>
									
									<option value='2046'>2046</option>
									
									<option value='2047'>2047</option>
									
									<option value='2048'>2048</option>
									
									<option value='2049'>2049</option>
									
									<option value='2050'>2050</option>
									
									<option value='2051'>2051</option>
									
									<option value='2052'>2052</option>
									
									<option value='2053'>2053</option>
									
									<option value='2054'>2054</option>
									
									<option value='2055'>2055</option>
									
									<option value='2056'>2056</option>
									
									<option value='2057'>2057</option>
									
									<option value='2058'>2058</option>
									
									<option value='2059'>2059</option>
									
									<option value='2060'>2060</option>
									
									<option value='2061'>2061</option>
									
									<option value='2062'>2062</option>
									
									<option value='2063'>2063</option>
									
									<option value='2064'>2064</option>
									
									<option value='2065'>2065</option>
									
									<option value='2066'>2066</option>
									
									<option value='2067'>2067</option>
									
						</select>
                        <label id="currentMonth" style="display: none;">11</label>
					</span>
					<span class="span12 error">
                        <label for="creditCardDate" generated="true" class="error"></label>
                    </span>
                </div>
                <div class="span6 creditCardData cvv-number-col">
                	<span class="span12 content-text"><span class="hidden-phone hidden-tablet">&nbsp;&nbsp;&nbsp;</span>CVV</span>
					<span class="span12 cvv_number">
						<span class="hidden-phone hidden-tablet">&nbsp;&nbsp;</span><input class="noradius textfield-55x25 cvvnumber onlynumbers" id="CVVNumberCreditCard" name="CVVNumberCreditCard" pattern="[0-9]*" type="tel" maxlength="3" autocomplete="off"/>
                           <span class="cvv">                           
	                            <div class="tip-content radius6">	                            
	                                <span class="Visa MasterCard Diners"><strong>Visa/Mastercard/Diners</strong><br />
									Verification number is the last 3 digits on signature panel on the back of your card.</span>
									
									<span class="Amex" style="display:none;"><strong>American Express</strong><br />
									Verification number is the 4 digit number at the top right hand side on the front of your card.</span>
									
									<span class="JCB" style="display:none;"><strong>JCB</strong><br />
									Verification number is the 4 digit number at the bottom left hand side on the front of your card.</span>									
	                            </div>
								<span class="arrow"></span>
							</span>
					</span>
					<span class="span12 error"> 
                       <label for="CVVNumberCreditCard" generated="true" class="error"></label>
                    </span>
                </div>
				<!-- <div class="span12 creditCardData">
                	<span class="span12 content-text formText issuingbank">Name of the Issuing Bank</span>
                	<span class="span12 content-text formText Amex" style="display: none">Card Issuing Country</span>
                    <input class="span12 textfield noradius issuingBankName" type="text" id="issuingBankNameCreditCard" name="issuingBank" autocomplete="off">
                    <span class="span12 error"><label class="error"></label></span>
                </div> -->
              
              
					<div id="savecard" class="span12 creditCardData savecustomerCard">
						<span class="span12 content-text border radius">
							<span class="span1"><input type="checkbox" class="register-new" name="saveCard"></span>
							<span class="span11 content-text note">
								Save your cards with CCAvenue Checkout for future payments <span class="border what-is-cvv innerpanel-bg innerpanel-text show-popup" data-showpopup="2">?</span><span class="span12">(Note: We do not store your CVV/CVC number.)</span>
							</span>
							<!-- New User Register Panel Starts Here  -->
							 
							    <span class="span12 new-user-register border removeUSerLogin">
								<!-- <span class="span12 small-text content-text removeUSerLogin">Make paying easy &amp; fast next time with a CCAvenue Checkout&nbsp;<span class="what-is-cvv border innerpanel-bg innerpanel-text">?</span></span>  -->
								<span class="span12 content-text userNameLabel removeUSerLogin">Email/Mobile</span>
								<input class="span12 textfield noradius userName removeUSerLogin" id="userNameCreditCard" name="userNameCreditCard" type="text" maxlength="70">
								<label for="userNameCreditCard" class="error user" generated="true"></label>
								<label class="error userNameError removeUSerLogin"></label>
								<span class="span12 removeUSerLogin"></span>
								<span class="span12 content-text password removeUSerLogin">Password</span>
								 <input class="span12 textfield noradius passWord removeUSerLogin" name="passWordCreditCard" id="passWordCreditCard" type="password" maxlength="22">
								 <label for="passWordCreditCard" class="error passwordError" generated="true"></label>
							    </span>
							
							<!-- New User Register Panel Ends Here -->
						<!--</span>	 -->		
					</div>
				
				
				
					
				
					<!-- for dcc integration -->
					
				<div class="span12 dcc border innerpanel-bg innerpanel-text radius6" align="left" id="p" style="display:none;">
					<div id="loadingdcc" class="innerpanel-bg"><span class="box"><img src="images/connecting.gif" border="0" alt=""><br />Connecting...</span></div>
					<div class="dcc-currency" style="display:none;">
						<span class="span12 title">Choose Payment Currency</span>
						<span class="span6 content-bg content-text border marginR">
							<span class="span12">
								<input type="radio" name="PaymentCurr" id="orignalCurr" class="radio" property="PaymentCurr" value="" checked="checked" /><br />
								<strong class="orderTotal">INR&nbsp;600.00</strong>
							</span>
							(exchange rate will be set at a later date by your card provider)
						</span>
						<span class="span6 content-bg content-text border">
							<span class="span12"><input type="radio" name="PaymentCurr" id="dccCurr" class="radio" property="PaymentCurr" value="" /><br /><strong><label id="dccForeignCurrency"></label>:</strong><label id="dccForeignAmount"></label></span>
							(exchange rate: 1 INR</strong> = <label id="dccExchangeRate"></label> <label id="dccForeignCurrency"></label> - includes a currency fee of 3%)
						</span>
					</div>
                </div>
				
				<div class="span12 amex-eze-click" >				
					<div class="span12 orpay-text content-text creditCardData">Or Pay By</div>			
					<div class="span12 border amex-logo">				
						<input type="checkbox" name="payByAmex" id="payByAmex" value="option1" class="radio">&nbsp;
					</div>
					<label class="error  downError"></label>
				</div>
				
				
				<div class="span12" style="margin:0;"><br />
						I agree with the <a href="https://www.ccavenue.com/privacy_policy_customers.jsp" class="primary-link" target="_blank" title="Privacy Policy">Privacy Policy</a> by proceeding with this payment. 
				</div>
				
				<div id="amount" class="span12">
                	<span class="span12 content-text formText"><strong class="orderTotal highlight-text"></strong>&nbsp;&nbsp;(Total Amount Payable)</span>
                </div>
				<div id="buttons" class="span12 buttonsCredit">
					<a href="javascript:void(0)" class="primary-button primary-button-bg primary-button-border btn-pay" style="display: none;"><span class="primary-button-text">Make Payment</span></a>
                	<a href="#" class="primary-button primary-button-bg primary-button-border SubmitBillShip SubmitBillCredit" id="SubmitBillShip"><span class="primary-button-text">Make Payment</span></a>
                	&nbsp;&nbsp;&nbsp;<a href="#"  class="primary-button primary-button-bg primary-button-border cancel"><span class="primary-button-text">Cancel</span></a>
                </div>
			</div>

</div>
						  
						  
						  
						  
						   
						
						
						 
						 
						
						
						
					
						  
						  
							<div class="tabcontent OPTDBCRD">            
            <div id="creditcard_form" class="span12">
                <div class="span12 debitcarddropdown">
                	<span class="span12 content-text formText" style="margin-top:0 !important;">We Accept</span>
                    <select name="debitCard" class="span12 noradius debitCard payoptselect" id="debitCard">
                      <option value="">Select Debit Card </option>
                         
                          
                          
                        <option style="display: none" id="" value="MasterCard Debit Card" class="CCAvenue ACTI  N" >MasterCard Debit Card</option>    	
                           
                           
                        
                          
                          
							
                         <option id="" value="Suryoday Small Finance Bank Ltd" class="CCAvenue ACTI nocvv N" >Suryoday Small Finance Bank Ltd</option>
                            
                           
                        
                          
                          
							
                         <option id="" value="Syndicate Bank" class="CCAvenue ACTI nocvv N" >Syndicate Bank</option>
                            
                           
                        
                          
                          
							
                         <option id="" value="Andhra Bank" class="Service Provider ACTI  N" >Andhra Bank</option>
                            
                           
                        
                          
                          
							
                         <option id="" value="Citibank" class="Service Provider ACTI  N" >Citibank</option>
                            
                           
                        
                          
                          
							
                         <option id="" value="IOB Debit card" class="Service Provider ACTI  N" >IOB Debit card</option>
                            
                           
                        
                          
                          
							
                         <option id="" value="IDFC Debit Card" class="Service Provider ACTI  N" >IDFC Debit Card</option>
                            
                           
                        
                          
                          
                        <option style="display: none" id="" value="Maestro Debit Card" class="CCAvenue ACTI  N" >Maestro Debit Card</option>    	
                           
                           
                        
                          
                          
                        <option style="display: none" id="" value="RuPay" class="CCAvenue ACTI  N" >RuPay</option>    	
                           
                           
                        
                          
                          
							
                         <option id="" value="State Bank of India" class="CCAvenue ACTI  N" >State Bank of India</option>
                            
                           
                        
                          
                          
                        <option style="display: none" id="" value="Visa Debit Card" class="CCAvenue ACTI  N" >Visa Debit Card</option>    	
                           
                           
                        
                    </select>
                    <label for="debitCard" generated="true" class="error"></label><label class="error downError"></label><label class="error fluctuateError"></label>
                    <span class="span12 content-text"><span class="small-text formText"></span></span>
                </div>
                <div class="span12 debitCardData" id="cardNumberDebit">
                	<span class="span12 content-text formText">Card Number</span>
                    <div class="span12 debitcards">
	                    <input class="span12 textfield noradius debitCard cardNumberC onlynumbers" type="tel"  name="debitCardNumber" id="debitCardNumber" maxlength="19" pattern="[0-9]*" autocomplete="off">
	                    <span class="span12 debitcards">
	                    	    
									<span class="MasterCard Debit Card N">&nbsp;</span>
								
									<span class="Suryoday Small Finance Bank Ltd N">&nbsp;</span>
								
									<span class="Syndicate Bank N">&nbsp;</span>
								
									<span class="Andhra Bank N">&nbsp;</span>
								
									<span class="Citibank N">&nbsp;</span>
								
									<span class="IOB Debit card N">&nbsp;</span>
								
									<span class="IDFC Debit Card N">&nbsp;</span>
								
									<span class="Maestro Debit Card N">&nbsp;</span>
								
									<span class="RuPay N">&nbsp;</span>
								
									<span class="State Bank of India N">&nbsp;</span>
								
									<span class="Visa Debit Card N">&nbsp;</span>
								
						</span>
						<label class="error debitCardDownError downError" style="display: none;"></label><label class="error debitCardFluctuateError fluctuateError" style="display: none;"></label>
	                    <label class="promobinmessage" style="color: #cc3333; font-size:11px; font-weight:bold;"></label>
                    </div>
                    <label class="error debitCardError"><br/></label>
                </div>
                <div class="span6 maestro debitCardData expiry-date-col" style="display: none">
                	<span class="span12 content-text formText">Expiry Date</span>
					<span class="span12">
						<select class="select-90x25 noradius expiryMonth payoptselect" id="expiryMonthDebitCard" name="expiryMonthDebitCard">
							<option value="">Month</option>
							<option value="01">Jan (01)</option>
							<option value="02">Feb (02)</option>
							<option value="03">Mar(03)</option>
							<option value="04">Apr (04)</option>
                            <option value="05">May (05)</option>
                            <option value="06">June (06)</option>
                            <option value="07">July (07)</option>
                            <option value="08">Aug (08)</option>
                            <option value="09">Sep (09)</option>
                            <option value="10">Oct (10)</option>
                            <option value="11">Nov (11)</option>
                            <option value="12">Dec (12)</option>
						</select>&nbsp;&nbsp;
						<select class="select-90x25 noradius expiryYear payoptselect" id="expiryYearDebitCard" name="expiryYearDebitCard">
							<option  value="">Year</option>
							
									<option value='2018'>2018</option>
									
									<option value='2019'>2019</option>
									
									<option value='2020'>2020</option>
									
									<option value='2021'>2021</option>
									
									<option value='2022'>2022</option>
									
									<option value='2023'>2023</option>
									
									<option value='2024'>2024</option>
									
									<option value='2025'>2025</option>
									
									<option value='2026'>2026</option>
									
									<option value='2027'>2027</option>
									
									<option value='2028'>2028</option>
									
									<option value='2029'>2029</option>
									
									<option value='2030'>2030</option>
									
									<option value='2031'>2031</option>
									
									<option value='2032'>2032</option>
									
									<option value='2033'>2033</option>
									
									<option value='2034'>2034</option>
									
									<option value='2035'>2035</option>
									
									<option value='2036'>2036</option>
									
									<option value='2037'>2037</option>
									
									<option value='2038'>2038</option>
									
									<option value='2039'>2039</option>
									
									<option value='2040'>2040</option>
									
									<option value='2041'>2041</option>
									
									<option value='2042'>2042</option>
									
									<option value='2043'>2043</option>
									
									<option value='2044'>2044</option>
									
									<option value='2045'>2045</option>
									
									<option value='2046'>2046</option>
									
									<option value='2047'>2047</option>
									
									<option value='2048'>2048</option>
									
									<option value='2049'>2049</option>
									
									<option value='2050'>2050</option>
									
									<option value='2051'>2051</option>
									
									<option value='2052'>2052</option>
									
									<option value='2053'>2053</option>
									
									<option value='2054'>2054</option>
									
									<option value='2055'>2055</option>
									
									<option value='2056'>2056</option>
									
									<option value='2057'>2057</option>
									
									<option value='2058'>2058</option>
									
									<option value='2059'>2059</option>
									
									<option value='2060'>2060</option>
									
									<option value='2061'>2061</option>
									
									<option value='2062'>2062</option>
									
									<option value='2063'>2063</option>
									
									<option value='2064'>2064</option>
									
									<option value='2065'>2065</option>
									
									<option value='2066'>2066</option>
									
									<option value='2067'>2067</option>
									
						</select>
                        <label class="error" for="debitCardDate" generated="true"></label>
                   <label id="currentMonth" style="display: none;">11</label>
					</span>
					<span class="span12 error"></span>
                </div>
                <div class="span6 maestro debitCardData debitCardCvv cvv-number-col" style="display: none;">
                	<span class="span12 content-text formText"><span class="hidden-phone hidden-tablet">&nbsp;&nbsp;</span>CVV </span>
					<span class="span12 cvv_number">
						<span class="hidden-phone hidden-tablet">&nbsp;&nbsp;</span>
                           <input class="noradius textfield-55x25 cvvnumber onlynumbers" type="tel" pattern="[0-9]*" name="CVVNumberDebitCard" id="CVVNumberDebitCard" maxlength="4" autocomplete="off"/>
                           	<span class="cvv">                           
	                            <div class="tip-content radius6">	                            
	                                <span class="Visa MasterCard Diners"><strong>Visa/Mastercard/Diners</strong><br />
									Verification number is the last 3 digits on signature panel on the back of your card.</span>
									
									<span class="Amex" style="display:none;"><strong>American Express</strong><br />
									Verification number is the 4 digit number at the top right hand side on the front of your card.</span>
									
									<span class="jcb" style="display:none;"><strong>JCB</strong><br />
									Verification number is the 4 digit number at the bottom left hand side on the front of your card.</span>									
	                            </div>
								<span class="arrow"></span>
							</span>
					    </span>
					<span class="span12 error"><label for="CVVNumberDebitCard" generated="true" class="error"></label></span>
                </div>
				<!-- <div class="span12 debitCardData">
                	<span class="span12 content-text formText">Name of the Issuing Bank</span>
                    <input class="span12 textfield noradius issuingBankName" type="text" name="issuingBankDebitCard" id="issuingBankDebitCard" autocomplete="off"/>
                    <span class="span12 error"></span>
                </div> -->
                 
              	<div id="savecard" class="span12 savecustomerCard">
					<span class="span12 content-text border radius">
							<span class="span1"><input type="checkbox" class="register-new" name="saveCard"></span>
							<span class="span11 content-text note">
								Save your cards with CCAvenue Checkout for future payments <span class="what-is-cvv border innerpanel-bg innerpanel-text">?</span><span class="span12">(Note: We do not store your CVV/CVC number.)</span>
							</span>
							<!-- New User Register Panel Starts Here  -->
							 
							    <span class="span12 new-user-register border removeUSerLogin">
								<!-- <span class="span12 small-text content-text removeUSerLogin">Make paying easy &amp; fast next time with a CCAvenue Checkout&nbsp;<span class="what-is-cvv border innerpanel-bg innerpanel-text">?</span></span>  -->
								<span class="span12 content-text userNameLabel removeUSerLogin">Email/Mobile</span>
								<input class="span12 textfield noradius userName removeUSerLogin" id="userNameDebitCard" name="userNameDebitCard" type="text" maxlength="70">
								<label for="userNameDebitCard" class="error user" generated="true"></label>
								<label class="error userNameError removeUSerLogin"></label>
								<span class="span12 removeUSerLogin"></span>
								<span class="span12 content-text password removeUSerLogin">Password</span>
								 <input class="span12 textfield noradius passWord removeUSerLogin" name="passWordDebitCard" id="passWordDebitCard" type="password" maxlength="22">
								 <label for="passWordDebitCard" class="error passwordError" generated="true"></label>
							    </span>
							
							<!-- New User Register Panel Ends Here -->
					</span>			
				</div>
				
				
				<!-- SI Panel Starts Here  -->
				
				<!-- SI Panel Ends Here -->
			    
				
				<div class="span12" style="margin:0;"><br />
						I agree with the <a href="https://www.ccavenue.com/privacy_policy_customers.jsp" class="primary-link" target="_blank" title="Privacy Policy">Privacy Policy</a> by proceeding with this payment. 
				</div>
				<div id="amount" class="span12">
                	<span class="span12 content-text formText"><strong class="orderTotal highlight-text "></strong>&nbsp;&nbsp;(Total Amount Payable)</span>
                </div>
				<div id="buttons" class="span12 buttonsDebit">
					<a href="javascript:void(0)" class="primary-button primary-button-bg primary-button-border btn-payDebit" style="display: none;"><span class="primary-button-text">Make Payment</span></a>
					<a href="#" class="primary-button primary-button-bg primary-button-border SubmitBillShip SubmitBillDebit" id="SubmitBillShip"><span class="primary-button-text">Make Payment</span></a>
                	&nbsp;&nbsp;&nbsp;<a href="#"  class="primary-button primary-button-bg primary-button-border cancel"><span class="primary-button-text">Cancel</span></a>
                </div>
			</div>
</div>
						  
						  
						  
						   
						
						
						 
						 
						
						
						
					
						  
						  
						  
						 	 <div class="tabcontent OPTNBK">            <div id="creditcard_form" class="span12">
              <div class="span12 content-text popular-banks" style="margin-top:0 !important;">
			  
              
               
				<span class="span4 innerpanel-bg border radius6 topNetBank popularBanks State Bank of India">
					<input type="radio" name="topNetBankradio" class="radio topNetBank" id="State Bank of India"/>
				</span>
				
			  
               
				<span class="span4 innerpanel-bg border radius6 topNetBank popularBanks ICICI Bank">
					<input type="radio" name="topNetBankradio" class="radio topNetBank" id="ICICI Bank"/>
				</span>
				
			  
               
				<span class="span4 innerpanel-bg border radius6 topNetBank popularBanks HDFC Bank">
					<input type="radio" name="topNetBankradio" class="radio topNetBank" id="HDFC Bank"/>
				</span>
				
			  
               
				<span class="span4 innerpanel-bg border radius6 topNetBank popularBanks Citibank">
					<input type="radio" name="topNetBankradio" class="radio topNetBank" id="Citibank"/>
				</span>
				
			  
               
				<span class="span4 innerpanel-bg border radius6 topNetBank popularBanks Kotak Mahindra Bank">
					<input type="radio" name="topNetBankradio" class="radio topNetBank" id="Kotak Mahindra Bank"/>
				</span>
				
			  
               
				<span class="span4 innerpanel-bg border radius6 topNetBank popularBanks Axis Bank">
					<input type="radio" name="topNetBankradio" class="radio topNetBank" id="Axis Bank"/>
				</span>
				
			  
               
			  
               
			  
               
			  
               
			  
			  
		
	           </div>
                <div class="span12 all-other-banks">
                	<span class="span12 content-text formText" style="margin-top:0 !important;">All Other Banks</span>
                    <select name="netBankingBank" id="netBankingBank" class="span12 noradius payoptselect">
                     <option value="">Select Bank</option>
                        
                           <option id="" value="State Bank of India"  class="ACTI N" >State Bank of India</option>
                        
                           <option id="" value="ICICI Bank"  class="ACTI N" >ICICI Bank</option>
                        
                           <option id="" value="HDFC Bank"  class="ACTI N" >HDFC Bank</option>
                        
                           <option id="" value="Citibank"  class="ACTI N" >Citibank</option>
                        
                           <option id="" value="Kotak Mahindra Bank"  class="ACTI N" >Kotak Mahindra Bank</option>
                        
                           <option id="" value="Axis Bank"  class="ACTI N" >Axis Bank</option>
                        
                           <option id="" value="Aditya Birla Payments Bank"  class="ACTI N" >Aditya Birla Payments Bank</option>
                        
                           <option id="" value="Airtel Payments Bank"  class="ACTI N" >Airtel Payments Bank</option>
                        
                           <option id="" value="Allahabad Bank"  class="ACTI N" >Allahabad Bank</option>
                        
                           <option id="" value="Andhra Bank"  class="ACTI N" >Andhra Bank</option>
                        
                           <option id="" value="Bandhan Bank"  class="ACTI N" >Bandhan Bank</option>
                        
                           <option id="" value="Bank of Baharin and Kuwait"  class="ACTI N" >Bank of Baharin and Kuwait</option>
                        
                           <option id="" value="Bank of Baroda Corporate"  class="ACTI N" >Bank of Baroda Corporate</option>
                        
                           <option id="" value="Bank of Baroda Retail"  class="ACTI N" >Bank of Baroda Retail</option>
                        
                           <option id="" value="Bank of India"  class="ACTI N" >Bank of India</option>
                        
                           <option id="" value="Bank of Maharashtra"  class="ACTI N" >Bank of Maharashtra</option>
                        
                           <option id="" value="Canara Bank"  class="ACTI N" >Canara Bank</option>
                        
                           <option id="" value="Catholic Syrian Bank"  class="ACTI N" >Catholic Syrian Bank</option>
                        
                           <option id="" value="Central Bank of India"  class="ACTI N" >Central Bank of India</option>
                        
                           <option id="" value="City Union Bank"  class="ACTI N" >City Union Bank</option>
                        
                           <option id="" value="Corporation Bank"  class="ACTI N" >Corporation Bank</option>
                        
                           <option id="" value="Cosmos Bank"  class="ACTI N" >Cosmos Bank</option>
                        
                           <option id="" value="DBS Bank Ltd"  class="ACTI N" >DBS Bank Ltd</option>
                        
                           <option id="" value="DCB Bank"  class="ACTI N" >DCB Bank</option>
                        
                           <option id="" value="Deutsche Bank"  class="ACTI N" >Deutsche Bank</option>
                        
                           <option id="" value="Dhanlaxmi Bank"  class="ACTI N" >Dhanlaxmi Bank</option>
                        
                           <option id="" value="Federal Bank"  class="ACTI N" >Federal Bank</option>
                        
                           <option id="" value="IDBI Bank"  class="ACTI N" >IDBI Bank</option>
                        
                           <option id="" value="IDFC Bank"  class="ACTI N" >IDFC Bank</option>
                        
                           <option id="" value="Indian Bank"  class="ACTI N" >Indian Bank</option>
                        
                           <option id="" value="Indian Overseas Bank"  class="ACTI N" >Indian Overseas Bank</option>
                        
                           <option id="" value="IndusInd Bank"  class="ACTI N" >IndusInd Bank</option>
                        
                           <option id="" value="Jammu and kashmir Bank"  class="ACTI N" >Jammu and kashmir Bank</option>
                        
                           <option id="" value="JANATA SAHAKARI BANK LTD PUNE"  class="ACTI N" >JANATA SAHAKARI BANK LTD PUNE</option>
                        
                           <option id="" value="Karnataka Bank"  class="ACTI N" >Karnataka Bank</option>
                        
                           <option id="" value="Karur Vysya Bank"  class="ACTI N" >Karur Vysya Bank</option>
                        
                           <option id="" value="Lakshmi Vilas Bank"  class="ACTI N" >Lakshmi Vilas Bank</option>
                        
                           <option id="" value="Oriental Bank Of Commerce"  class="ACTI N" >Oriental Bank Of Commerce</option>
                        
                           <option id="" value="Punjab And Sind Bank"  class="ACTI N" >Punjab And Sind Bank</option>
                        
                           <option id="" value="Punjab National Bank [Corporate]"  class="ACTI N" >Punjab National Bank [Corporate]</option>
                        
                           <option id="" value="Punjab National Bank [Retail]"  class="ACTI N" >Punjab National Bank [Retail]</option>
                        
                           <option id="" value="RBL Bank"  class="ACTI N" >RBL Bank</option>
                        
                           <option id="" value="Saraswat Bank"  class="ACTI N" >Saraswat Bank</option>
                        
                           <option id="" value="Shamrao Vithal Bank"  class="ACTI N" >Shamrao Vithal Bank</option>
                        
                           <option id="" value="South Indian Bank"  class="ACTI N" >South Indian Bank</option>
                        
                           <option id="" value="Standard Chartered Bank"  class="ACTI N" >Standard Chartered Bank</option>
                        
                           <option id="" value="State Bank Of Bikaner and Jaipur"  class="ACTI N" >State Bank Of Bikaner and Jaipur</option>
                        
                           <option id="" value="State Bank Of Hyderabad"  class="ACTI N" >State Bank Of Hyderabad</option>
                        
                           <option id="" value="State Bank Of Mysore"  class="ACTI N" >State Bank Of Mysore</option>
                        
                           <option id="" value="State Bank of Patiala"  class="ACTI N" >State Bank of Patiala</option>
                        
                           <option id="" value="State Bank of Travancore"  class="ACTI N" >State Bank of Travancore</option>
                        
                           <option id="" value="Suryoday Small Finance Bank Ltd"  class="ACTI N" >Suryoday Small Finance Bank Ltd</option>
                        
                           <option id="" value="Syndicate Bank"  class="ACTI N" >Syndicate Bank</option>
                        
                           <option id="" value="Tamilnad Mercantile Bank"  class="ACTI N" >Tamilnad Mercantile Bank</option>
                        
                           <option id="" value="UCO Bank"  class="ACTI N" >UCO Bank</option>
                        
                           <option id="" value="Ujjivan Small Finance Bank"  class="ACTI N" >Ujjivan Small Finance Bank</option>
                        
                           <option id="" value="Union Bank of India"  class="ACTI N" >Union Bank of India</option>
                        
                           <option id="" value="United Bank of India"  class="ACTI N" >United Bank of India</option>
                        
                           <option id="" value="Vijaya Bank"  class="ACTI N" >Vijaya Bank</option>
                        
                           <option id="" value="YES Bank"  class="ACTI N" >YES Bank</option>
                        
                    </select>
                    <label for="netBankingBank" generated="true" class="error"></label><label class="error downError"></label><label class="error fluctuateError"></label>
                    <span class="span12 content-text"><span class="small-text formText"><strong>Note:</strong> We will redirect you to the bank you have chosen above. Once the bank verifies your net banking credentials, we will proceed with your payment.</span></span>
                </div>
              
				<div id="savecard" class="span12  savecustomerCard">
					<span class="span12 content-text border radius">
							<span class="span1"><input type="checkbox" class="register-new" name="saveCard"></span>
							<span class="span11 content-text note">
								Save your bank name with CCAvenue Checkout for future payments.
							</span><span class="span12"></span>
							<!-- New User Register Panel Starts Here  -->
							 
							    <span class="span12 new-user-register border removeUSerLogin">
								<span class="span12 content-text userNameLabel removeUSerLogin">Email/Mobile</span>
								<input class="span12 textfield noradius userName removeUSerLogin" id="userNameNetBank" name="userNameNetBank" type="text" maxlength="70">
								<label for="userNameNetBank" class="error user" generated="true"></label>
								<label class="error userNameError removeUSerLogin"></label>
								<span class="span12 removeUSerLogin"></span>
								<span class="span12 content-text password removeUSerLogin">Password</span>
								<input class="span12 textfield noradius passWord removeUSerLogin" name="passWordNetBank" id="passWordNetBank" type="password" maxlength="22">
								<label for="passWordNetBank" class="error passwordError" generated="true"></label>
							    </span>
							
					</span>			
				</div>
				
				
				
				
				
				<div class="span12" style="margin:0;"><br />
						I agree with the <a href="https://www.ccavenue.com/privacy_policy_customers.jsp" class="primary-link" target="_blank" title="Privacy Policy">Privacy Policy</a> by proceeding with this payment. 
				</div>
					
                <div id="amount" class="span12">
                	<span class="span12 content-text formText"><strong class="orderTotal highlight-text"></strong>&nbsp;&nbsp;(Total Amount Payable)</span>
                </div>
				<div id="buttons" class="span12">
                	<a href="#" class="primary-button primary-button-bg primary-button-border SubmitBillShip" id="SubmitBillShip"><span class="primary-button-text">Make Payment</span></a>&nbsp;&nbsp;&nbsp;
                	<a href="#"  class="primary-button primary-button-bg primary-button-border cancel"><span class="primary-button-text">Cancel</span></a>
                </div>
			</div>

</div>
						  
						  
						   
						
						
						 
						 
						
						
						
					
						  
						  
						  
						  
							<div class="tabcontent OPTCASHC">			<!-- Cash Card Panel Starts --> 
            <div id="creditcard_form" class="span12">
             <div class="span12 content-text popular-banks" style="margin-top:0 !important;">
			  
              
               
				<span class="span4 innerpanel-bg border radius6 topCashCard popularCashCards ITZ Cash Card">
					<input type="radio" name="topCashCardradio" class="radio topCashCard" id="ITZ Cash Card"/>
				</span>
				
			  
			  
	           </div>
            
                <!-- Cash Card Forms Starts -->
                
                <div class="span12 all-other-banks">
                	<span class="span12 content-text formText" style="margin-top:0 !important;">Pay By</span>
                    <select name="cashcard" class="span12 noradius payoptselect" id="cashcard">
                        <option value="">Select CashCard</option>
                        
                           <option id="" value="ITZ Cash Card" class="ACTI">ITZ Cash Card</option>
                        
                    </select>
                    <label for="cashcard" generated="true" class="error"></label><label class="error downError"></label><label class="error fluctuateError"></label>
                    <span class="span12 content-text"><span class="small-text"><strong>Note:</strong> You will be redirected to the service provider for verification & processing.</span></span>
                </div>
                
                <div class="span12" style="margin:0;"><br />
						I agree with the <a href="https://www.ccavenue.com/privacy_policy_customers.jsp" class="primary-link" target="_blank" title="Privacy Policy">Privacy Policy</a> by proceeding with this payment. 
				</div>
					
                <div id="amount" class="span12">
                	<span class="span12 content-text formText"><strong class="orderTotal highlight-text"></strong>&nbsp;&nbsp;(Total Amount Payable)</span>
                </div>
                
				<div id="buttons" class="span12">
                	<a href="#" class="primary-button primary-button-bg primary-button-border SubmitBillShip" id="SubmitBillShip"><span class="primary-button-text">Make Payment
</span></a>&nbsp;&nbsp;&nbsp;
                	<a href="#"  class="primary-button primary-button-bg primary-button-border cancel"><span class="primary-button-text">Cancel
</span></a>
                </div>
                                
                <!-- Cash Card Forms Ends -->

			</div>

           <!-- Cash Card Panel Ends --></div>
						  
						   
						
						
						 
						 
						
						
						
					
						  
						  
						  
						  
						   
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						 
							<div class="tabcontent OPTWLT"> <div id="creditcard_form" class="span12">
             	<div class="span12 content-text popular-banks" style="margin-top:0 !important;">
			 	  
             		 
               		 
               		  
						<span class="span4 innerpanel-bg border radius6 topWallet popularwallets jioMoney">
							<input type="radio" name="topWalletradio" class="radio topWallet" id="jioMoney"/>
						</span>
					
					 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
               		 
			 		 
			  	
	           </div>
                <div class="span12">
                	<span class="span12 content-text formText" style="margin-top:0 !important;">Select Wallet</span>
                    <select name="walletPaymentBank" class="span12 noradius payoptselect" id="walletPaymentBank">
                   		 <option value="">Select Wallet</option>
                       
                       
                         <option id="" value="jioMoney" class="ACTI ">jioMoney</option>
                       
                       
                       
                         <option id="" value="ICash Card" class="ACTI ">ICash Card</option>
                       
                       
                       
                         <option id="" value="ICICI Pockets" class="ACTI otp">ICICI Pockets</option>
                       
                       
                       
                         <option id="" value="Itz Cash Card" class="ACTI ">Itz Cash Card</option>
                       
                       
                       
                         <option id="" value="oxigen" class="ACTI ">oxigen</option>
                       
                       
                       
                         <option id="" value="PayCash Card" class="ACTI ">PayCash Card</option>
                       
                       
                       
                         <option id="" value="The Mobile Wallet" class="ACTI ">The Mobile Wallet</option>
                       
                       
                       
                         <option id="" value="Vodafone M-Pesa" class="ACTI ">Vodafone M-Pesa</option>
                       
                       
                       
                         <option id="UAE XCHANGE payment option is temporarily down. Please select another payment option." value="XPAY" class="DOWN ">XPAY</option>
                       
                       
                       
                         <option id="" value="YES Bank" class="ACTI otp">YES Bank</option>
                       
                       
                    </select>
                   <label for="walletPaymentBank" generated="true" class="error"></label><label class="downError error"></label><label class="error fluctuateError"></label>
                   <span class="span12 content-text"><span class="small-text formText"></span></span>
                </div>
                 <div class="span12 walletmobnumber wallet" style="display: none;">
                	<span class="span12 content-text formText">Mobile Number</span>
                    <input class="span12 textfield noradius onlynumbers" type="text" id="walletmobilenumber" name="walletmobilenumber" autocomplete="off" maxlength="10">
                    <img id="loadingwallet" alt="Loading" src="/images/loaderemi.png" align="middle" style="display: block;position: absolute;right: 2px;top: 29px"/>
                    <span class="span12 error walletMobileNumberError"><label for="walletmobilenumber" generated="true" class="error"></label></span>
                    <span class="span12 content-text"><span class="small-text">Your mobile number without dashes or space.</span></span>
                </div> 
                <div class="span12 walletotp wallet" id="otp"  style="display: none;">
					<span class="span12 paymentspanel-text">Enter OTP</span>
					<input class="span8 textfield element-bg element-text element-border noradius onlynumbers otpwalletpayment" name="otpwalletpayment" type="text" maxlength="6">&nbsp;&nbsp;<a href="#" class="primary-link clickable" title="Resend OTP" id="resendOTP">Resend OTP</a>
					<br/>
					<label for="otpwalletpayment" generated="true" class="error"></label>
					<span id="note" class="span12 paymentspanel-text"><span class="small-text"><strong>Note:</strong> Enter the OTP (One Time Password) sent on your registered mobile number to authenticate this transaction.</span></span>
			   </div>
			   
			   <div class="span12" style="margin:0;"><br />
						I agree with the <a href="https://www.ccavenue.com/privacy_policy_customers.jsp" class="primary-link" target="_blank" title="Privacy Policy">Privacy Policy</a> by proceeding with this payment. 
				</div>
					
                <div id="amount" class="span12">
                	<span class="span12 content-text formText"><strong class="orderTotal highlight-text"></strong>&nbsp;&nbsp;(Total Amount Payable)</span>
                </div>
                
				<div id="buttons" class="span12">
                	<a href="#" class="primary-button primary-button-bg primary-button-border SubmitBillShip" id="SubmitBillShip"><span class="primary-button-text">Make Payment</span></a>&nbsp;&nbsp;&nbsp;
                	<a href="#"  class="primary-button primary-button-bg primary-button-border cancel"><span class="primary-button-text">Cancel</span></a>
                </div>
			</div>
</div>
						
						 
						
						
						
					
						  
						  
						  
						  
						   
						
						
						 
						 
						
							<div class="tabcontent OPTCHKOT">
<div id="creditcard_form" class="span12 upi">
			<div class="span12 paybyvpa">
				<span class="span12 content-text" style="margin-top:0 !important;">Virtual Payment Address&nbsp;
					<span class="upi-date border innerpanel-bg innerpanel-text show-popup" data-showpopup="6">?</span>
				</span>
				<input type="text" name="virtualAddress" value="" id="virtualAddress" class="span12 textfield noradius">
				
					<label class="error downError"></label>
					<label class="error fluctuateError"></label>
					<label id="upiError" style="display: none;" class="ACTI"></label>
				
				<label for="virtualAddress" generated="true" class="error"></label>
				<span class="span12 content-text"><span class="small-text formText"><strong>Note:</strong>You will recieve a payment request from ccavenue in your UPI payment App. Kindly authorize and confirm the request to complete payment. </span></span>
			</div>
			   
			    
			<div class="span12 border orpayby paybyvpa"><span class="content-bg content-text">OR</span></div>
			<div class="span12 content-text byqrcode"><input type="checkbox" name="UPIQR" value="Y" id="UPIQR" class="radio">&nbsp;&nbsp;Pay by QR Code</div>
			  
			   
			    
				
			<div class="span12" style="margin:0;"><br />
						I agree with the <a href="https://www.ccavenue.com/privacy_policy_customers.jsp" class="primary-link" target="_blank" title="Privacy Policy">Privacy Policy</a> by proceeding with this payment. 
				</div>
			<div id="amount" class="span12">
				<span class="span12 content-text"><strong class="orderTotal highlight-text"></strong>&nbsp;&nbsp;(Total Amount Payable)</span>
			</div>
			<div id="buttons" class="span12">
			   	<a href="#" class="primary-button primary-button-bg primary-button-border SubmitBillShip" id="SubmitBillShip"><span class="primary-button-text">Make Payment</span></a>&nbsp;&nbsp;&nbsp;
			       <a href="#"  class="primary-button primary-button-bg primary-button-border cancel"><span class="primary-button-text">Cancel</span></a>
			</div>
		</div>
<!-- Net Banking Panel Ends --></div>
						
						
						
					
					
				  </div>
				</div>
			</div>
            <!-- Payment Information Panel Ends -->
        </div>
        <!-- ********* Body Left Panel Ends ********* -->
		<span id="cvvSpan" class="span5 content-text" style="display: none">
					<span class="span12 cvv_number">
						<span class="content-text">CVV:&nbsp;&nbsp;</span>
						<!--<input class="noradius textfield-55x25" type="text" />-->
						<input class="noradius textfield-55x25 cvvnumber onlynumbers" id="custCvvNumber" name="custCvvNumber" type="password" maxlength="4"/>
						<span class="cvv">&nbsp;</span>
						 <span class="cvv">                           
	                            <div class="tip-content radius6">	                            
	                                <span class="VISA MasterCard Diners"><strong>Visa/Mastercard/Diners</strong><br />
									Verification number is the last 3 digits on signature panel on the back of your card.</span>
									
									<span class="Amex" style="display:none;"><strong>American Express</strong><br />
									Verification number is the 4 digit number at the top right hand side on the front of your card.</span>
									
									<span class="jcb" style="display:none;"><strong>JCB</strong><br />
									Verification number is the 4 digit number at the bottom left hand side on the front of your card.</span>									
	                            </div>
								<span class="arrow"></span>
							</span>
					</span>
		   		<span class="span12 error"></span>
		</span>
		</div>
<!-- ********* Body Panel Ends ********* -->      
</div>
<!-- Web Store Footer Panel Starts -->
	 
<!-- Web Store Footer Panel Ends -->
<!-- Footer Starts -->
	<div class="row-fluid footer-logos" id="cc-footer">
		<div class="span12">
			<span class="poweredby CCAV"><img src="/images/CCAV.png"/>&nbsp;</span><a class="norton" title="Norton Secured Powered by VeriSign" target="_blank" href="https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&amp;dn=www.ccavenue.com&amp;lang=en">&nbsp;</a><!-- <span class="hidden-phone">&nbsp;&nbsp;</span> --><a onclick="window.open('https://sisainfosec.com/site/certificate/36572671505100517165','SISA Certificate','width=685,height=670')" href="javascript:"><span title="PCI-DSS - Certified by SISA" class="pci">&nbsp;</span></a>
        </div>
    </div>
<!-- Footer Ends -->
</div>
<div class="overlay-bg">
	<div class="overlay-content popup1" >
		<div class="conditions-popup" >
		<a href="#" class="close-popup" title="Close"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAYAAADgKtSgAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTQ0NEVERkI2QTBGMTFFM0FFOTlDRTFBNjM4QTIzNTgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTQ0NEVERkM2QTBGMTFFM0FFOTlDRTFBNjM4QTIzNTgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1NDQ0RURGOTZBMEYxMUUzQUU5OUNFMUE2MzhBMjM1OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1NDQ0RURGQTZBMEYxMUUzQUU5OUNFMUE2MzhBMjM1OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgSQG6gAAAIwSURBVHjalJXPS1RRFMff6DTaFC0Cd1JKINIqSIhW5UKzIYYxGDXEqE2LJhdC0nL+g2ZAEWYmFzVB28ho0yKIKJhEGRvUWcQU0araZWX+6nvkPPl6eu85c+AD75577rn33fPjhhx/aQIXQRycAR3gKFgDn0EZPAOvwKbTgMTAW7BTByWQqMdpGNz3cPAXfALLoAbWPWxmQEuQ4ydmwRIYB6fBEXAIREE3uA0WjP1Tvw0yZLQN0uDwAX8qju6BDVqbt0aXaHILXHcak6RenetjkK/jPU2kadFZ3dhL+sE5Gt8lHxUQEWWvlxLSQ4GTXw2Ro6zqJQUvqK4ZzJOvK6KcIsUdk44crJwGNWP012jNDdLPiuKNDv6ALjKMqAE7+mDGj0ErrTkBfumcFJnzRQc1Y+joVRQ0yDsmm4oaL8ccqKo2X0Xxg+477BO8inH+McC2pDbfpX/8VmXUZ0FGi4blJJg2QXa0yI7pt6TmXg+RTU6Zis2aE9fMOK8OXWnXxubGZ7cnuMa3yHDAOJI7Pq4OWZ+kNaOkf+gWg6tYpKs5b7IiTK34Ac31UfC5kybcCJdJOUkn6dU8bvKIxbAezJUU+ahyX4rThFTl1QZ7S4zyWxixBjmzwURAuvFrlTKOi16GUkBzJljvwE3QST0noqk4Bl4b+5faIhy/DQoer4yk16oWyAr46WHzKMgxy5AJchAVTcH/JHTAK3NZW6e03zb9M4nHN33inoMXVOX75J8AAwBWAOh9KesMnAAAAABJRU5ErkJggg==" border="0" width="23" height="23" /></a>
		<b class="big">Terms & Conditions</b><br /><br/>
		<label class="promoconditiontext"></label>
		</div>
	</div>
	<div class="overlay-content popup2">
		<div class="conditions-popup">
					<a href="#" class="close-popup" title="Close"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAYAAADgKtSgAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTQ0NEVERkI2QTBGMTFFM0FFOTlDRTFBNjM4QTIzNTgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTQ0NEVERkM2QTBGMTFFM0FFOTlDRTFBNjM4QTIzNTgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1NDQ0RURGOTZBMEYxMUUzQUU5OUNFMUE2MzhBMjM1OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1NDQ0RURGQTZBMEYxMUUzQUU5OUNFMUE2MzhBMjM1OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgSQG6gAAAIwSURBVHjalJXPS1RRFMff6DTaFC0Cd1JKINIqSIhW5UKzIYYxGDXEqE2LJhdC0nL+g2ZAEWYmFzVB28ho0yKIKJhEGRvUWcQU0araZWX+6nvkPPl6eu85c+AD75577rn33fPjhhx/aQIXQRycAR3gKFgDn0EZPAOvwKbTgMTAW7BTByWQqMdpGNz3cPAXfALLoAbWPWxmQEuQ4ydmwRIYB6fBEXAIREE3uA0WjP1Tvw0yZLQN0uDwAX8qju6BDVqbt0aXaHILXHcak6RenetjkK/jPU2kadFZ3dhL+sE5Gt8lHxUQEWWvlxLSQ4GTXw2Ro6zqJQUvqK4ZzJOvK6KcIsUdk44crJwGNWP012jNDdLPiuKNDv6ALjKMqAE7+mDGj0ErrTkBfumcFJnzRQc1Y+joVRQ0yDsmm4oaL8ccqKo2X0Xxg+477BO8inH+McC2pDbfpX/8VmXUZ0FGi4blJJg2QXa0yI7pt6TmXg+RTU6Zis2aE9fMOK8OXWnXxubGZ7cnuMa3yHDAOJI7Pq4OWZ+kNaOkf+gWg6tYpKs5b7IiTK34Ac31UfC5kybcCJdJOUkn6dU8bvKIxbAezJUU+ahyX4rThFTl1QZ7S4zyWxixBjmzwURAuvFrlTKOi16GUkBzJljvwE3QST0noqk4Bl4b+5faIhy/DQoer4yk16oWyAr46WHzKMgxy5AJchAVTcH/JHTAK3NZW6e03zb9M4nHN33inoMXVOX75J8AAwBWAOh9KesMnAAAAABJRU5ErkJggg==" border="0" width="23" height="23" /></a>
					<b class="big">CCAvenue Checkout</b><br />
					Shopping online becomes easier and faster with CCAvenue Checkout. Simply save your name, billing address, shipping address and payment details (credit card / debit card or preferred bank for netbanking) in your CCAvenue secure account and shop across 85% of India's websites without having to enter these details ever again. Just login to your CCAvenue Checkout account, enter the CVV number and you are done!<br /><br />
					<b>Secure and Trusted</b><br />
				You can rely on CCAvenue to keep your information safe. We comply with the Payment Card Industry's highest Data security standards (PCI-DSS 2.0) to ensure that your personal information always remains encrypted and 100% secure to protect you against any identity theft and credit / debit card fraud.<br /><br />
					Make shopping online, a faster and more enjoyable experience with CCAvenue Checkout.   
				</div>
	</div>
	<div class="overlay-content popup3">
		<input type="hidden" name="cancelComment" value="" id="cancelComment">
		<div class="cancel-popup cancel-transaction">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="left" valign="middle" colspan="2" class="border"><b class="big">Cancellation Feedback</b></td>
				</tr>
				<tr>
					<td align="left" valign="middle" height="50" colspan="2">We have noticed that you didn't complete your transaction. Please help us understand the reason for your decision:</td>
				</tr>
				<tr>
					<td width="5%" align="left" valign="top">
						
						<input type="radio" id="reasonRadio1" name="reasonRadios" value="1" class="reasonRadio" />
					</td>
					<td width="95%" align="left" valign="top" class="reason1"><label style="display: none;" class="reason1">I wish to review my order again before completing the transaction.</label>I wish to review my order again before completing the transaction.</td>
				</tr>
				<tr>
					<td align="left" valign="top">
						
						<input type="radio" id="reasonRadio2" name="reasonRadios" value="2" class="reasonRadio" />
					</td>
					<td align="left" valign="top" class="reason2"><label style="display: none;" class="reason2">I have second thoughts about making this payment</label>I have second thoughts about making this payment.</td>
				</tr>
				<tr>
					<td align="left" valign="top">
						
						<input type="radio" id="reasonRadio3" name="reasonRadios" value="3" class="reasonRadio" />
					</td>
					<td align="left" valign="top" class="reason3"><label style="display: none;" class="reason3">I could not find my Bank/Credit Card in your list of payment options</label>I could not find my Bank/Credit Card in your list of payment options.</td>
				</tr>
				<tr>
					<td align="left" valign="top">
						
						<input type="radio" id="reasonRadio4" name="reasonRadios" value="4" class="reasonRadio" />
					</td>
					<td align="left" valign="top" class="reason4"><label style="display: none;" class="reason4">I wish to pay through another payment option.</label>I wish to pay through another payment option.</td>
				</tr>
				<tr>
					<td align="left" valign="top">
						
						<input type="radio" id="reasonRadio5" name="reasonRadios" value="5" class="reasonRadio" />
					</td>
					<td align="left" valign="top" class="reason5"><label style="display: none;" class="reason5">I do not wish to share my confidential payment details online.</label>I do not wish to share my confidential payment details online.</td>
				</tr>
				<tr>
					<td align="left" valign="top">
						
						<input type="radio" id="reasonRadio6" name="reasonRadios" value="6" class="reasonRadio" />
					</td>
					<td align="left" valign="top">
						<label class="reason6" style="display: none;">
						Any other Reason</label>
						<textarea name="otherReason" cols="50" rows="2" id="otherReason"></textarea><br/>
						<span class="span12 error-msg"><label for="otherReason" generated="true" class="error"></label></span>
						<!-- <textarea cols="30" rows="2" id="otherReason" name="otherReason" ></textarea> -->
					</td>
				</tr>
				<tr>
					<td align="left" valign="top">&nbsp;</td>
					<td align="left" valign="top" height="50">
						<div id="buttons" class="span12">
							<span class="content-text">
								<a href="#" class="primary-button primary-button-bg primary-button-border primary-button-border-hover radius4 confirmCancel" title="Cancel Transaction"><span class="primary-button-text primary-button-inside-border primary-button-inside-border-hover radius3">Cancel Transaction</span></a>&nbsp;&nbsp;&nbsp;
								<a href="#" class="secondary-button secondary-button-bg secondary-button-border secondary-button-border-hover radius4 close-popup continuePayment" title="Continue Payment"><span class="secondary-button-text secondary-button-inside-border secondary-button-inside-border-hover radius3">Continue Payment</span></a></span>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="overlay-content popup6" >
		<a href="#" class="close-popup" title="Close"><img src="images/icon-popup-close.png" border="0" width="23" height="23" /></a>
		<div class="message-popup upi-flow">
			<div class="scroll-content">
				<b class="big">Performing a UPI (Unified Payments Interface) Transaction</b>
				<ul>
					<li>Customer enters his Virtual Payment Address (VPA) and proceeds to pay.<br /><span class="note">Note: Virtual payment address (VPA) is a user-generated unique identifier for each bank account. All payment addresses are in the format abc @bank, where abc can be chosen by the customer.</span></li>
					<li>A payment collection request for the transaction amount is sent to the customer on this VPA.</li>
					<li>Customer will receive a mobile notification in their UPI app prompting him to authenticate the transaction with his 4 digit MPIN (Mobile Banking password)</li>
					<li>Customer accepts the transaction and the payment is complete.</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</form>
<script language="javascript" type="text/javascript" src="/scripts/allscripts.min20181211.js"></script>
<script language="javascript"  type="text/javascript" src="/scripts/jquery.sha1-min.js"></script>

<script  type="text/javascript">
	  var applycoupon = false;
$(document).ready(function(){
	
		 var validator =  $("#TransactionForm").validate({
		
			 rules:	{
				billAddress:{
					required: true,
					maxlength: 300,
					textArea: true,
					isBeginSpecialCharAddress: true,
					isEndSpecialCharAddress: true,
					isConsecuSpecialChar: true
				 },
				 billCity:{
					required: true,
					maxlength: 30,
					city : true,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForName: true
				 },
				 billState:{
					 required:true,
					 maxlength: 30,
					 state: true,
					 isBeginSpecialChar:true,
					 isConsecuSpecialChar: true,
					 isEndSpecialCharForName:true
				 },
				 billZip:{
					 required:true,
					 maxlength: 15,
					 zipCode: true,
					 isBeginSpecialChar:true,
					 isConsecuSpecialChar: true,
					 isEndSpecialChar:true
				 },
				 billCountry:{
					 required:true,
					 maxlength: 50,	
					 country: true,
					 isBeginSpecialChar:true,
					 isConsecuSpecialChar: true,
					 isEndSpecialChar:true					
				 },
				 billTel:{
					 required: true,
					 phone:true,
					 minlength:5,
					 maxlength: 22,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 isEndSpecialChar: true
				 },
				 billEmail:{
					 required:true,
					 maxlength: 70,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 email: true,
					 isEndSpecialChar:true
				 },
				 notesValue:{
					 maxlength: 150,
					 notes: true,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 isEndSpecialCharForNotes:true
				 },
				 shipName:{
					required:true,
					maxlength: 60,
					fullName: true,
					isBeginSpecialChar:true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForName:true
				 },
				 shipAddress:{
					required:true,
					maxlength: 300,
					textArea: true,
					isBeginSpecialCharAddress: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharAddress: true
				},
				shipCity:{
				required: true,
					maxlength: 30,
					city : true,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForName: true
	   			 },
	   			shipState:{
					required: true,
					maxlength: 30,
					state: true,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForName: true
				 },
	 			 shipZip:{
					required: true,
					maxlength: 15,
					zipCode: true,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialChar: true
				 },
				 shipCountry:{
					required: true
				 },
				 shipTel:{
					required: true,
					phone: true,
					minlength: 5,
					maxlength: 22,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialChar: true
				 },
				 creditCardNumber:{
					required: true,
					quantity:true,
					minlength: 13,
					maxlength: 19,
					creditcard: true
				 },
			     billName:{
					 required: true,
					 maxlength: 60,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 fullBillName: true,
					 isEndSpecialCharForName: true,
					 onealphabet:true
				 },
				 expiryMonthCreditCard:{
					required: true
				 },
				 expiryYearCreditCard:{
					required: true
				 },
				 CVVNumberCreditCard:{
					required: true,
					quantity:true,
					minlength:3,
					maxlength:4
				 },
				 custCvvNumber:{
					 required:function(){
					 if($("#custCvvNumber").is(":visible")){
						 return true;
					 }
					 else{
						 return false;
					 }
				    },
				    quantity:true,
				    minlength:3,
					maxlength:4
				 },
				 issuingBank:{
					required:true,
					issuingBankName:true,
					maxlength:100,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForAddr:true
				 },
				 creditCardEmiBanks:{
					required:true
				 },
				 nameoncreditcardEMI:{
					required: true,
					minlength:3,
					maxlength: 60,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					fullName: true,
					isEndSpecialCharForName: true
				 },
				 creditCardEMI:{
					required:true,
					quantity:true,
					minlength:13,
					maxlength:19,
					creditcard: true
				 },
				 expiryMonthCreditCardEMI:{
					required: true
				 },
				expiryYearCreditCardEMI:{
					required: true
				 },
				CVVNumberEMI:{
					required: true,
					quantity:true,
					minlength:3,
					maxlength:4
				 },
				issuingBankEMI:{
					required:true
				 },
				debitCard:{
					required:true
				 },
				debitCardNumber:{
					required:true,
					quantity:true,
					minlength:13,
					maxlength:19,//,
					creditcard: true
				},
				expiryMonthDebitCard:{
				    required: true
				},
				expiryYearDebitCard:{
					required: true
				},
				CVVNumberDebitCard:{
					required:true,
					quantity:true,
					minlength:3,
					maxlength:4
				},
				issuingBankDebitCard:{
					required:true,
					issuingBankName:true,
					maxlength:100,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForAddr:true
				 },
				 netBankingBank:{
					required: true
				 },
				 checkoutPaymentBank:{
					required: true
				 },
				 neftBanks:{
					 required:true
				 },
				cashcard:{
					required:true
				},
				coupenCode:{
					required:function(){
					 return applycoupon;
				},
					letterAndNumberOnly:true,
					minlength:3,
					maxlength:20
				},
				mobileNumber:{
					required:true,
					quantity:true,
					rangelength: [10,10]
				},
				walletmobilenumber:{
					required:true,
					quantity:true,
					rangelength: [10,10]
				},
				mmId:{
					required:true,
					quantity:true,
					rangelength: [7,7]
				},
				otpwalletpayment:{
					required:true,
					quantity:true,
					rangelength: [6,6]
				},
				otpmobpayment:{
					required:true,
					quantity:true,
					rangelength: [6,6]
				},
				otp:{
					required:true,
					quantity:true,
					rangelength: [6,6]
				},
				userNameCreditCard:{
					 required:true,
					 maxlength: 70,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 email: true,
					 isEndSpecialChar:true
					// remote:"/transaction/transaction.do?command=customerEmailCheckAvailability"
				},
				passWordCreditCard:{
					required:true,
					minlength : 8,
					maxlength : 22,
					passwordMin: true,
					password : true,
					isConsecuSpecialCharPassword : true,
					remote:{
						  url:"/transaction/transaction.do?command=checkUser",
						  data: {
							userName: function () {
						        return $("#userNameCreditCard").val();
						    },
						    userPassword: function () {
								return $.sha1($("#passWordCreditCard").val());
							}
						  }
						}
					
				},
				userNameNetBank:{
					 required:true,
					 maxlength: 70,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 email: true,
					 isEndSpecialChar:true
					
					 //remote:"/transaction/transaction.do?command=customerEmailCheckAvailability"
				},
				passWordNetBank:{
					required:true,
					minlength : 8,
					maxlength : 22,
					passwordMin: true,
					password : true,
					isConsecuSpecialCharPassword : true,
					 remote: {
						  url:"/transaction/transaction.do?command=checkUser",
						  data: {
							userName: function () {
						        return $("#userNameNetBank").val();
						    },
						    userPassword: function () {
								return $.sha1($("#passWordNetBank").val());
							}
						  }
						}
				},
				userNameDebitCard:{
					 required:true,
					 maxlength: 70,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 email: true,
					 isEndSpecialChar:true
					 //remote:"/transaction/transaction.do?command=customerEmailCheckAvailability"
				},
				passWordDebitCard:{
					required:true,
					minlength : 8,
					maxlength : 22,
					passwordMin: true,
					password : true,
					isConsecuSpecialCharPassword : true,
					remote:{
						  url:"/transaction/transaction.do?command=checkUser",
						  data: {
							userName: function () {
						        return $("#userNameDebitCard").val();
						    },
						    userPassword: function () {
								return $.sha1($("#passWordDebitCard").val());
							}
						  }
						}
				},
				loginUser:{
					 required:true,
					 maxlength: 70,
					 isBeginSpecialChar: true,
					 isConsecuSpecialChar: true,
					 email: true,
					 isEndSpecialChar:true
				},
				loginPassword:{
					required:true,
					minlength : 8,
					maxlength : 22,
					passwordMin: true,
					password : true,
					isConsecuSpecialCharPassword : true
					},
					mobilePaymentBank:{
					required:true
				},
				walletPaymentBank:{
					required:true
				},
				upiPaymentBank:{
					required:true
				},
				otherReason:{
					required:true,
					maxlength:200,
					textArea: true,
					isBeginSpecialChar: true,
					isEndSpecialChar: true,
					isConsecuSpecialChar: true
				},
				invoiceAmt:{
				 required:true,
				 min:parseFloat($("#minInvoiceAmt").val()),
				 max:parseFloat($("#orderAmount").val())
				},
				accepttermsdebit:{
					required:true
				},
				accepttermsnbk:{
					required:true
				},
				accepttermsneft:{
					required:true
				},
				accepttermscredit:{
					required:true
				},
				acceptterms:{
					required:true
				},
				accepttermscorp:{
					required:true
				},
				collectByDate:{
					dateITA:true
				},
				virtualAddress:{
					required:true,
					virtualAddress:true,
					maxlength:255,
					isBeginSpecialChar: true,
					isConsecuSpecialChar: true,
					isEndSpecialCharForName:true
				}
			},
			messages : {
				billAddress:{
					required: 'Please enter a valid address.',
					maxlength:'Address should not exceed 300 characters.',
					textArea: 'Only letters, numbers, hash, comma, circular brackets, slash, dot and hyphen are allowed.',
					isBeginSpecialCharAddress: 'Please enter a valid address.',
					isEndSpecialCharAddress:'Please enter a valid address.',
					isConsecuSpecialChar: 'Please enter a valid address.'
		 	},
				billCity:{
					required: 'Please enter city name.',
					maxlength: 'City should not exceed 30 characters.',
					city: 'Only letters, hyphen and dot are allowed.',
					isBeginSpecialChar: 'Please enter a valid city name.',
					isConsecuSpecialChar: 'Please enter a valid city name.',
					isEndSpecialCharForName:'Please enter a valid city name.'
				},
				billState:{
					required:'Please enter state name.',
					maxlength: 'State should not exceed 30 characters.',
					state: 'Only letters, hyphen and dot are allowed.',
					isBeginSpecialChar: 'Please enter a valid state name.',
					isConsecuSpecialChar: 'Please enter a valid state name.',
					isEndSpecialCharForState: 'Please enter a valid state name.'
				},
				billZip:{
					required: 'Please enter zip code.',
					maxlength: 'Zip code should not exceed 15 characters.',
					zipCode: 'Only letters, numbers and hyphen are allowed.',
					isBeginSpecialChar: 'Please enter a valid zip code.',
					isConsecuSpecialChar:'Please enter a valid zip code.',
					isEndSpecialChar: 'Please enter a valid zip code.'
				},
				
				billCountry:{
					required: 'Please select country.'
				},
				billTel:{
					required: 'Please enter a valid phone number.',
					minlength: 'Please enter a valid phone number.',
					maxlength: 'Please enter a valid phone number.',
					phone: 'Only numbers, hyphen and slash are allowed.',
					isBeginSpecialChar: 'Please enter a valid phone number.',
					isConsecuSpecialChar: 'Please enter a valid phone number.',
					isEndSpecialChar: 'Please enter a valid phone number.'
				},
				billEmail:{
					required:'Please enter a valid email.',
					maxlength: 'Email should not exceed 70 characters.',
					email: 'Please enter a valid email.',
					isBeginSpecialChar: 'Please enter a valid email.',
					isConsecuSpecialChar: 'Please enter a valid email.',
					isEndSpecialChar: 'Please enter a valid email.'
				},
				notesValue:{
					maxlength: 'Notes should not exceed 150 characters.',
					notes: 'Only letters, numbers, dot, ampersand, circular brackets, slash, comma and hyphen are allowed.',
					isBeginSpecialChar:'Notes must not start with any special character.',
					isConsecuSpecialChar: 'Notes must not have two special characters next to each other.',
					isEndSpecialCharForNotes:'Notes must not end with any special character.'
				},
				shipName:{
					required: 'Please enter recipients name.',
					minlength:'Please enter a name with min. 3 & max. 60 characters.',
					maxlength: 'Please enter a name with min. 3 & max. 60 characters.',
					isBeginSpecialChar: 'Name must not begin with any special character.',
					isConsecuSpecialChar: 'Name must not have two special characters next to each other.',
					isEndSpecialCharForName: 'Name must not end with any special character.',
					fullName: 'Only letters, apostrophe and dot are allowed.'
				},
				shipAddress:{
					required: 'Please enter a valid address.',
					maxlength:'Address should not exceed 300 characters.',
					textArea: 'Only letters, numbers, hash, comma, circular brackets, slash, dot and hyphen are allowed.',
					isBeginSpecialCharAddress:  'Please enter a valid address.',
					isEndSpecialCharAddress: 'Please enter a valid address.',
					isConsecuSpecialChar:  'Please enter a valid address.'
				},
				shipCity:{
					required: 'Please enter city name.',
					maxlength: 'City should not exceed 30 characters.',
					city: 'Only letters, hyphen and dot are allowed.',
					isBeginSpecialChar: 'Please enter a valid city name.',
					isConsecuSpecialChar: 'Please enter a valid city name.',
					isEndSpecialCharForName:'Please enter a valid city name.'
				},
				shipState:{
					required:'Please enter state name.',
					maxlength: 'State should not exceed 30 characters.',
					state: 'Only letters, hyphen and dot are allowed.',
					isBeginSpecialChar: 'Please enter a valid state name.',
					isConsecuSpecialChar: 'Please enter a valid state name.',
					isEndSpecialCharForState: 'Please enter a valid state name.'
				},
				shipZip:{
					required: 'Please enter zip code.',
					maxlength: 'Zip code should not exceed 15 characters.',
					zipCode: 'Only letters, numbers and hyphen are allowed.',
					isBeginSpecialChar: 'Please enter a valid zip code.',
					isConsecuSpecialChar:'Please enter a valid zip code.',
					isEndSpecialChar: 'Please enter a valid zip code.'
				},
				shipCountry:{
					required: 'Please select country.'
				},
				shipTel:{
					required: 'Please enter a valid phone number.',
					minlength: 'Please enter a valid phone number.',
					maxlength: 'Please enter a valid phone number.',
					phone: 'Only numbers, hyphen and slash are allowed.',
					isBeginSpecialChar: 'Please enter a valid phone number.',
					isConsecuSpecialChar: 'Please enter a valid phone number.',
					isEndSpecialChar: 'Please enter a valid phone number.'
				},
				creditCardNumber:{
					required: 'Please enter card number.',
					quantity: 'Please enter only numbers without space.',
				    minlength: 'Please enter valid card number.',
					maxlength: 'Please enter valid card number.',
					creditcard:'Please enter valid card number.'
				},
				billName:{
					required: 'Please enter billing name.',
					minlength:'Please enter a name with min. 3 & max. 60 characters.',
					maxlength:'Please enter a name with min. 3 & max. 60 characters.',
					isBeginSpecialChar:'Please enter billing name.',
					isConsecuSpecialChar:'Please enter billing name.',
					isEndSpecialCharForName:'Please enter billing name.',
					fullBillName:'Only letters, apostrophe and dot are allowed.'
				},
				expiryMonthCreditCard:{
					required: 'Select valid expiry date.'
				},
				expiryYearCreditCard:{
					required: 'Select valid expiry date.'
				},
				CVVNumberCreditCard:{
					required: 'Please enter CVV number.',
					quantity:'Please enter only numbers without space.',
					minlength:'CVV Number should be minimum 3 digits.',
					maxlength:'CVV number should not exceed 4 digits.'
				},
				custCvvNumber:{
					 required:'<br/>&nbsp;&nbsp;Please enter CVV number.',
					 quantity:'<br/>&nbsp;&nbsp;Please enter only numbers without space.',
					 minlength:'<br/>CVV Number should be minimum 3 digits.',
					 maxlength:'<br/>&nbsp;&nbsp;CVV number should not exceed 4 digits.'
				 },
				issuingBank:{
					required:'Please enter name of the issuing bank.',
					issuingBankName:'Please enter valid name of the issuing bank.',
					maxlength:'Issuing Bank should not exceed 100 characters.',
					isBeginSpecialChar:'Please enter valid name of the issuing bank.',
					isConsecuSpecialChar:'Please enter valid name of the issuing bank.',
					isEndSpecialCharForAddr:'Please enter valid name of the issuing bank.'
				},
				nameoncreditcardEMI:{
					required:'<br/>Please enter name as mentioned on card.',
					minlength:'<br/>Please enter a name with min. 3 & max. 60 characters.',
					maxlength:'<br/>Please enter a name with min. 3 & max. 60 characters.',
					isBeginSpecialChar:'<br/>Please enter name as mentioned on card.',
					isConsecuSpecialChar:'<br/>Please enter name as mentioned on card.',
					isEndSpecialCharForName:'<br/>Please enter name as mentioned on card.',
					fullName:'<br/>Only letters, apostrophe and dot are allowed.'
				},
				coupenCode:{
					required:'Enter coupon code.',
					letterAndNumberOnly:'Invalid coupon code.',
					minlength:'Invalid coupon code.',
					maxlength:'Invalid coupon code.'
					
				},
				creditCardEMI: {
					required: '<br/>Please enter card number.',
					quantity:  '<br/>Please enter only numbers without space.',
				    minlength: '<br/>Please enter valid card number.',
					maxlength: '<br/>Please enter valid card number.',
					creditcard:'<br/>Please enter valid card number.'
				},
				debitCardNumber:{
					required: '<br/>Please enter card number.',
					quantity: '<br/>Please enter only numbers without space.',
				    minlength:'<br/>Please enter valid card number.',
					maxlength:'<br/>Please enter valid card number.',
					creditcard:'<br/>Please enter valid card number.'
				},
				expiryMonthDebitCard:{
					required: '<br/>Select valid expiry date.'
				},
				expiryYearDebitCard:{
					required: '<br/>Select valid expiry date.'
				},
				
				expiryMonthCreditCardEMI:{
					required: 'Select valid expiry date.'
				},
				expiryYearCreditCardEMI:{
					required: 'Select valid expiry date.'
				},
				CVVNumberEMI:{
					required: 'Please enter CVV number.',
					quantity:'Please enter only numbers without space.',
					minlength:'CVV Number should be minimum 3 digits.',
					maxlength:'CVV number should not exceed 4 digits.'
				},
				CVVNumberDebitCard:{
					required: 'Please enter CVV number.',
					quantity:'Please enter only numbers without space.',
					minlength:'CVV Number should be minimum 3 digits.',
					maxlength:'CVV number should not exceed 4 digits.'
				},
				issuingBankEMI:{
					required: '<br/>Please enter name of the issuing bank.'
				},
				netBankingBank:{
					required:'Select a bank.'
				},
				checkoutPaymentBank:{
					required:'Select an option.'
				},
				neftBanks:{
					required:'Select a bank.'
				},
				creditCardEmiBanks:{
					required:'Select a bank.'
				},
				cashcard:{
					required:'Select a cash card.'
				},
				debitCard:{
					required:'<br/>Select a Debit Card.'
				},
				issuingBankDebitCard:{
					required:'<br/>Please enter name of the issuing bank.',
					issuingBankName:'<br/>Please enter valid name of the issuing bank.',
					maxlength:'<br/>Issuing Bank should not exceed 100 characters.',
					isBeginSpecialChar:'<br/>Please enter valid name of the issuing bank.',
					isConsecuSpecialChar:'<br/>Please enter valid name of the issuing bank.',
					isEndSpecialCharForAddr:'<br/>Please enter valid name of the issuing bank.'
				},
				mobileNumber:{
			    	required:'Please enter a valid mobile number.',
			    	quantity:'Only numbers are allowed.',
			    	rangelength:'Please enter a valid mobile number.'
			    },
			    walletmobilenumber:{
			    	required:'Please enter a valid mobile number.',
			    	quantity:'Only numbers are allowed.',
			    	rangelength:'Please enter a valid mobile number.'
			    },
			    mmId:{
			    	required:'Please enter a valid MMID number.',
			    	quantity:'Only numbers are allowed.',
			    	rangelength:'Please enter a valid MMID number.'
			    },
			    otpwalletpayment:{
			    	required:'Please enter a valid OTP number.',
			    	quantity:'Only numbers are allowed.',
					rangelength:'Please enter a valid OTP number.'
				},
				otpmobpayment:{
				   	required:'Please enter a valid OTP number.',
				   	quantity:'Only numbers are allowed.',
					rangelength:'Please enter a valid OTP number.'
				},
				otp:{
					required:'Please enter a valid OTP number.',
					quantity:'Only numbers are allowed.',
					rangelength:'Please enter a valid OTP number.'
				},
			    userNameCreditCard:{ 	
			    	required: 'Please enter a valid email.',
					maxlength: 'Email should not exceed 70 characters.',
					email: 'Please enter a valid email.',
					isBeginSpecialChar: 'Please enter a valid email.',
					isConsecuSpecialChar:'Please enter a valid email.',
					isEndSpecialChar: 'Please enter a valid email.'
					//remote:'This Email is already registered. Login through the panel on the right or register with a different email.'
						
				},
				passWordCreditCard:{
					required:'Please enter Password.',
					minlength :'Password should be atleast 8 characters long.',
					maxlength :'Password should not exceed 22 characters.',
					password :'Only alphabets, numbers and following special characters are allowed ~ ! @ # $ % ^ & + - = _  , ? : round brackets, curly brackets, square brackets and space.',
					passwordMin: 'Password should contain alphabet and atleast one special character and one number.',
					isConsecuSpecialCharPassword :'<br/>Password must not have two special characters next to each other.'
					//remote:'Username and/or password is wrong.'
				},
				userNameNetBank:{
					required:'Please enter a valid email.',
					maxlength: 'Email should not exceed 70 characters.',
					email: 'Please enter a valid email.',
					isBeginSpecialChar: 'Please enter a valid email.',
					isConsecuSpecialChar: 'Please enter a valid email.',
					isEndSpecialChar: 'Please enter a valid email.'
					//remote:'This Email is already registered. Login through the panel on the right or register with a different email.'	
				},
				passWordNetBank:{
					required:'Please enter Password.',
					minlength :'Password should be atleast 8 characters long.',
					maxlength :'Password should not exceed 22 characters.',
					password :'Only alphabets, numbers and following special characters are allowed ~ ! @ # $ % ^ & + - = _  , ? : round brackets, curly brackets, square brackets and space.',
					passwordMin: 'Password should contain alphabet and atleast one special character and one number.',
					isConsecuSpecialCharPassword :'<br/>Password must not have two special characters next to each other.'
					//remote:'Username and/or password is wrong.'
				},
				userNameDebitCard:{
					required:'Please enter a valid email.',
					maxlength: 'Email should not exceed 70 characters.',
					email: 'Please enter a valid email.',
					isBeginSpecialChar: 'Please enter a valid email.',
					isConsecuSpecialChar: 'Please enter a valid email.'
					//remote: 'This Email is already registered. Login through the panel on the right or register with a different email.'
				},
				passWordDebitCard:{
					required:'Please enter Password.',
					minlength :'Password should be atleast 8 characters long.',
					maxlength :'Password should not exceed 22 characters.',
					password :'Only alphabets, numbers and following special characters are allowed ~ ! @ # $ % ^ & + - = _  , ? : round brackets, curly brackets, square brackets and space.',
					passwordMin: 'Password should contain alphabet and atleast one special character and one number.',
					isConsecuSpecialCharPassword :'<br/>Password must not have two special characters next to each other.'
					//remote:'Username and/or password is wrong.'
				},
				loginUser:{
					required:'Please enter a valid email.',
					maxlength: 'Email should not exceed 70 characters.',
					email: 'Please enter a valid email.',
					isBeginSpecialChar: 'Please enter a valid email.',
					isConsecuSpecialChar: 'Please enter a valid email.',
					isEndSpecialChar: 'Please enter a valid email.'
				},
				loginPassword:{
					required:'Please enter Password.',
					minlength :'Password should be atleast 8 characters long.',
					maxlength :'Password should not exceed 22 characters.',
					loginPassword :'Invalid password.',
					passwordMin: 'Invalid password.',
					isConsecuSpecialCharPassword :'<br/>Invalid password.'
				},
				walletPaymentBank:{
					required:'Select wallet payment.'
				},
				mobilePaymentBank:{
					required:'Select mobile payment.'
				},
				upiPaymentBank:{
					required:"Select UPI payment."
				},
				otherReason:{
					required:'Please enter specific reason',
					maxlength:'Feedback should not exceed 200 characters',
					textArea:'Only letters, numbers, hash, comma,circular brackets, slash, dot and hyphen are allowed',
					isBeginSpecialChar:'Feedback must not begin with any special character.',
					isEndSpecialChar:'Feedback must not end with any special character.',
					isConsecuSpecialChar:'Feedback must not have two special characters next to each other.'
				},
				invoiceAmt:{
					required:"Enter Amt You wish to pay.",
					min:"Enter Amt greater than Min. amount payable.",
					max:"Enter Amt less than or equal invoice Amt."
				},
				accepttermsdebit:{
					required:"Please read and accept terms & conditions."
				},
				accepttermsnbk:{
					required:"Please read and accept terms & conditions."
				},
				accepttermsneft:{
					required:"Please read and accept terms & conditions."
				},
				accepttermscredit:{
					required:"Please read and accept terms & conditions."
				},
				acceptterms:{
					required:"Please read and accept terms & conditions."
				},
				accepttermscorp:{
					required:"Please read and accept terms & conditions."
				},
				collectbyDate:{
					dateITA:"Please enter a valid collectbyDate."
				},
				virtualAddress:{
					required:"Please enter a valid virtualAddress.",
					virtualAddress:"Please enter a valid virtualAddress.",
					maxlength:"Virtual address should not exceed 255 characters.",
					isBeginSpecialChar:"Please enter a valid virtualAddress.",
					isConsecuSpecialChar:"Please enter a valid virtualAddress.",
					isEndSpecialCharForName:"Please enter a valid virtualAddress.",
				}
			},
			groups:{
		    	debitCardDate:"expiryMonthDebitCard expiryYearDebitCard",
		    	creditCardDate: "expiryMonthCreditCard expiryYearCreditCard ",
		    	creditCardEMIDate:"expiryMonthCreditCardEMI expiryYearCreditCardEMI"
		    },
			// To avoid validations on hidden fields
		    ignore: ":hidden",
			//focusCleanup: true,
			//focusInvalid: false,
			//onclick: true,
			onkeyup: false
		    	
	});
			/**********************From Atul**************************************************/
			/*****************for displaying Look and Feel*******************************/
		 orderBillName='Billing Name';
		 otherReason='Any other Reason';
		 orderBillAddress='Address';
		 orderBillCity='City';
		 orderBillState='State';
		 orderBillZip='Zip Code';
		 orderBillTel='Mobile Number';
		 orderBillEmail='Email';
		 orderNotes='Notes (Optional)';
		 orderShipName='Recipients Name';
		 orderShipAddress='Address';
		 orderShipCity='City';
		 orderShipState='State';
		 orderShipZip='Zip Code';
		 orderShipTel='Phone Number.';
		 
		 $("#orderBillName").attr('placeholder',orderBillName);
		 $("#otherReason").attr('placeholder',otherReason);
		 $("#orderBillAddress").attr('placeholder', orderBillAddress);
		 $("#orderBillCity").attr('placeholder', orderBillCity);
		 $("#orderBillState").attr('placeholder', orderBillState);
		 $("#orderBillZip").attr('placeholder', orderBillZip);
		 $("#orderBillTel").attr('placeholder',orderBillTel);
		 $("#orderBillEmail").attr('placeholder', orderBillEmail);
		 $("#orderNotes").attr('placeholder', orderNotes);
		 $("#orderShipName").attr('placeholder', orderShipName);
		 $("#orderShipAddress").attr('placeholder',orderShipAddress );
		 $("#orderShipCity").attr('placeholder', orderShipCity);
		 $("#orderShipState").attr('placeholder', orderShipState);
		 $("#orderShipZip").attr('placeholder',orderShipZip);
		 $("#orderShipTel").attr('placeholder',orderShipTel);	
		 $("#collectByDate").attr('placeholder','DD/MM/YYYY');
		 
			/********For User Login **************/
			$(document).on('click','a#userLogin',function(e){
				$("input.register-new").removeAttr("checked");//For Removing the checked 
				e.preventDefault();
				$('div.custPayOptionDiv').empty();
				$("#loginPassword").valid();
				if($("#loginUser").valid()&&($("#loginPassword").valid())){
				//$("#loginPassword").valid();
				$("#userPassword").val($.sha1($("#loginPassword").val()));
				$("#userName").val($("#loginUser").val());
				$("#command").attr("value","checkUserLoginOneClick");
			    formData = $('#userName,#userPassword,#trackingId,#merchantId,#command').serialize();
				$.post("/transaction/transaction.do?",formData,function(data){
					if(data=="timeout")// for session Time out
					{
						$("#TransactionForm").find("input,select").each(function(){
							$(this).rules("remove");
						});
					  $("#command").attr("value","sessionTimeOut");  
					  $("#TransactionForm").submit();
					}
					 $("#userPassword").val("");
					 if(!(data=="Invalid username." ||data=="Invalid password." || data=="locked" || data=="expired")){
					 var shipInfo = $(data).filter(".shipping-pre-populate");
					 var billInfo = $(data).filter(".billing-pre-populate");
					 $("span.loginName").text(billInfo.find("#custpayNameOnCardLbl").text());
					 var custPayOptions = $(data).filter(".prepopulate-payment-option");
					 $("#loginscreen").hide();
					 $("#logged-in-screen").show();
					 $(".new-user-register").hide();
					 /***************check Merchant is allowing to Edit Prepopulated data**************/
					 if($("#isEditPrePopulateData").val()=="Y"){
						 $('div.billing-pre-populate').replaceWith(billInfo); 
					 	 //$('div.shipping-pre-populate').replaceWith(shipInfo);
					 	 $("#orderBillEmail").val($("#custBillEmaiLbl").text());
					 	  $("#orderBillEmail").trigger('change');
					 	 
					 }
					 /***************check Merchant is allowing to Edit Prepopulated data**************/
					 $('div.prepopulate-payment-option').replaceWith(custPayOptions);
					 if($('div.prepopulate-payment-option').children().length>0){
						 changePayment();
						 $("#promotion").trigger('change');
						 $("div.savecustomerCard").show();

					 }
						/********************From Atul***************************************/
						   if ($('div.billing-pre-populate').children().length >0){
							   changePosition();
						   }
						if($("div.shipping-pre-populate").children().length >0){
							  $("#shipping_form").show();
							  $("div.shipping-edit-form").hide();
							  $("a.cancelSave").show();
						}else{
							if($("#settingShippingInformation").val()=="Y"){
								$(".differentAddress").show();
							}
						}
					 }
					 else{
						 	 if(data=="locked")
						 	 $("span.loginPassWordError").text('Your account has been locked. Please contact CCAvenue system administrator.');
						 	 else if(data=="expired")
						 	 $("span.loginPassWordError").text('Password Expired! You must change your Password.'); 
						 	 else
							 $("span.loginPassWordError").text('Username and/or password is wrong.');
					 }
						/*******************From Atul***************************************/ 
					 
				});
				}
			});
			/**************For toggling**********************************/
			$("#ordertotal a.view-breakup").click(function (e){
						e.preventDefault();
						if($("#ordertotal div.breakup-panel").is(':hidden')){
							$('a.view-breakup').text('Hide Breakup');
						}else{
							$('a.view-breakup').text('View Breakup');
						}				
						$("#ordertotal .breakup-panel").slideToggle();
						//return false;
					});
			/**************For toggling**********************************/

});
	</script>
</body>
</html>
