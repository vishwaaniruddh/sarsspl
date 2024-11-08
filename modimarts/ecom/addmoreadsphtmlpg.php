<?php
$cnt=$_POST["videoscnt"];
?>
<div id="dv<?php echo $cnt;?>">
	<table align="center" width="100%">
  
             <tr>
                 
			<td> ADS Name<font color="red">*</font></td>
				<td>
				<input type="text" placeholder="Enter Name..."  id="dname<?php echo $cnt;?>" name="dname[]"  class="inp-form" required>
				
				</br>
					<lable class='errlable' id='dnamelable<?php echo $cnt;?>' style='display:none;'><font color='red' size='1'>Name is Mandatory</font></lable>
				</td>
 
                 
             <td>Select File<font color="red">*</font></td><td>
                 <input type="file" id="img<?php echo $cnt;?>"  class="inp-form" name="img[]" onchange="setFileInfo(this.files,'<?php echo $cnt;?>')" >
                
                 </br>
                
                 <lable class='errlable' id='imglable<?php echo $cnt;?>' style='display:none;'><font color='red' size='1'>Select File</font></lable>
                 
                 
                 </td>
                 
                 <td>
                     
                     Duration
                      <input type="text" style="width:40%" id="durationv<?php echo $cnt;?>" class="inp-form" name="durationv[]" readonly>
                      
                       <input type="hidden" style="width:40%" id="sizeinmb<?php echo $cnt;?>" class="inp-form" name="sizeinmb[]" readonly>
                      
                      
                     </td>
                 
                 <td>Description*</td>
				<td>	<input type="text" placeholder="Description"  id="desc<?php echo $cnt;?>" name="desc[]"  class="inp-form"  ></td>
				
				
				 
				<td>	<input type="button"   id="dated<?php echo $cnt;?>" name="dated[]"   onclick='selctdtfunc(<?php echo $cnt;?>,"","");' value="Select Date"></br>
				
				 <lable class='errlable' id='dtslable<?php echo $cnt;?>' style='display:none;'><font color='red' size='1'>Select Dates</font></lable>
                
				
				<input type="hidden" id="dateslectedid<?php echo $cnt;?>" name="dateslectedid[]"  class="inp-form" value="0" >
				</td>
                
                <td><button type="button" id="remv<?php echo $cnt;?>" name="remv[]" onclick="remfunc(<?php echo $cnt;?>);">X</button></td>
                 </tr>
                

	</table>
	</div>
	