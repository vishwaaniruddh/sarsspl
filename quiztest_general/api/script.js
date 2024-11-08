var map


function initMap() {
  var broadway = {
    info:
      '<strong>HDFC (ATM ID : P3ENJB06) </strong><br>\
    	PG Rd<br> Jahanabad, Bihar 804417<br>\
    	<a href="https://goo.gl/maps/A2Vm3vHPumGqMbBr7">Get Directions</a>',
    lat: 25.2010857,
    long: 84.9762928,
  }

  var belmont = {
    info:
      '<strong>HDFC (ATM ID : H05826)</strong><br>\
    	GOOTY ROAD,<br> ANATAPUR, ANDRA PRADESH 515001<br>\
    	<a href="https://goo.gl/maps/Fb6bC7b1LKmyJMWu5">Get Directions</a>',
    lat: 14.6970546,
    long: 77.5991134,
  }

  var sheridan = {
    info:
      '<strong>HDFC (ATM ID : P3ENAG23)</strong><br>\r\
    	RAM NAGAR MUKUND VADI <br> AURANGABAD, MAHARASHTRA 431007<br>\
    	<a href="https://goo.gl/maps/MfHdruxuQspX1JmY9">Get Directions</a>',
    lat: 19.8692734,
    long: 75.3156254,
  }

  var locations = [
    [broadway.info, broadway.lat, broadway.long, 0],
    [belmont.info, belmont.lat, belmont.long, 1],
    [sheridan.info, sheridan.lat, sheridan.long, 2],
  ]

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: new google.maps.LatLng(25.2010857, 84.9762928),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  })

  var infowindow = new google.maps.InfoWindow({})

  var marker, i

  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
    })

    google.maps.event.addListener(
      marker,
      'click',
      (function (marker, i) {
        return function () {
          infowindow.setContent(locations[i][0])
          infowindow.open(map, marker)
        }
      })(marker, i)
    )
  }
}