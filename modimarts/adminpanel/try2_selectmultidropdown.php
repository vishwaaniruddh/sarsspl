<html>
<head>
     <link rel="stylesheet" href="multiSelectDropdown.css">
 <style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}
.ms-options-wrap > button > span {
    display: inline-block;
}



</style>
</head>

<body>
    <div width="30px">
    <select size="5" name="lstStates" multiple="multiple" id="lstStates">
    <optgroup label="Merchant" >
         <optgroup label=" ">
        <option value="1">Add Merchant</option>
        <option value="2">View Merchant</option>
         <option value="3">Merchant Report</option>
         </optgroup>
          </optgroup>
          
          
          
           <optgroup label="Admin Products">
               </optgroup>
                <optgroup label="Homepage Display Ads">
                <option value="4">Homepage Display Ads</option>
               </optgroup>
               
        <optgroup label="Visual Advertisement">
            <option value="5">Upload Ads</option>
            <option value="6">View Ads</option>
            <option value="7">ads slot booking</option>
              <option value="8">set todays date for ads</option>
        </optgroup>
         
          <optgroup label="Reports">
                <option value="9">products uploaded</option>
                <option value="10">Homepage Display Ads</option>
          </optgroup>
         
          
          
          
          
           <optgroup label="Merchant Products">
               <optgroup label=" ">
                  <option value="11">Products Approval</option>
                
          </optgroup>
          
          
          
          <optgroup label="Parameters">
              <optgroup label=" ">
                <option value="12">Rate per second </option>
              </optgroup >
          </optgroup>
          
          
             <optgroup label="Area">
               </optgroup>
                <optgroup label="Cities">
                <option value="13">Add Cities</option>
                 <option value="14">View Cities</option>
               </optgroup>
               
        <optgroup label="Areas">
            <option value="15">Add Areas</option>
            <option value="16">View Areas</option>
        </optgroup>
         
         
          <optgroup label="Category">
         <optgroup label=" ">
        <option value="17">Add Category</option>
        <option value="18">View Category</option>
        </optgroup>
          </optgroup>
          
           <optgroup label="Orders">
         <optgroup label=" ">
        <option value="19">Order Details</option>
        </optgroup>
          </optgroup>
          
          
           <optgroup label="Sub Admin">
         <optgroup label=" ">
        <option value="20">Add Sub Admin</option>
        </optgroup>
          </optgroup>
          
          
    </select>   
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>


 <script>
    $(function () {
    $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               } 
            });
            return labels.join(', ');  
         }
    }); 
});
</script>

<!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />-->