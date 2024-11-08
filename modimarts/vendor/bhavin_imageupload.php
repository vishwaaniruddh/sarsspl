<!DOCTYPE html>
<html>
    <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script>
        function addItem()
        {

	if (window.XMLHttpRequest)
      {
      xmlhttp=new XMLHttpRequest();
      } 
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
		
		var newdiv=document.createElement("tr");
        newdiv.innerHTML=xmlhttp.responseText;
        
	document.getElementById('attatch').appendChild(newdiv);
    }
  }
  
    
  //alert("addrow_image.php?cnt="+cnt);
xmlhttp.open("GET","bhavin_addrowimg.php",true);
xmlhttp.send();	
}

function deleterow() {
    var table = document.getElementById("attatch");
    var rowCount = table.rows.length;
if(rowCount!=1){
    table.deleteRow(rowCount -1);
}
}
</script>
    </head>
    
<body>
    
<h2 align="center">File Upload</h2>

<form action="processAddProducts.php" method="post" enctype="multipart/form-data">

<div class="container" >
  
  <div class="form-inline">
  <div class="form-group">
      Upload:
      <select class="form-control" style="width:300px">
        <option id="">Select</option>
        <option id="1">Image</option>
        <option id="2">Vedio</option>
   </select>
  </div>
  </div>
  
  
<br />

 <div class="container">
 <table id="attatch" class="table table-bordered">
     <tr >
         <td><div align="left">Product Image</div></td>
         <td colspan="3">
             <input type="file" name="image[]" class="form"  required  />
         </td>
             <td>
               <button type="button" class="btn blue" onClick="addItem();">ADD MORE Images</button>
             </td>
             <td>
               <button type="button" class="btn blue" onClick="deleterow();">Delete Rows</button>
             </td>
     </tr>
 </table>
 </div>
 
</form> 
</body>
</html>
