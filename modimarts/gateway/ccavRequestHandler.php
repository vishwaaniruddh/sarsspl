<? session_start();?>
<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('ccCrypto.php')?>
<?php 

var_dump($_SESSION);
	error_reporting(0);
	
	$merchant_data='';
	$working_key='2767DEF9D0F926DEC2DC4403D962F59D';//Shared by CCAVENUES
	$access_code='AVLI96HK71AU45ILUA';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.


?>
<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<!--<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";

?>
<input type="submit" name="submit" values="submit">
</form>
</center>
<!--<script language='javascript'>document.redirect.submit();</script>-->
</body>
</html>

