<?php
session_start();
include_once("includes.php");
include_once("Pagination.php");

$listing_obj = new Listing;
$user_obj	 = new User;
$obj_mysql	 = new Mysql;


$dealer_type = $_GET['type'];

if($dealer_type=="Industrial Truck"){
	$dealer_type = "Industrial Truck";	
}

//get_users_by_region($is_active=false,$region=false,$orderby = false,$sortby = "DESC",$slimit=false,$elimit=false)
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
				//function get_dealers_type($is_active=false,$type=false,$orderby = false,$sortby = "DESC",$slimit=false,$elimit=false)		 
				  $_counter 		= $user_obj->get_dealers_type(true,$dealer_type,false,"DESC",false,false);
				  			
						$pagesPerSection =	5;
						$options		 = 20;	// Display options
						$paginationID	 = "search-inventory";					// This is the ID name for pagination object
						$stylePageOff	 = "pageOff";					// The following are CSS style class names. See styles.css
						$stylePageOn	 = "pageOn";
						$styleErrors	 = "paginationErrors";
						$styleSelect	 = "paginationSelect";
							
/*-===========================================PAGINATION ASSIGNMENT=======================================================*/
						$totalEntries = count($_counter);
				 		$Pagination = new Pagination($totalEntries, $pagesPerSection, $options, $paginationID, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect);
						$start 		= $Pagination->getEntryStart();
						$end 		= $Pagination->getEntryEnd(); 
/*-===========================================END PAGINATION ASSIGNMENT===================================================*/
					//function get_users_by_region($is_active=false,$region=false,$orderby = false,$sortby = "DESC",$slimit=false,$elimit=false)

						$delears_type	= $user_obj->get_dealers_type(true,$dealer_type,false,"DESC",$start,$end);
						$lcount 		= $user_obj->get_dealers_type(true,$dealer_type,false,"DESC",false,false);
					?>
			
 			<!--==============================end pagination================================-->
            <section id="content">
                <div class="container_12">
                	<div class="wrapper">
                    	<div class="grid_8">
                        <div class="result50">Results: <?php echo count($lcount); ?></div>
                        <div class="l_pagination"><?php if(count($lcount) > 0) { echo $Pagination->display(); } ?></div>
                        <div class="clear"></div> 
                   <?php if(count($lcount) > 0) { ?>                   
                        <div class="listing_page">
                        <div class="clear"></div>
                <!--*******************************DEALERS HERE***********************-->
               	 <?php foreach($delears_type as $dispDealers):?>
                 <?php $newuserdetails = $user_obj->get_user_detail($dispDealers['user_id']);    ?>
               			<div class="clear"></div>
                        <div class="listing_bx">
                        <div class="listing_img_box" style="height:32px;width:32px;">
                        <a href="profile.php?uid=<?php echo $dispDealers['user_id']; ?>" target="_blank">
                        	<!--IMAGE HERE-->
                            <?php $user_id = $dispDealers['user_id']; ?>
							  <img src="images/list.png" style="width:32px;height:32px;"/>
                            <!--END IMAGE-->
                        </a>
                        </div>
                        <div class="listing_desc_box">
                        <div class="listed_car_name"><a target="_blank" href="profile.php?uid=<?php echo $dispDealers['user_id'];?>"><?php echo $dispDealers['name']; ?></a></div>
                        <div class="listed_price"><a style ="color:#C03;" href="profile.php?uid=<?php echo $dispDealers['user_id'];?>" target="_blank"><?php echo "<span style='font-weight:bold;color:#066'>Total Listings:</span> ".$listing_obj->get_listings_count_by_userid($dispDealers['user_id']); ?></a></div>
                        <div class="listed_location"><?php echo $dispDealers['city'] .", " .$dispDealers['state']; ?></div>
                        <div class="listed_desc">Call: <?php echo $dispDealers['phone'] ?>, call for This Week's Hot Internet Price! View all our inventory online <a href="profile.php?uid=<?php echo $dispDealers['user_id']; ?>"></a></div>
                        </div>
                        <div class="listing_promolabel_box"><!--<img src="images/promo_label.jpg" width="92" height="77" alt="">--></div>
                        <div class="clear"></div>
                        </div>
                   <?php endforeach; ?>    
                  
                 <!--*******************************END LISTINGS HERE***********************-->
                        <div class="clear"></div>
                        <div class="listing_btm_pagination">
                      	<?php if(count($lcount) > 0) { echo $Pagination->display(); } ?>
                        </div>
                        </div> <!--end listing page here-->
                        <?php } ?> <!--end of php if condition if no record found -->
                        
                        <div class="clear"></div>
                        </div>
                         <div class="grid_4">
                       	<?php include_once("ads_r.php");?>
                        </div>
                    </div>
                </div>
		</section>
<?php include("footer.php");?>