<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller']           = 'Account';
$route['404_override']                 = '';
$route['translate_uri_dashes']         = false;

$route['Account/Home']                 = 'Account';
$route['Reports/Inventory_report']     = 'Reports/Inventory_report';
$route['User/Auth']                    = 'Login/LoginAuth';
$route['User/Logout']                  = 'Login/AdminLogout';
$route['Supplier/Bill_entry']          = 'Account/Bill_Entry';
$route['Supplier/Bill_entryTwo']       = 'Account/Bill_EntryTwo';
$route['Supplier/View_Bill']           = 'Account/View_bill';
$route['Supplier/Bill_details/(:any)'] = 'Account/Viwe_bill_details/$1';
$route['Supplier/Bill_Edit/(:any)']    = 'Account/Edit_SupplierBill/$1';
$route['Supplier/Bill_Delete/(:any)']  = 'Account/Bill_SupplierDelete/$1';
$route['Supplier/create_bill']         = 'Account/create_bill';
$route['Supplier/Manage']              = 'Account/Manage_Supplier';
$route['Supplier/New']                 = 'Account/Add_New_Supplier';
$route['Supplier/Create']              = 'Account/Create_New_Supplier';
$route['Supplier/Edit/(:any)']         = 'Account/Edit_Supplier/$1';
$route['Supplier/View/(:any)']         = 'Account/View_Supplier/$1';
$route['Supplier/Paybill/(:any)']      = 'Payment/Paybill/$1';
$route['Bill/Invoice/(:any)']          = 'Payment/View_Bill/$1';
$route['Bill/Create']                  = 'Payment/CreateTransaction';
$route['Bill/ViewAll']                 = 'Payment/Index';
$route['Bank/Add']                     = 'Payment/Addbank';
$route['Product/Stock']                = 'Inventory/index';
$route['Bank/View']                    = 'Payment/ViewBank';
$route['Bank/Transaction']             = 'Payment/ViewBankTransection';
$route['BankPayment/Entry']            = 'Payment/AddBankTransection';
$route['Customers/Manage']             = 'Customers/ManageCustomers';
$route['Customers/New']                = 'Customers/AddNewCustomer';
$route['Customers/Create']             = 'Customers/CreateNewCustomer';
$route['Customers/Edit/(:any)']        = 'Customers/EditCustomer/$1';
$route['Customers/View/(:any)']        = 'Customers/ViewCustomer/$1';
$route['Customers/Delete/(:any)']      = 'Customers/DeleteCustomer/$1';
$route['Sale/Bill_entry']              = 'Customers/Bill_Entry';
$route['Sale/BillRetailer']            = 'Customers/Bill_Entrytwo';
$route['Sale/BillRetailer_test']            = 'Customers/Bill_Entrytwo_test'; //sale bill entry test

$route['Sale/View_Bill']               = 'Customers/View_bill';
$route['Sale/View_Bill_test']               = 'Customers/View_bill_test';
$route['Sale/View_BillRetailer']       = 'Customers/View_BillTwo';
$route['Sale/View_BillRetailer_test']  = 'Customers/View_BillTwo_test';
$route['Sale/View_Sale_bill']          = 'Customers/sale_bill_report';

$route['Sale/ViewAllBill']             = 'Customers/ViewAllBill';
$route['Sale/ViewAllBill_test']             = 'Customers/ViewAllBill_test';
$route['Sale/Getbillsajex']            = 'Customers/Getbillsajex';
$route['Sale/Getbillsajex_test']            = 'Customers/Getbillsajex_test';
$route['Sale/PayAmount']               = 'Customers/PayAmount';
$route['Sale/PayBill']                 = 'Customers/PayBill';
$route['Sale/Bill_detailsTwo/(:any)']  = 'Customers/Bill_detailsTwo/$1';
$route['Sale/Bill_details/(:any)']     = 'Customers/View_bill_details/$1';
$route['Sale/Bill_Edit/(:any)']        = 'Customers/Edit_Bill/$1';
$route['Sale/Bill_EditTwo/(:any)']     = 'Customers/Edit_BillTwo/$1';
$route['Product/Add']                  = 'Product/AddItem';
$route['Product/Manage']               = 'Product/Manage';
$route['Product/ProductExpiry']               = 'Product/ProductExpiry';
$route['Product/ProductExpiryDetail/(:any)']        = 'Product/ProductExpiryDetail/$1';
$route['Sale/GetBatch']                = 'Customers/GetBatch';
$route['Sale/GetExpiry']               = 'Customers/GetExpiry';
$route['Sale/Invoice']                 = 'Customers/Invoice';
$route['Product/Category']             = 'Product/ManageCategory';
$route['Product/AddCategory']          = 'Product/AddCategory';
$route['Product/ProductEdit/(:any)']   = 'Product/ProductEdit/$1';

$route['Settings/ManageSettings']      = 'WebSettings/ManageSettings';
$route['Settings/UpdateSettings']      = 'WebSettings/UpdateSettings';
$route['Settings/ManageScheme']        = 'WebSettings/ManageScheme';
$route['Settings/AddScheme']           = 'WebSettings/AddScheme';

$route['Return']                       = 'Returns/index';
$route['Return/getInvoice']            = 'Returns/getInvoice';
$route['Return/getsupplier']           = 'Returns/getsupplier';

$route['Return/supplierReturn/(:any)']        = 'Returns/supplierReturn/$1';
$route['Return/InvoiceReturn/(:any)']         = 'Returns/InvoiceReturn/$1';
$route['Return/ProductSupplier/(:any)']       = 'Returns/ProductSupplier/$1';

// Doctors

$route['Doctors/Manage']             = 'Doctors/ManageDoctors';
$route['Doctors/New']                = 'Doctors/AddNewDoctors';
$route['Doctors/Create']             = 'Doctors/CreateNewDoctors';
$route['Doctors/Edit/(:any)']        = 'Doctors/EditDoctors/$1';
$route['Doctors/View/(:any)']        = 'Doctors/ViewDoctors/$1';
$route['Doctors/Delete/(:any)']      = 'Doctors/DeleteDoctors/$1';

