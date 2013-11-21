<?php  session_start();

include("includes.php");

$listing_obj = new Listing;



include("header.php");?>



<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>

<script type="text/javascript">



$(function() {

	

	

	$('#newcars_phone').mask("(999) 999-9999"); 



$('#newcars_make').change( function(){

 		  var value = $(this).val();

		  $.ajax({

		  type: 'POST',

		  data: ({ajax_make : value}),

		  url: 'ajax_control.php',

		  success: function(data) {

			   var opt = jQuery.parseJSON(data);

			   var pre_select = '<option value="">Select a model</option>';

				var select = '<select name="newcars_model" id="newcars_model" class="nc_frm">'+pre_select;

				for(var i = 0; i < opt.length; i++){

					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';

				}

				select += '</select>';

				$('#box-model_newcars').html(select);

				

			  }

        });

	});	



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

function validateEmail($email) {

  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

  if( !emailReg.test( $email ) ) {

    return false;

  } else {

    return true;

  }

}

$('#newcars_zip').keypress( function(e) {

	if(e.keyCode ==13) {

		e.preventDefault();	

	}

});

$('#bttn_1').on('click', function() {

	//STEP 1

	if(requiredSelect($('#newcars_make'))) {

		 alert('Please Select a Vehicle Make!');

	}

	else if(requiredSelect($('#newcars_model'))) {

		 alert('Please Select a Vehicle Model!');

	}

	else {

		$(this).attr("href","#step2");

	}	

});



$('#bttn_2').on('click', function(e) {

		

	//STEP 2

	if(requiredSelect($('#newcars_type'))) {

		 alert('Please Select a Purchase Type!');

		  e.preventDefault();

		 

	}

	else if(requiredSelect($('#newcars_timing'))) {

		 alert('Please Select a Purchase Timing!');

		  e.preventDefault();

	}

	else if(requiredInput($('#newcars_zip'))) {

		

		alert('Please Enter Your Zipcode!');

		 e.preventDefault();

	}	

	else {

		$(this).attr("href","#step3");

			

	}

	

});

var emailaddress = $("#newcars_email").val();

$('#submit_query').on('click', function(e) {

		

	//STEP 3

	if(requiredInput($('#newcars_firstname'))) {

		 alert('Please Enter your First Name!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#newcars_lastname'))) {

		 alert('Please Enter your Last Name!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#newcars_phone'))) {

		 alert('Please Enter Your Phone Number!');

		

		 e.preventDefault();

	}

	else if(requiredInput($('#newcars_email'))) {

		alert('Please Enter Your Email Address!');



		e.preventDefault();

	}	

	else if(!isValidEmailAddress($("#newcars_email").val()) ) { 

		alert('Please enter your real email address!');



		e.preventDefault();

	}

	else {



		$('#newcars_form').submit();

	}

	

});





});



</script>

<?php

if(isset($_SESSION["sent"])) {

	$newcond	 = $_SESSION['condition'];

	$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used' and $newcond"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)

	$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New' and $newcond");

	$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1 and $newcond");

	$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1 and $newcond");	

}

else {

	$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used'"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)

	$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New'");

	$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1");

	$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1");	

}

$n1 = count($usedcars);

$n2 = count($newcars);

$n3 = count($is_dicker);

$n4 = count($is_finance);

?>

<?php if($_SESSION["sent"]) {

	if($_SESSION['cartype']=="new") {

		?>



         <script type="text/javascript">

		 

$(function() {

	

		 $('ul li:first-child').removeClass("active");;

		  $('#liNewcars').addClass("active");

		  $('#usedcars').hide();

		  $('#newcars').show();

		  

});

		window.history.pushState("string", "Title", "getcarquote.php?type=new");

		

	 $.msgBox({

				title:"Thank you!",

				content:"You’ll receive your new car quote/s soon! Meanwhile please view the listings below that we have found near you.",

				type:"info"

			});

	 </script>

        <?php	

	}

	elseif($_SESSION['cartype']=="used") {

		?>

         <script type="text/javascript">

		 	window.history.pushState("string", "Title", "getcarquote.php?type=used");

	 $.msgBox({

				title:"Thank you!",

				content:"You’ll receive your used car quote/s soon! Meanwhile please view the listings below that we have found near you.",

				type:"info"

			});

	 </script>

        <?php	

	}

}

 unset($_SESSION['cartype']);

 unset($_SESSION["sent"]);

 unset($_SESSION["condition"]);

 

?>

      <div class="container_12">

        <?php include("menu.inc.php");?>

         <!--SEARCHTAB-->

        <?php include_once("searchtab.php"); ?>

        <!--END SEARCHTAB-->

        <div class="grid_9">

		<!--CONTENT HERE-->

       	<div class="usedCars">

            <div class="usedcar_header">GET YOUR BEST DEAL WITH A CAR QUOTE</div>

            <div class="usedCars_Inner">

              <div class="newcar_title">Get a Car Quote FREE in 3 Easy Steps!</div>

              <div class="newcar_left">

                <div class="image"><img src="images/newcars/newcar1.jpg" width="377" height="243" alt=""></div>

                <div class="image-content">

                  <ul>

                    <li>All price quotes are free, with no obligations.</li>

                    <li>Your Privacy is Our Top Concern</li>

                    <li>We seach our database of thousands of dealers to get you the best price.</li>

                  </ul>

                </div>

              </div>

              <div class="newcar_right">

              <form name="newcars_form" id="newcars_form" action="send_inquries.php" method="post">

                <div class="step_head_bg" id="step1"> <span>step 1</span><br>

                 Select <input type="radio" name="rCarType" value="used" checked="checked"/><span style="font-family: Tahoma, Geneva, sans-serif;text-transform: capitalize; font-size:13px;color: #fff;">Used</span><input type="radio" name="rCarType" value="new" /><span style="font-family: Tahoma, Geneva, sans-serif; font-size:13px;color: #fff;text-transform: capitalize;">New</span></div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p class="title marginan"> <strong>Make<span>*</span></strong><br>

                      <select name="newcars_make" id="newcars_make" class="nc_frm">

                        <option value="">Select</option>

                         <?php

						$dispMake = $listing_obj->get_all_makes();

						foreach($dispMake as $arrmake){

							echo "<option value='".$arrmake['make_name']."'>". $arrmake['make_name']."</option>";

						}

						?>

                      </select>

                    </p>

                    <p class="title marginan"> <strong>Model</strong><span>*</span><br>

                     <div id="box-model_newcars" name = "box-model_newcars" class="marginan">

                      <select name="newcars_model" id="newcars_model" class="nc_frm">

                        <option value="">Select</option>

                      </select>

                     </div>

                    </p>

                    <p class="title marginan"> Color<br>

                      <select name="newcars_color" id ="newcars_color" class="nc_frm">

                        <option value="">No Prefrence</option>

                          <?php

						$color = $listing_obj->getColors();

						

						while($arrcolor = mysql_fetch_array($color)){

							echo "<option value='".$arrcolor['value']."'>". $arrcolor['value']."</option>";

						}

						?>

                      </select>

                    </p>

                    <p style="padding-top:5px;"> <span class="nc_req">* require </span><a href="#" id="bttn_1"><img src="images/continue_btn.jpg" alt=""></a> </p>

                  </div>

                </div>

                <div class="clear"></div>

                <div class="step_head_bg" id="step2"> <span>step 2</span><br>

                  Purchase Info </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                    <p class="title marginan"> <strong>Purchase Type<span>*</span></strong><br>

                      <select name="newcars_type" id="newcars_type" class="nc_frm">

                        <option value="">Select</option>

                        <option value="All Cash">All Cash</option>

                        <option value="Finance">Finance</option>

                      	<option value="Cash w/Trade">Cash w/Trade</option>

                      	<option value="Finance w/Trade">Finance w/Trade</option>

                      </select>

                    </p>

                    <p class="title marginan"> <strong>Purchase Timing</strong><span>*</span><br>

                      <select name="newcars_timing" id = "newcars_timing" class="nc_frm">

                        <option value="">Select</option>

                        <option value="Ready now">Ready now</option>

                        <option value="1 Week">1 Week</option>

                        <option value="2 weeks">2 weeks</option>

                        <option value="3 weeks">3 weeks</option>

                        <option value=" 4+ weeks"> 4+ weeks</option>                      

                      </select>

                    </p>

                 <!--   <p class="title"> <strong>Driver Age</strong><span>*</span><br>

                       <input name="newcars_age" id ="newcars_age" type="text" class="nc_frm2">

                    </p>

                     <p class="title"> <strong>Status</strong><span>*</span><br>

                      <select name="newcars_timing" id = "newcars_timing" class="nc_frm">

                        <option value="">Select</option>

                        <option value="Ready now">Ready now</option>

                        <option value="1 Week">1 Week</option>

                        <option value="2 weeks">2 weeks</option>

                        <option value="3 weeks">3 weeks</option>

                        <option value=" 4+ weeks"> 4+ weeks</option>                      

                      </select>

                    </p>-->

                    <p class="title marginan"> Zip/PC<span>*</span><br>

                      <input name="newcars_zip" id ="newcars_zip" type="text" class="nc_frm2" maxlength="5">

                    </p>

                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step1">&lt;&lt;</a> * require </span><a href="#" id="bttn_2"><img src="images/continue_btn.jpg" alt=""></a> </p>

                  </div>

                </div>

                <div class="clear"></div>

                <div class="step_head_bg" id="step3"> <span>step 3</span><br>

                  Your Contact Info </div>

                <div class="grey_box_nc">

                  <div class="syv_form">

                  <div class="contactname marginan">

                    <p class="title"> <strong>Name<span>*</span></strong><br>

                      <input name="newcars_firstname" id="newcars_firstname" placeholder="First" type="text" class="nc_frm2 inputSmall">

                    </p>

                    <p class="title"><br />

                      <input name="newcars_lastname" id="newcars_lastname" placeholder="Last" type="text" class="nc_frm2 inputSmall">

                    </p>

                  </div>

                  <div class="clear"></div>

                    <p class="title marginan"> <strong>Phone</strong><span>*</span><br>

                      <input name="newcars_phone" id="newcars_phone" type="text" class="nc_frm2">

                    </p>

                    <p class="title marginan"> Email<span>*</span><br>

                      <input name="newcars_email" id="newcars_email" type="text" class="nc_frm2">

                      <input type="hidden" name="getcarquote_subject" value="Enquiry - Used Car Quote" />

                    </p>

                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step2">&lt;&lt;</a> * require </span>

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

      </div>

    </section>

<?php include("footer.php");?>