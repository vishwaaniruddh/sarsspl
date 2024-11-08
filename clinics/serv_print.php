<?php 
include 'config.php';

$billno  = $_GET['billno'];
$name = $_GET['name'];
$agesex = $_GET['agesex'];
$address = $_GET['address'];
$contact = $_GET['contact'];
$amtc=$_GET['amtc'];
$rem=$_GET['rem'];
$proc1=$_GET['proc1'];
$rate1=$_GET['rate1'];
$amt1=$_GET['amt1'];


?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript">

                 $(document).ready(function() {

                        $('#cou_btn').click(function(e) {
                          e.preventDefault();

                          w=window.open();
                          var temp=$('#cou_box').html();
                          w.document.write(temp);
                          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
        else w.print();
                          w.close();
                         return false;
                        });
                       });  


            </script>


            <div id="cou_box">
              <table>
                
                <tr> 
            	<td width="401">Name :</td>
                <td width="236"><input id="name" name="name" type="text" value="<?php echo $name; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Age/Sex :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $agesex; ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
               
                <tr>
                <td><label class="pro_diag">Address :</label></td>
                <td><textarea name="inv" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" readonly><?php echo $address; ?></textarea></td>
				</tr>
                
                 <tr>
                <td><label class="datead">Contact No:</label></td>
                <td> <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php echo $contact; ?>" readonly="readonly"></td>
                </tr>
               
                
             <tr><td colspan="4"> 
             <table width="882" border="1">
             <tr>
             <th width="27">Sr no</th>
             <th width="122">Chargeable Procedure</th>
             <th width="84">Rate</th>
             <th width="202">Amt. Claimed with date</th>
             </tr>
             
             <?php 
			 $i=1;
			 for($j=0;$j<=2;$j++){?>
                <tr>
                <td><?php echo $i; ?></td>
                <td>
                <select style="width:140px;" name="proc[]" id="proc" class="proc">
                <option value="0">Select</option>
                </select>
                </td>
                
                       

				<td><input type="text" name="rate[]" id="rate[]" class="rate" style="width:140px;"/></td>
                
                <td><input type="text" name="amt[]" id="amt[]" class="amt" style="width:140px;"/></td>
                </tr>

<?php  $i++; } ?>
            </table> 
            <tr>
             
             <td width="242">Amount Claimed : </td>
             <td width="240"><?php echo $amtc; ?> </td>
             </tr>
             
             <tr>
             
             <td>Remarks : </td>
             <td><?php echo $rem; ?> </td>
             </tr>
               
<!--end discharge form-->
                                              
               
                </table>         
            </div>
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>