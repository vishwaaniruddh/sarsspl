<?php
class Product_M extends CI_Model{

	public function __contructor()
	{
		parent::__constructor();

	}
	 
	 function getcategory()
	 {
	 	$sql="SELECT * FROM `categories`";
	 	$query=$this->db->query($sql);
	    return $row = $query->result();
	 }	

	 function getproduct($pro)
	 {
	 	$sql="SELECT * FROM `phppos_items` WHERE item_id ='".$pro."'";
	 	$query=$this->db->query($sql);
	    return $row = $query->row();
	 }

	 
	




	
	
}
?>
