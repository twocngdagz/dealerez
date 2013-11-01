<?php  session_start();
include_once("includes.php");

	$address="555 N. Bluff";
	$city="St. George";
	$state ="Utah";
	$zip="84000";
	$google_address	 = " $address $city, $state $zip";
	$google_map_html			 = "<strong>City:$city</strong><br>State:$state <br>Zip:$zip<br>Address:$address";
	$google_map_zoom_level	= 12;
	$google_map_api_key		= "AIzaSyAh0VkDaPEEpF9ms1Sr1XVCq5SwtFjBZKs";
	$google_key=$google_map_api_key;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0;}
      #map_canvas { height: 100%; color: #000; }
    </style>
    
	<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY_HOTBUYCARS;?>&sensor=true">
    </script>
     <script>
	var state = '<?php print $google_address; ?>';
	$(function() {
		
		$('#map_canvas').on('click', function() {
			var url = 'https://maps.google.com/maps?q='+state;
			window.open(url, '_blank');	
		});
		
	});
	</script>
    <script type="text/javascript">
	var geocoder;
    var map;
	  
function display_map(div_id,address,zoom_level,div_html) {
		 geocoder = new google.maps.Geocoder();
       
        var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
        var mapOptions = {
          zoom: zoom_level,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
       map = new google.maps.Map(document.getElementById(div_id), mapOptions);

        var contentString = div_html;

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
		var address = address;
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
			infowindow.open(map,marker);} 
			else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });  
      } 
    </script>
</head>
<body onLoad="initialize()">
  <div id="map_canvas" style="width:262px; height:135px;"></div>
    <script language="javascript">
	display_map("map_canvas","<?php echo  $google_address; ?>",<?php echo $google_map_zoom_level; ?>, "<?php echo $google_map_html; ?>");
  </script>
</body>
</html>
