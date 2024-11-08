<!DOCTYPE html>
<html> 
    <head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
    <title>Captain INDIA</title>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
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
   
<script>
    var MapPoints = '<?php  echo   $map_arr  ; ?>' ;
     
    var MY_MAPTYPE_ID = 'custom_style';
    
    function initialize() {

        if (jQuery('#map2').length > 0) {
    
            var locations = jQuery.parseJSON(MapPoints);
    
            window.map = new google.maps.Map(document.getElementById('map2'), {
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
                 
            });
    
            var infowindow = new google.maps.InfoWindow();
            var flightPlanCoordinates = [];
            var bounds = new google.maps.LatLngBounds();
    
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                map: map,
                 icon:  locations[i].icon,
                });
                flightPlanCoordinates.push(marker.getPosition());
                bounds.extend(marker.position);
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i]['title']);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
            map.fitBounds(bounds);
           
            var flightPath = new google.maps.Polyline({
                map: map,
                path: flightPlanCoordinates,
                strokeColor: "#0000FF",
                strokeOpacity: 1.0,
                strokeWeight: 2
            });
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<div id="map2" style="border: 0px solid #3872ac;"  class="full-height" ></div>
</body>
</html>