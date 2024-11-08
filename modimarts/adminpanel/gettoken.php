<?php 
$str='{"id":1333840,"first_name":"API","last_name":"USER","email":"shipping.allmart@gmail.com","company_id":1311471,"created_at":"2021-04-09 16:13:47","token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEzMzM4NDAsImlzcyI6Imh0dHBzOi8vYXBpdjIuc2hpcHJvY2tldC5pbi92MS9leHRlcm5hbC9hdXRoL2xvZ2luIiwiaWF0IjoxNjE5NzgwMzEwLCJleHAiOjE2MjA2NDQzMTAsIm5iZiI6MTYxOTc4MDMxMCwianRpIjoiQ1Z2QTRXUUtHSHJKT1V2WSJ9.RqyzHkLnx4Jf87tmjqSQPBCldOdP2KyL--1G9ZHaCIY"}';
$json=json_decode($str);
echo $json->token;
 ?>