<html>
<head>
    <title>OMS Location | ModiMart</title>
    
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    
    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.png" type="image/png"/>
    
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
    padding-top : 17px;
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
        width: 30%;
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
.tagname {
        width:40%;
        text-align:center;
    }
</style>
<body>

    
    <? 
    
    $id = $_GET['id'];
    ?>
    <div class="heading">

        <div class="logo">
        <a href="https://modimart.world/franchise4/get_members.php"><img src="visiting_assets/modi-logo.png" alt="" style="width: 40%;background:white;"></a>
        </div>
        <div class="tagname">
            <img src="visiting_assets/omslogo.png" alt="" style="width:50%;background:white;">
            <!--<h4 style="color:aliceblue;width:115%;">TradeEx.World</h4>-->
        </div>
        <!--<div class="menu">-->
                            <? //include('menu.php');?>
        <!--</div>-->

    </div>
    
<br>
<br>
    <div class="container-fluid" style="overflow-x:auto;">

<table>
  <tr>
    <th>Sr.No</th>
    <th>Date</th>
    <th>Advertisement Name</th>
    <th>विज्ञापन के नाम</th>
    <th>English</th>
    <th>हिंदी</th>
    <th>मारवाडी</th>
    <th>मराठी</th>
    <th>गुजराती</th>
    <th>Assamese</th>
    <th>Bengali</th>
    <th>Kannada</th>
    <th>Malyalam</th>
    <th>Oriya</th>
    <th>Tamil</th>
    <th>Telugu</th>
  
    
  </tr>
  
  <tr>      
    <td>1</td>
    <td>08-Oct-22</td>
    <td>Property Registration</td>
    <td></td>
    <td><a href="promo/Property Registration/property.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  
  <tr>      
    <td>2</td>
    <td>08-Oct-22</td>
    <td>Music Album</td>
    <td></td>
    <td><a href="promo/Music Album/album.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  
   <tr>      
    <td>3</td>
    <td>08-Oct-22</td>
    <td>Short Films</td>
    <td></td>
    <td><a href="promo/Short Films/short_films.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  
  <tr>      
    <td>4</td>
    <td>08-Oct-22</td>
    <td>Mr./Miss & Mrs. India</td>
    <td></td>
    <td><a href="promo/Mr. Miss Mrs. India/india.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  
  <tr>      
    <td>5</td>
    <td>08-Oct-22</td>
    <td>Corporate Films</td>
    <td></td>
    <td><a href="promo/Corporate Films/corporate.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  
  <tr>      
    <td>6</td>
    <td>08-Oct-22</td>
    <td>In-Film Branding</td>
    <td></td>
    <td><a href="promo/In-Film Branding/in-films.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  
  
  <tr>      
    <td>7</td>
    <td>08-Oct-22</td>
    <td>Destination Wedding</td>
    <td></td>
    <td><a href="promo/Destination Wedding/destination.php?id=<? echo $id;?>" target="_blank">Yes</a></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

  </tr>
  

</table>

</div>

</body>
</html>