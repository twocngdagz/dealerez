<?php  session_start();

include("includes.php");

$listing_obj = new Listing;

$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used'"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)

$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New'");

$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1");

$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1");



/*** Asad Work

 * Getting Blogs ***/



$blogs_object = new Blogs();



$cond=false;

$data_list=array();

$page = 1;



$paging_sql = $blogs_object->get_blogs(" and is_active='1'",'','','','','',1);



$page_arguments = '';//"blogs.php?".get_page_arguments();

$pagging=array();

$pagging = generate_pagination_sql_correct($paging_sql,5,$page,$page_arguments);

if($pagging["totalrows"]>0){

		$data_list = $blogs_object->get_blogs(" and is_active='1'",'','','',$pagging["limitvalue"],$pagging["limit"]);

	}



//print_r($data_list);die();



$count=1;



include("header.php");?>

      <div class="container_12">

        <?php include("menu.inc.php");?>

        <!--SEARCHTAB-->

        <?php include_once("searchtab.php"); ?>

        <!--END SEARCHTAB-->

        <div class="grid_9">

		<!--CONTENT HERE-->

		<div class="usedCars">

            <div class="usedcar_header">NEW AND USED  <span class="red">CAR FINANCING</span></div>

            <div class="usedCars_Inner">         

            <div class="finance_left">

            <div class="fin_head">Get Pre-Approved<br><span>from the <strong>comfort</strong> of your<br>own home!</span></div>

            <div>

              <p><span class="red">HotBuyCars.com</span> is not only here to help you find a great deal on your car purchase, but also on your car financing. We have developed relationships with americas top vehicle finance companies offering the expertise to get you approved quickly, and with the best possible terms and rates.                </p>

              <p><strong><em><a href="#">Get Pre-Approved</a> now or choose your car first. <br>

                Enjoy rates as low as 2.5% with no-money down!              </em></strong></p>

              <p class="gcbc_fin">&nbsp;</p>

              <p class="gcbc_fin"><strong>Good or Bad Credit, we’ll help you get<br>

                the auto loan you need ... fast! </strong></p>

            </div>

            

            </div>

            <div class="finance_right">

              <img src="images/finance/img1.png" width="346" height="279" alt=""><br>

              <div class="fin_start_now"><a href="getapproved.php"><img src="images/start_now.png" width="113" height="79" alt=""></a></div> 

              <div class="fin_start_now_txt">Most loan applicaitons<br>approved in minues!</div>

            </div>

            <div class="clear" style="padding-top:12px;"></div>

            </div>

          </div>

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

             <!--========Featured Dealers Start=======================-->
               <?php include_once("featured-dealers-slider.php");?>
              <!--========Featured Dealers End=======================-->
            

          </div>

          <!--CARS TAB-->

          <?php include_once("cars_tab.php"); ?>

          <!--END CARS TAB-->

        </div>

      </div>

    </section>

<?php include("footer.php");?>