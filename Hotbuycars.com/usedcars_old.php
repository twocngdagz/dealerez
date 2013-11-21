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
        <div class="usedcar_header">BUY A <span class="red">USED CAR</span> WITH CONFIDENCE</div>
        <div class="usedCars_Inner2">
        <div class="fright"><img src="images/usedcar/img1.jpg" width="368" height="230"></div>
        <span class="red">HotBuyCars.com</span> is here to help you find a great deal on your next vehicle purchase and to ensure you are protected by dealing with a certified dealer. Whether searching for a car, suv, convertible wagon, van or minivan, pickup or commercial truck we can help you find it. To get started, enter your zip/pc to view the listings nearest you then use our <a href="#"><em>Search</em></a> tabs below.<br><br>
          <div class="usedcar_great_selection">Find the vehicle you love from our great<br>selection nearest you <input name="zip_search" id = "zip_search" type="text" placeholder="enter zip"><div class="go_btn"><a id="a_href" name="a_href" href=""><img src="images/go_btn_blue.jpg" width="41" height="38" alt=""></a></div></div>
          <div class="clear"></div>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="20%" height="25" align="left" valign="top"><span class="red">Latest Used</span> or <span class="red">New </span> - </td>
                    <td width="80%" align="left" valign="top">provides you the most recent cars listed for sale giving you a first chance at what’s new. </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="103" height="25" align="left" valign="top"><span class="red">Deals n Steals </span> - </td>
                    <td width="557" align="left" valign="top">provides you the most recent vehicles listed offered at reduced or incredbibe blowout prices! 
      </td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="25%" align="left" valign="top"><span class="red">Buy Here You’re Approved! </span> - </td>
                    <td width="75%" align="left" valign="top">provides you the most recent vehicles available from “BuyHere - Pay here” car dealerships that guarantee you financing no matter if your credit is bad,</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="105" height="25" align="left" valign="bottom"><span class="red">Detailed Search</span> - </td>
                    <td width="555" align="left" valign="bottom">provides you a full detailed search on by make, model, type, price, color, trim, etc.</td>
                  </tr>
                  <tr>
                    <td height="27" align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table>
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
          <?php include_once("cars_tab.php"); ?>
          <!--END CARS TAB-->
        </div>
      </div>
    </section>
<?php include("footer.php");?>