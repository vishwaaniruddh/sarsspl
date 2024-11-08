<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Form</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
      
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
      <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></script>-->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
      
</head>
<!doctype html>
<html lang="en">

<body>
   <form class="needs-validation"  id="noform">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationTooltip01">Advertise Name</label>
      <input type="text" class="form-control" id="adname" name="adname" placeholder="Please enter the Advertise name." required>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
   
  </div>
<div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationTooltip02">Language</label>
      
      <input type="text" class="form-control" id="languagae" name="languagae" placeholder="Please enter the Language." required>
          <div class="valid-tooltip">
            Looks good!
          </div> 
    </div>
</div>
<div>
    
</div>
    
    <div class="form-row">
           <div class="col-md-6 mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image_name" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" id='image_label' for="inputGroupFile01" >Choose file</label>
                  </div>
          </div>
    </div>
    
  <button class="btn btn-primary" type="submit">Submit form</button>
</form>
</body>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->
<script type="text/javascript" src="noform.js"></script> 
</html>