<?php  session_start();
include("includes.php");
$listing_obj = new Listing;
$user_obj    = new User;

$featureListing = $listing_obj->get_feature_listing(349); 
$user_id  = 349;
?>
<?php include_once("header.php"); ?>

<div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">
            	<div class="search-box">
                	<h2><a href="javascript:;" id="qs" title="Click to Show/Hide Search Options">Quick Search</a></h2>
                    <div class="ulVtype">
                                <ul>
                                    <li><a href="listings.php?bodystyle=convertible" title="Convertible">Convertible</a></li>
                                    <li><a href="listings.php?bodystyle=hatchback" title="Hatchback">Hatchback</a></li>
                                    <li><a href="listings.php?bodystyle=wagon" title="Wagon">Wagon</a></li>
                                    <li><a href="listings.php?bodystyle=van" title="Van">Van</a></li>
                                </ul>
                                <ul>
                                    <li><a href="listings.php?bodystyle=coupe" title="Coupe">Coupe</a></li>
                                    <li><a href="listings.php?bodystyle=sedan" title="Sedan">Sedan</a></li>
                                    <li><a href="listings.php?bodystyle=suv" title="Suv">Suv</a></li>
                                    <li><a href="listings.php?bodystyle=truck" title="Truck">Truck</a></li>
                                </ul>
                           
                     </div>
                </div>
                
                <div class="image-slider">
                	<div id="quicksearch-wrapper" style="display:none;">
                        <div class="cols c-1" style="width:80px;">
                            <h2>Make</h2>
                            <div class="cols-data">
                            	<!--column 1-->
                                   	<ul>
                                    <?php 
                                    	//$makes = $listing_obj->getListingsGroupBy(false,false,"make","asc","user_id=$user_id","make");
                                    	$makes = $listing_obj->getListingsGroupBy(0,8,"make","asc","user_id=$user_id","make");
                                    	foreach($makes as $newmakes) {
                                    		$count = mysql_query("select * from listing where make = '".$newmakes['make']."' and user_id = $user_id");
                                    ?>
                                    	<li><a href="listings.php?make=<?php echo $newmakes['make'];?>"><?php echo $newmakes['make']." (".mysql_num_rows($count).")"; ?></a></li>
                                    <?php } ?>
                                    </ul>
                            	
                            </div>
                        </div><!-- end cols -->  
                        <div class="cols c-1" style="width:80px;padding-top:17px;">
                            <h2></h2>
                            <div class="cols-data">
                            	<!--column 2-->
                                   	<ul>
                                    <?php 
                                    	$makes = $listing_obj->getListingsGroupBy(8,8,"make","asc","user_id=$user_id","make");
                                    	foreach($makes as $newmakes) {
                                    		$count = mysql_query("select * from listing where make = '".$newmakes['make']."' and user_id = $user_id");
                                    ?>
                                    	<li><a href="listings.php?make=<?php echo $newmakes['make'];?>"><?php echo $newmakes['make']." (".mysql_num_rows($count).")"; ?></a></li>
                                    <?php } ?>
                                    </ul>
                            	
                            </div>
                        </div><!-- end cols -->  
                    
                        <div class="cols c-2">
                            <h2>Price</h2>
                            <div class="cols-data">
                                <ul>
                                    <li><a href="listings.php?priceto=5000">Less Than $5,000</a></li>
                                    <li><a href="listings.php?priceto=10000">Less Than $10,000</a></li>
                                    <li><a href="listings.php?priceto=15000">Less Than $15,000</a></li>
                                    <li><a href="listings.php?priceto=20000">Less Than $20,000</a></li>
                                    <li><a href="listings.php?priceto=25000">Less Than $25,000</a></li>
                                    <li><a href="listings.php?priceto=30000">Less Than $30,000</a></li>
                                    <li><a href="listings.php?priceto=35000">Less Than $35,000</a></li>
                                    <li><a href="listings.php?pricefrom=35000">More Than $35,000</a></li>
                                </ul>
                            </div>
                        </div><!-- end cols -->  
                    
                    <div class="cols c-3">
                        <h2>Other</h2>
                        <form action="listings.php" method="GET">
                            <div class="cols-data">
                                <label id="lblfirst">Mileage</label>
                                <select class="qs-select" name="mileagefrom" id="mileagefrom">
                                    <option value="1000">1,000</option>
                                    <option value="10000">10,000</option>
                                    <option value="25000">25,000</option>
                                    <option value="50000">50,000</option>
                                    <option value="100000">100,000</option>
                                </select>
                                <p class="center-text">To</p>
                                <select class="qs-select" name="mileageto" id="mileageto">
                                    <option value="1000">1,000</option>
                                    <option value="10000">10,000</option>
                                    <option value="25000">25,000</option>
                                    <option value="50000">50,000</option>
                                    <option value="100000">100,000</option>                             
                                </select>                         
                                <br />
                           
                                <label>Year</label>
                                <select class="qs-select" name="yearfrom" id="yearfrom">
                                    <option>Any</option>
                                    <?php
                                	for($yearfrom=2013;$yearfrom>=1990;$yearfrom--) {
                                		echo "<option>".$yearfrom."</option>";	
					                   }
			                        ?>
				                    <option>Other</option>
                                </select>
                                <p class="center-text">To</p>
                                <select class="qs-select" name="yearto" id="yearto">
                                    <option>Any</option>
                                    <?php
                                	for($yearto=2013;$yearto>=1990;$yearto--) {
				                        echo "<option>".$yearto."</option>";	
				                    }
				                    ?>
				                    <option>Other</option>
                                </select>
                            
                                <br />
                           
                                <label>Transmission</label>
                                <select class="qs-select" name="transmission" id="transmission">
                                    <option>Any</option>
                                    <option>Automatic</option>
                                    <option>Manual</option>
                                </select>
                                
                                <div id="bottoms">
                                    <label>Condition</label>
                                    <input type="checkbox" name="used" id="used" checked="checked" >
                                    <span>Used</span>
                                    <input type="submit" name="submit" id="submit" value="Search">
                                </div>
                            </div>
                        </form>
                        <span id="close" title="Close">x</span>
                    </div><!-- end cols -->  
                
                </div>
                	<div class="container">
                      <div id="slides">
                        <img src="img/Dixie_Motors_slide1.jpg" width="685" height="228"/>
                        <img src="img/Dixie_Motors_slide2.jpg" width="685" height="228"/>
                        <img src="img/Dixie_Motors_slide3.jpg" width="685" height="228"/>
                        <img src="img/Dixie_Motors_slide4.jpg" width="685" height="228"/>
                        <img src="img/Dixie_Motors_slide5.jpg" width="685" height="228"/>
                      </div>
                    </div>
                </div>
               
                <div class="clear"></div>
                <h2 class="title p2">Featured Vehicles</h2>
                <div id="gallery" class="ad-gallery">
                    <div class="ad-nav">
                      <div class="ad-thumbs">
                        <ul class="ad-thumb-list">
                     
                        <?php
							foreach($featureListing as $newfl) {
						?>
                          <li>
                         	<p class="thumb-name"><?php echo $newfl['year']." ".$newfl['make']; ?></p>
                            <a href="listing_detail.php?lid=<?php echo $newfl['listing_id'];?>">
                              <img src="<?php echo SITE_URL.SITE_LISTING_THUMB_PATH.$newfl['images_array'][0]['image_name']; ?>" class="indeximg" alt="<?php echo $newfl['year']." ".$newfl['make']; ?>" >
                            </a>
                            <p class="thumb-price">$<?php echo number_format($newfl['price']); ?></p>
                          </li>
                      	<?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div><!-- end gallery -->
                  
				  <section>
                  <h2 class="title-1">Welcome to Dixie Motors&nbsp;<img src="img/mini-car-icon_03.png" alt="c-img" style="vertical-align:bottom;"/></h2>
                  	  <p class="p">
                      		<strong>Hello St. George, drivers!</strong>  Our quality used car dealership is new to your city, but we have years of experince in the car industry and have saved our Utah clients thousands of dollars! Dixie Motors is conveniently located at 555 N. Bluff Street and worth the drive in serving locals and our surrounding communites in Utah and Nevada with a great selection of used cars. Come in and experience our premium used car dealership in person and meet your friendly sales team Ryan and Glenn who are also the owners so you can be assured satisaction in finding the perfect used car for your needs. We offer low-rate financing  and The Best Cars and Best Deals in town! We&rsquo;ll look forward to serving you for many years to come.  
                      </p>
                  </section>   
                  <div class="clear"></div>
<?php include_once("footer-information.php"); ?>        
<?php include_once("footer.php"); ?>