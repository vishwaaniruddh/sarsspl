<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'User';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Greetings/View'] = 'Greetings/Manage';
$route['Greeting/View/(:any)'] = 'Greetings/View/$1';
$route['Greetings/Send'] = 'Greetings/Send';
$route['Test'] = 'Greetings/Test';
$route['Greetings/Download/(:any)'] = 'Greetings/Download/$1';


      // Profile Section
$route['User/EditProfile'] = 'User/EditProfile';
$route['CreateReferralCode'] = 'Referral/CreateReferralCode';
$route['User/Register'] = 'Register/RegisterUser';
$route['Franchisee/Register'] = 'User/Registerfranchisee/$1';

      // Profile Section
$route['Result/getpincode'] = 'Register/getpincode';
$route['Result/getpincode1'] = 'Register/getpincode1';
$route['Result/getvillage'] = 'Register/getvillage';
$route['Result/getvillage1'] = 'Register/getvillage1';
$route['Result/gettaluka'] = 'Register/gettaluka';
$route['Result/gettaluka1'] = 'Register/gettaluka1';
$route['Result/getdistrict'] = 'Register/getdistrict';
$route['Result/getdistrict1'] = 'Register/getdistrict1';
$route['Result/getdivision'] = 'Register/getdivision';
$route['Result/getdivision1'] = 'Register/getdivision1';
$route['Result/getState'] = 'Register/getState';
$route['Result/getState1'] = 'Register/getState1';
$route['Result/getZone'] = 'Register/getZone';
$route['Result/getZone1'] = 'Register/getZone1';
$route['Result/getCountry'] = 'Register/getCountry';
$route['Result/getCountry1'] = 'Register/getCountry1';
$route['Result/getnoofvilage'] = 'Register/getnoofvilage';

// advertisement
$route['Advt/Register'] = 'Register/RegAdvertiser';

$route['Advt/AddNew'] = 'Advert/AddNew';






