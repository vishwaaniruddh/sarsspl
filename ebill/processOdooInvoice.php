<? include('config.php');


$invid  = $_REQUEST['invid'];

$sql = mysqli_query($con,"select * from send_bill where send_id='".$invid."'") ; 



$sql_result = mysqli_fetch_assoc($sql);
$invoice_no = $sql_result['invoice_no'];
$savedodooInvoice_a = $sql_result['odooInvoice_a'];
$savedodooInvoice_b = $sql_result['odooInvoice_b'];


if(isset($_REQUEST['submit'])){
    $odooInvoice_a = $_REQUEST['odooInvoice_a'];
    $odooInvoice_b = $_REQUEST['odooInvoice_b'];

    $statement= "update send_bill set odooInvoice_a='".$odooInvoice_a."',odooInvoice_b='".$odooInvoice_b."' where send_id='".$invid."'" ;
    if(mysqli_query($con,$statement)){ ?>
       
       <script>
           alert('Invoice Updated');
           window.location='oldeinvoice.php';
       </script> 
    <? }
    
}

?>



<html lang="en"><head>
  <meta charset="UTF-8">
  <title>CSS</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:500,400,300" rel="stylesheet" type="text/css">

  
  
  
<style>
html,
body {
  background-color: #f4f4f4;
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  margin: 0;
  color: #333;
}

body {
  display: flex;
  justify-content: center;
}

h1 {
  font-weight: 300;
}

main {
  align-self: center;
  background-color: #fefefe;
  border: 1px solid #f2f2f2;
  border-radius: 3px;
  box-shadow: 0 30px 60px -30px rgba(0, 0, 0, 0.5);
  min-width: 350px;
  max-width: 450px;
  width: 60vw;
  padding: 2rem;
}
main .form-buttons {
  display: flex;
  justify-content: flex-end;
  padding: 1em 0 0 0;
}
main .form-buttons button {
  margin-left: 16px;
}

.form-field {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 0.5em;
}
.form-field:last-child {
  margin-bottom: 0;
}
.form-field .icon {
  align-self: center;
  fill: #2980b9;
  padding: 0.5em 0.5em;
}
.form-field label {
  align-self: center;
  flex-shrink: 0;
  flex-basis: 100%;
  width: 100%;
  margin: 10px auto;
}
@media (min-width: 768px) {
  .form-field label {
    /*flex-basis: 80px;*/
    /*width: 80px;*/
  }
}
.form-field > section {
  border: 1px solid #aaa;
  border-radius: 3px;
  display: flex;
  flex: 1;
}
.form-field > section input {
  border: 0;
  border-left: 1px solid #ccc;
  flex-grow: 1;
  font-size: 1.1rem;
  font-weight: 300;
  padding: 0.35em 0.5em;
}

.icon {
  display: inline-block;
  width: 1em;
  height: 1em;
  fill: currentColor;
}

.a-btn, .a-btn--filled {
  padding: 0.35em 1em;
  box-shadow: 0 30px 60px -30px rgba(0, 0, 0, 0.5);
  cursor: pointer;
  border: 1px solid #3498db;
  background-color: #fff;
  transition: all 146ms ease;
  font-size: 1.2rem;
  border-radius: 3px;
  color: #3498db;
}
.a-btn:enabled:hover, .a-btn--filled:enabled:hover {
  background-color: #3498db;
  color: #fff;
  box-shadow: 0 8px 6px -6px rgba(0, 0, 0, 0.3);
}
.a-btn--filled {
  background-color: #3498db;
  border-color: #3498db;
  color: #fff;
}
.a-btn--filled:enabled:hover {
  background-color: #2980b9;
  border-color: #2980b9;
}
.a-btn:disabled, .a-btn--filled:disabled {
  background-color: #ecf0f1;
  border-color: #bdc3c7;
  color: #6a6a6a;
}

/* add a red asterisk after required labels 
 without having to include it in the markup */
.label--required:after {
  content: "*";
  color: red;
  margin-left: 5px;
}
</style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
</head>

<body translate="no">
  <main>
    <form method="POST" action="?invid=<? echo $invid ; ?>">
        <h1>Update/Enter Odoo Invoice </h1>

        <div class="form-field">
            <label for="field" class="label--required">CSS Invoice</label>
            <section>

                <input id="field" name="cssInvoice" required="" value="<? echo $invoice_no; ?>" type="text" placeholder="CSS Invoice" readonly>
            </section>
        </div>
<br />
<hr />
<br />
        <div class="form-field">
            <label for="phone" class="label--required"> Odoo Invoice - A </label>
            <section>

                <input id="phone" name="odooInvoice_a" value="<? echo $savedodooInvoice_a; ?>" required="" type="text" placeholder="Odoo Invoice - A">
            </section>
        </div>

        <div class="form-field">
            <label for="phone" class="label--required"> Odoo Invoice - B </label>
            <section>

                <input id="phone" name="odooInvoice_b" value="<? echo $savedodooInvoice_b; ?>" required="" type="text" placeholder="Odoo Invoice - B">
            </section>
        </div>



        <div class="form-buttons">
            <input type="submit" name="submit" class="a-btn" value="Update">
        </div>

    </form>
</main>

<svg style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
    <symbol id="icon-close" viewBox="0 0 24 24">
<title>close</title>
<path class="path1" d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
</symbol>
    <symbol id="icon-mail_outline" viewBox="0 0 24 24">
<title>mail_outline</title>
<path class="path1" d="M12 11.016l8.016-5.016h-16.031zM20.016 18v-9.984l-8.016 4.969-8.016-4.969v9.984h16.031zM20.016 3.984c1.078 0 1.969 0.938 1.969 2.016v12c0 1.078-0.891 2.016-1.969 2.016h-16.031c-1.078 0-1.969-0.938-1.969-2.016v-12c0-1.078 0.891-2.016 1.969-2.016h16.031z"></path>
</symbol>
<symbol id="icon-phone" viewBox="0 0 24 24">
<title>phone</title>
<path class="path1" d="M6.609 10.781c1.453 2.813 3.797 5.156 6.609 6.609l2.203-2.203c0.281-0.281 0.703-0.375 1.031-0.234 1.125 0.375 2.344 0.563 3.563 0.563 0.563 0 0.984 0.422 0.984 0.984v3.516c0 0.563-0.422 0.984-0.984 0.984-9.375 0-17.016-7.641-17.016-17.016 0-0.563 0.422-0.984 0.984-0.984h3.516c0.563 0 0.984 0.422 0.984 0.984 0 1.266 0.188 2.438 0.563 3.563 0.094 0.328 0.047 0.75-0.234 1.031z"></path>
</symbol>
<symbol id="icon-edit_location" viewBox="0 0 24 24">
<title>edit_location</title>
<path class="path1" d="M14.906 7.547c0.141-0.141 0.141-0.375 0-0.516l-0.938-0.938c-0.141-0.141-0.375-0.141-0.516 0l-0.703 0.703 1.453 1.453zM10.453 12l3.328-3.328-1.453-1.453-3.328 3.328v1.453h1.453zM12 2.016c3.844 0 6.984 3.141 6.984 6.984 0 5.25-6.984 12.984-6.984 12.984s-6.984-7.734-6.984-12.984c0-3.844 3.141-6.984 6.984-6.984z"></path>
</symbol>
<symbol id="icon-home" viewBox="0 0 24 24">
<title>home</title>
<path class="path1" d="M9.984 20.016h-4.969v-8.016h-3l9.984-9 9.984 9h-3v8.016h-4.969v-6h-4.031v6z"></path>
</symbol>
<symbol id="icon-person" viewBox="0 0 24 24">
<title>person</title>
<path class="path1" d="M12 14.016c2.672 0 8.016 1.313 8.016 3.984v2.016h-16.031v-2.016c0-2.672 5.344-3.984 8.016-3.984zM12 12c-2.203 0-3.984-1.781-3.984-3.984s1.781-4.031 3.984-4.031 3.984 1.828 3.984 4.031-1.781 3.984-3.984 3.984z"></path>
</symbol>
    <symbol id="icon-check_circle" viewBox="0 0 24 24">
<title>check_circle</title>
<path class="path1" d="M9.984 17.016l9-9-1.406-1.453-7.594 7.594-3.563-3.563-1.406 1.406zM12 2.016c5.531 0 9.984 4.453 9.984 9.984s-4.453 9.984-9.984 9.984-9.984-4.453-9.984-9.984 4.453-9.984 9.984-9.984z"></path>
</symbol>
    <symbol id="icon-search" viewBox="0 0 32 32">
<title>search</title>
<path class="path1" d="M31.008 27.231l-7.58-6.447c-0.784-0.705-1.622-1.029-2.299-0.998 1.789-2.096 2.87-4.815 2.87-7.787 0-6.627-5.373-12-12-12s-12 5.373-12 12 5.373 12 12 12c2.972 0 5.691-1.081 7.787-2.87-0.031 0.677 0.293 1.515 0.998 2.299l6.447 7.58c1.104 1.226 2.907 1.33 4.007 0.23s0.997-2.903-0.23-4.007zM12 20c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z"></path>
</symbol>
</defs>
</svg>
    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>

  
      <script id="rendered-js">
// 404
//# sourceURL=pen.js
    </script>

  



</body></html>