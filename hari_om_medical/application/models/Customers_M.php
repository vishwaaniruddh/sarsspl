<?php
class Customers_M extends CI_Model{

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
					$this->db->insert('phppos_customers',$supplier_data);
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
				$this->db->update('phppos_customers',$supplier_data);
					return 1;
				}
				return 1;

		}
		return 0;
	}
	public function DeleteCustomer($person_id)
	{	
		if($person_id!='')
		{
			
				$this->db->where('person_id', $person_id);
               $delete= $this->db->delete('phppos_customers');
               if ($delete) {
               	$this->db->where('person_id', $person_id);
                $delete= $this->db->delete('phppos_people');
                return 1;
               }
               else
               {
				return 0;
               }
		}
		return 0;
	}


	function get_supplier_deatils($person_id)
	{
		$sql = "SELECT * FROM phppos_customers WHERE person_id='".$person_id."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->row();


	}

	function getbatch($item_id)
	{
		$sql = "SELECT * FROM `phppos_purchase_details` WHERE item_id='".$item_id."' and qty !='0' order by expiry_date asc";
	        $query=$this->db->query($sql);
	        return $row = $query->result();
	}

	function getExpiry($item_id,$batchno)
	{
		$sql = "SELECT * FROM `phppos_purchase_details` WHERE item_id='".$item_id."' AND batch_no='".$batchno."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->row();
	}

	function getall_customers_deatils($person_id)
	{
		$sql = "SELECT phppos_customers.*,phppos_people.* FROM phppos_customers LEFT JOIN phppos_people ON phppos_customers.person_id = phppos_people.person_id WHERE phppos_people.person_id='".$person_id."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->row();

	}
	



	public function get_customers()
	{	
		$sql = "SELECT phppos_customers.*,phppos_people.* FROM phppos_customers LEFT JOIN phppos_people ON phppos_customers.person_id = phppos_people.person_id";
        $query=$this->db->query($sql);
        return $row = $query->result();
	}
	
	
	public function get_customersbyid($id)
	{	
		$sql = "SELECT * FROM `phppos_customers` WHERE person_id='".$id."'";
        $query=$this->db->query($sql);
        return $row = $query->row();
	}
	public function getproduct($id)
	{	
		$sql = "SELECT * FROM `phppos_items` WHERE item_id='".$id."'";
        $query=$this->db->query($sql);
        return $row = $query->row();
	}

	public function getcustomerdata($person_id)
	{	
		$sql = "SELECT * FROM `phppos_people` WHERE person_id='".$person_id."'";
        $query=$this->db->query($sql);
        $row = $query->row();
        return $row;
	}

	public function get_billno()
	{	
		$sql = "SELECT * FROM `Customers_sales`";
        $query=$this->db->query($sql);
        $row = $query->num_rows();
        return $row+1;
	}
	
	public function get_billno_test()
	{	
		$sql = "SELECT * FROM `Customers_sales_test`";
        $query=$this->db->query($sql);
        $row = $query->num_rows();
        return $row+1;
	}

	function get_all_sales()
	{
		$sql="SELECT * FROM Customers_sales order by pur_id DESC";
		$query= $this->db->query($sql);
		return $row = $query->result();
	}

	function get_all_sales_two()
	{
		$sql="SELECT * FROM Customers_sales WHERE sale_type='1' order by pur_id DESC";
		$query= $this->db->query($sql);
		return $row = $query->result();
	}

	function getbill_details($billid)
	{
		$sql="SELECT * FROM Customers_sales WHERE pur_id ='".$billid."'";
		$query= $this->db->query($sql);
		return $row = $query->row();

	}

	function getbill_product($billid)
	{
	$sql = "SELECT Customers_sales_details.*,phppos_items.* FROM Customers_sales_details LEFT JOIN phppos_items ON Customers_sales_details.item_id = phppos_items.item_id WHERE Customers_sales_details.pur_id='".$billid."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->result();
 

	}
	
	function getmrp($itemid,$batchno){
        $sql="SELECT price,rate,gst FROM phppos_purchase_details WHERE item_id ='".$itemid."' and batch_no='".$batchno."'";
		$query= $this->db->query($sql);
		return $row = $query->row();

    }

	function GetBillAjex($cust_id,$start,$end,$bill_type)
	{

		 $this->db->select('*');
         $this->db->from('Customers_sales');

		if ($cust_id!='All') {
			$this->db->where('cust_id', $cust_id);  			
		}

		if ($bill_type==0) {		
		$this->db->where('outstanding >=', '1');  				
		}
		else if($bill_type==1)
		{
         $this->db->where('outstanding <=', '0');  				
		}

		if ($end!=''&& $start!='') {
			$first_date=date('Y-m-d',strtotime($start));
			$second_date=date('Y-m-d',strtotime($end));

			$this->db->where('date >=', $first_date);
            $this->db->where('date <=', $second_date);
		}
		 $query = $this->db->get();
		 return $row = $query->result();

	}
	
    function get_docname($refid){
        $sql = "select first_name,last_name from phppos_doctors where person_id ='".$refid."' ";
        $query=$this->db->query($sql);
    	return $row = $query->result();
    }
    
    
    /*View Bill Test*/

	function getall_customers_deatils_test($person_id)
	{
		$sql = "SELECT phppos_customers.*,phppos_people.* FROM phppos_customers LEFT JOIN phppos_people ON phppos_customers.person_id = phppos_people.person_id WHERE phppos_people.person_id='".$person_id."' ";
	        $query=$this->db->query($sql);
	        return $row = $query->row();

	}
	
	function GetBillAjex_test($cust_id,$start,$end,$bill_type)
	{

		 $this->db->select('*');
         $this->db->from('Customers_sales');

		if ($cust_id!='All') {
			$this->db->where('cust_id', $cust_id);  			
		}

		if ($bill_type==0) {		
		$this->db->where('pay_status = ', '0');  				
		}
		else if($bill_type==1)
		{
         $this->db->where('pay_status =', '1');  				
		}

		if ($end!=''&& $start!='') {
			$first_date=date('Y-m-d',strtotime($start));
			$second_date=date('Y-m-d',strtotime($end));

			$this->db->where('date >=', $first_date);
            $this->db->where('date <=', $second_date);
		}
		 $query = $this->db->get();
		 return $row = $query->result();

	}
	
	function checkquantity($proid){
	    $sql = "SELECT item_id,qty FROM phppos_items WHERE item_id = '".$proid."' ";
	     $query=$this->db->query($sql);
    // 	 $row = $query->result();
    // 	 return $row;
    	 
    	 
    	 if ($query) {
            $row = $query->result();
            $response = array('item_id' => $row['item_id'], 'qty' => $row['qty']);
            return json_encode($response);
        } else {
            // Handle the error case
            return json_encode(array('error' => 'Unable to fetch quantity.'));
        }
	}

	
	
}
?>
