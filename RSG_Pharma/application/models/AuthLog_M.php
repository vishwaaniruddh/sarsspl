<?php
class AuthLog_M extends CI_Model{

	// public function __contructor()
	// {
	// 	parent::__constructor();
		

	// }
	 
	public function CheckUser($U_Id)
	{	
		$sql = "SELECT * FROM `phppos_employees` WHERE `username` = ?";
        $query=$this->db->query($sql,$U_Id);
        return $row = $query->num_rows();
	}

	public function getuserDetails($U_Id)
	{	
		$sql = "SELECT * FROM `phppos_employees` WHERE `username` = ?";
        $query=$this->db->query($sql,$U_Id);
        return $row = $query->row();
	}

	public function User_act($massage)
	{
		$agent = $this->agent->browser().' '.$this->agent->version().' ( IP-Address:-'.$this->input->ip_address().')';
		date_default_timezone_set('Asia/Kolkata');
		$logintime =  date('d-m-Y h:i a');
		$User_Id = $this->session->LogAdminId;
		$logindata = array(
			'user_id' => $User_Id,
			'user_details' => $agent,
			'time' => $logintime,
			'message' => $massage, );
		$this->db->insert('User_Activity',$logindata);
		return true;
	}

	
	
}
?>
