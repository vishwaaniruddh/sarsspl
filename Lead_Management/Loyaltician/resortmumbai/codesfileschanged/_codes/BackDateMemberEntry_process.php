<?php session_start();
include 'config.php';

$MemberId=$_POST['MemberId'];
$EntryDt=$_POST['EntryDt'];
$backDt1=$_POST['backDt'];
//echo $backDt1;
 $date = str_replace('/', '-', $backDt1);

$bk=date('Y-m-d', strtotime($date));
$b= $bk." 00:00:00";

$backDt=$b;

$updateDate=date('Y-m-d H:i:s');
$EntryDate=date('Y-m-d', strtotime($EntryDt));

$level= substr($MemberId,1,1);

  	$runsql4=mysqli_query($conn,"SELECT Expiry_month FROM `validity` where Leval_id='".$level."' ");
	$sql4fetch=mysqli_fetch_array($runsql4);
	

	
   $dd=date('Y-m-d', strtotime($backDt));
  
  
$exm="";
$exm=$sql4fetch['Expiry_month'];

if(date('d', strtotime($backDt))>="25" ){
    if(date("Y-m-d")>="2019-11-25"){$exm+=1;}
}





//=======================Function for add month in date ================


function addTime($time, $days, $months, $years)
{
    // Convert unix time to date format
    if (is_numeric($time))
    $time = date('Y-m-d', $time);

    try
    {
        $date_time = new DateTime($time);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        exit;
    }

    if ($days)
    $date_time->add(new DateInterval('P'.$days.'D'));

    // Preserve day number
    if ($months or $years)
    $old_day = $date_time->format('d');

    if ($months)
    $date_time->add(new DateInterval('P'.$months.'M'));

    if ($years)
    $date_time->add(new DateInterval('P'.$years.'Y'));

    // Patch for adding months or years    
    if ($months or $years)
    {
        $new_day = $date_time->format("d");

        // The day is changed - set the last day of the previous month
        if ($old_day != $new_day)
        $date_time->sub(new DateInterval('P'.$new_day.'D'));
    }
    // You can chage returned format here
    return $date_time->format('Y-m-d');
    
    
}



$d= strtotime(addTime($dd, 0, $exm, 0));

////////////////////////////////////////////////////////////////////




	// $d = strtotime("+".$exm." months",strtotime($dd));
      $expiryDt=  date("Y-m-d",$d);


 mysqli_query($conn,"START TRANSACTION");

 $q=mysqli_query($conn,"update Members set entryDate='".$b."', ExpiryDate='".$expiryDt."' where GenerateMember_Id='".$MemberId."' ");

 $q1=mysqli_query($conn,"insert into BackDate_LOG (member_Id,real_date,back_date,updateBy,updateDate)values('".$MemberId."','".$EntryDate."','".$bk."','".$_SESSION['user']."','".$updateDate."')");


if($q && $q1){
    echo "1";
    mysqli_query($conn,"COMMIT");
}else{
    echo "0";
    mysqli_query($conn,"ROLLBACK");
}

?>