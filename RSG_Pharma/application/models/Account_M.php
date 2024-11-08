<?php
class Account_M extends CI_Model{

	public function __contructor()
	{
		parent::__constructor();
		

	}
	 
	public function productsearch($search)
	{	
		$query=$this->db->query("SELECT * FROM `phppos_items` WHERE `name` LIKE '%".$search."%'");
		return $row=$query->result();


	}

	public function productdetails($search)
	{	
// 		$query=$this->db->query("SELECT * FROM `phppos_items` WHERE `item_id` ='".$search."'");
		$sql = "SELECT * FROM `phppos_items` WHERE `item_id` ='".$search."'";
		$query=$this->db->query($sql);
		return $row=$query->row();

	}

	public function get_suppliers()
	{	
		$sql = "SELECT * FROM `phppos_suppliers`";
        $query=$this->db->query($sql);
        return $row = $query->result();
	}

		public function getstatelist()
	{	
		
		$sql = "SELECT * FROM `states` ORDER BY state_name ASC";
        $query=$this->db->query($sql);
        return $row = $query->result();
	}
	
	public function getsupplier($id)
	{	
		$sql = "SELECT * FROM `phppos_suppliers` WHERE person_id='".$id."'";
        $query=$this->db->query($sql);
        return $row = $query->row();
	}

	public function get_billno()
	{	
		$sql = "SELECT * FROM `phppos_purchase`";
        $query=$this->db->query($sql);
        $row = $query->num_rows();
        return $row+1;
	}

	public function getallsupplierbills()
	{	
		$sql = "SELECT * FROM `phppos_purchase`";
        $query=$this->db->query($sql);
        $row = $query->num_rows();
        return $row+1;
	}
	public function getsupplierdata($person_id)
	{	
		$sql = "SELECT * FROM `phppos_people` WHERE person_id='".$person_id."'";
        $query=$this->db->query($sql);
        $row = $query->row();
        return $row;
	}


	
	
}
?>
