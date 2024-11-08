<?php
class Returns_M extends CI_Model
{

public function get_invoice($invoice)
{
	$query=$this->db->query("SELECT * FROM `Customers_sales` WHERE `bill_id` LIKE '%".trim($invoice)."%'");
	return $row=$query->result();
}

public function get_suppliers($suppname)
{
	$query=$this->db->query("SELECT * FROM `phppos_suppliers` WHERE `company_name` LIKE '%".trim($suppname)."%'");
	return $row=$query->result();
}

public function supplier_bill($supp_id)
	{	
		$query=$this->db->query("SELECT * FROM `phppos_purchase` WHERE `supp_id` ='".$supp_id."'");
		return $row=$query->row();

	}

public	function getSUpplierbill_details($supp_id)
	{
		$sql="SELECT * FROM phppos_purchase WHERE supp_id='".$supp_id."' ORDER BY `phppos_purchase`.`pur_id` DESC";
		$query= $this->db->query($sql);
		return $row = $query->result();
	}

}