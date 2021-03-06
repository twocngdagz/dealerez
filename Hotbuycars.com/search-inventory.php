<?php
session_start();
include_once("includes.php");
include_once("Pagination.php");

$listing_obj = new Listing;
$user_obj	 = new User;
$obj_mysql	 = new Mysql;

$featureListing = $listing_obj->get_all_feature_listing(); 
include("header.php");
?>
       <div class="container_12">
                	<!--=================MAIN-MENU==========================-->
					<?php include("menu.inc.php"); ?>
                    <!--===============END MAIN-MENU========================-->
                </div>
            </header>
<!--===========================================content============================================================-->
            <!--==============================pagination================================-->
                  <?php 
				  $search_item 	= $_GET['search'];
				  $addParams = array("search" => $search_item);
				  
				  $data_search 		= array(
				  		"title",
						"category",
						"body_style",
				  		"make",
						"model",
						"year",
						"price"
				  );
				  $result =	"";
				  foreach($data_search as $item){
						$result .= "$item like '" .$addParams['search']. "%' or "; 
				  }

				  $where_clause = substr($result,0,-3);

				  $_counter 		= $listing_obj->getListings(false,false,"created_date ","ASC",$where_clause);
				  				
						$inventory_search = ""; //WILL HANDLE WHERE CLAUSE FOR MYSQL QUERIES

						$pagesPerSection =	5;
						$options		 = 20;	// Display options
						$paginationID	 = "search-inventory";					// This is the ID name for pagination object
						$stylePageOff	 = "pageOff";					// The following are CSS style class names. See styles.css
						$stylePageOn	 = "pageOn";
						$styleErrors	 = "paginationErrors";
						$styleSelect	 = "paginationSelect";
							
/*-===========================================PAGINATION ASSIGNMENT=======================================================*/
						$totalEntries = count($_counter);
				 		$Pagination = new Pagination($totalEntries, $pagesPerSection, $options, $paginationID, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect,$addParams);
						$start 		= $Pagination->getEntryStart();
						$end 		= $Pagination->getEntryEnd(); 
/*-===========================================END PAGINATION ASSIGNMENT===================================================*/
					//function getListings($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)

						$listings		= $listing_obj->getListings($start,$end,"created_date ","asc",$where_clause);
						$lcount 		= $listing_obj->getListings(false,false,"created_date ","ASC",$where_clause);

					?>
			
 			<!--==============================end pagination================================-->
            <section id="content">
                <div class="container_12">
                	<div class="wrapper">
                    	<div class="grid_8">
                        <div class="result50">Results: <?php echo count($lcount); ?></div>
                        <div class="l_pagination"><?php echo $Pagination->display(); ?></div>
                        <div class="clear"></div>
                        <!--************************FEATURE LISTING CODE**********************-->
                        
             	<?php foreach($featureListing as $newfeaturelising):?>
                        <?php $newuserdetails = $user_obj->get_user_detail($newfeaturelising['user_id']); ?>
                        <div class="listing_page">
                        <div class="feature_listing_box">
                        <div class="desc">
                        <div class="fl_car_name"><a href="listings_details.php?lid=<?php echo $newfeaturelising['listing_id'];?>"><?php echo $newfeaturelising['title']; ?></a></div>
                        <div class="fl_car_price">$<?php echo $newfeaturelising['price']; ?></div>
                        <div class="fl_car_location"><?php echo $newuserdetails['city'] .", " .$newuserdetails['state']; ?> | 2 Days</div>
                        <div class="fl_car_desc">FINAL REDUCED PRICE : $<?php echo $newfeaturelising['price']; ?> or best offer! We will consider all serious offers over.</div>
                        </div>
                        <div class="fl_right">
                        <div class="fl_title_right">Feautre Listings</div>
                        <div class="promo_label"><img src="images/promo_label.jpg" width="92" height="77" alt=""></div>
                        </div>
                        <div id="bigbox">

                    <ul id="box">
                    	<?php  if(empty($newfeaturelising['images_array'])):?>
                        		<li><img src="images/lp_fl_no_image.jpg" title="No Image Available"/></li>
						<?php endif; ?>
                        <?php  foreach($newfeaturelising['images_array'] as $newfeaturelistingimages_array): ?>  
                            <li> <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$newfeaturelistingimages_array['image_name']; ?>" alt="<?php echo $newfeaturelistingimages_array['image_name']; ?>" title="<?php echo $newfeaturelising['title'];?>"/> </li>
                        <?php endforeach; ?>
                        
                        
                    </ul>
                   		
					<div id="box2">
                    	<a href="listings_details.php?lid=<?php echo $newfeaturelising['listing_id'];?> ">
						  <?php  if(empty($newfeaturelising['image_name'])):?>
                              <img src="images/lp_fl_no_image.jpg"/>
                          <?php endif; ?>
                          <?php  foreach($newfeaturelising['image_name'] as $newfeaturelistingimagename): ?>  
                              <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$newfeaturelistingimagename['image_name']; ?>" alt="<?php echo $newfeaturelistingimagename['image_name']; ?>" /> 
                          <?php endforeach; ?>
                       </a>
                     </div>
                   </div>

               <?php endforeach; ?>
              	<!--*******************************END FEATURE LISTING CODE******************-->
                        </div>
                        <div class="clear"></div>
                        <div class="listing_hrline"></div>
                <!--*******************************LISTINGS HERE***********************-->
               	 <?php foreach($listings as $dispListing):?>
                 <?php $newuserdetails = $user_obj->get_user_detail($dispListing['user_id']);    ?>
               			<div class="clear"></div>
                        <div class="listing_bx">
                        <div class="listing_img_box">
                        <a href="listings_details.php?lid=<?php echo $dispListing['listing_id']; ?>">
                        	<!--IMAGE HERE-->
                            <?php
							  $listing_id = $dispListing['listing_id'];
							  $row_img = $listing_obj->get_img_name($listing_id);
							  
							  if(empty($row_img)):?>
                                    <img src="images/lp_fl_no_image.jpg"/>
                                <?php endif; ?>                                   
                                <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$row_img; ?>" alt="<?php echo $row_img; ?>" /> 
                            <!--END IMAGE-->
                        </a>
                        </div>
                        <div class="listing_desc_box">
                        <div class="listed_car_name"><a href="listings_details.php?lid=<?php echo $dispListing['listing_id'];?>"><?php echo $dispListing['title']; ?></a></div>
                        <div class="listed_price">$<?php echo $dispListing['price']; ?></div>
                        <div class="listed_location"><?php echo $newuserdetails['city'] .", " .$newuserdetails['state']; ?> | 2 Days</div>
                        <div class="listed_desc">Call Toll Free: <?php echo $newuserdetails['phone'] ?>, call for This Week's Hot Internet Price! View all our inventory online <a href="listings_details.php?lid=<?php echo $dispListing['listing_id']; ?>">More...</a></div>
                        </div>
                        <div class="listing_promolabel_box"><img src="images/promo_label.jpg" width="92" height="77" alt=""></div>
                        <div class="clear"></div>
                        </div>
                   <?php endforeach; ?>    
                  
                 <!--*******************************END LISTINGS HERE***********************-->
                        <div class="clear"></div>
                        <div class="listing_btm_pagination">
                         <?php echo $Pagination->display(); ?>
                        </div>
                        </div>
                        <div class="clear"></div>
                        </div>
                         <div class="grid_4">
                       	<?php include_once("ads_r.php");?>
                        </div>
                    </div>
                </div>
		</section>
<?php include("footer.php");?>