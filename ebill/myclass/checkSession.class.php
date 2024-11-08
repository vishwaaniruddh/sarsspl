<?php
Class CheckLogin
{
	private $user;
	private $pwd;
	 private $errors;
	 public function __construct()
	 {
		 $this->errors=array();
		 $this->user=$this->Filter($_POST['uname']);
		 $this->pwd=$_POST['password'];
	 }
	 
	 public function Filter($var)
	{
	return preg_replace('/[^a-zA-Z0-9@.]$/','',$var);
	}
	 
	 public function Process($con)
	 {
		 if($this->ValidData())
		{
	$this->logchk($con);
		
		}
		
				return count($this->errors)?0:1;
	 }
	 public function ShowErrors()
	 {
		 echo "<h3>Errors :</h3><div class='error' align='center' style='display:block; color:red'>";
		 foreach($this->errors as $values=>$value)
			 echo $value."<br>";
			 
			 echo "</div>";
	 }
	 public function logchk($con)
	 {
		// include("config.php");
		 //echo "select * from login where username='$this->user' and password='$this->pwd' and status=1 ";
		 //$result = mysqli_query("select * from login where username='$this->user' and password='$this->pwd' and status=1 and designation<8 or designation=13");
		//$result = mysqli_query("select * from login where username='$this->user' and password='$this->pwd' and status=1 and (designation < 8 or designation=13 or designation=20 or designation=21 or designation=30 or designation=31)");
$result = mysqli_query($con,"select * from login where username='$this->user' and password='$this->pwd' and status=1 and designation>0");

if(mysqli_num_rows($result)>0)
   {
   //echo "hi";
   $row=mysqli_fetch_row($result);   
   session_start();
   $_SESSION['user']=$row[1];

   if($row[3]=='')
   $_SESSION['branch']="all";
   else
   $_SESSION['branch']=$row[3];
   
   if($row[4]=='')
   $_SESSION['designation']='all';
   else
   $_SESSION['designation']=$row[4]; 
  
  if($row[7]=='')
   $_SESSION['custid']='all';
   else
   $_SESSION['custid']=$row[7]; 
   
   if($row[8]=='')
   $_SESSION['dept']='all';
   else
   $_SESSION['dept']=$row[8]; 
   
   if($row[6]=='')
   $_SESSION['serviceauth']='all';
   else
   $_SESSION['serviceauth']=$row[6];
  
   }
else
 
$this->errors[]="Invalid Login";
	 }
	 
	 public function ValidData()
	 {
		 if(empty($this->user) || empty($this->pwd))
		 $this->errors[]="All fields are compulsory";
		
		
		 return count($this->errors)?0:1;
	 }
}

?>