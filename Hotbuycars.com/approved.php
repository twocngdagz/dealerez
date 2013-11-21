<?php  session_start();

include("includes.php");

$listing_obj = new Listing;

$mysql		 = new Mysql;



$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used'"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)

$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New'");

$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1");

$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1");

include("header.php");?>

<script type="text/javascript">

	$(function() {

		$('#a_href').on('click',function() {

			zip = $('#zip_search').val();

			$('#a_href').attr("href","listings.php?search-listing-zip=" +zip);

		});

	});

</script>

      <div class="container_12">

        <?php include("menu.inc.php");?>

        <!--SEARCHTAB-->

        <?php include_once("searchtab.php"); ?>

        <!--END SEARCHTAB-->

        <div class="grid_9">

		<!--CONTENT HERE-->

         <div class="usedCars">

                      <div class="usedcar_header">CHOOSE YOUR CAR - <span class="red">YOU’RE APPROVED </span></div>

                      <div class="usedCars_Inner"> 

                      <div class="newcar_title">Bad Credit, No Credit  -  No Problem! </div>        

                      <div class="finance_left2">

                      <div>

                        <p>We know life can just get tough at times, so we’ve developed relationships with americas top used car Dealers and specialized auto finance lenders with the expertise to get you approved, and on the best possible terms. To qualify you typically just need to provide proof of income and residence. You’ll also get the benefit of restoring your credit while paying off your auto loan to help you fix bad credit and get a good credit rating!  <a href="getapproved.html"><em>Get Approved!</em></a></p>

          <strong>No matter what your situation ...  </strong>

                        <table width="300" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td height="15" align="left" valign="bottom">Bad Credit </td>

              <td height="15" align="left" valign="bottom">No Credit</td>

            </tr>

            <tr>

            <td height="15" align="left" valign="bottom"> Self Employed</td>

            <td height="15" align="left" valign="bottom"> Get Paid in Cash</td>

            </tr>

            <tr>

            <td height="15" align="left" valign="bottom">Bankrupt</td>

            <td height="15" align="left" valign="bottom">Consumer Proposal</td>

            </tr>

            <tr>

            <td height="15" align="left" valign="bottom">Poor Credit</td>

            <td height="15" align="left" valign="bottom">Previous Repo</td>

            </tr>

            <tr>

            <td height="15" align="left" valign="bottom">Divorced </td>

            <td height="15" align="left" valign="bottom">Fixed Income </td>

            </tr>

            <tr>

            <td height="15" align="left" valign="bottom">Collections</td>

            <td height="15" align="left" valign="bottom">Disability</td>

            </tr>

          </table>

          <div class="usedcar_great_selection" style="padding-top:25px;">Find the vehicle you love from our great<br>selection nearest you <input name="zip_search" id = "zip_search" type="text" placeholder="enter zip">

          <div class="go_btn"><a id="a_href" name="a_href" href=""><img src="images/go_btn_blue.jpg" width="41" height="38" alt=""></a></div></div>

          

                        

                      </div>

                      

                      </div>

                      <div class="finance_right"><img src="images/approved/img2.jpg" width="346" height="246" alt=""><br><span class="fleft"><a href="#"><img src="images/approved/find-ur-car-btn.jpg" width="225" height="91" alt=""></a></span>

                      

                        <div class="fleft"></div>

                      </div>

          <div class="clear"></div>

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