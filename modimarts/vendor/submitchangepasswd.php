<?php
session_start();
include "config.php";
try {


$id =$_SESSION['id'];

$un = $_SESSION['adminuser'];

$cnfpass = $_POST['cnfpass'];
$newpass = $_POST['newpass'];
$oldpass = $_POST['oldpass'];
// echo $oldpass ;

$error=0;
$er=1;
	mysqli_begin_transaction($con1);					   

//echo "select password from users where id='$id'";
		$sql = mysqli_query($con1,"select password from users where cid='$id'");		

//		 echo("one");

         if($row = mysqli_fetch_array($sql))				  

            {		// echo("two");



	 if($row[0] == $oldpass )

                     {

	     $sql1 = mysqli_query($con1,"update users set password='$newpass' where id='$un'");

                          if(!$sql1)

	           {
	               
	               echo mysqli_error($con1);
$error++;
	             
	           }

	

                      }

	 else{
	     
	     $er=5;
	 }

	    

			  

					// echo("three");

             }
if($error==0)
{
mysqli_commit($con1);
echo $er;
//echo "er".$error;
}
else
{

mysqli_rollback($con1);
echo 2;
}
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
				

?>

				

