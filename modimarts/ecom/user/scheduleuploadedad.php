<?php
$dur=$_POST['duratn'];
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt1'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt2'])));

$days = (strtotime($dt2) - strtotime($dt1)) / (60 * 60 * 24);
//echo $days+1;

$dt=$dt1." 00:00:00";
$dtr=$dt2." 24:00:00";

//echo $dt."<br>".$dtr;
?>

<table border="2" class="table table-striped m-b-none">
<th>Duration</th>
<th>Date</th>
<th> Start Time</th>
<th> End Time</th>


<?php
while(date("Y-m-d H:i:s",strtotime($dt))<=date("Y-m-d H:i:s",strtotime($dtr)))
{
   ?>
   
   
   
   <?php
   $dt=date("d-m-Y H:i:s",strtotime($dt)+$dur); 
    
    if(date("Y-m-d H:i:s",strtotime($dt)+$dur)<=date("Y-m-d H:i:s",strtotime($dtr)))
    {
    //echo $dt."<br>"; 
    
    ?>
    <tr>
    <td><?php echo $dur." seconds";?></td>
    <td><?php echo date("d-m-Y",strtotime($dt));?></td>
   <td><?php echo date("h:i:s:a",strtotime($dt));?></td>
   <td><?php echo date("h:i:s:a",strtotime($dt)+$dur);?></td>
   </tr>
    <?php
    }
    else
    {
        break;
    }
}
?>
</table>

<?php

//echo "dur".$dur."days".$days;
echo doubleval(100)*doubleval($dur)*doubleval($days);

?>
<input type="amt" id="amt" name="amt" value="<?php echo doubleval(100)*doubleval($dur)*doubleval($days);?>">