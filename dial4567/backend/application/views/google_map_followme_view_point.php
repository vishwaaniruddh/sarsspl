<!DOCTYPE html>
<html> 
    <head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
    <title>Captain INDIA</title> 
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8"       type="text/javascript"></script>
    <style>
        html, body {
            height: 100%;margin: 0px;
        }
        .full-height {
            height: 100%;
        }
    </style>
    </head> 
<body>
  <div id="map" style=" " class="full-height"></div>
  <!--<div id="map" style="width: 100%;height:1800px; "></div>-->

  <script type="text/javascript">
    // var locations = [
    //   ['Bondi Beach', -33.890542, 151.274856, 4],
    //   ['Coogee Beach', -33.923036, 151.259052, 5],
    //   ['Cronulla Beach', -34.028249, 151.157507, 3],
    //   ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
    //   ['Maroubra Beach', -33.950198, 151.259302, 1]
    // ];
    
    /* Multiple markers location, latitude, and longitude */
    var locations = [
           <?php 
           $map_arr = json_decode($map_array);
           foreach( $map_arr as $k=>  $row  ){ 
              $ct = (int)$k+1;
                echo '["'.$row[0].'", '.$row[1].', '.$row[2].',  "'. (int)$ct.  '", "'.$row[4]. '" ],'; 
            }
        ?>
    ];
        
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
    //   center: new google.maps.LatLng(-33.92, 151.25),
      center: new google.maps.LatLng( <?php echo $first_arr_lat; ?>, <?php echo $first_arr_lng; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon:  locations[i][4],
        
        // START - map change 20-jul-2022
        label: {
          color: '#fff',
          fontSize: '16px',
          fontWeight: '600',
         // text:"1"// locations[i][3],
          text: locations[i][3],
        }
        // END - map change 20-jul-2022
        
      });
      
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>