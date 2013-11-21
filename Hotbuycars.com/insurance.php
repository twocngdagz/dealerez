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

	

$('#insurance_phone').mask("(999) 999-9999");



$('#insurance_make').change( function(){

 		  var value = $(this).val();

		  $.ajax({

		  type: 'POST',

		  data: ({ajax_make : value}),

		  url: 'ajax_control.php',

		  success: function(data) {

			   var opt = jQuery.parseJSON(data);

			   var pre_select = '<option value="">Select a model</option>';

				var select = '<select name="insurance_model" id="insurance_model" class="nc_frm marginan">'+pre_select;

				for(var i = 0; i < opt.length; i++){

					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';

				}

				select += '</select>';

				$('#box-model_insurance').html(select);

				

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

$('#bttn_1').click(function(evt) {

	//STEP 1

	if(requiredSelect($('#insurance_make'))) {

		 alert('Please Select a Vehicle Make!');

	}

	else if(requiredSelect($('#insurance_model'))) {

		 alert('Please Select a Vehicle Model!');

	}

	else if(requiredSelect($('#insurance_year'))) {

		 alert('Please Select a Vehicle Year!');

	}

	else {

		$(this).attr("href","#step2");



	}	

});



$('#bttn_2').on('click', function(e) {

		

	//STEP 2

	if(requiredSelect($('#insurance_licensed_state'))) {

		 alert('Please Select Licensed state!');

		  e.preventDefault();

		 

	}

	else if(requiredSelect($('#insurance_driver_age'))) {

		 alert('Please Select Driver Age!');

		  e.preventDefault();

	}

	else if(requiredSelect($('#insurance_driver_status'))) {

		

		alert('Please Select Driver Status!');

		 e.preventDefault();

	}	

	else if(requiredSelect($('#insurance_credit'))) {

		

		alert('Please Select Credit!');

		 e.preventDefault();

	}	

	else if(requiredSelect($('#insurance_violations'))) {

		

		alert('Please Select Violations!');

		 e.preventDefault();

	}	

	else {

		$(this).attr("href","#step3");

			

	}

	

});

var emailaddress = $("#newcars_email").val();

$('#submit_query').on('click', function(e) {

		

	//STEP 3

	if(requiredInput($('#insurance_firstname'))) {

		 alert('Please Enter your First Name!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#insurance_lastname'))) {

		 alert('Please Enter your Last Name!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#insurance_phone'))) {

		 alert('Please Enter Your Phone Number!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#insurance_email'))) {

		alert('Please Enter Your Email Address!');



		e.preventDefault();

	}	

	else if(!isValidEmailAddress($("#insurance_email").val()) ) { 

		alert('Please enter your real email address!');



		e.preventDefault();

	}

	else {



		$('#insurance_form').submit();

	}

	

});



//end validation here



});

</script>

<?php if($_SESSION["sent"]) { ?>

 <script type="text/javascript">

 $.msgBox({

			title:"Thank you!",

			content:"Your car insurance quote will be provided shortly.",

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

            <div class="usedcar_header">GET A FAST QUOTE ON  <span class="red">CAR INSURANCE </span></div>

            <div class="usedCars_Inner">

              <div class="newcar_title">NOBODY BEATS US ... find out in 3 Quick Steps!  </div>

              <div class="newcar_left" style="padding-bottom:18px;">

                <div class="image"><img src="images/insuracne/img1.jpg" width="375" height="218" alt="">

                <div class="insu_txt">Our Rates Will Blow You Away!</div>

                <div class="insu_txt red" style="padding-bottom:7px; font-size:20px">OR CALL US... 888-928-5558</div>

</div>

                <div class="image-content">

                  <ul>

                    <li>All price quotes are free, with no obligations.</li>

                    <li>Your Privacy is Our Top Concern <a href="#">Privacy Policy</a></li>

                  </ul>

                </div>

              </div>

              <div class="newcar_right">

              <form name="insurance_form" id="insurance_form" action="send_inquries.php" method="post">

                <div class="step_head_bg" id="step1"> <span>step 1</span><br>

                  Select your vehicle </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p class="marginan"> <strong>Make<span>*</span></strong><br>

                      <select name="insurance_make" id="insurance_make" class="nc_frm">

                        <option value="">Select</option>

                         <?php

						$dispMake = $listing_obj->get_all_makes();

						foreach($dispMake as $arrmake){

							echo "<option value='".$arrmake['make_name']."'>". $arrmake['make_name']."</option>";

						}

						?>

                      </select>

                    </p>

                    <p class="marginan"> <strong>Model</strong><span>*</span><br>

                      <div id="box-model_insurance" name = "box-model_insurance">

                      <select name="insurance_model" id="insurance_model" class="nc_frm marginan">

                        <option value="">Select</option>

                      </select>

                     </div>

                    </p>

                    <p class="marginan">Year<span>*</span>

                    <div class="clear"></div>

                	<select name="insurance_year" id = "insurance_year" class="nc_frm4 marginan">

                      		<option value="">Year</option>

                              <?php

							 for($i=2013;$i>=1980;$i--):

									echo "<option value='".$i."'>". $i."</option>";

							  endfor;

							  ?>

                   </select>

                    </p>

                    <div class="clear"></div>

                    <p style="padding-top:5px;"> <span class="nc_req">* require </span><a href="#" id="bttn_1"><img src="images/continue_btn.jpg" alt="" style="margin-left: 25px;"></a> </p>

                  </div>

                </div>

                <div class="clear"></div>

                <div class="step_head_bg" id="step2"> <span>step 2</span><br>

                  Driver Info </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p class="marginan"> <strong>Licenced State<span>*</span></strong><br>

                      <?php

						$region_u = loadStates();

						?>

						  <select name="insurance_licensed_state" id="insurance_licensed_state" class="nc_frm">

						   <?php

						   foreach($region_u as $row_region){ 

						   if($row_region['state']=="Utah"){

							   echo "<option value='".$row_region['state']."' selected='selected'>". $row_region['state']."</option>";

						   }

						   else {

							 echo "<option value='".$row_region['state']."'>". $row_region['state']."</option>";

						   }

						   }

						   ?>

						  </select>

                    </p>

                    <p class="marginan"><div class="fleft marginan"><strong>Driver Age</strong><span>*</span></div><div class="fleft" style="padding-left:25px;"><strong>Status</strong><span>*</span></div>

                    <div class="clear"></div>

                      <select name="insurance_driver_age" id="insurance_driver_age" class="nc_frm3 marginan">

                        <option value="">Select</option>

                        <?php 

						for($age_c = 16; $age_c <= 75 ; $age_c++) {

							 echo '<option>'.$age_c.'</option>';	

						}

						?>

                   

                      </select>

                      <select name="insurance_driver_status" id="insurance_driver_status" class="nc_frm4">

                        <option value="">Select</option>

                        <option value="Single">Single</option>

                        <option value="Married">Married</option>

                        <option value="Divorced">Divorced</option>

                      </select>

                    </p>

                    <div class="clear"></div>

                    <p class="marginan"><div class="fleft marginan"><strong>Credit</strong><span>*</span></div><div class="fleft" style="padding-left:50px;"><strong>Violations</strong>                    <span>*</span></div>

                    <div class="clear"></div>

                      <select name="insurance_credit" id="insurance_credit" class="nc_frm3 marginan">

                        <option value="">Select</option>

                        <option value="Bad">Bad</option>

                        <option value="Fair">Fair</option>

                        <option value="Good">Good</option>

                        <option value="Excellent">Excellent</option>

                      </select>

                      <select name="insurance_violations" id="insurance_violations" class="nc_frm4">

                        <option value="">Select</option>

                        <option value="None">None</option>

						<option value="1">1</option>

                        <option value="2">2</option>

                        <option value="3">3</option>

                        <option value="4">4</option>

                        <option value="5+">5+</option>

                      </select>

                    </p>

                    <div class="clear"></div>

                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step1">&lt;&lt;</a> * require </span> <a href="#" id="bttn_2"><img src="images/continue_btn.jpg" alt="" 

                    class="padL7px"></a> </p>

                  </div>

                </div>

                <div class="clear"></div>

                <div class="step_head_bg" id="step3"> <span>step 3</span><br>

                  Driver Contact </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p> 

                    <div class="fleft marginan"><strong>Name</strong><span>*</span></div>

                    <div class="clear"></div>

                    <input name="insurance_firstname" id="insurance_firstname" type="text" class="nc_frm5 marginan" placeholder="First"><input name="insurance_lastname" id="insurance_lastname" type="text" class="nc_frm5" placeholder="Last">

                    </p>

                    <div class="clear"></div>

                    <p class="marginan"><strong>Phone</strong><span>*</span><br />

                      <input name="insurance_phone" id="insurance_phone" type="text" class="nc_frm2">

                   </p>

                    <div class="clear"></div>

                    <p class="marginan"><strong>Email</strong><span>*</span><br>

                      <input name="insurance_email" id="insurance_email" type="text" class="nc_frm9">

                      <input type="hidden" name="insurance_subject" value="Enquiry - Car Insurance Quote" />

                    </p>

                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step2">&lt;&lt;</a> * require </span>

                    <input name="submit_query" class="marginan" type="image" src="images/submit_btn.png" id="submit_query" title="Please check to ensure all information is correct before submitting">

                    </p>

                   

                  </div>

                </div>

                </form>

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

          <?php include_once("index-cars_tab.php"); ?>

          <!--END CARS TAB-->

        </div>

      </div>

    </section>

<?php include("footer.php");?>