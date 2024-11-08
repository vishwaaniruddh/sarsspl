<?php
$input=Array(Array('ab','cd'),Array('ef','gh'),Array('ij','kl'),Array('ab','cd'));
echo "<pre>";
print_r($input);
$input = array_map("unserialize", array_unique(array_map("serialize", $input)));
print_r($input);
?>