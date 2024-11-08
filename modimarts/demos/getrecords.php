<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebbok https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
require_once("../config.php");

$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 10;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;

$sql = mysqli_query($con1,"SELECT * FROM product WHERE 1 ORDER BY product_id ASC LIMIT $limit OFFSET $offset");
// $data = mysqli_fetch_assoc($sql);
while($data = mysqli_fetch_assoc($sql)){
    echo "<h4>". $data['product_name']."</h4>";
}


?>