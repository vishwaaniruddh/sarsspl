<html>
   
   <head>
  <title>Allmart.world</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></script>-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"</script>
    
  
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
   </head>
   
   <body>
      
   
      <!--<h2>Allmart.world</h2>-->
      
      <!--<form method = "post" action = "newmembers.php" >-->
      <!--   <table>-->
            
      <!--         <td>Ads Name</td>-->
      <!--         <td>-->
      <!--                <select name="cars" id="adsname">-->
      <!--                <option value="tata">Volvo</option>-->
      <!--              </select>-->
      <!--         </td>-->
      <!--      </tr>-->
            
      <!--      <tr>-->
      <!--         <td>Languages</td>-->
      <!--         <td>-->
      <!--            <select name="cars" id="language">-->
      <!--                <option value="volvo">Volvo</option>]-->
      <!--              </select>-->
      <!--         </td>-->
      <!--      </tr>-->
            
      <!--      <tr>-->
      <!--         <td>Status:</td>-->
      <!--         <td>-->
      <!--            <input type = "radio" name = "Status"  value = "1">Yes-->
      <!--            <input type = "radio" name = "Status" onclick="idForm()" value = "0">No-->
      <!--         </td>-->
      <!--      </tr>-->
            
      <!--      <tr style="display:none;">-->
      <!--         <td>Date:</td> -->
      <!--         <td><input type = "date" name = "Date1" id="datepicker"></td>-->
      <!--      </tr>-->
            
      <!--      <tr style="display:none;" >-->
      <!--         <td>Advertisement Name:</td>-->
      <!--         <td><input type = "text" name = "Adname"></td>-->
      <!--      </tr>-->
            
            

      <!--      <tr style="display:none;">-->
      <!--         <td>Languages</td>-->
      <!--         <td>-->
      <!--            <select name="cars" id="language1">-->
      <!--                <option value="Tata">Tata Motoers</option>]-->
      <!--              </select>-->
      <!--         </td>-->
      <!--      </tr>-->
        
                       
      <!--         <td>-->
      <!--            <input type = "submit" name = "submit" value = "Submit"> -->
      <!--         </td>-->
      <!--      </tr>-->
      <!--   </table>-->
      <!--</form>-->
<form>
     <div class="form-group" >
        <label for="exampleFormControlSelect1">Promotions:</label>
        <select class="form-control" id="adsname" > 
          <!--<option></option>.-->
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Language</label>
        <select class="form-control" id="language">
          <option>Hindi</option>
          <option>English</option>
          <option>Marathi</option>
          <option>Gujarati</option>
          <option>Tamil</option>
        </select>
      </div>
      
  <fieldset class="form-group">
    <div class="row" >
      <legend class="col-form-label col-sm-2 pt-0">Is it a new Ad?</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" onclick="idForm()" value="0" >
          <label class="form-check-label" for="gridRadios1">
            Yes
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="1" checked>
          <label class="form-check-label" for="gridRadios2">
            No
          </label>
        </div>
        <!--<div class="form-check disabled">-->
        <!--  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>-->
        <!--  <label class="form-check-label" for="gridRadios3">-->
        <!--    Third disabled radio-->
        <!--  </label>-->
        <!--</div>-->
      </div>
    </div>
  <!--</fieldset>-->
  <!--<div class="form-group row">-->
  <!--  <div class="col-sm-2">Checkbox</div>-->
  <!--  <div class="col-sm-10">-->
  <!--    <div class="form-check">-->
  <!--      <input class="form-check-input" type="checkbox" id="gridCheck1">-->
  <!--      <label class="form-check-label" for="gridCheck1">-->
  <!--        Example checkbox-->
  <!--      </label>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>   
   </body>
  <script type="text/javascript" src="form.js"></script> 
 
</html>