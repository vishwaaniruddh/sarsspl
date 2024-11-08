<?php

Class Service

{

	private $cust;

	private $po;

	private $ref;

	private $pcb;

	private $assets;

	private $atm;

	private $prblm;

	private $bank;

	private $area;

	private $pin;

	private $add;

	private $state;

	private $city;

	private $alertdt;

	private $caller;

	private $con;

	private $email;

	private $appby;

	private $cnt;

	private $how;

	private $assid;

	private $type;

	private $crby;

	//private $atm

	

	private $errors;

	

	public function __construct()

	{

		$this->errors=array();

		$this->assets=array();

		$this->pcb=array();

		$this->assid=array();

		$this->atm=$_POST['ref'];

		$this->type=$_POST['type'];

		$this->cust=$_POST['cust'];

		$this->caller=$_POST['cname'];

		$this->con=$_POST['cphone'];

		$this->email=$_POST['cemail'];

		$this->po=$_POST['po'];

		$this->ref=$_POST['ref'];

		$this->prblm=$_POST['prob'];

		 $this->cnt=$_POST['cnt'];

		$this->crby=$_POST['crby'];

		//echo count($_POST['assets'];

		for($i=0;$i<$this->cnt;$i++)

		{

			//echo $_POST['assid'][$i]."<br>";

//echo			$i."- ".$_POST['assets'][$i];

			//echo "asset ".$_POST['pcb'][$i];

			//echo "hello";

			if(isset($_POST['assets'][$i]))

			{

		$this->assets[]=$_POST['assets'][$i];

	 $this->pcb[]=$_POST['pcb'][$i];

	

	$this->assid[]=$_POST['assid'][$i];

			}

		}

		$this->bank=$_POST['bank'];

		$this->area=$_POST['area'];

		$this->state=$_POST['state'];

		$this->city=$_POST['city'];

		//$this->alertdt=$_POST['adate'];

		$this->appby=$_POST['appby'];

		$this->how=$_POST['how'];

		//$this->atm=$_POST['atm'];

		

	}

	

	public function Process()

	{

		if($this->Isvalid() && $this->Execute())

		{

		}mysqli_query($con,

		
mysqli_query($con,
		return(count($this->errors)?0:1);

	}

	

	public function ShowErrors()
mysqli_query($con,
	{
mysqli_query($con,
		foreach($this->errors as $key=>$values)

		echo mysqli_query($con,>";

	}

	

	public function Isvalid()

	{

		$s=0;

		$t=0;

		$s2=0;

		$t2=0;

		if(empty($this->cust))

		$this->errors[]="Please select Your customer";

		if(empty($this->po))

		$this->errors[]="Please Select PO for this customer";

		if(empty($this->ref))

		$this->errors[]="Please Select Reference ID for this PO";

		for($i=0;$i<$this->cnt;$i++)

		{

			

			if(isset($_POST['assets'][$i]))

			{

		if($this->pcb[$i]=='pcb')

		{

			if(empty($this->appby))

				$s=1;

				if(empty($this->how))

				$t=1;

		}

			}

		}

		for($j=0;$j<$this->cnt;$j++)

		{

			

			if(isset($_POST['assets'][$j]))

			{

		$s2=1;

			}

		}

		

		if(empty($this->caller))

		$this->errors[]="Please Enter Caller Name";

		if(empty($this->con))

		$this->errors[]="Please Enter Contact number of caller";

		if(empty($this->email))

		$this->errors[]="Please enter email ID of caller";

		if($s2==0)

		{

	$this->errors[]="Please select atlease 1 asset";

		}

		if($s==1)

		{

	$this->errors[]="Approval by field cannot be left blank";

		}

		if($t==1)

		{

	$this->errors[]="Reference by field cannot be left blank";

		}

		

		

	return (count($this->errors)?0:1);

	}

	

	public function Execute()

	{

		$dt=date("Y-m-d H:m:s");

		//print_r($this->assets);

	//$asst=	explode("####",$this->po);

//	echo $asst[0]."<br>%%<br>".$asst[1]."<br>";

	//echo $this->cust."<br>".$this->po."<br>".count($this->assets)."<br>".$this->assets."<br>";

	//echo "INSERT INTO `satyavan_accounts`.`alert` (`alert_id`, `cust_id`, `bank_name`, `area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`) VALUES (NULL, '".$this->cust."',  '".$this->bank."', '".$this->area."', '".$this->add."', '".$this->city."', '".$this->state."', '".$this->pin."', '".$this->prblm."', '".$dt."', '".$this->alertdt."', '".$this->caller."', '".$this->con."', '".$this->email."', 'Pending', 'Pending', 'service', '', '', '".$asst[0]."', '".$asst[1]."', '".$this->appby."', '".$this->how."')";

	$sql = mysqli_query($con,"INSERT INTO `satyavan_accounts`.`alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`) VALUES (NULL, '".$this->cust."','".$this->atm."' , '".$this->bank."', '".$this->area."', '".$this->add."', '".$this->city."', '".$this->state."', '".$this->pin."', '".$this->prblm."', '".$dt."', '".$this->alertdt."', '".$this->caller."', '".$this->con."', '".$this->email."', 'Pending', 'Pending', 'service', '', '', '".$this->po."','".$this->type."', '".$this->appby."', '".$this->how."')");

	// 	 	echo count($this->assets);

	$row=mysqli_insert_id();

	$qry4=mysqli_query($con,"Update alert_id set createdby='".$this->crby."_".$row."' where alert_id='".$row."'");

	if(!$sql)

	echo "failed".mysqli_error();

	for($i=0;$i<count($this->assid);$i++)

		{

			//echo "select * from assets_specification where ass_spc_id='".$this->assid[$i]."'";

			if($this->assid[$i]!="")

			{

			$qry2=mysqli_query($con,"select * from assets_specification where ass_spc_id='".$this->assid[$i]."'");

				$row2=mysqli_fetch_row($qry2);

				$qry3=mysqli_query($con,"Select * from assets where assets_id='".$row2[1]."'");

				$row3=mysqli_fetch_row($qry3);

				$assets=$row3[1]." (".$row2[2].")";

		$qry=mysqli_query($con,"Insert into alert_assets(`alert_id`,`po`,`assets`,`qty`) Values('".$row."','".$asst[0]."','".$assets."','1')");

		if(!$qry)

		echo "Failed".mysqli_error();

			}

		}

	}

	

}

?>