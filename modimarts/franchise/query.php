<?php 
    include ('config.php');
    $country_query="SELECT * FROM country"; 
    $country_con=mysqli_query($conn,$country_query);
   
    $zone_query="SELECT * FROM zone"; 
    $zone_con=mysqli_query($conn,$zone_query);
    
    $state_query="SELECT * FROM state"; 
    $state_con=mysqli_query($conn,$state_query);
    
    $city_query="SELECT * FROM city"; 
    $city_con=mysqli_query($conn,$city_query);
    
    $district_query="SELECT * FROM district"; 
    $district_con=mysqli_query($conn,$district_query);
        
    $taluka_query="SELECT * FROM taluka"; 
    $taluka_con=mysqli_query($conn,$taluka_query);
   
    $ward_query="SELECT * FROM ward"; 
    $ward_con=mysqli_query($conn,$ward_query);
    
  ?>