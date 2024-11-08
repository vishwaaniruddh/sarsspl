<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');



$fname=array(
    'Aniruddh',
    'Kundan',
    'Akash',
    'Vishal',
    'Ruchi',
    'Anand',
    'Rahul',
    'Satyendra',
    'Prashant',
    'Pash',
    'Inderpal',
    'Keval',
    'Sangeeta',
    'Jignal',
    'Mithun',
    'Lakhan'
    );


$lname=array(
    'Sharma',
    'Patel',
    'Gada',
    'Singh',
    'Yadav',
    'Bachhan',
    'Kumar',
    'Dixit',
    'Saxena',
    'Parab',
    'Rajput',
    'Sanghi',
    'Raghuwanshi',
    'Suryawanshi',
    'Pasi',
    'Joshi',
    'Krishnan',
    'Balan'
    );



for($i=1;$i<=100;$i++){
    
shuffle($fname);
shuffle($lname);

    mysql_query("INSERT INTO ai_players(fname,lname,standard) VALUES('".$fname[0]."','".$lname[0]."',7)",$con);    
}












?>