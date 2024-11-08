<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->checkLogin();
        $this->load->model('Account_M');
        $this->load->model('Supplier_M');
        $this->load->model('Payment_M');
    }

    public function checkLogin()
    {
        $User_Id = $this->session->LogAdminId;
        if ($User_Id) {
            echo "";
        } else {
            if ($this->uri->uri_string()) {
                $reffurl = base_url($this->uri->uri_string());
            } else {
                $reffurl = base_url();
            }

            $stflash = array(
                'type'         => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
                'Show'         => 'Please Login First',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Login?redirecturl=' . urlencode($reffurl)));
        }
    }

    public function index()
    {
        $data['Payment_details'] = $this->Payment_M->getpurchasepayment();
        $data['title']           = "Home :Account";
        $data['connect']         = "Payment/View_Bills";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function Paybill($billid)
    {
        $Bill_Details         = $this->Payment_M->Bill_Details($billid);
        $data['Bill_Details'] = $Bill_Details;
        $data['supplier']     = $this->Account_M->getsupplier($Bill_Details->supp_id);
        $data['bank_details'] = $this->Payment_M->get_accountdetails();
        $data['title']        = "Home :Account";
        $data['connect']      = "Payment/Paybill";
        $this->load->view("partials/Dash_connect", $data);

    }

    public function CreateTransaction()
    {

        $pur_id       = $this->input->post('pur_id', true);
        $suppliername = $this->input->post('suppliername', true);
        $paymentmode  = $this->input->post('paymentmode', true);
        $fromaccount  = $this->input->post('fromaccount', true);
        $paydate      = $this->input->post('paydate', true);
        $paydate      = date("Y-m-d", strtotime($paydate));
        $payamount    = $this->input->post('payamount', true);
        if ($pur_id != '') {
            $purchase = $this->Payment_M->Bill_Details($pur_id);
            $flag     = 0;

            if ($purchase->outstanding <= $payamount) {
                $purchase_payment = array(
                    'bill_no'   => $pur_id,
                    'mode'      => $paymentmode,
                    'amt'       => $payamount,
                    'paid_date' => $paydate,
                );
                $paysuccess = $this->db->insert('phppos_purchase_payments', $purchase_payment);
                if ($paysuccess) {
                    $uppurchase = array(
                        'outstanding' => 0,
                    );
                    $this->db->where('pur_id', $pur_id);
                    $this->db->update('phppos_purchase', $uppurchase);
                } else {
                    $flag = 1;
                }

            } else if ($purchase->outstanding > $payamount) {
                $purchase_payment = array(
                    'bill_no'   => $pur_id,
                    'mode'      => $paymentmode,
                    'amt'       => $payamount,
                    'paid_date' => $paydate,
                );
                $paysuccess = $this->db->insert('phppos_purchase_payments', $purchase_payment);
                if ($paysuccess) {
                    $remainbal  = $purchase->outstanding - $payamount;
                    $uppurchase = array(
                        'outstanding' => $remainbal,
                    );
                    $this->db->where('pur_id', $pur_id);
                    $this->db->update('phppos_purchase', $uppurchase);
                } else {
                    $flag = 1;
                }

            }

            if ($flag != '1') {
                $memo     = "payment for supplier " . $suppliername;
                $banktran = array(
                    'bank_id'    => $fromaccount,
                    'trans_type' => "Payment",
                    'trans_amt'  => $payamount,
                    'trans_date' => $paydate,
                    'trans_memo' => $memo,
                    'reconcile'  => "NO",
                    'enrty_date' => $paydate,
                );
                $this->db->insert('bank_transaction', $banktran);

                $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Supplier Payment Paid Successfully!</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Supplier/Bill_details/' . $pur_id));
            } else {

                $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Supplier Payment Not Addedd !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Supplier/Paybill/' . $pur_id));
            }
        } else {

            $stflash = array(
                'type'         => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-warning">Payment Id Not Exist !</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Supplier/View_Bill'));

        }
    }

    public function Addbank()
    {

        if (isset($_POST['accountno'])) {

            $accountno  = $this->input->post('accountno', true);
            $bankname   = $this->input->post('bankname', true);
            $accounttyp = $this->input->post('accounttyp', true);
            $ifsccode   = $this->input->post('ifsccode', true);
            $bankadd    = $this->input->post('bankadd', true);
            $openbal    = $this->input->post('openbal', true);
            $t_day      = date('Y-m-d h:i:s a');

            $bankadd = array(
                'bank_name' => $bankname,
                'ac_no'     => $accountno,
                'address'   => $bankadd,
                'ac_type'   => $accounttyp,
                'overdraft' => $openbal,
            );

            $bankadd   = $this->db->insert('banks', $bankadd);
            $lastbnkid = $this->db->insert_id();

            $AddTxn = array(
                'bank_id'    => $lastbnkid,
                'trans_type' => 'receit',
                'trans_amt'  => $openbal,
                'trans_date' => $t_day,
                'trans_memo' => 'opening Balance',
                'reconcile'  => 'NO',
            );
            $this->db->insert('bank_transaction', $AddTxn);

            $stflash = array(
                'type'         => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-success">Bank Added Successfully!</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Bank/View'));

        } else {

            $data['title']   = "Home :Account";
            $data['connect'] = "Payment/Addbank";
            $this->load->view("partials/Dash_connect", $data);
        }
    }

    public function View_Bill($billid)
    {

        $PaymentDetails         = $this->Payment_M->getPaymentdetails($billid);
        $data['suppliername']   = $this->Payment_M->getsupplierdata($PaymentDetails->bill_no);
        $data['PaymentDetails'] = $PaymentDetails;

        $data['title']   = "Home :Account";
        $data['connect'] = "Payment/View_Invoice";
        $this->load->view("partials/Dash_connect", $data);

    }

    public function ViewBank()
    {
        $data['Banks']   = $this->Payment_M->get_accountdetails();
        $data['title']   = "Home :Account";
        $data['connect'] = "Payment/ViewBank";
        $this->load->view("partials/Dash_connect", $data);

    }

    public function ViewBankTransection()
    {
    	$bank_id=$this->input->post('bank_id',True);
    	if(isset($bank_id))
    	{
    		$bank_id=$this->input->post('bank_id',True);
    		$start=$this->input->post('start',True);
    		$end=$this->input->post('end',True);

    	$data['Payment_details'] = $this->Payment_M->getbanktransectionbydate($bank_id,$start,$end);
        $data['Banks']           = $this->Payment_M->get_accountdetails();
        $data['title']           = "Home :Account";
        $data['connect']         = "Payment/ViewBankTransection";
        $this->load->view("partials/Dash_connect", $data);

    	}
    	else
    	{
    	$data['Payment_details'] = $this->Payment_M->getbanktransection();
        $data['Banks']           = $this->Payment_M->get_accountdetails();
        $data['title']           = "Home :Account";
        $data['connect']         = "Payment/ViewBankTransection";
        $this->load->view("partials/Dash_connect", $data);

    	}
        

    }

    public function AddBankTransection()
    {
        $AddTxn = $this->input->post('AddTxn', true);
        if (isset($AddTxn)) {
            $trans_type = $this->input->post('trans_type', true);
            $bank_id    = $this->input->post('bank_id', true);
            $bank_id1   = $this->input->post('bank_id1', true);
            $count      = $this->input->post('count', true);
            $trans_date = $this->input->post('transdate', true);
            $trans_date = date('Y-m-d', strtotime($trans_date));
            $t_day      = date('Y-m-d h:i:s a');
            $count      = count($_POST['amt']);

            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    // $amount = $this->input->post('amt', true);
                    $amount = $_POST['amt'][$i];
                    // $memo   = $this->input->post('memo', true);
                    $memo = $_POST['memo'][$i];

                    $addtxn = array(
                        'bank_id'    => $bank_id,
                        'trans_type' => $trans_type,
                        'trans_amt'  => $amount,
                        'trans_date' => $trans_date,
                        'trans_memo' => $memo,
                        'reconcile'  => 'NO',
                        'enrty_date' => $t_day,
                    );
                    $ins_Res = $this->db->insert('bank_transaction', $addtxn);
                    if ($ins_Res) {
                        if ($trans_type == "banktrans") {
                            $addrecip = array(
                                'bank_id'    => $bank_id1,
                                'trans_type' => 'receit',
                                'trans_amt'  => $amount,
                                'trans_date' => $trans_date,
                                'trans_memo' => $memo,
                                'reconcile'  => 'NO',
                                'enrty_date' => $t_day,
                            );
                            $recipt_Res = $this->db->insert('bank_transaction', $addtxn);
                        }
                    }
                }

                $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success"> ' . $count . '- Bank Transction Addedd Successfully !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Bank/Transection'));

            } else {
                $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Bank Transction Not Addedd!</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('BankPayment/Entry'));

            }

        } else {

            $data['Payment_details'] = $this->Payment_M->getbanktransection();
            $data['Banks']           = $this->Payment_M->get_accountdetails();
            $data['title']           = "Home :Account";
            $data['connect']         = "Payment/AddBankTransection";
            $this->load->view("partials/Dash_connect", $data);
        }
    }

}
