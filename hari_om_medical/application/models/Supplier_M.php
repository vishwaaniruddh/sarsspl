<?php
class Supplier_M extends CI_Model{

	public function __contructor()
	{
		parent::__constructor();
		$db2 = $this->load->database('database2', TRUE);
		

	}
	 
	

	public function Save($person_data,$supplier_data)
	{	
		if($person_data!='')
		{
			$sql="SELECT * FROM `phppos_people` WHERE first_name='".$person_data['first_name']."' AND last_name='".$person_data['last_name']."' AND phone_number='".$person_data['phone_number']."'";
			$query=$this->db->query($sql);
            $count = $query->num_rows();
            if($count>0)
            {
            	return 2;

            }
            else
            {
				$this->db->insert('phppos_people',$person_data);
				$person_id=$this->db->insert_id();
				if($supplier_data!='')
				{
					$supplier_data['person_id'] = $person_id;
					$this->db->insert('phppos_suppliers',$supplier_data);
					return 1;
				}
				return 1;
		    }

		}
		return 0;
	}

	public function Update($person_data,$supplier_data)
	{	
		if($person_data!='')
		{
			
				$this->db->where('person_id',$person_data['person_id']);
				$this->db->update('phppos_people',$person_data);
				if($supplier_data!='')
				{
					
					$this->db->where('person_id',$person_data['person_id']);
				$this->db->update('phppos_suppliers',$supplier_data);
					return 1;
				}
				return 1;

		}
		return 0;
	}

	function get_supplier_deatils($person_id)
	{
		$sql = "SELECT * FROM phppos_suppliers WHERE person_id='".$person_id."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->row();


	}
	
	

	function getall_supplier_deatils($person_id)
	{
		$sql = "SELECT phppos_suppliers.*,phppos_people.* FROM phppos_suppliers LEFT JOIN phppos_people ON phppos_suppliers.person_id = phppos_people.person_id WHERE phppos_people.person_id='".$person_id."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->row();

	}

	function get_all_bills()
	{
		$sql="SELECT * FROM phppos_purchase ORDER BY `phppos_purchase`.`pur_id` DESC";
		$query= $this->db->query($sql);
		return $row = $query->result();
	}

	function getbill_details($billid)
	{
		$sql="SELECT * FROM phppos_purchase WHERE pur_id ='".$billid."'";
		$query= $this->db->query($sql);
		return $row = $query->row();

	}

	function getbill_product($billid)
	{
	$sql = "SELECT phppos_purchase_details.*,phppos_items.* FROM phppos_purchase_details LEFT JOIN phppos_items ON phppos_purchase_details.item_id = phppos_items.item_id WHERE phppos_purchase_details.pur_id='".$billid."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->result();
 

	}
	




	
	
}
?>
