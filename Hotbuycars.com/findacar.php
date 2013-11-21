<?php  session_start();
include("includes.php");
$listing_obj = new Listing;
$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used'"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New'");
$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1");
$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1");
include("header.php");?>
<script type="text/javascript">
$(function() {
$('#findacar_make').change( function(){
 		  var value = $(this).val();
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
			   var opt = jQuery.parseJSON(data);
			   var pre_select = '<option value="anymodel">Select a model</option>';
				var select = '<select name="findacar_model" id="findacar_model" class="nc_frm">'+pre_select;
				for(var i = 0; i < opt.length; i++){
					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
				}
				select += '</select>';
				$('#box-model_findacar').html(select);
				
			  }
        });
	});	
$('#findacar_query').on('click', function() {
	
		$('#findacar_form').submit();
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
            <div class="usedcar_header">LET US  <span class="red">FIND A CAR</span>  FOR YOU </div>
            <div class="usedCars_Inner">
              <div class="newcar_title">Let Us Find Your Car ... in 3 Quick Steps!</div>
              <div class="newcar_left">
                <div class="image"><img src="images/findcars/image1.jpg" width="375" height="244" alt="">
                <div class="findcar_lense"><img src="images/findcars/find_icon.png" width="225" height="223" alt=""></div>
                </div>
                <div class="image-content">
                  <ul>
                    <li>All price quotes are free, with no obligations.</li>
                    <li>Your Privacy is Our Top Concern <a href="#">Privacy Policy</a></li>
                    <li>We seach our database of thousands of dealers to get you the best price.</li>
                  </ul>
                </div>
              </div>
              <div class="newcar_right">
               <form name="findacar_form" id="findacar_form" action="send_inquries.php" method="post">
                <div class="step_head_bg" id="step1"> <span>step 1</span><br>
                  Select your vehicle </div>
                <div class="grey_box_nc">
                  <div class="syv_form">
                    <p> <strong>Make<span>*</span></strong><br>
                      <select name="findacar_make" id="findacar_make" class="nc_frm">
                        <option value="anymake">Select a Make</option>
                         <?php
						$dispMake = $listing_obj->get_all_makes();
						foreach($dispMake as $arrmake){
							echo "<option value='".$arrmake['make_name']."'>". $arrmake['make_name']."</option>";
						}
						?>
                      </select>
                    </p>
                    <p> <strong>Model</strong><span>*</span><br>
                      <div id="box-model_findacar" name = "box-model_findacar">
                        <select name="findacar_model" id="findacar_model" class="nc_frm">
                          <option value="anymodel">Select a model</option>
                        </select>
                      </div>
                    </p>
                    <p> Color<br>

                      <select name="findacar_color" id ="findacar_color" class="nc_frm3">
                        <option value="anycolor">Any</option>
                          <?php
						$color = $listing_obj->getColors();
						
						while($arrcolor = mysql_fetch_array($color)){
							echo "<option value='".$arrcolor['value']."'>". $arrcolor['value']."</option>";
						}
						?>
                      </select>
                      <select name="findacar_year" id="findacar_year" class="nc_frm4">
                      <option value="anyyear">Year</option>
                              <?php
							 for($i=2013;$i>=1980;$i--):
									echo "<option value='".$i."'>". $i."</option>";
							  endfor;
							  ?>
                        </select>
                    </p>
                    <div class="clear"></div>
                    <p style="padding-top:5px;"> <span class="nc_req">* require </span><a href="#step2"><img src="images/continue_btn.jpg" alt=""></a> </p>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="step_head_bg" id="step2"> <span>step 2</span><br>
                  Purchase Info </div>
                <div class="grey_box_nc">
                  <div class="syv_form">
                    <p> <strong>Purchase Type<span>*</span></strong><br>
                      <select name="findacar_type" id="findacar_type" class="nc_frm">
                        <option value="anytype" selected="selected">Any</option>
                        <?php
						$dispCat = $listing_obj->get_all_categories();
						foreach($dispCat as $arrtype){
							echo "<option value='".$arrtype['cat_name']."'>".$arrtype['cat_name']."</option>";
						}
						?>
                      </select>
                    </p>
                    <p> <strong>Purchase Timing</strong><span>*</span><br>
                      <select name="findacar_timing" id="findacar_timing" class="nc_frm">
                        <option value="anytiming">Select</option>
                         <?php
						$engine = $listing_obj->getEngines();
						
						while($arrengine = mysql_fetch_array($engine)){
							echo "<option value='".$arrengine['value']."'>". $arrengine['value']."</option>";
						}
						?>
                      </select>
                    </p>
                    <p> Zip/PC<span>*</span><br>
                      <input name="findacar_zip" id="findacar_zip" type="text" class="nc_frm2">
                    </p>
                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step1">&lt;&lt;</a> * require </span><a href="#step3"><img src="images/continue_btn.jpg" alt=""></a> </p>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="step_head_bg" id="step3"> <span>step 3</span><br>
                  Your Contact Info </div>
                <div class="grey_box_nc">
                  <div class="syv_form">
                    <p> <strong>Name<span>*</span></strong><br>
                      <input name="findacar_name" id="findacar_name" type="text" class="nc_frm2">
                    </p>
                    <p> <strong>Phone</strong><span>*</span><br>
                      <input name="findacar_phone" id="findacar_phone" type="text" class="nc_frm2">
                    </p>
                    <p> Email<span>*</span><br>
                      <input name="findacar_email" id= "findacar_email" type="text" class="nc_frm2">
                      <input type="hidden" name="findacar_subject" value="Enquiry - Find a Car Quote" />
                    </p>
                    <p>&nbsp; </p>
                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step2">&lt;&lt;</a> * require
                      <input name="findacar_query" id="findacar_query" type="image" src="images/continue_btn.jpg" />
                    </span></p>
                  </div>
                </div>
                </form>
              </div>
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