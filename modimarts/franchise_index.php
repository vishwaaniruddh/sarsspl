<html>
<head>
    <title>ModiMart | Franchise</title>
    
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png"/>
    
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
  border : 1px solid black;
}

tr, td {
    border : 1px solid black;
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
    border: 1px solid black;
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
        <a href="#"><img src="/assets/logo.png" alt="" style="width: 100px; padding:10px;"><span style="font-size:0.7em;">Modimart.world</span></a>
        </div>
        
        <div class="menu">
                            <? include('menu.php');?>
        </div>

    </div>
    
<section class="section">
            <div class="row" id="table-bordered">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="text-align:center"><u><b>Franchise List</b></u></h3>
                  </div>
                  <div class="card-content">
                   
                    <!-- table bordered -->
                    <div class="table-responsive">
                      <table class="table table-bordered mb-0">
                        <thead>
                          <tr>
                            <th>LOGO</th>
                            <th>NAME</th>
                            <th>TAG LINE</th>
                            <th>LINK</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            
                        <tr>
                            <!--<td><img src="favicons/r-mart.ico"></td>-->
                            <td><img src="favicons/press_index.png" style="width: 100px;height: 100px;" alt="Press "></td>
                            <td><b>Press</td>
                            <td>Mission Patrakarita</td>
                            <td><a href="franchise8/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                        </tr>
                            
                        <tr>
                            <!--<td><img src="favicons/r-mart.ico"></td>-->
                            <td><img src="favicons/rmart.png" style="width: 100px;height: 100px;"></td>
                            <td><b>R-Mart</td>
                            <td>Farm To Kitchen</td>
                            <td><a href="franchise7/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                        </tr>
                          <tr>
                            <td><img src="favicons/trade.ico"></td>
                            <td><b>TradeEx.World</td>
                            <td>Your Product Exchange</td>
                            <td><a href="franchise6/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                          </tr>
                          <tr>
                              <td><img src="favicons/oms.ico"></td>
                            <td><b>OMS Location</b></td>
                            <td>Your Shooting and Location Solutions</td>
                            <td><a href="franchise4/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                          </tr>
                          <tr>
                              <td><img src="favicons/celeb.ico" ></td>
                            <td><b>Celebrity School</b></td>
                            <td>Learning Video From Legends</td>
                            <td><a href="franchise2/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                          </tr>
                          <tr>
                              <td><img src="favicons/doubtx.ico" ></td>
                            <td><b>DoubtX</b></td>
                            <td>Education Software Play Group to 12</td>
                            <td><a href="franchise3/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                          </tr>
                          <tr>
                              <td><img src="favicons/npa.ico" ></td>
                            <td><b>Non Performance Assets Accounts Holders Welfare Association</b></td>
                            <td>We Solve All India NPA Problem From Bank and Private Finance </td>
                            <td><a href="franchise5/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                          </tr>
                          <tr>
                              <td><img src="favicons/modimart.ico" ></td>
                            <td><b>Modimart</b></td>
                            <td>Sell Your Products</td>
                            <td><a href="franchise/get_members.php" target="_blank">CLICK HERE !!!</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

</div>

</body>
</html>