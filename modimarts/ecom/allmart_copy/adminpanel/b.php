<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>jQuery Multi Select Dropdown with Checkboxes</title>


</head>
<body>
<form id="form1">
<div class="facilities">
    <span class="label">Facilities</span>
    <span class="input">
        <select>
           <option value="">--- All ---</option>
           <option value="39945">Internet</option>
           <option value="39946">Swimming Pool</option>
           <option value="39947">Beach</option>
           <option value="39948">B&B</option>
           <option value="39949">Restaurant</option>
        </select>
        <input type="button"  onclick="a()">
    </span>
</div>
</form>
</body>
</html>

<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>
<script>
$(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.facilities select option');
  var selected = $('.facilities').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.facilities').find('select').empty().append( my_options );
  $('.facilities').find('select').val(selected);
  
  // set it to multiple
  $('.facilities').find('select').attr('multiple', true);
  
  // remove all option
  $('.facilities').find('select option[value=""]').remove();
  // add multiple select checkbox feature.
  $('.facilities').find('select').multiselect();
})

function a()
{
    
    
     var selected = $(".facilities option:selected");
                var message = "";
                selected.each(function () {
                  message += $(this).text() + " " + $(this).val() + "\n";
                 // message +=$(this).text()+ " ";
            //// message1 = $(this).text();
                });
            // alert(message1);   
//alert(message); 

    var fields2 = message.split(" ");
  //alert(fields2)
 
  var q= fields2.slice(0, -1);;
  alert(q);
    
}


</script>

