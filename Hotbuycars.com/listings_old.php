<?php  session_start();
include_once("includes.php");
include_once("Pagination.php");
$listing_obj = new Listing;
$user_obj    = new User;

$featureListing = $listing_obj->get_all_feature_listing(); 
include("header.php");
?>
<script language="javascript">
 $(document).ready(
 function()
	{
	 $("#box img").click(
			function()
				{
					var sr=$(this).attr("src");						
					//alert(sr);
					$("#box2 img").fadeOut("slow",function(){
					$("#box2").html("<img src='"+sr+"' style='opacity:0.30'/>");
					$("#box2 img").fadeTo("slow",1);
					});	
				}
		);
	//click on the image
		var length=$("#box img").length;
		var myimage=new Array();
		
		$("#box2 img").live('click',function()
				{
				var r=Math.ceil(length*Math.random());
					$("#box2 img").fadeOut("slow",function(){
					$("#box2").html("<img src='"+myimage[r]+"' style='opacity:0'/>");
					$("#box2 img").fadeTo("slow",1);
					});	
				}
			);	
	 //Listing jquery post
	  $('span a').click( function() {
		//var listing = $(this).text();
				
		
	});
	} 
 );
 </script>
       <div class="container_12">
                	<!--=================MAIN-MENU==========================-->
					<?php include("menu.inc.php"); ?>
                    <!--===============END MAIN-MENU========================-->
                </div>
            </header>
<!--===========================================content============================================================-->
            <!--==============================pagination================================--><!--==============================end pagination================================-->
            <section id="content">
                <div class="container_12">
                	<div class="wrapper">
                    	<div class="grid_8">
                        <div class="result50">Re
                          <?php 
				  	function queryTrimmer($conds){	
						
						$listing_search = ""; //WILL HANDLE WHERE CLAUSE FOR MYSQL QUERIES
						$trimcond = ltrim($conds);
					
						$strCompare = substr($trimcond,0,1);
						if($strCompare=="o"){ //CLEAN OR
							$listing_search = ltrim($trimcond,"or");
						}
						elseif($strCompare=="a"){ //CLEAN AND
							$listing_search = ltrim($trimcond,"and");
						}
						else{
							$listing_search = $conds;
						}
					 	return $listing_search;
					
					}	

						$pagesPerSection=5;
												// How many pages will be displayed in the navigation bar
												// If total number of pages is less than this number, the
																		// former number of pages will be displayed
						$options		 = RESULT_PER_PAGE;	// Display options
						$paginationID	 = "listing";					// This is the ID name for pagination object
						$stylePageOff	 = "pageOff";					// The following are CSS style class names. See styles.css
						$stylePageOn	 = "pageOn";
						$styleErrors	 = "paginationErrors";
						$styleSelect	 = "paginationSelect";
						$addParams		 = "";
					
					if(@$_GET['event']=="newcars" || $_GET['event']=="usedcars"):	
						$addParams = array(
						"region" 		=> $_GET['region'],
						"event"		=> $_GET['event'],
						"make" 		=> $_GET['make'],
						"model" 	=> $_GET['model'],
						"price" 	=> $_GET['price'],
						"miles" 	=> $_GET['miles'],
						"zip" 		=> $_GET['zip'],
						"miles"		=> $_GET['miles'],
						"onlyCertified"	=> $_GET['onlyCertified'],						
						"region1" 		=> $_GET['region1'], 	//FOR NEWCARS TAB
						"make_new" 		=> $_GET['make_new'],	//FOR NEWCARS TAB
						"model_new" 	=> $_GET['model_new']	//FOR NEWCARS TAB
					);
					elseif(@$_GET['event']=="searchtab"):
						$addParams = array(
						"searchby" 	=> $_GET['searchby'],
						"make_tab" 	=> $_GET['make_tab'],
						"model_tab" => $_GET['model_tab'],
						"make_pop" 	=> $_GET['make_pop'], 	//FOR POPUP SEARCH
						"model_pop" => $_GET['model_pop'],  //FOR POPUP SEARCH
						"year" 		=> $_GET['year'],
						"pricefrom" => $_GET['pricefrom'],
						"priceto" 	=> $_GET['priceto'],
						"fueltype"	=> $_GET['fueltype'],
						"type" 		=> $_GET['type'],
						"color" 	=> $_GET['color'],
						"engine" 	=> $_GET['engine'],
						"drive" 	=> $_GET['drive'],
						"other" 	=> $_GET['other'],
						"transmission" 	=> $_GET['transmission'],
						"luxury" 	=> $_GET['luxury'],
						"miles"		=> $_GET['miles'],
						"zip" 	    => $_GET['zip'],
						"event"		=> $_GET['event']
					);
					elseif(@isset($_GET['search-listing-zip'])):
				
						$addParams = array(
							"search-listing-zip" => $_GET['search-listing-zip']
						);
						$zip = $addParams['search-listing-zip'];
					
					else:
						$addParams = array(
						"tab" 		=> $_GET['tab']
					);
					endif;
					
					//print_r($addParams);
					/*-==============================================USED CARS SEARCH BY ZIP=========================================================*/
					//New codes here.. ..
					/*-==============================================END USED CARS SEARCH BY ZIP=========================================================*/
					
					/*-==============================================||USEDCARDS && NEWCARS||SEARCH TAB AT INDEX FILE=========================================================*/

					$condition = "";
					if($addParams['region'] <> ""):
						$condition .=" (state ='".$addParams['region']."')";
					endif;
					if($addParams['region1'] <> ""):
						$condition .=" (state ='".$addParams['region1']."')";
					endif;
					if(($addParams['make'] <> "anymake") && ($addParams['make'] <> "")):
						$condition .=" and (make ='".$addParams['make']."')";
					endif;
					if(($addParams['make_new'] <> "anymake") && ($addParams['make_new'] <> "")):
						$condition .=" and (make ='".$addParams['make_new']."')";
					endif;
					if(($addParams['model'] <> "anymodel") && ($addParams['model'] <> "")):
						$condition .=" and (model ='".$addParams['model']."')";
					endif;
					if($addParams['miles'] <> ""):
						$condition .=" and ((miles > 0 and miles <=".$addParams['miles']."))";
					endif;
					if($addParams['onlyCertified'] <> ""):
						$condition .=" and (certified_used = 1 )";
					endif;
					if(($addParams['model_new'] <> "anymodel") && ($addParams['model_new'] <> "")):
						$condition .=" and (model ='".$addParams['model_new']."')";
					endif;
					if($addParams['zip'] <> ""):
						$condition .=" and (zip ='".$addParams['zip']."')";
					endif;
					if($addParams['price'] <> ""):
						$condition .=" and (price ='".$addParams['price']."')";

					endif;
					if($addParams['event'] =="newcars"):
						$condition .=" and (new_used ='New')";
					endif;
					if($addParams['event'] =="usedcars"):
						$condition .=" and (new_used ='Used')";
					endif;
					
					$listing_cars = queryTrimmer($condition);
					
					//print_r($listing_cars);
					/*-==============================================END ||USEDCARDS && NEWCARS||SEARCH TAB AT INDEX FILE=========================================================*/
					/*-==============================================SEARCH TAB AT INDEX FILE && popup search=========================================================*/
					$cond = ""; //will hold the where phrase
					$c = 0;
		
					if(!empty($addParams['searchby'])):
					$cond .="(";
						foreach($addParams['searchby'] as $searchby):
							if($c==0): $cond .= "(new_used ='".$searchby."' )"; else: $cond .= " or (new_used ='".$searchby."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					if(($addParams['make_tab'] <> "") && $addParams['make_tab'] <> "anymake"):
						$cond .=" and (make ='".$addParams['make_tab']."')";
					endif;
					if(($addParams['model_tab'] <> "") && $addParams['model_tab'] <> "anymodel"):
						$cond .=" and (model ='".$addParams['model_tab']."')";
					endif;
					//added 3/25/2013
					if(($addParams['make_pop'] <> "") && $addParams['make_pop'] <> "anymake"):
						$cond .=" and (make ='".$addParams['make_pop']."')";
					endif;
					if(($addParams['model_pop'] <> "") && $addParams['model_pop'] <> "anymodel"):
						$cond .=" and (model ='".$addParams['model_pop']."')";
					endif;
					//end here
					if($addParams['year'] <> "any"):
						$cond .=" and (year ='".$addParams['year']."')";
					endif;
					if(isset($addParams['is_luxury'])):
						$cond .=" and (is_luxury =1)";
					endif;
					if($addParams['miles'] <> "anymiles"):
						$cond .=" and ((miles > 0 and miles <=".$addParams['miles']."))";
					endif;
					if(isset($addParams['is_3rd_row'])):
						$cond .=" and (is_3rd_row =1)";
					endif;
					if(trim($addParams['zip']) <> ""):
						$cond .=" and (zip ='".$addParams['zip']."')";
					endif;
					if(($addParams['pricefrom'] <> "any") && ($addParams['priceto'] <> "any")):
						$cond .=" and ((price >=".$addParams['pricefrom'].") and (price <=".$addParams['priceto']."))";
					else:
						if($addParams['pricefrom'] <> "any"):
							$cond .=" and (price >=".$addParams['pricefrom'].")";
						elseif($_GET['priceto'] <> "any"):
							$cond .=" and (price <=".$addParams['priceto'].")";
						else:					
						endif;
					endif;
					if(!empty($addParams['type'])):
					$cond .=" and (";
						foreach($addParams['type'] as $type):
							if($c==0): $cond .= "(body_style ='".$type."' )"; else: $cond .= " or (body_style ='".$type."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					if(!empty($addParams['fueltype'])):
					$cond .=" and (";
						foreach($addParams['fueltype'] as $fueltype):
							if($c==0): $cond .= "(fuel ='".$fueltype."' )"; else: $cond .= " or (fuel ='".$fueltype."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					if(!empty($addParams['color'])):
					$cond .=" and (";
						foreach($addParams['color'] as $color):
								if($c==0): $cond .= "(exterior ='".$color."' )"; else: $cond .= " or (exterior ='".$color."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					if(!empty($addParams['engine'])):
					$cond .=" and (";
						foreach($addParams['engine'] as $engine):
								if($c==0): $cond .= "(engine ='".$engine."' )"; else: $cond .= " or (engine ='".$engine."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					if(!empty($addParams['drive'])):
					$cond .=" and (";
						foreach($addParams['drive'] as $drive):
								if($c==0): $cond .= "(drive ='".$drive."' )"; else: $cond .= " or (drive ='".$drive."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					if(!empty($addParams['transmission'])):
					$cond .=" and (";
						foreach($addParams['transmission'] as $transmission):
								if($c==0): $cond .= "(trans ='".$transmission."' )"; else: $cond .= " or (trans ='".$transmission."' )"; endif; $c++;
						endforeach;
					$cond .=")";
					$c=0;
					endif;
					
					$listing_search_tab = queryTrimmer($cond);
					//print_r($listing_search_tab);
/*-============================================SEARCH TAB AT INDEX FILE + 4 tabs + 2 tabs(used and newcars)=======================================================*/
					if($addParams['event']=="searchtab"):
						$_counter 		= $listing_obj->getListings(false,false,"created_date ","desc",$listing_search_tab);
					elseif($addParams['event']=="usedcars" || $addParams['event']=="newcars"):
						$_counter 		= $listing_obj->getListings(false,false,"created_date ","desc",$listing_cars);
					elseif(isset($addParams['search-listing-zip'])):
						if($addParams['search-listing-zip']<>""){
							$_counter 			= $listing_obj->getListings(false,false,"created_date ","desc","zip = '".$zip."'");
						}
						else {
							$_counter 			= $listing_obj->getListings(false,false,"created_date ","desc",false);
						}						
					else:
				  		if($_GET['tab']=="used"):
							$_counter = $listing_obj->getListings(false,false,"created_date ","desc","new_used = 'Used'");
							
						elseif($addParams['tab']=="new"):
							$_counter = $listing_obj->getListings(false,false,"created_date ","desc","new_used = 'New'");
						elseif($addParams['tab']=="dicker"):
							$_counter = $listing_obj->getListings(false,false,"created_date ","desc","is_dicker = 1");
				
						elseif($addParams['tab']=="finance"):
							$_counter	= $listing_obj->getListings(false,false,"created_date ","desc","is_finance = 1");
						else:
							$_counter	= $listing_obj->getListings(false,false,"created_date ","desc",false);
						endif;
					endif;
/*-============================================END SEARCH TAB AT INDEX FILE + 4 tabs + 2 tabs(used and newcars)====================================================*/
/*-===========================================PAGINATION ASSIGNMENT=======================================================*/
						$totalEntries = count($_counter);
			
				 		$Pagination = new Pagination($totalEntries, $pagesPerSection, $options, $paginationID, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect);
						$start 		= $Pagination->getEntryStart();
						$end 		= $Pagination->getEntryEnd(); 
/*-===========================================END PAGINATION ASSIGNMENT===================================================*/
						//echo "START: ".$start. ","."END: ".$end;
					//function getListings($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
					if($addParams['event']=="searchtab"):
						$listings		= $listing_obj->getListings($start,$end,"created_date ","desc",$listing_search_tab);
						$lcount 		= $listing_obj->getListings(false,false,"created_date ","desc",$listing_search_tab);
					elseif($addParams['event']=="usedcars" || $addParams['event']=="newcars"):
						$listings		= $listing_obj->getListings($start,$end,"created_date ","desc",$listing_cars);
						$lcount 		= $listing_obj->getListings(false,false,"created_date ","desc",$listing_cars);
					elseif(isset($addParams['search-listing-zip'])):
						if($addParams['search-listing-zip']<>""){
							$listings			= $listing_obj->getListings($start,$end,"created_date ","desc","zip = '".$zip."'");
							$lcount 			= $listing_obj->getListings(false,false,"created_date ","desc","zip = '".$zip."'");
						}
						else {
							$listings			= $listing_obj->getListings($start,$end,"created_date ","desc",false);
							$lcount 			= $listing_obj->getListings(false,false,"created_date ","desc",false);
						}
						
					else:
						if($_GET['tab']=="used"):
							$listings		= $listing_obj->getListings($start,$end,"created_date ","desc","new_used = 'Used'");
							$lcount 		= $listing_obj->getListings(false,false,"created_date ","desc","new_used = 'Used'");
						elseif($addParams['tab']=="new"):
							$listings		= $listing_obj->getListings($start,$end,"created_date ","desc","new_used = 'New'");
							$lcount			= $listing_obj->getListings(false,false,"created_date ","desc","new_used = 'New'");
						elseif($addParams['tab']=="dicker"):
							$listings		= $listing_obj->getListings($start,$end,"created_date ","desc","is_dicker = 1");
							$lcount = $listing_obj->getListings(false,false,"created_date ","desc","is_dicker = 1");
						elseif($addParams['tab']=="finance"):
							$listings		= $listing_obj->getListings($start,$end,"created_date ","desc","is_finance = 1");
							$lcount	= $listing_obj->getListings($start,false,"created_date ","desc","is_finance = 1");
						else:
							$listings		= $listing_obj->getListings($start,$end,"created_date ","desc",false);
							$lcount			= $listing_obj->getListings(false,false,"created_date ","desc",false);
						endif;
					endif;
					//print_r($listings);
					?>
                          sults: <?php echo count($lcount); ?></div>
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
                <div id="content">
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
                  </div>
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