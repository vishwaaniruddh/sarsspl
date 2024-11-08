<?php
class Settings_M extends CI_Model{

	public function __contructor()
	{
		parent::__constructor();		

	}
	 




	function getSettingdetails($id)
	{
		$sql = "SELECT * FROM `web_setting` WHERE setting_id='".$id."'";
	        $query=$this->db->query($sql);
	        return $row = $query->row();

	}
	
	function getSchemedetails()
	{
		$sql = "SELECT * FROM `Scheme`";
	        $query=$this->db->query($sql);
	        return $row = $query->result();
	}

	




	
	
}
?>
