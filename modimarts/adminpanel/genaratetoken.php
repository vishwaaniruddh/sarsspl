<?php
include 'config.php';

$qrytoken     = "select updated_at from add_ship_rocket_token where id='1'";
$result_token = mysqli_query($con1, $qrytoken);
$rowtoken     = mysqli_fetch_assoc($result_token);
$lastdate     = $rowtoken['updated_at'];
$update       = date('Y-m-d H:i:s', strtotime($lastdate . ' +9 day'));
// $current=date('Y-m-d H:i:s', strtotime($lastdate .' +10 day'));
$current = date('Y-m-d H:i:s');

// if ($update <= $current) {

    $email    = "shipping.allmart@gmail.com";
    $password = "Allmart@9";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://apiv2.shiprocket.in/v1/external/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => '{
    "email": "shipping.allmart@gmail.com",
    "password": "Allmart@9"
}',
        CURLOPT_HTTPHEADER     => array(
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response;
    $json       = json_decode($response);
    $tokendata  = $json->token;
    $updated_at = date('Y-m-d H:i:s');

    $data = mysqli_query($con1, "UPDATE `add_ship_rocket_token` SET `token`='" . $tokendata . "',updated_at='" . $updated_at . "' WHERE id='1'");
    if ($data) {
        echo 1;
    } else {
        echo 0;
    }
    echo "Update";
// } else {
//     echo "Not Update";
// }
