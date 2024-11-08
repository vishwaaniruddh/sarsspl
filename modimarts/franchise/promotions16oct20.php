<? include('config.php'); 
   error_reporting(0); 

function get_promotion($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from promotions where id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['promotions'];
}


function get_language($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from promotions where id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['promotions'];
}


function lang_promo($language,$promotion){
    global $con;
    
    $sql = mysqli_query($con,"select * from total_promotions  where promotion='".$promotion."' and language='".$language."'");
    if($sql_result= mysqli_fetch_assoc($sql)){
        return 1;
    }
    else{
        return 0;
    }
    
    
}
 ?> 
<html>
<head>
    <title>AllMart | Franchise</title>
    
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
</head>

<script>
    if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            // console.log('Reloading');
            window.location.reload(); // reload whole page

        }
</script>

<style>
table, td, th {  
  border: 1px solid black;
  text-align: center;
}

table {
  border-collapse: collapse;
  width: 100%;
}

td{
    background-color: #ffeee6;
}

th, td {
  padding: 7px;
}

</style>

<style>
    * {
    box-sizing: border-box;
    }
    body{
    margin: 0;
    background-color:rgb(240,240,240);
    scroll-behavior: smooth;
    }

    /* Style the top navigation bar */
    .heading {
    overflow: hidden;
    background-color: red;
    padding-top: 10px;
    }

    /* Style the topnav links */
    .heading a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    text-decoration: none;
    font-size: 50px;
    
    }

    /* Change color on hover */
    .heading a:hover {
    color: black;
    }

    .main{
        background-color: white;
        padding: 20px;
        box-shadow: 5px 10px #888888;
        }


    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    text-align: center;
    padding: 8px;
    /*white-space: nowrap;*/
    border: 1px solid;
}
    input{
    width: 140px;
    margin-bottom: 10px;
    }


    #member_pic img{
        height: 150px;
        /*width: 150px;*/
            /*border: 1px solid black;*/
    }



    @media only screen and (max-width: 768px) {
    .col{
        margin-top: 20px;
    }

    .row{
        display: flex;
        flex-direction:column;
    }
    }




/* Style the footer */
    .footer {
        background-color:red;
        padding: 10px;
        text-align: center;
        padding: 30px;
        height: 280px; 
        padding-left: 20px;
        padding-right: 20px;
        
    }

    .contact_us{
        color: white;
        line-height: 30px;
        font-size: 18px;
        margin-top: 20px;
    
    }


    .social_a{
        text-decoration: none;
        color: white;
    }

    .social_label{
        margin-left: 10px;
        margin-right: 10px;
        padding: 20px;
        
    }
    .heading {
        display: flex;
    }
    .logo {
        width: 30%;
    }
    .menu {
        width: 70%;
    }
    .menu ul {
        float: right;
    }

    .menu_ul {
        padding: 0;
        margin: 3%;
        list-style-type: none;
    }
    .menu ul li a {
        font-size: 18px;
    }

    .menu_ul{
            width: 100%;
        display: flex;
        justify-content: flex-end;
    }
    .menu_ul li{
        margin: auto 2%;
    }
    .custom_row{
        display:flex;
    }
    
    .col input,.col select{
        width:100%;
    }
    .cust_col{
        padding-left:1%;
        padding-right:1%;
    }
    
.typeahead li a{
    font-size: 14px;
}
    
    
    input{
            border-left: none;
    border-top: none;
    border-right: none;
    }
    
    input:focus{
            border-left: none;
    border-top: none;
    border-right: none;
    }
    
    #myModal td{
        text-align:left;
    }
    
    .sweet-alert button{
        margin:0 !important;
        font-size: 12px !important;
    }
    .sweet-alert h2{
            font-size: 20px !important;
            margin: 10px 0 !important;
    }
    
    .confirm{
        font-size: 18px;
        color: red;
        font-weight: 700;
    }
    .heading a:hover {
    color: cyan;
}
.nav>li>a:focus, .nav>li>a:hover{
    background-color:red;
}


ul.typeahead{
    width:100%;
}

#franchise_of{
    text-align: center;
    color: red;
    text-decoration: underline;
    font-weight: 700;
}
</style>
<body>
<? 
 $id = $_GET['id'];
    ?>
    <div class="heading">

        <div class="logo">
        <a href="https://allmart.world/franchise/get_members.php"><img src="2.png" alt="" style="width: 100px; padding:10px;"><span style="font-size:0.7em;">Allmart.world</span></a>
        </div>
        
        <div class="menu">
          <? include('menu.php');?>
        </div>

    </div>
<br>
<br>
    <div class="container-fluid" style="overflow-x:auto;">

<table>
  <tr>
    <th>Sr.No</th>
    <th>Date</th>
    <th>Advertisement Name</th>
    <!--<th>विज्ञापन के नाम</th>-->
<? $lang_sql = mysqli_query($con,"select * from language");
while($lang_sql_result = mysqli_fetch_assoc($lang_sql)){ ?>

   <th><? echo $lang_sql_result['language'];?></th> 

<? }

?>
   
    
  </tr>
  
  <?
  $sql  = mysqli_query($con,"SELECT * FROM promotions");
  while($sql_result = mysqli_fetch_assoc($sql)){
  $promotion = $sql_result['id'];
//   echo $promotion;
  ?>
  <tr>      
    <td>3</td>
    <td>8-Sep-20</td>
    <td><? echo $sql_result['promotions'];?> </td>

<? $lang_sql = mysqli_query($con,"select * from language");
while($lang_sql_result = mysqli_fetch_assoc($lang_sql)){ 


$language = $lang_sql_result['id'];

if(lang_promo($language,$promotion)==1){ ?>
      <th><a href="promo/view_promotion.php?id=<? echo $id; ?>&&language=<? echo $language; ?>&&promotion=<? echo $promotion; ?>">Yes</a></th> 
<? }else{ ?>
      <th>No</th>
<? }

 }

?>
  </tr>      
<?  }
  
  ?>

</table>

</div>

</body>
</html>