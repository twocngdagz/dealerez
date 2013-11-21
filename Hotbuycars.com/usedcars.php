<?php  session_start();
include("includes.php");

$listing_obj = new Listing;
$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used'"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New'");
$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1");
$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1");
$n1 = count($usedcars);
$n2 = count($newcars);
$n3 = count($is_dicker);
$n4 = count($is_finance);

include("header.php");?>
      <div class="container_12">
        <?php include("menu.inc.php");?>
        <!--SEARCHTAB-->
        <?php include_once("searchtab.php"); ?>
        <!--END SEARCHTAB-->
        <div class="grid_9">
		<!--CONTENT HERE-->
        <!--INDEX SLIDER HERE-->
       	<?php
		include_once("map2.php");
		?>
        <!--  END HERE  -->
        </div>
        <div class="clear"></div>
      </div>
    </header>
    
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
            <div class="box-2">
              <h3 class="light">Featured Dealers</h3>
              <div class="box-2-container">
                <ul class="list-1-1 p2" id="scroller">
                  <li><a href="#"><img src="images/feature_dealer1.jpg" style="width:177px;height:88px;"  alt=""></a></li>
                  <li><a href="#"><img src="images/feature_dealer2.jpg" style="width:177px;height:88px;"  alt=""></a></li>
                </ul>
              </div>
            </div>
          </div>
          <!--CARS TAB-->
          <?php include_once("index-cars_tab.php"); ?>
          <!--END CARS TAB-->
        </div>
      </div>
    </section>
<?php include("footer.php");?>