<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8"       type="text/javascript"></script>
</head> 
<body>

  <script type="text/javascript">
   var MapPoints = '[{"address":{"address":"plac Grzybowski, Warszawa, Polska","lat":"52.2360592","lng":"21.002903599999968"},"title":"Warszawa"},{"address":{"address":"Jana Paw\u0142a II, Warszawa, Polska","lat":"52.2179967","lng":"21.222655600000053"},"title":"Wroc\u0142aw"},{"address":{"address":"Wawelska, Warszawa, Polska","lat":"52.2166692","lng":"20.993677599999955"},"title":"O\u015bwi\u0119cim"}]';

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
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
                map: map
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
  <div id="map" style="width: 100%; height: 600px;"></div>

</body>
</html>