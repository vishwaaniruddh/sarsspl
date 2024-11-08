<?php
include 'config.php';
$cnt = $_GET['cnt'];
$j = $cnt - 1;
?>

<td><input type="hidden" value="<?php echo $cnt; ?>" name="sr[]" id="sr" class="sr" /><?php echo $cnt; ?></td>
<td>

 <select style="width:140px;" name="proc[]" id="proc<?php echo $j; ?>" class="proc" onchange="proce(<?php echo $j; ?>);">
     <option value="0">Select</option>
     <?php
        $sq = mysqli_query($con, "select * from service_master where serv_name<>'' order by id");
        while ($ro = mysqli_fetch_row($sq)) {
        ?>
         <option value="<?php echo $ro[0]; ?>"><?php echo $ro[1]; ?></option>
     <?php } ?>
 </select>
</td>



<td><input type="text" name="rate[]" id="rate<?php echo $j; ?>" class="rate" style="width:140px;" /></td>
<td><input type="text" name="qty[]" id="qty<?php echo $j; ?>" value="1" class="rate" style="width:40px;" /></td>
<td><input type="text" name="discount[]" id="discount<?php echo $j; ?>" class="discount" style="width:140px;" /></td>                                    

<td><input type="text" name="amt[]" id="amt<?php echo $j; ?>" class="amt" style="width:140px;" /></td>
<!-- <td><input type="text" name="amtad[]" id="amtad<?php echo $j; ?>" class="amt" style="width:140px;" /></td>
<td><input type="text" name="rem[]" id="rem<?php echo $j; ?>" class="amt" style="width:140px;" /></td> -->