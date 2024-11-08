<?php

$id = "727";
// call make pdf function
$ch = curl_init();
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://allmart.world/franchise/Product_recipts/invoice.php?user_id=".$id);
curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// close cURL resource, and free up system resources
curl_close($ch);

// var_dump($httpcode);

?>