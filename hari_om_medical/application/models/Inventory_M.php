<?php
class Inventory_M extends CI_Model{

	public function __contructor()
	{
		parent::__constructor();
		$db2 = $this->load->database('database2', TRUE);
		

	}
	 
	function getproductStock()
	{
		$sql="SELECT * FROM `product_stock`";
		$query=$this->db->query($sql);
		return $row=$query->result();
	}
	function getproductname($item_number)
	{
		$sql="SELECT * FROM `phppos_items` WHERE item_number='".$item_number."'";
		$query=$this->db->query($sql);
		return $row=$query->row();
	}

	function getproductcat($cat_id)
	{
		// $db2 = $this->load->database('database2', TRUE);
		// $sql="SELECT name FROM `main_cat` WHERE id='".$cat_id."'";
		// $query=$db2->query($sql);
		// return $row=$query->row();
		return array();
	}
	
}
?>
