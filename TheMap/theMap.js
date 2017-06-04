var qytetet =
[
	['Prishtina', 42.6629, 21.1655, 4],
	['Vushtrria', 42.8267, 20.9704, 5],
	['Mitrovica', 42.8914, 20.8660, 3],
	['Peja', 42.6593, 20.2887, 2],
	['Prizren', 42.2153, 20.7415, 1],
	['Ferizaj', 42.3702, 21.1483, 6],
	['Gjakova', 42.3844, 20.4285, 7],
	['Istogu', 42.7820, 20.4911, 8],
	['Rahovec', 42.3998, 20.6528, 9],
	['Skenderaj', 42.7476, 20.7892, 10],
	['Gjilan', 42.4635, 21.4694, 11],
	['Kamenice', 42.5876, 21.5737, 12],
	['Besiane', 42.9108, 21.1956, 13],
	['Kline', 42.6193, 42.6193, 14],
	['Malisheve', 42.4838, 20.7431, 15]
];

	var map, marker;

	function final()
	{
		initAutocomplete();
		initMap();
	}

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 42.637633, lng: 20.773874},
          zoom: 9,
		  scrollwheel: true,
		  draggable: true,
		  mapTypeId: 'roadmap'
        });
			
		setMarkers(map);
		  
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

			
			marker = new google.maps.Marker(
			{
				position: pos,
				map: map,
				animation: google.maps.Animation.DROP,
				draggable: true
			});
			  
			
			  
            marker.addListener('click', toggleBounce);
            map.setCenter(pos);
			map.setZoom(14);
			  
          }, function() {
            handleLocationError(true, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, map.getCenter());
        }
		  
		 function toggleBounce()
			{
				if (marker.getAnimation() !== null)
				{
				  marker.setAnimation(null);
				} 
				else 
				{
				  marker.setAnimation(google.maps.Animation.BOUNCE);
				}
			}
      }

      /*function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }*/

function setMarkers(map) 
{
	var image = 
		{
			size: new google.maps.Size(20, 32),

			origin: new google.maps.Point(0, 0),

			anchor: new google.maps.Point(0, 32)
		};

	var shape = 
		{
			coords: [1, 1, 1, 20, 18, 20, 18, 1],
			type: 'poly'
		};

	for (var i = 0; i < qytetet.length; i++)
	{
		var qyteti = qytetet[i];
		var marker = new google.maps.Marker(
		{
			position: {lat: qyteti[1], lng: qyteti[2]},
			map: map,
			title: qyteti[0],
			zIndex: qyteti[3]
		});
	}
}

//-----------------------------------------------

function initAutocomplete() {
  map = new google.maps.Map(document.getElementById('map'));

 
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}

//--------------------------------

