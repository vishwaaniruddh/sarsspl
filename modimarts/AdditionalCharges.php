<?php session_start();  
?>

<? include('head.php') ; ?>



<?php include('ccCrypto.php')?>

<style>

    form{

        text-align:center;

    }

</style>



<?php





	error_reporting(1);



	$merchant_data='';

	$working_key='2767DEF9D0F926DEC2DC4403D962F59D';//Shared by CCAVENUES

	$access_code='AVLI96HK71AU45ILUA';//Shared by CCAVENUES



	foreach ($_POST as $key => $value){

		$merchant_data.=$key.'='.$value.'&';

	}



	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.





?>



<br><br><br><br>

<!-- <form method="post" name="redirect" id="form" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->

<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">

<?php

echo "<input type=hidden name=encRequest value=$encrypted_data>";

echo "<input type=hidden name=access_code value=$access_code>";





?>

<!-- <input type="submit" name="submit" value="Proceed To Pay" class="btn btn-danger"> -->

<script language='javascript'>document.redirect.submit();</script>


</form>

<br><br><br><br>



<?php include('footer.php'); ?>