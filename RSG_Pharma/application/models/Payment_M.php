<?php
class Payment_M extends CI_Model{

	public function __contructor()
	{
		parent::__constructor();
		$db2 = $this->load->database('database2', TRUE);
		

	}
	 
	 function Bill_Details($pur_id)
	 {
	 	$sql="SELECT * FROM `phppos_purchase` WHERE pur_id='".$pur_id."'";
	 	$query=$this->db->query($sql);
	    return $row = $query->row();
	 }

	 function getsupplierdata($billno)
	 {
	 	$sql="SELECT * FROM `phppos_purchase` WHERE pur_id='".$billno."'";
	 	$query=$this->db->query($sql);
	    $row = $query->row();
	    $personid=$row->supp_id;
	    $sql2="SELECT * FROM `phppos_suppliers` WHERE person_id='".$personid."'";
	    $query2=$this->db->query($sql2);
	    return $row2 = $query2->row();

	 	
	 }

	 function get_accountdetails()
	 {
	 	$sql="SELECT * FROM banks ORDER BY `banks`.`bank_name` ASC";
	 	$query=$this->db->query($sql);
	    return $row = $query->result();
	 }

	 function getpurchasepayment()
	 {
	 	$sql="SELECT * FROM phppos_purchase_payments";
	 	$query=$this->db->query($sql);
	    return $row = $query->result();
	 }


	 function getbanktransection()
	 {
	 	$sql="SELECT * FROM bank_transaction ORDER BY `bank_transaction`.`trans_id` DESC LIMIT 0,100";
	 	$query=$this->db->query($sql);
	    $row = $query->result();

	    $query1=$this->db->query("SELECT SUM(trans_amt) as total_credit  FROM bank_transaction WHERE trans_type ='receit'");
		$temp=$query1->row();

	     $row[0]->total_credit=$temp->total_credit;

	       $query2=$this->db->query("SELECT SUM(trans_amt) as total_debit  FROM bank_transaction WHERE  trans_type ='banktrans' OR trans_type ='payment'");
		$temp=$query2->row();

	     $row[0]->total_debit=$temp->total_debit;
	     return $row;
	 }

	 function getbanktransectionbydate($bank_id,$start,$end)
	 {
	 	if($bank_id)
	 	{
	 		$sql="SELECT * FROM bank_transaction WHERE bank_id='".$bank_id."' AND  trans_date BETWEEN '$start' AND '$end'";

	 	$query=$this->db->query($sql);
	     $row = $query->result();

	     $query1=$this->db->query("SELECT SUM(trans_amt) as total_credit  FROM bank_transaction WHERE bank_id='".$bank_id."' AND trans_type ='receit' AND   trans_date BETWEEN '$start' AND '$end'");
		$temp=$query1->row();

	     $row[0]->total_credit=$temp->total_credit;

	       $query2=$this->db->query("SELECT SUM(trans_amt) as total_debit  FROM bank_transaction WHERE bank_id='".$bank_id."' AND trans_type ='banktrans' OR trans_type ='payment' AND   trans_date BETWEEN '$start' AND '$end'");
		$temp=$query2->row();

	     $row[0]->total_debit=$temp->total_debit;

	     

	     return $row;

	 	}
	 	else
	 	{
	 		$sql="SELECT * FROM bank_transaction WHERE trans_date BETWEEN '$start' AND '$end'";
	 	$query=$this->db->query($sql);
	    $row = $query->result();

	    $query1=$this->db->query("SELECT SUM(trans_amt) as total_credit  FROM bank_transaction WHERE trans_type ='receit' AND   trans_date BETWEEN '$start' AND '$end'");
		$temp=$query1->row();

	     $row[0]->total_credit=$temp->total_credit;

	       $query2=$this->db->query("SELECT SUM(trans_amt) as total_debit  FROM bank_transaction WHERE  trans_type ='banktrans' OR trans_type ='payment' AND   trans_date BETWEEN '$start' AND '$end'");
		$temp=$query2->row();

	     $row[0]->total_debit=$temp->total_debit;

	    return $row;

	 	}
	 	
	 }
	 
	 function getPaymentdetails($trans_id)
	 {
	 	$sql="SELECT * FROM phppos_purchase_payments WHERE trans_id='".$trans_id."'";
	 	$query=$this->db->query($sql);
	    return $row = $query->row();
	 }

	

	
	




	
	
}
?>
