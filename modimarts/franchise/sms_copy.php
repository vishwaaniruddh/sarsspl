<?php
include ('config.php');
$mobile_no=$_POST['mobile_no'];
$otp = $_POST['otp'];

 $sql="select * from member where mobile ='".$mobile_no."'";
$query=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);

if($numrow == 0){
    echo '0';
}else{
    
    $sql_insert="insert into otp_verification(mobile_no,otp) values('".$mobile_no."','".$otp."')";
           $query=mysqli_query($conn,$sql_insert);
function PostRequest($url, $referer, $_data) {
// convert variables array to string:
$data = array(); while(list($n,$v) =
each($_data)){
$data[] = "$n=$v";
}
$data = implode('&', $data);
// format --> test1=a&test2=b etc.
// parse the given URL
$url = parse_url($url);
if ($url['scheme'] != 'http') {
die('Only HTTP request are supported !');
}
// extract host and path:
$host = $url['host'];
$path = $url['path'];
// open a socket connection on port 80
$fp = fsockopen($host, 80);
// send the request headers:
fputs($fp, "POST $path HTTP/1.1\r\n");
fputs($fp, "Host: $host\r\n");
fputs($fp, "Referer: $referer\r\n");
fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Content-length: ". strlen($data) ."\r\n");
fputs($fp, "Connection: close\r\n\r\n");
fputs($fp, $data);
$result = '';
while(!feof($fp)) {
// receive the results of the request
$result .= fgets($fp, 128);
}
// close the socket connection:
fclose($fp);
// split the result header from the content
$result = explode("\r\n\r\n", $result, 2);
$header = isset($result[0]) ? $result[0] : '';
$content = isset($result[1]) ? $result[1] : '';
// return as array:
return array($header, $content);
}


$data = array(
'user' => "satyendra1111",
'password' => "207860",
'msisdn' => $mobile_no,
'sid' => "SBDOTP",
// 'sid' => "Shyambabadham",
'msg' => "Dear User, Your OTP is $otp on ShyamBabaDham.com. Please use this passcode to complete your phone number verification.",
'fl' =>"0",
'gwid' =>"2",
);



list($header, $content) = PostRequest( "http://www.smslane.com//vendorsms/pushsms.aspx",
// the url to post to
"http://www.shyambabadham.com/Committee/smstest.php", // its your url
$data
);
echo $content;
    echo '1';
}    



// $sql="select * from member_credentials where user_name ='".$mobile_no."'";
// $query=mysqli_query($conn,$sql);
// $numrow=mysqli_num_rows($query);

// if($numrow >0){
//     echo '0';
// }else{
    
//     $sql_insert="insert into otp_verification(mobile_no,otp) values('".$mobile_no."','".$otp."')";
//                                     $query=mysqli_query($conn,$sql_insert);
// function PostRequest($url, $referer, $_data) {
// // convert variables array to string:
// $data = array(); while(list($n,$v) =
// each($_data)){
// $data[] = "$n=$v";
// }
// $data = implode('&', $data);
// // format --> test1=a&test2=b etc.
// // parse the given URL
// $url = parse_url($url);
// if ($url['scheme'] != 'http') {
// die('Only HTTP request are supported !');
// }
// // extract host and path:
// $host = $url['host'];
// $path = $url['path'];
// // open a socket connection on port 80
// $fp = fsockopen($host, 80);
// // send the request headers:
// fputs($fp, "POST $path HTTP/1.1\r\n");
// fputs($fp, "Host: $host\r\n");
// fputs($fp, "Referer: $referer\r\n");
// fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
// fputs($fp, "Content-length: ". strlen($data) ."\r\n");
// fputs($fp, "Connection: close\r\n\r\n");
// fputs($fp, $data);
// $result = '';
// while(!feof($fp)) {
// // receive the results of the request
// $result .= fgets($fp, 128);
// }
// // close the socket connection:
// fclose($fp);
// // split the result header from the content
// $result = explode("\r\n\r\n", $result, 2);
// $header = isset($result[0]) ? $result[0] : '';
// $content = isset($result[1]) ? $result[1] : '';
// // return as array:
// return array($header, $content);
// }


// $data = array(
// 'user' => "satyendra1111",
// 'password' => "207860",
// 'msisdn' => $mobile_no,
// 'sid' => "SBDOTP",
// // 'sid' => "Shyambabadham",
// 'msg' => "Dear User, Your OTP is $otp on ShyamBabaDham.com. Please use this passcode to complete your phone number verification.",
// 'fl' =>"0",
// 'gwid' =>"2",
// );



// list($header, $content) = PostRequest( "http://www.smslane.com//vendorsms/pushsms.aspx",
// // the url to post to
// "http://www.shyambabadham.com/Committee/smstest.php", // its your url
// $data
// );
// echo $content;
    
//     echo '1';
// }


?>