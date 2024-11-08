<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8"       type="text/javascript"></script>
</head> 
<body>

   
  <script>
    //var MapPoints = '[{"address":{"address":"","lat":"18.603033","lng":"73.788562"},"title":""},{"address":{"address":"","lat":"18.603043","lng":"73.788556"},"title":""},{"address":{"address":"","lat":"18.603136","lng":"73.788483"},"title":""},{"address":{"address":"","lat":"18.603096","lng":"73.788451"},"title":""},{"address":{"address":"","lat":"18.603030","lng":"73.788553"},"title":""},{"address":{"address":"","lat":"18.603042","lng":"73.788557"},"title":""},{"address":{"address":"","lat":"18.603043","lng":"73.788557"},"title":""},{"address":{"address":"","lat":"18.603036","lng":"73.788563"},"title":""},{"address":{"address":"","lat":"18.603035","lng":"73.788564"},"title":""},{"address":{"address":"","lat":"18.603034","lng":"73.788553"},"title":""},{"address":{"address":"","lat":"18.603034","lng":"73.788552"},"title":""},{"address":{"address":"","lat":"18.603034","lng":"73.788552"},"title":""},{"address":{"address":"","lat":"18.603034","lng":"73.788552"},"title":""},{"address":{"address":"","lat":"18.603043","lng":"73.788557"},"title":""},{"address":{"address":"","lat":"18.603039","lng":"73.788564"},"title":""},{"address":{"address":"","lat":"18.603039","lng":"73.788564"},"title":""},{"address":{"address":"","lat":"18.603032","lng":"73.788559"},"title":""},{"address":{"address":"","lat":"18.603035","lng":"73.788554"},"title":""},{"address":{"address":"","lat":"18.603141","lng":"73.788516"},"title":""},{"address":{"address":"","lat":"18.603034","lng":"73.788558"},"title":""},{"address":{"address":"","lat":"18.603040","lng":"73.788558"},"title":""},{"address":{"address":"","lat":"18.603026","lng":"73.788434"},"title":""},{"address":{"address":"","lat":"18.603035","lng":"73.788562"},"title":""}]';
    var MapPoints = <?php $map_arr = json_decode($map_array);
        $ct=count($map_arr);
               foreach( $map_arr as $k=>  $row  ){
                   if($k ==0) {
                   echo '\'[';
                   }
                    echo '{"address":{"address":"","lat":"'.$row[1].'","lng":"'.$row[2]. '","icon":"'.$row[4].'"},"title":"'.$row[0].'"}';
                    if(++$k ==$ct) {
                   echo ']\'';
                   } else {
                    echo ','; 
                   }
                }
            ?>;
var MY_MAPTYPE_ID = 'custom_style';

function initialize() {

    if (jQuery('#map').length > 0) {

        var locations = jQuery.parseJSON(MapPoints);

        window.map = new google.maps.Map(document.getElementById('map'), {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        });

        var infowindow = new google.maps.InfoWindow();
        var flightPlanCoordinates = [];
        var bounds = new google.maps.LatLngBounds();

        for (i = 0; i < locations.length; i++) {
            console.log( locations[i].address.icon);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
                map: map,
                  icon:  locations[i].address.icon
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
                strokeColor: "#FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
 
  </script>
    <div id="map" style="width: 100%; height:700px;"></div>

</body>
</html>