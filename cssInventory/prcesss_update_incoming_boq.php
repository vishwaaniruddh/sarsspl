<? session_start();
include('config.php');

$id = $_REQUEST['id'];
$material = $_REQUEST['material'];
$serial_number = $_REQUEST['serial_number'];
$boq_id = $_REQUEST['boq_id'];
$remark2 = $_REQUEST['remark2'];
$not_remark = $_REQUEST['not_remark'];


$notification_to_sql = mysqli_query($css,"select created_by from boq_raise where id='".$id."'");
$notification_to_sql_reuslt = mysqli_fetch_assoc($notification_to_sql);

$notification_to = $notification_to_sql_reuslt['created_by'];


$sql = "update boq_raise set updated_at='".$datetime."',updated_by='".$userid."',dept='inventory',updated_by_name='".$username."' where id='".$id."'";


if(mysqli_query($css,$sql)){
    $i=0;
    foreach($boq_id as $k=>$v){        
        $update = "update boq_raise_detail set serial_number='".$serial_number[$i]."',remark2='".$remark2."' where id='".$v."'";
        mysqli_query($css,$update);
        $i++;
    }
    
    $notification = "insert into notification(department,userid,remark,is_seen,created_by,created_at,status,module,notification_to) values('Inventory','".$userid."','".$not_remark."','0','".$userid."','".$datetime."','1','BOQ','".$notification_to."')";
    mysqli_query($css,$notification);
    
    
    ?>
    
    <script>
        alert('BOQ UPDATED');
        window.location.href="incoming_boq.php";
        
    </script>
    
<? } ?>