 <?php 
include('config.php');
 $id=$_POST['ccode'];
 /*
    $sdate=date("Y-m-d");
    $Q="select tilldate from Subscription where mid='".$id."'";
    $ret = mysql_query($Q);
    $row = mysql_fetch_array($ret);
    $sql2="update Subscription set status='Expire' where mid='".$id."' and tilldate<'".$sdate."' ";
    $result2 = mysql_query($sql2);
    echo $sql2;*/
                                        
    //------------------------------------------------------------------------------------------------------------------------------
    // -----------code for if subscription package is expire then update clients table and  Subscription table  ----------------------      
    $Q="select tilldate from Subscription where mid='".$id."'";
                                    
    $ret = mysqli_query($con1,$Q);
    $row = mysqli_fetch_array($ret);
                    
    $sdate=date("Y-m-d");
    $mont=$row[0];
                            
    $date1=date_create("$sdate");
    $date2=date_create("$mont");
    $diff=date_diff($date1,$date2);
    // $diffck= $diff->format("%R%a days");
    $diffs= $diff->format("%a ");
    //echo  $diffck;

    if($diffs==0){
    $sql1="update clients set subscribe='Expire' where code='".$id."'";
    $result1 = mysqli_query($con1,$sql1);
   // echo $sql1;
     $sql2="update Subscription set status='Expire' where mid='".$id."'";
    $result2 = mysqli_query($con1,$sql2);
    //echo $result2;
    }
?>