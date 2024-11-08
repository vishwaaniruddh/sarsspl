<script>
var valid = false;

function validate_fileupload(input_element)
{
    var el = document.getElementById("feedback");
    var fileName = input_element.value;
    var allowed_extensions = new Array("jpg","png","gif");
    var file_extension = fileName.split('.').pop(); 
    for(var i = 0; i < allowed_extensions.length; i++)
    {
        if(allowed_extensions[i]==file_extension)
        {
            valid = true; // valid file extension
            el.innerHTML = "";
            return;
        }
    }
    el.innerHTML="Invalid file";
    valid = false;
}

function valid_form()
{
    return valid;
}
</script>

<div id="feedback" style="color: red;"></div>
<form method="post" action="b.php" enctype="multipart/form-data">
  <input type="file" name="fileName" accept=".jpg,.png,.bmp" onchange="validate_fileupload(this);"/>
  <input id="uploadsubmit" type="submit" value="UPLOAD IMAGE" onclick="return valid_form();"/>
</form>