<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

$lid = $_GET['lid'];

$vdetails = $listing_obj->get_listing_detail($lid);

$uid  		= $vdetails['user_id'];
$price 		= $vdetails['price'];
$miles 		= $vdetails['miles'];
$doors		= $vdetails['doors'];
$fuel		= $vdetails['fuel'];
$drive		= $vdetails['drive'];
$engine		= $vdetails['engine'];
$trans		= $vdetails['trans'];
$stock_no	= $vdetails['stock_no'];
$interior	= $vdetails['interior'];
$exterior	= $vdetails['exterior'];
$title_type	= $vdetails['title_type'];
$vin		= $vdetails['vin'];
$body_style	= $vdetails['body_style'];
$model		= $vdetails['model'];
$make		= $vdetails['make'];
$year		= $vdetails['year'];
$city		= $vdetails['city'];
$state		= $vdetails['state'];
$fuelEC		= $vdetails['fuelEC'];
$fuelEH		= $vdetails['fuelEH'];
$description	= $vdetails['description'];
$title		= $vdetails['title'];

if($title == "")
	$cartitle = $year." ".$make." ".$model;
else
	$cartitle = $title;
		
$standard_feature  = $vdetails['standard_feature'];
$optional_feature  = $vdetails['optional_feature'];
		
$counter    = 0;
		
$getData = $listing_obj->get_user_details($lid);
$user_comments 	= $getData['user_comments'];
$dealer_id  	= $getData['dealer_id'];
		
$sql = mysql_query("select * from users where user_id = $dealer_id");
$row = mysql_fetch_array($sql);
$dealer_name 	= $row['name'];
$phone   	= $row['phone'];

$user_detail = $user_details->get_user_detail($uid);
		
$sm = $listing_obj->getSimilarVehicle($uid,$make,$lid); // FOR SIMILAR VEHICLES
		
define("DEALER_ADDRESS",$user_detail['address']);
define("DEALER_CITY",$user_detail['city']);
define("DEALER_STATE",$user_detail['state']);
define("DEALER_ZIP",$user_detail['zip']);
		
$address	= DEALER_ADDRESS;
$city		= DEALER_CITY;
$state 		= DEALER_STATE;
$zip		= DEALER_ZIP;
$google_address	= " $address $city, $state $zip";

include_once("header.php"); 

?>
    <div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">
            	<div class="search-box-1">
                    <h2>Similar Vehicles</h2>
                    
                    <!--  change here=========================================================================-->    
                    <?php
                   	$i=0;
                   	
                   	foreach($sm as $newsm) { 
                    ?> 
                    
                    <section class="refine-search" id="<?php echo "a".$i++; ?>">
                        <div class="similar-listings">
                        	<!--IMAGE HERE-->
                            	<?php
                            		$row_img = $listing_obj->get_img_name($newsm['listing_id']);
                            		if(empty($row_img)):
                            	?>
                                    	<img src="images/lp_fl_no_image.jpg"/>
                                <?php endif; ?>    
                                
                                <a href="listing_detail.php?lid=<?php echo $newsm['listing_id']; ?>">
                               	    <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$row_img; ?>" width="85" height="65" alt="Vehicle Image" />
                               	</a>
                            	<!--END IMAGE-->
                        	
                        </div>
                        <div class="similar-listings">
                        	<p class="similar-listings-name"><a href="listing_detail.php?lid=<?php echo $newsm['listing_id']; ?>"><strong><?php echo $newsm['year']." ".$newsm['make']." ".$newsm['model']; ?></strong></a></p>
                            <p><a href="listing_detail.php?lid=<?php echo $newsm['listing_id']; ?>"><?php echo $newsm['exterior']; ?></a></p>
                            <p><a href="listing_detail.php?lid=<?php echo $newsm['listing_id']; ?>"><?php echo number_format($newsm['miles']); ?> mi.</a></p>
                            <p><a href="listing_detail.php?lid=<?php echo $newsm['listing_id']; ?>">$<?php echo number_format($newsm['price']); ?></a></p>
                        </div>
                        <div class="clear"></div>
                    </section>
                   <?php } ?> 
      		   <!--  change here=========================================================================-->
                
                    <section class="refine-search">
                         <dl>
                            <dt>View more:</dt>
                                <dd><a href="listings.php?bodystyle=<?php echo $body_style; ?>"><?php echo $body_style; ?></a></dd>
                                <dd><a href="listings.php?make=<?php echo $make; ?>"><?php echo $make." inventory"; ?></a></dd>
                                <dd><a href="listings.php?year=<?php echo $year; ?>"><?php echo $year." inventory"; ?></a></dd>
                         </dl>
                    </section>
                </div>
                
                <div class="listings-container-1">
                	<section class="listings-container-info rounded">
                  		<div id="vehicle_topbar">
                              <div id="vehicle_topbar_left">
                                <a href="listings.php">All</a>    
                                  
                                 &nbsp;&raquo;&nbsp;<a href="listings.php?make=<?php echo $make; ?>"><?php echo $make; ?></a>
                                 
                                 
                                 &nbsp;&raquo;&nbsp;<a href="listings.php?model=<?php echo $model; ?>"><?php echo $model; ?></a>
                              </div>
                            
                                <ul id="vehicle_social_buttons" class="social_buttons" style="display: block;">
                                    <li id="vehicle_google_plus_button" style="margin-top:-12px; width:70px;">
                                        <div class="g-plusone" data-size="medium"></div>
                                        
                                        <!-- Place this tag after the last +1 button tag. -->
                                        <script type="text/javascript">
                                          (function() {
                                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                            po.src = 'https://apis.google.com/js/plusone.js';
                                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                          })();
                                        </script>
                                    </li>
                                    <li id="vehicle_facebook_like_button">
                                    	<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.dixiemotorsutah.com%2Flisting_detail.php%3Flid%3D<?php echo $_GET['lid']; ?>&amp;width=80&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>
                                    </li>
                                    <li>
                                    	<iframe data-twttr-rendered="true" title="Twitter Tweet Button" style="width: 109px; height: 20px;" class="twitter-share-button twitter-count-horizontal" src="http://platform.twitter.com/widgets/tweet_button.1380566451.html#_=1380605073612&amp;count=horizontal&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fwww.dixiemotorsutah.com%2Flisting_detail.php%3Flid%3D<?php echo $_GET['lid']; ?>&amp;size=m&amp;text=<?php echo 'Check out this '.$cartitle.' at Dixie Motors Utah'; ?>&amp;url=http%3A%2F%2Fwww.dixiemotorsutah.com%2Flisting_detail.php%3Flid%3D<?php echo $_GET['lid']; ?>" allowtransparency="true" frameborder="0" scrolling="no"></iframe>
                                    </li>
                                    <li>
                                    	<!-- AddThis Button BEGIN -->
                                        <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=xa-524a89ef17d4201f"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
                                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-524a89ef17d4201f"></script>
                                        <!-- AddThis Button END -->
                                    </li>
                                    <li><a title="Email this vehicle to a friend" rel="nofollow" id="vehicle_social_email" href="send_to_friend.php?id=<?php echo $_GET['lid']; ?>" class="fancybox fancybox.iframe">Email</a></li>
                                    <li><a title="Print this vehicle" id="vehicle_social_print" href="print_vehicle.php?id=<?php echo $_GET['lid']; ?>">Print</a></li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                    </section><!-- end social media -->
                    
                    <section class="listings-container-info rounded">
                    <?php
                    	$user_id  = 349;

						$make_ 		= isset($_GET['make'])&&$_GET['make']<>"All" ? " and make = '".$_GET['make']."'" : "";
						$model_ 	= isset($_GET['model'])&&$_GET['model']<>"All" ? " and model = '".$_GET['model']."'" : "";
						$body_ 		= isset($_GET['bodystyle']) ? " and body_style = '".$_GET['bodystyle']."'" : "";
						$priceto_	= isset($_GET['priceto']) ? " and price <= ".$_GET['priceto'] : "";
						$pricefrom_	= isset($_GET['pricefrom']) ? " and price >= ".$_GET['pricefrom'] : "";
						$vyear_		= isset($_GET['year'])&&$_GET['year']<>"All" ? " and year = ".$_GET['year'] : "";
						$mileagefrom_	= isset($_GET['mileagefrom'])&&$_GET['mileagefrom']<>"Any" ? " and miles >= '".$_GET['mileagefrom']."'"	: "";
						$mileageto_	= isset($_GET['mileageto'])&&$_GET['mileageto']<>"Any" ? " and miles <= '".$_GET['mileageto']."'" : "";
						$yearfrom_	= isset($_GET['yearfrom'])&&$_GET['yearfrom']<>"Any" ? " and year >= ".$_GET['yearfrom'] : "";
						$yearto_ 	= isset($_GET['yearto'])&&$_GET['yearto']<>"Any" ? " and year <= ".$_GET['yearto'] : "";
						
						$cond 	= "user_id = $user_id $make_ $model_ $body_ $pricefrom_ $priceto_ $vyear_ $mileagefrom_ $mileageto_ $yearfrom_ $yearto_";
						$orderby= "price";
						$sortby = "desc";
                    ?>
                    <form name="listing-filter-form">
	                <select id="inventory_year" onChange="filter_by_year(this.value);">
	                        <option <?php if($_GET['year'] == "All"){echo "selected";} ?> value="All">All Years</option>
	                         <?php 
	                            $years = $listing_obj->getListingsGroupBy(false,false,"year","desc",$cond,"year");
	                            foreach($years as $newyear) {
	                                $sqlyear_c = mysql_query("select count(year) as countyear from listing where $cond and year=".$newyear['year']);
									
									if(isset($_GET['year']) && $_GET['year'] == $newyear['year'])
	                                	echo "<option selected value='$newyear[year]'>".$newyear['year']. " (".mysql_result($sqlyear_c,0). ")" ."</option>";
									else
										echo "<option value='$newyear[year]'>".$newyear['year']. " (".mysql_result($sqlyear_c,0). ")" ."</option>";
	                            }
	                         ?>
	                    </select>
	                    <select id="inventory_make" onChange="filter_by_make();">
	                        <option <?php if($_GET['make'] == "All"){echo "selected";} ?> value="All">All Makes</option>
							<?php 
	                            $makes = $listing_obj->getListingsGroupBy(false,false,"make","desc",$cond,"make");
	                            foreach($makes as $newmakes) {
	                                $sqlmakes_c = mysql_query("select count(make) as countmake from listing where $cond and make='$newmakes[make]'");
									
									if(isset($_GET['make']) && $_GET['make'] == $newmakes['make'])
										echo "<option selected value='$newmakes[make]'>".$newmakes['make']. " (".mysql_result($sqlmakes_c,0). ")" ."</option>";
									else
	                                	echo "<option value='$newmakes[make]'>".$newmakes['make']. " (".mysql_result($sqlmakes_c,0). ")" ."</option>";
	                            }
	                        ?>
	                    </select>
	                    <select id="inventory_model" onChange="filter_by_model();">
	                        <option <?php if($_GET['model'] == "All"){echo "selected";} ?> value="All">All Models</option>
							<?php 
	                            $models = $listing_obj->getListingsGroupBy(false,false,"model","desc",$cond,"model");
	                            foreach($models as $newmodels) {
	                                $sqlmodel_c = mysql_query("select count(model) as countmodel from listing where $cond and model='$newmodels[model]'");
									
									if(isset($_GET['model']) && $_GET['model'] == $newmodels['model'])
										echo "<option selected value='$newmodels[model]'>".$newmodels['model']. " (".mysql_result($sqlmodel_c,0). ")" ."</option>";
									else
	                                	echo "<option value='$newmodels[model]'>".$newmodels['model']. " (".mysql_result($sqlmodel_c,0). ")" ."</option>";
	                            }
	                        ?>
	                    </select>
	                    <input type="button" onclick="filter_listing();" value="Go" />
	                </form>
	                </section><!-- end filter form -->
	                <script>
	                    function filter_listing() {
	                        var year = document.getElementById('inventory_year').value;
	                        var make = document.getElementById('inventory_make').value;
	                        var model = document.getElementById('inventory_model').value;
	                        
	                        window.location = "listings.php?year="+year+"&make="+make+"&model="+model;
	                    }
						
						function filter_by_year(value) {
							var params = "";
							
							if(value != "All")
								params = "and year="+value;
							
							$.ajax({
								type: "POST",
								url: "ajax.php",
								data: "work=filterByYear&year="+value+"&params="+params,
								async: false
							}).done(function(data) {
								var str = data.split("@");
								$("#inventory_year").html(str[0]);
								$("#inventory_make").html(str[1]);
								$("#inventory_model").html(str[2]);
							});
							
						}
						
						function filter_by_make() {
							var params = "";
							var year = document.getElementById('inventory_year').value;
	                        var make = document.getElementById('inventory_make').value;
							
							$.ajax({
								type: "POST",
								url: "ajax.php",
								data: "work=filterByMake&year="+year+"&make="+make,
								async: false
							}).done(function(data) {
								var str = data.split("@");
								$("#inventory_year").html(str[0]);
								$("#inventory_make").html(str[1]);
								$("#inventory_model").html(str[2]);
							});
							
						}
						
						function filter_by_model() {
							var params = "";
							var year = document.getElementById('inventory_year').value;
	                        var make = document.getElementById('inventory_make').value;
	                        var model = document.getElementById('inventory_model').value;
							
							$.ajax({
								type: "POST",
								url: "ajax.php",
								data: "work=filterByModel&year="+year+"&make="+make+"&model="+model,
								async: false
							}).done(function(data) {
								var str = data.split("@");
								$("#inventory_year").html(str[0]);
								$("#inventory_make").html(str[1]);
								$("#inventory_model").html(str[2]);
							});
							
						}
	                </script>
                    
                    <?php $images_list = $listing_obj->get_listing_images($lid); ?>
                    <section class="listing-details">
                    	<div class="listings-detail-data col-1">
                        	<h3><?php echo $cartitle; ?></h3>
                            <a href="listinggallery.php?lid=<?php echo $lid; ?>&amp;img_id=1" data-img = "<?php echo $img_large; ?>" class="fancybox fancybox.iframe">
                            <img src="<?php echo SITE_URL.SITE_LISTING_IMAGES_PATH.$images_list[0]['image_name']?>" id="img-large" height="196" width="272" alt="listing-image" />
                            </a>
                        </div> 
                        <div class="listings-detail-data col-2">
                            <h3><?php echo number_format($price); ?><span>Internet Price</span></h3>
                            <p><strong>Style:</strong> <?php echo $body_style; ?></p>
                            <p><strong>Type:</strong> <?php echo "Used, Clear Title"; ?></p>
                            <p><strong>Color:</strong> Ext. <?php echo $exterior.","; ?>  Int. <?php echo $interior; ?></p>
                       	    <p><strong>Vin #:</strong> <?php echo $vin; ?></p>
                            <p><strong>Trim:</strong>  <?php echo $trim; ?></p> 
                            <p class="listing-data-others"><a href="listinggallery.php?lid=<?php echo $lid; ?>&amp;img_id=1" data-img = "<?php echo $img_large; ?>" class="fancybox fancybox.iframe"><strong>View Photos (<?php echo count($images_list); ?>)</strong></a></p>
                        </div> 
                        <div class="listings-detail-data col-3">
                            <h3><span style="font-size: 15px;color: #1386E1;line-height: 2em;">Call&nbsp;&nbsp;</span><?php echo "888-960-1114"; ?></h3>
                            <div style="margin-top:45px;"> 
                                <p><strong>Mileage:</strong> <?php echo number_format($miles); ?></p>   
                                <p><strong>Engine:</strong>  <?php echo $engine; ?></p>
                            	<p><strong>Drive:</strong> <?php echo $trans.", ".$drive; ?></p>
                            	<p><strong>Stock #:</strong> <?php echo $stock_no; ?></p> 
                            	<p><strong>Warranty:</strong> </p>
                            	<p class="listing-data-finance">
                            	    <a href="finance.php?make=<?php echo $make; ?>&model=<?php echo $model; ?>&year=<?php echo $year; ?>&vin=<?php echo $vin; ?>&price=<?php echo $price; ?>&image_url=<?php echo SITE_URL.SITE_LISTING_IMAGES_PATH.$images_list[0]['image_name'] ?>">
                            	    	<strong>Apply for financing</strong>
                            	    </a>
                            	</p>
                            	<p class="listing-data-link"><a href="requestinfo.php?lid=<?php echo $lid; ?>" class="fancybox fancybox.iframe"><strong>Request More Info</strong></a></p>
                            </div>
                            
                            <div id="fuel">
                            	<div id="fuel-city">
                            	    <p>CITY</p>
                            	    <p class="fuelvalue"><?php echo $fuelEC; ?></p>
                                </div>
                                <img src="img/mpg_icon_new.png" alt="" width="32" height="32" />
                                <div id="fuel-hwy">
                                    <p>HWY</p>
                                    <p class="fuelvalue"><?php echo $fuelEH; ?></p>
                                </div>
                            </div>
                        </div>   
                        <div class="clear"></div>                 
                    </section><!-- end listing details -->
                    
                    <section class="listing-details img-thumbnails">
						<ul>
                        <?php 
							$imgarry = array();
							
							if(!empty($images_list)) {
							
								$count = count($images_list)-1;
					
								foreach($images_list as $newimages_list) {
									$counter++;
									
									$img_large = SITE_URL.SITE_LISTING_IMAGES_PATH.$newimages_list['image_name'];
									?>
										<img src="<?php echo $img_large; ?>" width="322" height="217" style="display: none;" /> <!-- for images cached! -->
									<?php
									$img = SITE_URL.SITE_LISTING_THUM_PATH.$newimages_list['image_name'];
							 ?>
							  		<li>
                           		 		<a href="listinggallery.php?lid=<?php echo $lid; ?>&amp;img_id=<?php echo $counter; ?>" data-img = "<?php echo $img_large; ?>" class="aThumbs fancybox fancybox.iframe">
                                        <img src="<?php echo $img; ?>" alt="imgthumb" width="60" height="37" />
                                        </a>
                            		</li>
							  <?php 
								}
							}
											
							?>
                        	
                        </ul>   
                        <div class="clear"></div>            
                    </section><!-- end listing gallery -->
                    
                    <section class="listing-details listing-desc">
						   <h2>Comments</h2>
                           <p>
  							<?php echo str_replace("Year, Make, Model",$year.", ".$make.", ".$model,$description); ?>
                           </p> 
                      
                           <p>THIS IS INTERNET PRICING ONLY! BRING IN THIS AD, OR CALL 888-960-1114.</p>

                           <p class="none">
                      		<?php echo $optional_feature; ?>
                           </p>
                             <a href="#" class="showToggle">Show More &gt;&gt;</a>
                            <div class="clear"></div> 
                           
                            <h3 class="strandard_eq"><?php echo $cartitle; ?> Features</h3>
                            <p><?php echo str_replace(" ,",",",substr($standard_feature,0,-2)); ?></p>
                            
                            <div class="ip_equipment_column1"></div>
                    </section><!-- end listing description -->
                </div>
                
                <div class="clear"></div>
<?php include_once("footer.php"); ?> 