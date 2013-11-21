<?php  session_start();
include("includes.php");

$listing_obj = new Listing;
$users_obj = new User;

//function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","condition_ = 'Used'");
$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","condition_ = 'New'");
$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_featured = 1");
$is_finance  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_hotbuy_guaranteed = 1");
$n1 = count($usedcars);
$n2 = count($newcars);
$n3 = count($is_dicker);
$n4 = count($is_finance);

include("header.php");?>
<link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery_indx.css">
      <div class="container_12">
        <?php include("menu.inc.php");?>
        <!--SEARCHTAB-->
        <?php include_once("searchtab.php"); ?>
        <!--END SEARCHTAB-->
        <div class="grid_9">
		<!--CONTENT HERE-->
        <!--INDEX SLIDER HERE-->
       	<?php
		include_once("index-slider.php");
		?>
        <!--  END HERE  -->
        </div>
        <div class="clear"></div>
      </div>
    </header>

    
   <?php 
   		
		/**************************** EXTRA WORK FOR TESTING********************/
   	
   		/// 	 Crossover  Luxury Hybird
		// Sedan Have New Cars 
		// Mostlt sedan have used cars and Pickup
		
       /* $car_body_style = $listing_obj->get_body_style_groupByStyleName();
		$index = 0;
		foreach( $car_body_style as $cbs ){
			
			$body = $cbs['style_name'] ;
			$car_list = $listing_obj->getall_listing("","","created_date","DESC"," is_featured = 1 and body_style = '".$body."'");
			echo "<br>";
			foreach( $car_list as $cars ){			
				echo $cars['listing_id']." | ".$cars['year']." ".$cars['make']." ".$cars['model']." | $body "; 
			echo "<br>";
			}
			echo "<br>";
			$index++;
			}
			die();*/
		?>
    
    
    
    
    
    
     <!--==============================content================================-->
    <section id="content">
      <div class="container_12">
        <div class="wrapper">
          <div class="grid_3">
            <div class="box-1 box-indent">
               <h3 class="dark">News & Views</h3>
               <!--========News and Views Start=======================-->
               <?php include_once("news.inc.php");?>
              <!--========News and Views end=======================-->
            </div>
            
            
              <!--========Featured Dealers Start=======================-->
               <?php include_once("featured-dealers-slider.php");?>
              <!--========Featured Dealers End=======================-->
            
          </div>
          <!--CARS TAB-->
          <?php include_once("index-cars_tab.php"); ?>
          <!--END CARS TAB-->

        </div>

          
      </div>
    </section>
<?php include("footer.php");?>