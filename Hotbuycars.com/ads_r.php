<?php 
	  $contents_obj = new Contents;
	  $this_page = basename($_SERVER['REQUEST_URI']);
	  
	  if (strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));
	  
	  if($this_page=="hotbuycars") $get_ads_right = $contents_obj->get_ads("index.php","right");
	  else $get_ads_right = $contents_obj->get_ads($this_page,"right");
	  
	  foreach($get_ads_right as $r_ads) {?>
	  <div class="listing_ad_right"><img src="<?php echo SITE_URL.SITE_ADS_PATH.$r_ads['file_name']; ?>" width="300" height="600" alt=""></div>
<?php } ?>