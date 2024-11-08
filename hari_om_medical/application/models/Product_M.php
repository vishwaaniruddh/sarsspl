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
	 
	 function getallproductdetails($itemid){
	   //  $sql = "select * from phppos_items order by item_id asc ";
	   //  $query=$this->db->query($sql);
	   //  $item_id = $query['item_id'];
	     $expiryQuery = "select expiry_date from phppos_purchase_details where item_id = '".$item_id."'  ";
	     $Expquery=$this->db->query($expiryQuery);
	     return $row = $Expquery->row();
	 }
        
        
    function getproduct_purchase($pro){
        $sql = "select * from phppos_purchase where item_id = '".$itemid."' ";
        $query = $this->db->query($sql);
        return $row = $query->row();
    }
	 
	 function getcompanyname($suppid){
	     $sql = "select company_name from phppos_suppliers where person_id = '".$suppid."' ";
	     $query = $this->db->query($sql);
	     return $row = $query->result();
	 }
	
	function getproductpurchasequantity($pro){
// 	    $sql="SELECT * FROM `phppos_items` WHERE item_id ='".$pro."'";
// 	 	$query=$this->db->query($sql);
// 	 	 $row = $query->result();
// 	 	 $itemid = $row['item_id'];
	 	 $sql2 = "select sum(qty) as qty from `phppos_purchase_details` where item_id = '".$pro."' ";
	 	 $query2=$this->db->query($sql2);
	    return $row = $query2->result();
	 	 
	}
	
	function getsupplierproductquantity($pro){
	   $sql="SELECT * FROM `phppos_items` WHERE item_id ='".$pro."'";
	 	$query=$this->db->query($sql);
	 	 $row = $query->row();
	 	 $itemid = $row-> $row = $query->row();
	 	 $sql2 = "select sum(qty) from `Customers_sales_details` where item_id = '".$itemid."' ";
	 	 $query2=$this->db->query($sql2);
	    return $row2 = $query2->row();
	}




	
	
}
?>
