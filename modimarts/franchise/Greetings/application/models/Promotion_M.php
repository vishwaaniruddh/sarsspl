<?php
class Promotion_M extends CI_Model{

	 
	public function CheckPromotion($id=null)
	{	
		if($id!='')
		{
         $sql = "SELECT * FROM `promotions` WHERE `status` = '1' AND type='2' AND id='".$id."'";
		}
		else
		{
			$sql = "SELECT * FROM `promotions` WHERE `status` = '1' AND type='2'";
		}
		
        $query=$this->db->query($sql);
        return $row = $query->result();
	}

	public function promotion_images($promotion)
	{	
		$sql = "SELECT * FROM `total_promotions` WHERE `promotion` = ?";
        $query=$this->db->query($sql,$promotion);
        return $row = $query->result();
	}

	public function getallgreetings()
	{	
		$sql = "SELECT * FROM `total_promotions` WHERE `status` = '1'";
        $query=$this->db->query($sql);
        return $row = $query->result();
	}
	
	public function getdownloadimagecountbyUserid($userid)
	{	
		$sql = "SELECT * FROM `greeting_download_count` WHERE `user_id` = ?";
        $query=$this->db->query($sql,$userid);
        return $row = $query->result();
	}
	

// 	public function getImgId($id)
// 	{	
// 		$sql = "SELECT * FROM `total_promotions` WHERE `id` = ?";
//         $query=$this->db->query($sql,$id);
//         return $row = $query->row();
// 	}
	
	public function getImgId($id)
	{	
		$sql = "SELECT tp.*,p.* FROM `total_promotions` as tp LEFT JOIN promotions as p ON tp.promotion=p.id  WHERE tp.id = ?";
        $query=$this->db->query($sql,$id);
        return $row = $query->row();
	}
	
	public function getdaysimg($proid,$limit)
	{	
	    $lim1=$limit-1;
	    
	    
		$sql = "SELECT * FROM `total_promotions` WHERE `promotion` = ? ORDER BY `total_promotions`.`id`  ASC LIMIT $lim1,1";
        $query=$this->db->query($sql,$proid);
        return $row = $query->result();
	}

	public function getlanguage($id=null)
	{
	   if($id!='')
	   {
        $sql = "SELECT * FROM `language` WHERE id='".$id."'";
         $query=$this->db->query($sql);
        return $row = $query->row();
	   }
	   else
	   {
	   	$sql = "SELECT * FROM `language` ORDER BY `language`.`order_in` ASC";
	   	 $query=$this->db->query($sql);
        return $row = $query->result();
	   }	
		
       
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
