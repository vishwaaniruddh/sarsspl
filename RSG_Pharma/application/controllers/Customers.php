<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->checkLogin();
        $this->load->model('Account_M');
        $this->load->model('Customers_M');
        $this->load->model('Payment_M');
        $this->load->model('Settings_M');
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
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
                'Show' => 'Please Login First',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Login?redirecturl=' . urlencode($reffurl)));
        }
    }

    public function ManageCustomers()
    {
        $Customers = array();
        $Customersdata = $this->Customers_M->get_customers();

        foreach ($Customersdata as $key => $cust) {
            $cust->data = $this->Customers_M->getcustomerdata($cust->person_id);
            array_push($Customers, $cust);
        }
        $data['Customers'] = $Customers;
        $data['title'] = "Home :Customers";
        $data['connect'] = "Customers/ManageCustomers";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function AddNewCustomer()
    {
        $data['statelist'] = $this->Account_M->getstatelist();
        $data['title'] = "Home :Customers";
        $data['connect'] = "Customers/AddNewCustomer";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function CreateNewCustomer()
    {

        $companyname = $this->input->post('companyname', true);
        $companyname = ($companyname != '') ? $companyname : '';
        $firstname = $this->input->post('firstname', true);
        $Lastname = $this->input->post('Lastname', true);
        $email = $this->input->post('email', true);
        $birthdate = $this->input->post('birthdate', true);
        $phonenumber = $this->input->post('phonenumber', true);
        $inputAddress = $this->input->post('inputAddress', true);
        $inputAddress2 = $this->input->post('inputAddress2', true);
        $inputCity = $this->input->post('inputCity', true);
        $state = $this->input->post('state', true);
        $inputZip = $this->input->post('inputZip', true);
        $country = $this->input->post('country', true);

        if (isset($_POST['accountno'])) {
            $accountno = $this->input->post('accountno', true);
            $accountno = ($accountno != '') ? $accountno : null;
        } else {
            $accountno = null;
        }

        if (isset($_POST['ifsccode'])) {
            $ifsccode = $this->input->post('ifsccode', true);
            $ifsccode = ($ifsccode != '') ? $ifsccode : null;
        } else {
            $ifsccode = null;
        }

        $pannumber = $this->input->post('pannumber', true);
        $gstno = $this->input->post('gstno', true);
        $comments = $this->input->post('comments', true);
        if ($firstname != '' && $phonenumber != '') {
            $person_data = array(
                'first_name' => $firstname,
                'last_name' => $Lastname,
                'email' => $email,
                'phone_number' => $phonenumber,
                'address_1' => $inputAddress,
                'address_2' => $inputAddress2,
                'city' => $inputCity,
                'state' => $state,
                'zip' => $inputZip,
                'country' => $country,
                'pannumber' => $pannumber,
                'gstno' => $gstno,
                'comments' => $comments,
            );

            $customer_data = array(
                'company_name' => $companyname,
                'account_number' => $accountno == '' ? null : $accountno,
                'ifsccode' => $ifsccode == '' ? null : $ifsccode,
            );
            $addcustomers = $this->Customers_M->Save($person_data, $customer_data);
            if ($addcustomers == '1') {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Add Customer Details Successfully !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Customers/Manage'));
            } else if ($addcustomers == '0') {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Customer Details Not Addedd !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Customers/New'));

            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-warning">Customer Details Exist Already !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Customers/New'));

            }

        } else {
            $stflash = array(
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Fille Phone Number And First name !</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Customers/New'));
        }
    }

    public function EditCustomer($person_id)
    {

        $updatebtn = $this->input->post('updatebtn', true);
        if (isset($updatebtn)) {
            $person_id = $this->input->post('person_id', true);
            $companyname = $this->input->post('companyname', true);
            $firstname = $this->input->post('firstname', true);
            $Lastname = $this->input->post('Lastname', true);
            $email = $this->input->post('email', true);
            $birthdate = $this->input->post('birthdate', true);
            $phonenumber = $this->input->post('phonenumber', true);
            $inputAddress = $this->input->post('inputAddress', true);
            $inputAddress2 = $this->input->post('inputAddress2', true);
            $inputCity = $this->input->post('inputCity', true);
            $state = $this->input->post('state', true);
            $inputZip = $this->input->post('inputZip', true);
            $country = $this->input->post('country', true);
            if (isset($_POST['accountno'])) {
                $accountno = $this->input->post('accountno', true);
                $accountno = ($accountno != '') ? $accountno : null;
            } else {
                $accountno = null;
            }

            if (isset($_POST['ifsccode'])) {
                $ifsccode = $this->input->post('ifsccode', true);
                $ifsccode = ($ifsccode != '') ? $ifsccode : null;
            } else {
                $ifsccode = null;
            }
            $pannumber = $this->input->post('pannumber', true);
            $gstno = $this->input->post('gstno', true);
            $comments = $this->input->post('comments', true);
            $person_id = $this->input->post('person_id', true);
            $birthdate = $this->input->post('birthdate', true);
            $dob = date('Y-m-d', strtotime($birthdate));
            if ($firstname != '' && $email != '') {
                $person_data = array(
                    'first_name' => $firstname,
                    'last_name' => $Lastname,
                    'email' => $email,
                    'phone_number' => $phonenumber,
                    'address_1' => $inputAddress,
                    'address_2' => $inputAddress2,
                    'city' => $inputCity,
                    'state' => $state,
                    'zip' => $inputZip,
                    'country' => $country,
                    'pannumber' => $pannumber,
                    'gstno' => $gstno,
                    'comments' => $comments,
                    'person_id' => $person_id,
                    'dob' => $dob,
                );

                $supplier_data = array(
                    'company_name' => $companyname,
                    'account_number' => $accountno == '' ? null : $accountno,
                    'ifsccode' => $ifsccode == '' ? null : $ifsccode,
                );
                $addcustomers = $this->Customers_M->Update($person_data, $supplier_data);
                if ($addcustomers) {
                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-success">Update Customer Details Successfully !</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Customers/Manage'));
                } else {
                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-danger">Customer Details Not Updated !</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Customers/Edit/' . $person_id));

                }

            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Please Fille Email And Full name !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Customers/New'));
            }
        } else {
            $data['Customers'] = $this->Customers_M->getall_customers_deatils($person_id);
            $data['statelist'] = $this->Account_M->getstatelist();
            $data['title'] = "Home :Customers";
            $data['connect'] = "Customers/UpdateCustomers";
            $this->load->view("partials/Dash_connect", $data);

        }
    }
    public function ViewCustomer($person_id)
    {
        if (isset($person_id)) {
            $data['Customers'] = $this->Customers_M->getall_customers_deatils($person_id);
            $data['statelist'] = $this->Account_M->getstatelist();
            $data['title'] = "Home :Customers";
            $data['connect'] = "Customers/ViewCustomer";
            $this->load->view("partials/Dash_connect", $data);

        } else {
            redirect(base_url('Customers/Manage'));
        }
    }

    public function DeleteCustomer($person_id)
    {
        if (isset($person_id)) {
            $DeleteCustomer = $this->Customers_M->DeleteCustomer($person_id);
            if ($DeleteCustomer) {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Delete Customer Details Successfully !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Customers/Manage'));
            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Customer Not Deleted !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Customers/Edit/' . $person_id));

            }

        } else {
            redirect(base_url('Customers/Manage'));
        }
    }

    public function Bill_Entrytwo()
    {
        $data['title'] = "Home :Account";

        $data['Customers'] = $this->Customers_M->get_customers();
        $data['billno'] = $this->Customers_M->get_billno();
        $data['connect'] = "Customers/CreateBillTwo";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function Bill_Entry()
    {
        $data['title'] = "Home :Account";

        $data['Customers'] = $this->Customers_M->get_customers();
        $data['billno'] = $this->Customers_M->get_billno();
        $data['connect'] = "Customers/CreateBill";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function create_bill()
    {
        $bill_id = $this->input->post('bill_id', true);
        $bill_date = $this->input->post('bill_date', true);
        $supp_id = $this->input->post('cust_id', true);
        $cust_id = $this->input->post('cust_id', true);
        $myitemid = $this->input->post('myitemid', true);
        $item_cat = $this->input->post('item_cat', true);
        $item_no = $this->input->post('item_no', true);
        $cprice = $this->input->post('cprice', true);
        $uprice = "0";
        $qty = $this->input->post('qty', true);
        $totalqty = $this->input->post('totalqty', true);
        $totalamt = $this->input->post('totalamt', true);
        $payamt = $this->input->post('payamt', true);
        $distype = "";
        $discount = "";
        $disamt = "";
        $hsn = $this->input->post('batchno', true);
        $GST = $this->input->post('GST', true);
        $dis = $this->input->post('discount', true);
        $gsttype = "";
        $gstper = "";
        $addgst = "";
        $expirydate = $this->input->post('expirydate', true);
        // $expirydate=date('Y-m-d',strtotime($expirydate));
        if ($bill_date != '') {
            $date1 = date('Y-m-d', strtotime($bill_date));
            $date2 = $date1 . date('H:i:s');
            $date = date('Y-m-d H:i:s', strtotime($date2));
        } else {
            $date = date('Y-m-d H:i:s');
        }

        $instdata = array(
            'bill_id' => $bill_id,
            'cust_id' => $cust_id,
            'date' => $date,
            'totalqty' => $totalqty,
            'totalamt' => $totalamt,
            'outstanding' => $payamt,
            'discount' => $discount,
            'payamt' => $payamt,
            'dis_type' => $distype,
            'disamt' => $disamt,
            'gsttype' => $gsttype,
            'gstper' => $gstper,
            'addgst' => $addgst,
            'created_date' => $date,
        );

        $qrypur = $this->db->insert('Customers_sales', $instdata);

        if ($qrypur) {
            $pur_id = $this->db->insert_id();

            for ($i = 0; $i < count($myitemid); $i++) {

                $res = $this->db->query("select * from phppos_items where name='" . $myitemid[$i] . "'");
                $row = $res->row();
                $numcount = $res->num_rows();
                if ($numcount) {
                    $myautoid = $row->item_id;
                } else {
                    $this->db->where('pur_id', $pur_id);
                    $this->db->delete('Customers_sales');
                    $stflash = array(
                        'type' => 'success', //error : success
                        'FlashMassage' => '<div class="alert alert-success">' . $myitemid[$i] . ' Out Of Stock</div>',
                        'Show' => 'Supplier Bill Created Successfully!',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Sale/Bill_entry'));

                }

                //    $sql="SELECT * FROM `product_stock` WHERE cat_id ='".$item_cat[$i]."' AND pid='".$item_no[$i]."'";
                //    $query=$this->db->query($sql);

                //    $count=$query->num_rows();
                //    if ($count) {
                //    $row=$query->row();
                //    $stock=$row->stock;
                //        if ($stock>=$qty[$i]) {
                //                $_whr= array('cat_id' => $item_cat[$i],
                //            'pid' => $item_no[$i] );

                //                $qnty=$row->stock-$qty[$i];

                //        $data = array('stock' => $qnty,);
                //     $this->db->where($_whr);
                //     $this->db->update('product_stock', $data);
                // }
                // else
                // {
                //     $this->db->where('pur_id',$pur_id);
                //                     $this->db->delete('Customers_sales');
                //             $stflash = array(
                //         'type' => 'success', //error : success
                //         'FlashMassage' => '<div class="alert alert-warning">'.$myitemid[$i].' Out of Stock, Currently Only '.$stock.' Item In Stock  </div>',
                //         'Show' => 'No Stock!',
                //          );
                //     $this->session->set_flashdata($stflash);
                //               redirect(base_url('Sale/View_Bill'));

                // }
                //    }
                //    else
                //    {

                //          $this->db->where('pur_id',$pur_id);
                //                     $this->db->delete('Customers_sales');
                //             $stflash = array(
                //         'type' => 'success', //error : success
                //         'FlashMassage' => '<div class="alert alert-warning">'.$myitemid[$i].' Out Of Stock</div>',
                //         'Show' => 'No Stock!',
                //          );
                //     $this->session->set_flashdata($stflash);
                //               redirect(base_url('Sale/Bill_entry'));

                //    }

                $datainsert = array(
                    'pur_id' => $pur_id,
                    'item_id' => $myautoid,
                    'qty' => $qty[$i],
                    'price' => $cprice[$i],
                    'hsn' => $hsn[$i],
                    'batch_no' => $hsn[$i],
                    'expiry_date' => date('Y-m-d', strtotime($expirydate[$i])),
                    'gst' => $GST[$i],
                    'gst_amount' => $GST[$i],
                    'dis' => $dis[$i],
                    'dis_amount' => $dis[$i],
                );
                $this->db->insert('Customers_sales_details', $datainsert);
            }

        }
        $stflash = array(
            'type' => 'success', //error : success
            'FlashMassage' => '<div class="alert alert-success">Customer Bill Created Successfully</div>',
            'Show' => 'Customer Bill Created Successfully!',
        );
        $this->session->set_flashdata($stflash);
        redirect(base_url('Sale/View_Bill'));
    }


    public function create_billtwo()
    {
        $bill_id = $this->input->post('bill_id', true);
        $bill_date = $this->input->post('bill_date', true);
        $supp_id = $this->input->post('cust_id', true);
        $cust_id = $this->input->post('cust_id', true);
        $myitemid = $this->input->post('myitemid', true);
        $item_cat = $this->input->post('item_cat', true);
        $item_no = $this->input->post('item_no', true);
        $cprice = $this->input->post('crate', true);
        $uprice = "0";
        $qty = $this->input->post('qty', true);
        $totalqty = $this->input->post('totalqty', true);
        $totalamt = $this->input->post('totalamt', true);
        $payamt = $this->input->post('payamt', true);
        $distype = $this->input->post('distype', true);
        $discount = $this->input->post('per', true);
        $disamt =$this->input->post('disamt', true);
        $hsn = $this->input->post('batchno', true);
        $GST = $this->input->post('GST', true);
        $dis = $this->input->post('discount', true);
        // $disamt = $this->input->post('discount', true);
        // $trate = $this->input->post('trate', true);
        $freeqty = $this->input->post('freeqty', true);
        
        if($GST!=''){$GST=$GST;}else{$GST=0;}
        if($dis!=''){$dis=$dis;}else{$dis=0;}
        
        
        $gsttype = "0";
        $gstper = "0";
        $addgst = "";
        $expirydate = $this->input->post('expirydate', true);
        // $expirydate=date('Y-m-d',strtotime($expirydate));
        if ($bill_date != '') {
            $date1 = date('Y-m-d', strtotime($bill_date));
            $date2 = $date1 . date('H:i:s');
            $date = date('Y-m-d H:i:s', strtotime($date2));
        } else {
            $date = date('Y-m-d H:i:s');
        }

        $instdata = array(
            'bill_id' => $bill_id,
            'cust_id' => $cust_id,
            'date' => $date,
            'totalqty' => $totalqty,
            'totalamt' => $totalamt,
            'outstanding' => $payamt,
            'discount' => $discount,
            'payamt' => $payamt,
            'dis_type' => $distype,
            'disamt' => $disamt,
            'gsttype' => $gsttype,
            'gstper' => $gstper,
            'addgst' => $addgst,
            'created_date' => $date,
            'sale_type' => "1",
            // 'trade_rate' => $trate,
            // 'freeqty' => $freeqty,
        );

        $qrypur = $this->db->insert('Customers_sales', $instdata);

        if ($qrypur) {
            $pur_id = $this->db->insert_id();

            for ($i = 0; $i < count($myitemid); $i++) {

                $res = $this->db->query("select * from phppos_items where name='" . $myitemid[$i] . "'");
                $row = $res->row();
                $numcount = $res->num_rows();
                if ($numcount) {
                    $myautoid = $row->item_id;
                } else {
                    $this->db->where('pur_id', $pur_id);
                    $this->db->delete('Customers_sales');
                    $stflash = array(
                        'type' => 'success', //error : success
                        'FlashMassage' => '<div class="alert alert-success">' . $myitemid[$i] . ' Out Of Stock</div>',
                        'Show' => 'Supplier Bill Created Successfully!',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Sale/BillRetailer'));

                }

              

                $datainsert = array(
                    'pur_id' => $pur_id,
                    'item_id' => $myautoid,
                    'qty' => $qty[$i],
                    'price' => $cprice[$i],
                    'hsn' => $hsn[$i],
                    'batch_no' => $hsn[$i],
                    'expiry_date' => date('Y-m-d', strtotime($expirydate[$i])),
                    'gst' => $GST[$i],
                    'gst_amount' => 0,
                    'dis' => 0,
                    'dis_amount' => 0,
                    'freeqty' => $freeqty[$i],
                );
                $this->db->insert('Customers_sales_details', $datainsert);
            }

        }
        $stflash = array(
            'type' => 'success', //error : success
            'FlashMassage' => '<div class="alert alert-success">Customer Bill Created Successfully</div>',
            'Show' => 'Customer Bill Created Successfully!',
        );
        $this->session->set_flashdata($stflash);
        redirect(base_url('Sale/View_BillRetailer'));
    }

    public function View_BillTwo()
    {
        $all_bills = array();
        $all_billsdata = $this->Customers_M->get_all_sales_two();

        foreach ($all_billsdata as $key => $bills) {
            $supplier = $this->Customers_M->getall_customers_deatils($bills->cust_id);
            if (isset($supplier->first_name)) {
                $bills->supplier_name = $supplier->company_name;
                array_push($all_bills, $bills);
            } else {
                $bills->supplier_name = "NA";
                array_push($all_bills, $bills);

            }
        }
        $data['all_bills'] = $all_bills;
        $data['title'] = "Home :Account";
        $data['connect'] = "Customers/View_billTwo";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function View_bill()
    {
        $all_bills = array();
        $all_billsdata = $this->Customers_M->get_all_sales();

        foreach ($all_billsdata as $key => $bills) {
            $supplier = $this->Customers_M->getall_customers_deatils($bills->cust_id);
            if (isset($supplier->first_name)) {
                $bills->supplier_name = $supplier->first_name . " " . $supplier->last_name;
                array_push($all_bills, $bills);
            } else {
                $bills->supplier_name = "NA";
                array_push($all_bills, $bills);

            }
        }
        $data['all_bills'] = $all_bills;
        $data['title'] = "Home :Account";
        $data['connect'] = "Customers/View_bill";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function View_bill_details($billid)
    {
        $bills_data = $this->Customers_M->getbill_details($billid);
        $data['Settings'] = $this->Settings_M->getSettingdetails(1);
        $data['bills_data'] = $bills_data;
        $this->load->library('billing');
        $data['amtwords'] = $this->billing->getIndianCurrency($bills_data->payamt);
        $data['customer_data'] = $this->Customers_M->getall_customers_deatils($bills_data->cust_id);
        $data['getbill_product'] = $this->Customers_M->getbill_product($billid);
        $data['title'] = "Home :Account";
        $data['connect'] = "Customers/View_bill_details";
        $this->load->view("partials/Dash_connect", $data);

    }
    public function Bill_detailsTwo($billid)
    {
        $bills_data = $this->Customers_M->getbill_details($billid);
        $data['Settings'] = $this->Settings_M->getSettingdetails(1);
        $data['bills_data'] = $bills_data;
        $this->load->library('billing');
        $data['amtwords'] = $this->billing->getIndianCurrency($bills_data->payamt);
        $data['customer_data'] = $this->Customers_M->getall_customers_deatils($bills_data->cust_id);
        $data['getbill_product'] = $this->Customers_M->getbill_product($billid);
        $data['title'] = "Home :Account";
        $data['connect'] = "Customers/View_bill_details";
        $this->load->view("partials/Dash_connect", $data);

    }

    public function Edit_Bill($billid)
    {

        if (isset($_POST['updtbtn'])) {

            $bill_id = $_POST['bill_id'];
            $pur_id = $_POST['pur_id'];
            //echo $bill_id."<br>";
            $bill_date = $_POST['bill_date'];
            $supp_id = $_POST['cust_id'];
            //echo $supp_id."<br>";

            $myitemid = $_POST['myitemid']; //name of item
            //print_r($myitemid);
            $item_cat = $_POST['item_cat'];
            //echo $item_cat."<br>"; //cat of item
            $item_no = $_POST['item_no'];
            //echo $item_no."<br>";//Number of item
            $cprice = $_POST['cprice'];
            //print_r($cprice)."<br>";
            $uprice = "0";
            //echo $uprice."<br>";
            $qty = $_POST['qty'];
            $totalqty = $_POST['totalqty'];
            $totalamt = $_POST['totalamt'];
            $payamt = $_POST['payamt'];
            $distype = $_POST['distype'];
            $discount = $_POST['per'];
            $disamt = $_POST['disamt'];
            $hsn = $_POST['hsn'];
            $itemname = $_POST['itemname'];

            $gsttype = $_POST['gsttype'];
            $gstper = $_POST['gstper'];
            $addgst = $_POST['addgst'];
            $date = date('Y-m-d H:i:s');

            $getbill = "SELECT amt FROM `Customers_sales_payments` WHERE bill_no='" . $pur_id . "'";
            $gquery = $this->db->query($getbill);
            $aResult = $gquery->result();
            $outst = 0;
            foreach ($aResult as $key => $res) {
                $outst = $outst + $res->amt;
            }

            $outstanding = $payamt - $outst;

            $instdata = array(
                'bill_id' => $bill_id,
                'cust_id' => $supp_id,
                'totalqty' => $totalqty,
                'totalamt' => $totalamt,
                'outstanding' => $outstanding,
                'discount' => $discount,
                'payamt' => $payamt,
                'dis_type' => $distype,
                'disamt' => $disamt,
                'gsttype' => $gsttype,
                'gstper' => $gstper,
                'addgst' => $addgst,
            );

            $this->db->where('pur_id', $pur_id);
            $qrypur = $this->db->update('Customers_sales', $instdata);

            if ($qrypur) {
                $pur_id = $this->db->insert_id();

                for ($i = 0; $i < count($myitemid); $i++) {

                    $res = $this->db->query("select * from phppos_items where name='" . $myitemid[$i] . "'");
                    $row = $res->row();
                    $numcount = $res->num_rows();
                    if ($numcount) {
                        $myautoid = $row->item_id;
                    } else {
                        $this->db->where('pur_id', $pur_id);
                        $this->db->delete('Customers_sales');
                        $stflash = array(
                            'type' => 'success', //error : success
                            'FlashMassage' => '<div class="alert alert-warning">' . $myitemid[$i] . ' Out Of Stock</div>',
                            'Show' => 'Supplier Bill Created Successfully!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Sale/Bill_entry'));

                    }

                    $sql = "SELECT * FROM `product_stock` WHERE cat_id ='" . $item_cat[$i] . "' AND pid='" . $item_no[$i] . "'";
                    $query = $this->db->query($sql);
                    $row = $query->row();
                    $stock = $row->stock;
                    $count = $query->num_rows();
                    if ($count) {
                        if ($stock >= $qty[$i]) {
                            $_whr = array('cat_id' => $item_cat[$i],
                                'pid' => $item_no[$i]);

                            $qnty = $row->stock - $qty[$i];

                            $data = array('stock' => $qnty);
                            $this->db->where($_whr);
                            $this->db->update('product_stock', $data);
                        } else {
                            $this->db->where('pur_id', $pur_id);
                            $this->db->delete('Customers_sales');
                            $stflash = array(
                                'type' => 'success', //error : success
                                'FlashMassage' => '<div class="alert alert-warning">' . $qty[$i] . ' ' . $myitemid[$i] . ' Out of Stock, Currently Only ' . $stock . ' Item In Stock  </div>',
                                'Show' => 'Supplier Bill Created Successfully!',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Sale/Bill_entry'));

                        }
                    } else {

                        $this->db->where('pur_id', $pur_id);
                        $this->db->delete('Customers_sales');
                        $stflash = array(
                            'type' => 'success', //error : success
                            'FlashMassage' => '<div class="alert alert-warning">' . $myitemid[$i] . ' Out Of Stock</div>',
                            'Show' => 'Supplier Bill Created Successfully!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Sale/Bill_entry'));

                    }

                    $datainsert = array(
                        'pur_id' => $pur_id,
                        'item_id' => $myautoid,
                        'qty' => $qty[$i],
                        'price' => $cprice[$i],
                        'hsn' => $hsn[$i],
                    );
                    $this->db->insert('Customers_sales_details', $datainsert);
                }

            }
            $stflash = array(
                'type' => 'success', //error : success
                'FlashMassage' => '<div class="alert alert-success">Customer Sale Bill Edited Successfully</div>',
                'Show' => 'Supplier Bill Created Successfully!',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Sale/View_Bill'));

        } else {

            $bills_data = $this->Customers_M->getbill_details($billid);
            $data['bills_data'] = $bills_data;
            $data['supplier_data'] = $this->Customers_M->getall_customers_deatils($bills_data->cust_id);
            $data['getbill_product'] = $this->Customers_M->getbill_product($billid);

            $data['supplier'] = $this->Customers_M->get_customers();

            $data['title'] = "Home :Account";
            $data['connect'] = "Customers/Edit_Bill";
            $this->load->view("partials/Dash_connect", $data);

        }
    }
    public function Bill_EditTwo($billid)
    {

        if (isset($_POST['updtbtn'])) {

            $bill_id = $_POST['bill_id'];
            $pur_id = $_POST['pur_id'];
            //echo $bill_id."<br>";
            $bill_date = $_POST['bill_date'];
            $supp_id = $_POST['cust_id'];
            //echo $supp_id."<br>";

            $myitemid = $_POST['myitemid']; //name of item
            //print_r($myitemid);
            $item_cat = $_POST['item_cat'];
            //echo $item_cat."<br>"; //cat of item
            $item_no = $_POST['item_no'];
            //echo $item_no."<br>";//Number of item
            $cprice = $_POST['cprice'];
            //print_r($cprice)."<br>";
            $uprice = "0";
            //echo $uprice."<br>";
            $qty = $_POST['qty'];
            $totalqty = $_POST['totalqty'];
            $totalamt = $_POST['totalamt'];
            $payamt = $_POST['payamt'];
            $distype = $_POST['distype'];
            $discount = $_POST['per'];
            $disamt = $_POST['disamt'];
            $hsn = $_POST['hsn'];
            $itemname = $_POST['itemname'];

            $gsttype = $_POST['gsttype'];
            $gstper = $_POST['gstper'];
            $addgst = $_POST['addgst'];
            $date = date('Y-m-d H:i:s');

            $getbill = "SELECT amt FROM `Customers_sales_payments` WHERE bill_no='" . $pur_id . "'";
            $gquery = $this->db->query($getbill);
            $aResult = $gquery->result();
            $outst = 0;
            foreach ($aResult as $key => $res) {
                $outst = $outst + $res->amt;
            }

            $outstanding = $payamt - $outst;

            $instdata = array(
                'bill_id' => $bill_id,
                'cust_id' => $supp_id,
                'totalqty' => $totalqty,
                'totalamt' => $totalamt,
                'outstanding' => $outstanding,
                'discount' => $discount,
                'payamt' => $payamt,
                'dis_type' => $distype,
                'disamt' => $disamt,
                'gsttype' => $gsttype,
                'gstper' => $gstper,
                'addgst' => $addgst,
            );

            $this->db->where('pur_id', $pur_id);
            $qrypur = $this->db->update('Customers_sales', $instdata);

            if ($qrypur) {
                $pur_id = $this->db->insert_id();

                for ($i = 0; $i < count($myitemid); $i++) {

                    $res = $this->db->query("select * from phppos_items where name='" . $myitemid[$i] . "'");
                    $row = $res->row();
                    $numcount = $res->num_rows();
                    if ($numcount) {
                        $myautoid = $row->item_id;
                    } else {
                        $this->db->where('pur_id', $pur_id);
                        $this->db->delete('Customers_sales');
                        $stflash = array(
                            'type' => 'success', //error : success
                            'FlashMassage' => '<div class="alert alert-warning">' . $myitemid[$i] . ' Out Of Stock</div>',
                            'Show' => 'Supplier Bill Created Successfully!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Sale/Bill_entry'));

                    }

                    $sql = "SELECT * FROM `product_stock` WHERE cat_id ='" . $item_cat[$i] . "' AND pid='" . $item_no[$i] . "'";
                    $query = $this->db->query($sql);
                    $row = $query->row();
                    $stock = $row->stock;
                    $count = $query->num_rows();
                    if ($count) {
                        if ($stock >= $qty[$i]) {
                            $_whr = array('cat_id' => $item_cat[$i],
                                'pid' => $item_no[$i]);

                            $qnty = $row->stock - $qty[$i];

                            $data = array('stock' => $qnty);
                            $this->db->where($_whr);
                            $this->db->update('product_stock', $data);
                        } else {
                            $this->db->where('pur_id', $pur_id);
                            $this->db->delete('Customers_sales');
                            $stflash = array(
                                'type' => 'success', //error : success
                                'FlashMassage' => '<div class="alert alert-warning">' . $qty[$i] . ' ' . $myitemid[$i] . ' Out of Stock, Currently Only ' . $stock . ' Item In Stock  </div>',
                                'Show' => 'Supplier Bill Created Successfully!',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Sale/Bill_entry'));

                        }
                    } else {

                        $this->db->where('pur_id', $pur_id);
                        $this->db->delete('Customers_sales');
                        $stflash = array(
                            'type' => 'success', //error : success
                            'FlashMassage' => '<div class="alert alert-warning">' . $myitemid[$i] . ' Out Of Stock</div>',
                            'Show' => 'Supplier Bill Created Successfully!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Sale/Bill_entry'));

                    }

                    $datainsert = array(
                        'pur_id' => $pur_id,
                        'item_id' => $myautoid,
                        'qty' => $qty[$i],
                        'price' => $cprice[$i],
                        'hsn' => $hsn[$i],
                    );
                    $this->db->insert('Customers_sales_details', $datainsert);
                }

            }
            $stflash = array(
                'type' => 'success', //error : success
                'FlashMassage' => '<div class="alert alert-success">Customer Sale Bill Edited Successfully</div>',
                'Show' => 'Supplier Bill Created Successfully!',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Sale/View_Bill'));

        } else {

            $bills_data = $this->Customers_M->getbill_details($billid);
            $data['bills_data'] = $bills_data;
            $data['supplier_data'] = $this->Customers_M->getall_customers_deatils($bills_data->cust_id);
            $data['getbill_product'] = $this->Customers_M->getbill_product($billid);

            $data['supplier'] = $this->Customers_M->get_customers();

            $data['title'] = "Home :Account";
            $data['connect'] = "Customers/Edit_Bill";
            $this->load->view("partials/Dash_connect", $data);

        }
    }

    public function ViewAllBill()
    {
        $data['Customers'] = $this->Customers_M->get_customers();
        $data['Payment_details'] = array();
        $data['title'] = "Home :Account";
        $data['connect'] = "Customers/ViewAllBill";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function Getbillsajex()
    {
        $cust_id = $this->input->post('cust_id', true);
        $start = $this->input->post('start', true);
        $end = $this->input->post('end', true);
        $bill_type = $this->input->post('bill_type', true);

        $all_bills = array();
        $all_billsdata = $this->Customers_M->GetBillAjex($cust_id, $start, $end, $bill_type);

        foreach ($all_billsdata as $key => $bills) {
            $supplier = $this->Customers_M->getall_customers_deatils($bills->cust_id);
            $bills->customer_name = $supplier->first_name . " " . $supplier->last_name;
            array_push($all_bills, $bills);
        }
        $data['Bill_deatils'] = $all_bills;
        $data['bill_type'] = $bill_type;
        $data['cust_id'] = $cust_id;

        $this->load->view("Customers/Getbillsajex", $data);
        // echo json_encode($data['Bill_deatils']);
    }

    public function PayAmount()
    {

        if ($this->input->post('cust_id', true) != '') {
            $bill = $_POST['payment'];
            $bill1 = implode(',', $bill);

            $data['payamt'] = $this->input->post('payamt', true);
            $data['bill1'] = $bill1;

            $person_id = $this->input->post('cust_id', true);
            $data['bank_details'] = $this->Payment_M->get_accountdetails();
            $data['Customers'] = $this->Customers_M->getall_customers_deatils($person_id);
            $data['title'] = "Home :Account";
            $data['connect'] = "Customers/PayAmount";
            $this->load->view("partials/Dash_connect", $data);
        } else {
            redirect(base_url('Sale/ViewAllBill'));
        }
    }

    public function GetBatch()
    {
        $item_id = $this->input->post('item_id', true);
        $data['getbatch'] = $this->Customers_M->getbatch($item_id);
        $data['title'] = "Home :Account";
        // $data['connect']="Customers/GetBatch";
        $this->load->view("Customers/GetBatch", $data);
    }

    public function GetExpiry()
    {

        $item_id = $this->input->post('item_id', true);
        $batchno = $this->input->post('batchno', true);
        $getExpiry = $this->Customers_M->getExpiry($item_id, $batchno);
        echo $getExpiry->expiry_date . "&" . $getExpiry->price;
        // $data['title']="Home :Account";
        // // $data['connect']="Customers/GetBatch";
        // $this->load->view("Customers/GetBatch",$data);
    }

    public function PayBill()
    {

        $pur_id = $this->input->post('pur_id', true);
        $customername = $this->input->post('customername', true);
        $paymentmode = $this->input->post('paymentmode', true);
        $fromaccount = $this->input->post('fromaccount', true);
        $paydate = $this->input->post('paydate', true);
        $paydate = date("Y-m-d", strtotime($paydate));
        $payamount = $this->input->post('payamount', true);
        $pur_id = explode(',', $pur_id);

        if ($pur_id != '') {
            $tamount = number_format($payamount, 2, '.', '');

            for ($i = 0; $i < count($pur_id); $i++) {
                $purchase = $this->Customers_M->getbill_details($pur_id[$i]);
                $flag = 0;
                $amt = number_format($purchase->outstanding, 2, '.', '');
                // number_format($num1, 2, '.', '');

                if ($amt <= $tamount) {

                    $purchase_payment = array(
                        'bill_no' => $pur_id[$i],
                        'mode' => $paymentmode,
                        'amt' => $amt,
                        'paid_date' => $paydate,
                    );
                    $paysuccess = $this->db->insert('Customers_sales_payments', $purchase_payment);
                    if ($paysuccess) {
                        // $tamount=$amt;
                        $uppurchase = array(
                            'outstanding' => 0,
                        );
                        $this->db->where('pur_id', $pur_id[$i]);
                        $this->db->update('Customers_sales', $uppurchase);
                    } else {
                        $flag = 1;
                    }
                    $tamount = $tamount - $amt;

                } else if ($amt >= $tamount) {
                    if ($tamount > 0) {

                        $purchase_payment = array(
                            'bill_no' => $pur_id[$i],
                            'mode' => $paymentmode,
                            'amt' => $tamount,
                            'paid_date' => $paydate,
                        );
                        $paysuccess = $this->db->insert('Customers_sales_payments', $purchase_payment);
                        if ($paysuccess) {
                            $remainbal = number_format($amt, 2, '.', '') - number_format($tamount, 2, '.', '');
                            $payamount = $tamount;
                            $uppurchase = array(
                                'outstanding' => $remainbal,
                            );
                            $this->db->where('pur_id', $pur_id[$i]);
                            $this->db->update('Customers_sales', $uppurchase);

                        } else {
                            $flag = 1;
                        }
                        $tamount = $tamount - $amt;
                    } else {
                        $flag = 1;
                    }

                }

                if ($flag != 1) {
                    $memo = "payment form " . $customername;
                    $banktran = array(
                        'bank_id' => $fromaccount,
                        'trans_type' => "receit",
                        'trans_amt' => $payamount,
                        'trans_date' => $paydate,
                        'trans_memo' => $memo,
                        'reconcile' => "NO",
                        'enrty_date' => $paydate,
                    );
                    $this->db->insert('bank_transaction', $banktran);
                } else {

                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-danger">Customer Payment Not Addedd !</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Sale/ViewAllBill'));
                }
            }
            $stflash = array(
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-success">Customer Payment Paid Successfully!</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Sale/ViewAllBill'));

        } else {

            $stflash = array(
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-warning">Payment Id Not Exist !</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Sale/ViewAllBill'));

        }

    }

    public function Invoice()
    {
        $data['title'] = "Home :Account";
        $data['connect'] = "Customers/Invoice";
        $this->load->view("partials/Dash_connect", $data);
    }

}
