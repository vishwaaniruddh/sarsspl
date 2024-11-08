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
    <td>20</td>
    <td>8-Sep-20</td>
    <td>Maxcare</td>
    <td></td>
    <td><a href="promo/Maxcare/Maxcare_English.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>19</td>
    <td>8-Sep-20</td>
    <td>Corona Kavach</td>
    <td></td>
    <td><a href="promo/Corona Kavach/Corona Kavach_English.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>18</td>
    <td>8-Sep-20</td>
    <td>Wellness</td>
    <td></td>
    <td><a href="promo/Wellness/Wellness_English.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>17</td>
    <td>8-Sep-20</td>
    <td>Insurance</td>
    <td></td>
    <td><a href="promo/Insurance/Insurance.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>16</td>
    <td>8-Sep-20</td>
    <td>Loan Application</td>
    <td></td>
    <td><a href="promo/Loan Application/Loan Application.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>15</td>
    <td>8-Sep-20</td>
    <td>Video Making Services</td>
    <td></td>
    <td><a href="promo/Video Making Services/Video Making Services_English.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>14</td>
    <td>8-Sep-20</td>
    <td>Buddhanjali</td>
    <td></td>
    <td><a href="promo/Buddhanjali/Buddhanjali.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>13</td>
    <td>8-Sep-20</td>
    <td>Brand Up</td>
    <td></td>
    <td><a href="promo/Brand up/Brand up.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>12</td>
    <td>8-Sep-20</td>
    <td>Legal Shileld</td>
    <td></td>
    <td><a href="promo/Legal Shileld/Legal Shileld.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>11</td>
    <td>8-Sep-20</td>
    <td>Jain Namkeen </td>
    <td></td>
    <td><a href="promo/Jain/Jain_English.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Jain/Jain_Hindi.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>10</td>
    <td>8-Sep-20</td>
    <td>Trustee </td>
    <td></td>
    <td>No</td>
    <td><a href="promo/Trustee/Trustee.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>9</td>
    <td>8-Sep-20</td>
    <td>Shyam Baba </td>
    <td></td>
    <td>No</td>
    <td><a href="promo/Shyam baba/Shyam_baba.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>8</td>
    <td>18-Aug-20</td>
    <td>Deccan's Tulsi Satt </td>
    <td></td>
    <td><a href="promo/Tulsi_offer/tulsi_offer.php?id=<? echo $id;?>">Yes</a></td>
    <td>No</td>
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
    <td>12-Aug-20</td>
    <td>AatmNirbhar Image </td>
    <td>आत्मनिर्भर चित्र </td>
    <td><a href="promo/Atma_Nir_English/aatma_nirbhar_English.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Hindi/aatma_nirbhar_Hindi.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Marwari/aatma_nirbhar_Marwari.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Marathi/aatma_nirbhar_Marathi.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Gujarati/aatma_nirbhar_Gujarati.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Assamese/aatma_nirbhar_Assamese.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Bengali/aatma_nirbhar_Bengali.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Kannada/aatma_nirbhar_Kannada.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Malayalam/aatma_nirbhar_Malayalam.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Oriya/aatma_nirbhar_Oriya.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Tamil/aatma_nirbhar_Tamil.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Atma_Nir_Telgu/aatma_nirbhar_Telgu.php?id=<? echo $id;?>">Yes</a></td>
    
    

  </tr>


    <td>6</td>
    <td>12-Aug-20</td>
    <td>Profiting Today</td>
    <td></td>
    <td><a href="promo/Profiting_today/English/profit_today_English.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Hindi/profit_today_Hindi.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Marwadi/profit_today_Marwadi.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Marathi/profit_today_Marathi.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Gujarati/profit_today_Gujarati.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Assamese/profit_today_Assamese.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Bengali/profit_today_Bengali.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Kannada/profit_today_Kanada.php?id=<? echo $id;?>">Yes</a></td>
   
    <td><a href="promo/Profiting_today/Malyalam/profit_today_Malyalam.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Oriya/profit_today_Oriya.php?id=<? echo $id;?>">Yes</a></td>
    
    <td><a href="promo/Profiting_today/Tamil/profit_today_Tamil.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/Profiting_today/Telgu/profit_today_Telgu.php?id=<? echo $id;?>">Yes</a></td>

  </tr>
  
 
    <td>5</td>
    <td>16-Aug-20</td>
    <td>3 Ply Mask</td>
    <td>3 प्लाई मास्क</td>
    <td><a href="promo/mask_offer/mask_offer.php?id=<? echo $id;?>">Yes</a></td>
    <td><a href="promo/mask_offer/mask_offer_Hindi.php?id=<? echo $id;?>">Yes</a></td>
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
    <td>14-Aug-20</td>
    <td>Watch - Gents</td>
    <td>घड़ी - पुरुषों</td>
    <td><a href="promo/Erose_Gents_Watch/erose_gents_watch.php?id=<? echo $id;?>"> Yes</a></td>
    <td><a href="promo/Erose_Gents_Watch/erose_gents_watch_Hindi.php?id=<? echo $id;?>"> Yes</a></td>
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
    <td>14-Aug-20</td>
    <td>Watch - Ladies</td>
    <td>घड़ी - महिलाओं</td>
    <td><a href="promo/Erose_Ladies_watch/erose_ladies_watch.php?id=<? echo $id;?>"> Yes</a></td>
    <td>No</td>
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
    <td>12-Aug-20</td>
    <td>Clenveil Cream for Scars</td>
    <td> चेहरे के दाग मिटाने की क्रीम</td>
      <td><a href="promo/cream-offer/cream_offer.php?id=<? echo $id;?>"> Yes</a></td>
    <td>No</td>
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
    <td>1</td>
    <td>12-Aug-20</td>
    <td>Car Polish</td>
    <td>कार पॉलिश</td>
    <td><a href="promo/car-offer/car_offer.php?id=<? echo $id;?>"> Yes </a></td>
    <td><a href="promo/car-offer/Car Coating.php?id=<? echo $id;?>">Yes</a></td>
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