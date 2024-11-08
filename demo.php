<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
<?

$ip = $_SERVER['REMOTE_ADDR'];

$LocationArray = json_decode( file_get_contents('http://ip-get-geolocation.com/api/json/'.$ip), true);
echo '<h1>Your IP Address is : '.$ip.'</h1>';
echo '<br />';

$city = $LocationArray['city'];
$state = $LocationArray['regionName']; 



echo 'City : '. $city .'<br />';
echo 'State : '. $state .'<br />';

echo '<br />';


?>


<div id="result"></div>

<script>


$(document).ready(function(){
    
    const ip = '<? echo $ip; ?>';
    const city = '<? echo $city; ?>';
    const state = '<? echo $state; ?>';
    
     $.ajax({
        url: 'setcookies.php',
        type: "post",
        async: true,
        data: 'ip='+ip+'&city='+city+'&state='+state,
        success: function (msg) {
            $("#result").html(msg);
        }
     });
        
})  ;  
</script>


</body>
</html>


