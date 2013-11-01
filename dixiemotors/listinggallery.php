<?php
session_start();
include_once("includes.php");

$listing_obj = new Listing();

?>
<!DOCTYPE html >
<html lang="en">
<head>
  <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery.css">
  <script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
  
  
  <script type="text/javascript">
  $(function() {
	
    var galleries = $('.ad-gallery').adGallery({
		start_at_index: <?php echo intval($_GET['img_id'])-1; ?>,
		slideshow: { autostart: true,speed: 5000 }
	});
	
	
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );	
	
 $('.fancybox-inner').css({"height":"660px;","width":"660px","padding":"0 !important"});
  });
  </script>

  <style type="text/css">
    * {
    font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Verdana, Arial, sans-serif;
    color: #333;
    line-height: 140%;
  }
  select, input, textarea {
    font-size: 1em;
  }
  body {
    font-size: 70%;
  }
  h2 {
    margin-top: 1.2em;
    margin-bottom: 0;
    padding: 0;
    border-bottom: 1px dotted #dedede;
  }
  h3 {
    margin-top: 1.2em;
    margin-bottom: 0;
    padding: 0;
  }
  .example {
    border: 1px solid #CCC;
    background: #f2f2f2;
    padding: 10px;
  }
  pre {
    font-family: "Lucida Console", "Courier New", Verdana;
    border: 1px solid #CCC;
    background: #f2f2f2;
    padding: 10px;
  }
  code {
    font-family: "Lucida Console", "Courier New", Verdana;
    margin: 0;
    padding: 0;
  }
  #gallery {
    padding: 0 30px 30px 30px;
    background: #F6F6F6;
  }
  #descriptions {
    position: relative;
    height: 50px;
    background: #EEE;
    margin-top: 10px;
    width: 640px;
    padding: 10px;
    overflow: hidden;
  }
    #descriptions .ad-image-description {
      position: absolute;
    }
      #descriptions .ad-image-description .ad-description-title {
        display: block;
      }
   #container {
		border-radius: 6px; 
	    margin: -9px;
	    padding:0;
		background: #F6F6F6;
		width: 660px;  
   }
   #logo {
		margin: 0 auto;
		width: 100%;
		text-align: center;
   }
   #logo h2{
		font-size: 15px;
		font-family: Arial, Helvetica, sans-serif;
		padding-bottom: 5px;
   }
  .listingdetails {
	float: left;
	position: relative;
	width: 50%;
	margin-bottom: 7px;
  }
  .listingdetails .price {
	color :#1386E1;
	text-align: right !important;
  }
  .listingdetails .name {
	 color: #000 !important;
	 margin-left: 9%;  
  }
  .listingdetails .name,  .listingdetails .price {
	 display: block;
	 font-size: 22px;
	 font-weight: bold;
	 font-family: Arial, Helvetica, sans-serif !important; 
	 width: 90%;
   }
  .clear {
	clear: 	both;  
  }
  </style>
  <title>Listing Images</title>
</head>
<body>

<?php
 $lid = isset($_GET['lid'])?$_GET['lid']:5;
 $images_list = $listing_obj->get_listing_images($lid); 
 $getVehicleDetails = $listing_obj->get_listing_detail($lid);
 		$uid  =			$getVehicleDetails['user_id'];
		$price =  		$getVehicleDetails['price'];
	
		$model=			$getVehicleDetails['model'];
		$make=			$getVehicleDetails['make'];
		$year=			$getVehicleDetails['year'];
		$cartitle=		$year." ".$make." ".$model;
?>
<div id="container">
  <div id="logo"><h2>DixieMotorsUtah.com &nbsp; Call: 888-960-1114</h2></div>
    <div class="listingdetails">
   	  <span class="name"><?php echo $cartitle; ?></span>
    </div>
  <div class="listingdetails">
   	  <span class="price">$<?php echo number_format($price); ?></span>
    </div>
    <div class="clear"></div>
  <div id="gallery" class="ad-gallery">
      <div class="ad-image-wrapper" style="height: 400px;width: 600px;">
      </div>
      <div class="ad-controls">
      </div>
      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
          <?php 

				foreach($images_list as $newimages_list) {
					
					$img_large = SITE_URL.SITE_LISTING_IMAGES_PATH.$newimages_list['image_name'];
					$img	   = SITE_URL.SITE_LISTING_THUM_PATH.$newimages_list['image_name'];
			 ?>
                    <li>
                      <a href="<?php echo $img_large; ?>">
                        <img src="<?php echo $img; ?>" class="image4">
                      </a>
                    </li>		
			  <?php 
				}		
		  ?>
           
            
          </ul>
        </div>
      </div>
    </div>

  </div>
</body>
</html>