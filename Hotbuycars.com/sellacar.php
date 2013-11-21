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

<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>

<script type="text/javascript">

$(function() {



$('#sellacar_phone').mask("(999) 999-9999");



$('#sellacar_make').change( function(){

 		  var value = $(this).val();

		  $.ajax({

		  type: 'POST',

		  data: ({ajax_make : value}),

		  url: 'ajax_control.php',

		  success: function(data) {

			   var opt = jQuery.parseJSON(data);

			   var pre_select = '<option value="">Select a model</option>';

				var select = '<select name="sellacar_model" id="sellacar_model" class="nc_frm marginan">'+pre_select;

				for(var i = 0; i < opt.length; i++){

					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';

				}

				select += '</select>';

				$('#box-model_sellacar').html(select);

				

			  }

        });

	});	

	

//validation for the form steps

function isValidEmailAddress(emailAddress) {

        var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);

        return pattern.test(emailAddress);

    };	

function requiredSelect(selectS) {

  if(	$(selectS).find(":selected").val() =='') {

	  $('#bttn_1').attr("href","#");

	  $(selectS).focus();

	  return true;

  }

}

function requiredInput(inputI) {

  if($.trim((inputI).val()) =='') {

	  $('#bttn_2').attr("href","#");

	  $(inputI).focus();

	  return true;

  }

}

$('#bttn_1').on('click', function() {

	//STEP 1

	if(requiredSelect($('#sellacar_make'))) {

		 alert('Please Select a Vehicle Make!');

	}

	else if(requiredSelect($('#sellacar_model'))) {

		 alert('Please Select a Vehicle Model!');

	}

	else if(requiredInput($('#sellacar_miles'))) {

		 alert('Please enter a Vehicle Miles!');

	}

	else if(requiredSelect($('#sellacar_year'))) {

		 alert('Please Select a Vehicle Year!');

	}

	else {

		$(this).attr("href","#step2");



	}	

});



$('#bttn_2').on('click', function(e) {

		

	//STEP 2

	if(requiredSelect($('#sellacar_v_title'))) {

		 alert('Please Select Vehicle Title!');

		  e.preventDefault();

		 

	}

	else if(requiredSelect($('#sellacar_financed'))) {

		 alert('Please Select Financed !');

		  e.preventDefault();

	}

	else if(requiredInput($('#sellacar_owing'))) {

		

		alert('Please Enter Vehicle Owing!');

		 e.preventDefault();

	}	

	else if(requiredSelect($('#sellacar_condition'))) {

		

		alert('Please Select Vehicle Condition!');

		 e.preventDefault();

	}	

	else if(requiredSelect($('#sellacar_color'))) {

		

		alert('Please Select Vehicle Color!');

		 e.preventDefault();

	}	

	else {

		$(this).attr("href","#step3");

		// e.preventDefault();

			

	}

	

});

var emailaddress = $("#newcars_email").val();

$('#submit_query').on('click', function(e) {

		

	//STEP 3

	if(requiredInput($('#sellacar_firstname'))) {

		 alert('Please Enter your First Name!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#sellacar_lastname'))) {

		 alert('Please Enter your Last Name!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#sellacar_phone'))) {

		 alert('Please Enter Your Phone Number!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#sellacar_zip'))) {

		 alert('Please Enter Your Zipcode!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#sellacar_email'))) {

		alert('Please Enter Your Email Address!');



		e.preventDefault();

	}	

	else if(!isValidEmailAddress($("#sellacar_email").val()) ) { 

		alert('Please enter your real email address!');



		e.preventDefault();

	}

	else {

		$('#sellacar_form').submit();

	}

	

});



//end validation here



});

</script>

<?php if($_SESSION["sent"]) { ?>

 <script type="text/javascript">

 $.msgBox({

			title:"Thank you!",

			content:"Your sell a car quote will be provided shortly.",

			type:"info"

		});

 </script>

 <?php

}

 unset($_SESSION["sent"]);

 

?>

      <div class="container_12">

        <?php include("menu.inc.php");?>

       	<!--SEARCHTAB-->

        <?php include_once("searchtab.php"); ?>

        <!--END SEARCHTAB-->

        <div class="grid_9">

		<!--CONTENT HERE-->

		<div class="usedCars">

            <div class="usedcar_header"><span class="red">SELL YOUR CAR </span> FOR THE BEST PRICE </div>

            <div class="usedCars_Inner">

              <div class="newcar_title">Get FAST CASH offers for your car in 3 Easy Steps!</div>

              <div class="newcar_left">

                <div class="image"><img src="images/sellcar/image1.jpg" width="375" height="244" alt="">

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

              <form name="sellacar_form" id="sellacar_form" action="send_inquries.php" method="post">

                <div class="step_head_bg" id="step1"> <span>step 1</span><br>

                  Select your vehicle </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p class="marginan"> <strong>Make</strong><span>*</span><br>

                      <select name="sellacar_make" id="sellacar_make" class="nc_frm">

                        <option value="">Select</option>

                         <?php

						$dispMake = $listing_obj->get_all_makes();

						foreach($dispMake as $arrmake){

							echo "<option value='".$arrmake['make_name']."'>". $arrmake['make_name']."</option>";

						}

						?>

                      </select>

                    </p>

                    <p class="marginan"><strong>Model</strong><span>*</span><br>

                       <div id="box-model_sellacar" name = "box-model_sellacar">

                      <select name="sellacar_model" id="sellacar_model" class="nc_frm marginan">

                        <option value="">Select</option>

                      </select>

                     </div>

                    </p>

                    <p><div class="fleft marginan"><strong>Miles/km</strong><span>*</span></div>  <div class="fleft" style="padding-left:30px;"><strong>Year</strong><span>*</span></div>

                    <div class="clear"></div>

                    <input name="sellacar_miles" id="sellacar_miles" type="text" class="nc_frm5 marginan" placeholder="Enter">

                      

                      <select name="sellacar_year" id="sellacar_year" class="nc_frm4">

                      		<option value="">Year</option>

                              <?php

							 for($i=2013;$i>=1980;$i--):

									echo "<option value='".$i."'>". $i."</option>";

							  endfor;

							  ?>

                      </select>

                    </p>

                    <div class="clear"></div>

                    <p style="padding-top:5px;"> <span class="nc_req">* require</span><a href="#" id="bttn_1"><img src="images/continue_btn.jpg" alt="" style="padding-left:28px !important;"></a> </p>

                  </div>

                </div>

                <div class="clear"></div>

                <div class="step_head_bg" id="step2"> <span>step 2</span><br>

                  Vehicle Info </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p class="marginan"> <strong>Vehicle Title<span>*</span></strong><br>

                      <select name="sellacar_v_title" id ="sellacar_v_title" class="nc_frm">

                        <option value="">Select</option>

                        <option value="Clear">Clear</option>

                        <option value="Dismantled">Dismantled</option>

                        <option value="Rebuilt">Rebuilt</option>

                        <option value="Salvage">Salvage</option>

                      </select>

                    </p>

                    <p><div class="fleft marginan"><strong>Financed</strong><span>*</span></div><div class="fleft" style="padding-left:28px;"><strong>Owing</strong></div>

            		<div class="clear"></div>

                      <select name="sellacar_financed" id="sellacar_financed" class="nc_frm3 marginan">

                        <option value="">Select</option>

                        <option value="yes">Yes</option>

                        <option value="no">No</option>

                      </select>

                      <input name="sellacar_owing" id="sellacar_owing" type="text" class="nc_frm6" placeholder="$000.00">

                    

                    </p>

                    <div class="clear"></div>

                    <p><div class="fleft marginan"><strong>Condition</strong><span>*</span></div><div class="fleft" style="padding-left:28px;"><strong>Color</strong><span>*</span></div>

                    <div class="clear"></div>

                      <select name="sellacar_condition" id="sellacar_condition" class="nc_frm3 marginan">

                        <option value="">Select</option>

                        <option value="Poor">Poor</option>

                        <option value="Fair">Fair</option> 

                        <option value="good">Good</option>

                        <option value="Excellent">Excellent</option>

                      </select>



                       <select name="sellacar_color" id ="sellacar_color" class="nc_frm4">

                        <option value="">Select</option>

                          <?php

						$color = $listing_obj->getColors();

						

						while($arrcolor = mysql_fetch_array($color)){

							echo "<option value='".$arrcolor['value']."'>". $arrcolor['value']."</option>";

						}

						?>

                      </select>

                    </p>

                    <div class="clear"></div>

                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step1">&lt;&lt;</a> * require</span><a href="#" id="bttn_2"><img src="images/continue_btn.jpg" alt="" class="marginan"></a> </p>

                  </div>

                </div>

                <div class="clear"></div>

                <div class="step_head_bg" id="step3"> <span>step 3</span><br>

                  Your Contact Info </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                  	<p>

                    <div class="fleft marginan"><strong>Name</strong><span>*</span></div>

                    <div class="clear"></div>

                    <input name="sellacar_firstname" id="sellacar_firstname" type="text" class="nc_frm5 marginan" placeholder="First"><input name="sellacar_lastname" id="sellacar_lastname" type="text" class="nc_frm5" placeholder="Last">

                   </p>

                    <div class="clear"></div>

                    <p><div class="fleft marginan"><strong>Phone</strong><span>*</span></div><div class="fleft" style="padding-left:45px;"><strong>Zip/PC</strong><span>*</span>

                    </div>

                    <div class="clear"></div>

                      <input name="sellacar_phone" id="sellacar_phone" type="text" class="nc_frm4a marginan">

                      <input name="sellacar_zip" id="sellacar_zip" type="text" class="nc_frm4a"  maxlength="5">

                    </p>

                    <div class="clear"></div>

                    <p class="marginan"><strong>Email</strong><span>*</span><br>

                      <input name="sellacar_email" id="sellacar_email" type="text" class="nc_frma">

                      <input type="hidden" name="sellacar_subject" value="Enquiry - Sell a Car Quote" />

                    </p>

                    <p style="padding-top:5px;"><span class="nc_req"><a href="#step2">&lt;&lt;</a>* require</span>

                    <input name="submit_query" type="image" src="images/submit_btn.png" id="submit_query" title="Please check to ensure all information is correct before submitting" class="marginan">

                    </p>

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