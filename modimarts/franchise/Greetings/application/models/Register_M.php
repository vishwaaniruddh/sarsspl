<?php
class Register_M extends CI_Model{

	// public function __contructor()
	// {
	// 	parent::__constructor();
		

	// }
	 
	public function CheckUser($U_Id)
	{	
		$sql = "SELECT * FROM `customer_promotion` WHERE `mobile_number` = ?";
        $query=$this->db->query($sql,$U_Id);
        return $row = $query->num_rows();
	} 

	public function Checknoofref($refcode)
	{	
		$sql = "SELECT  customer_id FROM `customer_promotion` where refcode=?";
        $query=$this->db->query($sql,$refcode);
        return $row = $query->num_rows();
	}
	public function refdetails($refcode)
	{	
		$sql = "SELECT * FROM `greetings_referral_code` WHERE code=? AND status='1'";
        $query=$this->db->query($sql,$refcode);
        return $row = $query->row();
	}

	public function getuserDetails($U_Id)
	{	
		$sql = "SELECT * FROM `customer_promotion` WHERE `mobile_number` = ?";
        $query=$this->db->query($sql,$U_Id);
        return $row = $query->row();
	}	
	
	public function getsessionDetails($userid)
	{	
		$sql = "SELECT * FROM `customer_promotion_session` WHERE `user_id` = ?";
        $query=$this->db->query($sql,$userid);
        return $row = $query->row();
	}
	
	public function getsessioncount($userid)
	{	
		$sql = "SELECT * FROM `customer_promotion_session` WHERE `user_id` = ?";
        $query=$this->db->query($sql,$userid);
        return $row = $query->num_rows();
	}

	public function getCountry($id='')
	{	
	    if($id!=''){
		$sql = "SELECT * FROM `new_country` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
	    }
	    else
	    {
	    $sql = "SELECT * FROM `new_country`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getZone($id='')
	{	
	    if($id!=''){
		$sql = "SELECT * FROM `new_zone` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_zone`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getstate($id='')
	{	
	
        if($id!=''){
		$sql = "SELECT * FROM `new_state` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_state`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getdivision($id='')
	{	
        if($id!=''){
		$sql = "SELECT * FROM `new_division` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_division`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getdistrict($id='')
	{	
        if($id!=''){
		$sql = "SELECT * FROM `new_district` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_district`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function gettaluka($id='')
	{	
        if($id!=''){
		$sql = "SELECT * FROM `new_taluka` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_taluka`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getpincode($id='')
	{	
        if($id!=''){
		$sql = "SELECT * FROM `new_pincode` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_pincode`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getvillage($id='')
	{	
	
        if($id!=''){
		$sql = "SELECT * FROM `new_village` WHERE `id` = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
     	}
	    else
	    {
	    $sql = "SELECT * FROM `new_village`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	        
	    }
	}
	
	public function getuserDeta($U_Id)
	{	
		$sql = "SELECT * FROM `customer_promotion` WHERE `customer_id` = ?";
        $query=$this->db->query($sql,$U_Id);
        return $row = $query->row();
	}

	



	public function User_act($massage)
	{
		$agent = $this->agent->browser().' '.$this->agent->version().' ( IP-Address:-'.$this->input->ip_address().')';
		date_default_timezone_set('Asia/Kolkata');
		$logintime =  date('d-m-Y h:i a');
		$User_Id = $this->session->LoggedUserId;
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
