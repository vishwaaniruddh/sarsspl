<?php	session_start();
//echo '1111';
	
include "config.php";
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) 
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc()) 
		{
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($con3,$str);
	}
	
	//Sanitize the POST values
	/*$login = clean($_POST['uname']);
	$password = clean($_POST['passwd']);*/
	
	$login = $_POST['uname'];
	$password = $_POST['passwd'];
	
	//echo $login;
	
	//Input Validations
	if($login == '')
	{
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') 
	{
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag)
	{
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location:index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM admin_login WHERE username='$login' AND pass='$password' and status=1";
	$result=mysqli_query($con3,$qry);
	//Check whether the query was successful or not
	if($result)
	{
		if(mysqli_num_rows($result) == 1)
		 {
		     
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			//$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			//$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			//$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			
			$_SESSION['SESS_USER_NAME'] = $member['id'];
			$_SESSION['designation'] = $member['designation'];
			$_SESSION['id']="0";
			$_SESSION['permission'] = $member['permission'];
			/* Ruchi */
			$_SESSION['email'] = $member['email'];
			
			$curr_dt=date('Y-m-d H:i:s');
			$subAdminWork=mysqli_query($con3,"insert into audit_log (user_id,action,description,date_time)values('".$member['id']."','Login','Login','".$curr_dt."') ");
			
			$lastSubId=mysqli_insert_id($con3);
			
			
			$subAdminWorkupdate=mysqli_query($con3,"update audit_log set srid='".$lastSubId."' where   id='".$lastSubId."' ");
		
			
			$_SESSION['lastSubID']=$lastSubId;
		
			session_write_close();
// 			header("location:admin.php"); 
			
			 echo "<script>window.location.href='admin.php';</script>";
			 
			///echo "hiii//";
			exit();
		}
		else 
		{
			//echo "Login failed";
// 			header("location: login_failed.php");
			echo "<script>window.location.href='login_failed.php';</script>";
			exit();
		}
	}
	else
	{
		die("Query failed");
	}
?>