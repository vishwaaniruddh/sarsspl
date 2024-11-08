<?

$location = '3-3-866/A, S.G.Complex, F2,Kachiguda, Hyderabad -500027 Telangana';
 $address = preg_split('/[\ \n\,]+/', $location);
// $address = explode(' ', $location);
$address1 = array_slice($address, 0, 5, true);
$address2 = array_slice($address, 5, 5, true);
$address3 = array_slice($address, 10, 5, true);
$address4 = array_slice($address, 15, 5, true);
$address5 = array_slice($address, 20, 5, true);

echo $address1 = implode(" ",$address1);
$address2 = implode(" ",$address2);
$address3 = implode(" ",$address3);
$address4 = implode(" ",$address4);
$address5 = implode(" ",$address5);

?>