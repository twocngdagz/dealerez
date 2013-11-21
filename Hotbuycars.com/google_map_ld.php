<?php
	include("../includes.php");
	$user_details = new User;
	$listing_obj  = new Listing;
	
	$listing_id = $_GET['lid'];
	$getUserId = $listing_obj->get_listing_detail($listing_id);
	$user_id =  $getUserId['user_id'];

	$user_detail = $user_details->get_user_detail($user_id);
	
	define("DEALER_ADDRESS",$user_detail['address']);
	define("DEALER_CITY",$user_detail['city']);
	define("DEALER_STATE",$user_detail['state']);
	define("DEALER_ZIP",$user_detail['zip']);
	
	$address=DEALER_ADDRESS;
	$city=DEALER_CITY;
	$state =DEALER_STATE;
	$zip=DEALER_ZIP;
	$google_address	 = " $address $city, $state $zip";
	$google_map_html			 = "<strong>City:$city</strong><br>State:$state <br>Zip:$zip<br>Address:$address";
	$google_map_zoom_level	= MAP_ZOOM_LEVEL;
	$google_map_api_key		= GOOGLE_API_KEY_HOTBUYCARS;
	$google_key=$google_map_api_key;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>

	<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY_HOTBUYCARS;?>&sensor=true">
    </script>
    <script>
	var state = '<?php print $google_address; ?>';
	$(function() {
		
		$('#map_canvas').click( function() {
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
  <div id="map_canvas" style="width:370px; height:110px;"></div>
    <script language="javascript">
	display_map("map_canvas","<?php echo  $google_address; ?>",<?php echo $google_map_zoom_level; ?>, "<?php echo $google_map_html; ?>");
  </script>
</body>
</html>
