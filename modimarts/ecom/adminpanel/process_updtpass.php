<?php
session_start();
include ('config.php');
try {


$id =$_SESSION['SESS_USER_NAME'];

//$un = $_SESSION['adminuser'];

$cnfpass = $_POST['cnfpass'];
$newpass = $_POST['newpass'];
$oldpass = $_POST['oldpass'];
// echo $oldpass ;

$error=0;
$er=0;
	mysql_query('BEGIN');					   

	//	$sql = mysql_query("select pass from admin_login where id=1 and designation=0");
	$sql = mysql_query("select pass from admin_login where id='".$id."' ");

//		 echo("one");

         if($row = mysql_fetch_array($sql))				  

            {		// echo("two");



	 if($row[0] == $oldpass )

                     {

	     $sql1 = mysql_query("update admin_login set pass='".$newpass."' where  id='".$id."' ");

                          if(!$sql1)

	           {
	               
	               ECHO mysql_error();
$error++;
	             
	           }else{

	$er=1;
}
                      }

	 else{
	     
	     $er=5;
	 }

	    

			  

					// echo("three");

             }
if($error==0)
{
mysql_query('COMMIT');
echo $er;
//echo "er".$error;
}
else
{

mysql_query('ROLLBACK');
echo 2;
}
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
				

?>

				

