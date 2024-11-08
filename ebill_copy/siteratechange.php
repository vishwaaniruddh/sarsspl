<?php
include("config.php");
$tkdt=$_GET['tkdt'];
$tkdt=str_replace('/','-',$tkdt);
$tkdt=date('Y-m-d',strtotime($tkdt));
$htdt=$_GET['htdt'];
$htdt=str_replace('/','-',$htdt);
$htdt=date('Y-m-d',strtotime($htdt));
$rate=$_GET['rate'];
$from=$_GET['frmdt'];
$to=$_GET['enddt'];
$date_parts1=explode("/", $from);
    $date_parts2=explode("/", $to);
    //echo $from."  ".$to;
   // $start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
   // $end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
   $start_date=$date_parts1[2]."-".$date_parts1[1]."-".$date_parts1[0]; //echo $start_date;
   $end_date=$date_parts2[2]."-".$date_parts2[1]."-".$date_parts2[0];  //echo $end_date;
   $mon=date( 'F', mktime(0, 0, 0, $date_parts1[1]) ); //echo $mon;
  //  $dd = $end_date - $start_date;
  //  echo $dd/(3600*24)+1;
    $fr = strtotime($start_date, 0);
    $t = strtotime($end_date, 0);
    $difference = $t - $fr;
    $dd = intval($difference/(3600*24)+1);
   // echo $dd;
    $nod = cal_days_in_month(CAL_GREGORIAN, $date_parts1[1], $date_parts1[2]);
//echo $nod;
$days=0;
if(strtotime($tkdt,0)<strtotime($start_date,0)){
		   if($_GET['htdt']==''){
		 $days= $dd;
		  
		  }
		  else
		  {
		 // echo "hello";
		  $fr = strtotime($start_date, 0);
                                            $t = strtotime($htdt, 0);
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                $days= $dd1; 
                                
		  }
		  }
                                   else{ 
                                   //echo "hi";
                                   if($_GET['htdt']!='')
                                   {
                                    $fr = strtotime($tkdt, 0);
                                            $t = strtotime($htdt, 0);
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                          $days= $dd1;
                                   }
                                   else{
                                      $fr = strtotime($tkdt, 0);
                                            $t = strtotime($end_date, 0);
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                          $days= $dd1;
                        }
                                       }
                                       $var= number_format(($days/$nod)*$rate, 2, '.', '');
                                   
                                       
                                       echo $days."****".$rate."****".$var;	 
?>