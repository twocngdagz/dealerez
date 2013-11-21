<?php  session_start();
include("includes.php");
$listing_obj = new Listing;

include("header.php");?>

<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">

$(function() {
	
	
	$('#newcars_phone').mask("(999) 999-9999"); 

	//$('#newcars_phone').val('(___)-___-____'); 

	/*$('#newcars_phone').on('focusout', function() {
		alert($(this).val());
		if($.trim($(this)).val()=='(___)-___-____') {
			$(this).val('(___)-___-____');
		}
		alert($(this).val());
	});*/
<?
if(isset($_SESSION["sent"])) {
?>
	$('ul li:first-child').removeClass("active");;
	$('#liNewcars').addClass("active");
	$('#usedcars').hide();
	$('#newcars').show();

<?php
}
?>
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
 ?>
 <script type="text/javascript">
 $.msgBox({
			title:"Thank you!",
			content:"You’ll receive your new car quote/s soon! Meanwhile please view the listings below that we have found near you.",
			type:"info"
		});
 </script>
 <?php
}
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
            <div class="usedcar_header">GET YOUR BEST DEAL ON A <span class="red">NEW CAR</span></div>
            <div class="usedCars_Inner">
              <div class="newcar_title">Get a New Car Quote FREE in 3 Easy Steps!</div>
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
                  Select your vehicle </div>
                <div class="grey_box_nc">
                  <div class="syv_form">
                    <p class="title"> <strong>Make<span>*</span></strong><br>
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
                    <p class="title"> <strong>Model</strong><span>*</span><br>
                     <div id="box-model_newcars" name = "box-model_newcars">
                      <select name="newcars_model" id="newcars_model" class="nc_frm">
                        <option value="">Select</option>
                      </select>
                     </div>
                    </p>
                    <p class="title"> Color<br>
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
                    <p class="title"> <strong>Purchase Type<span>*</span></strong><br>
                      <select name="newcars_type" id="newcars_type" class="nc_frm">
                        <option value="">Select</option>
                        <option value="All Cash">All Cash</option>
                        <option value="Finance">Finance</option>
                      	<option value="Cash w/Trade">Cash w/Trade</option>
                      	<option value="Finance w/Trade">Finance w/Trade</option>
                      </select>
                    </p>
                    <p class="title"> <strong>Purchase Timing</strong><span>*</span><br>
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
                    <p class="title"> Zip/PC<span>*</span><br>
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
                  <div class="contactname">
                    <p class="title"> <strong>Name<span>*</span></strong><br>
                      <input name="newcars_firstname" id="newcars_firstname" placeholder="First" type="text" class="nc_frm2 inputSmall">
                    </p>
                    <p class="title"><br />
                      <input name="newcars_lastname" id="newcars_lastname" placeholder="Last" type="text" class="nc_frm2 inputSmall">
                    </p>
                  </div>
                  <div class="clear"></div>
                    <p class="title"> <strong>Phone</strong><span>*</span><br>
                      <input name="newcars_phone" id="newcars_phone" type="text" class="nc_frm2">
                    </p>
                    <p class="title"> Email<span>*</span><br>
                      <input name="newcars_email" id="newcars_email" type="text" class="nc_frm2">
                      <input type="hidden" name="newcars_subject" value="Enquiry - New Car Quote" />
                    </p>
                    <p style="padding-top:5px;"> <span class="nc_req"><a href="#step2">&lt;&lt;</a> * require </span>
                      <input name="submit_query" type="image" src="images/submit_btn.png" id="submit_query" title="Please check to ensure all information is correct before submitting">
                
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
         <div class="grid_9">
  <div class="wrapper">
    <ul class="tabs-1">
      <li><a href="#usedcars" id="#uc">Latest <span>used cars</span></a></li>
      <li id="liNewcars"><a href="#newcars">Latest <span>new cars</span></a></li>
      <li><a href="#dealnsteals">Deals n' <span>Steals!</span></a></li>
      <li><a href="#buyhere">Buy Here- <span>You're Approved!</span></a></li>
      <li><a href="#searchby">Search</a></li>
    </ul>
  </div>
 <div class="tab_container-1" style="height:585px;min-height:580px;">
<!--=============================LATEST USED CARS tab#usedcars=============================================================-->
    <div id="usedcars" class="tab_content-1" style="height:585px;">
      <div class="tabs-1-padd">
       <?php
	   if($n1 == 0) {
			?> 
            <div style="height:580px;">
          	<img src="images/nofound.png" width="40" height="40" style="vertical-align:bottom"/>&nbsp;No record found.
            </div>
            <?php   
	   }
	   else {
          $counter =0;
          $c = 0;
      
          foreach($usedcars as $row): $counter++; $c++;
          
          ?> 	 

                                  <div class="tab-col tab-col-indent">
                                        <div class="p2">
                                        <a href="listings_details.php?lid=<?php echo $row['listing_id'];?>">
                                        <?php  if(empty($row['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row['image_name'] as $list_image => $image_name_usedcars): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_usedcars['image_name']; ?>" alt="<?php echo $image_name_usedcars['image_name']; ?>" /> 
                                          
                                        <?php endforeach; ?>
                                        </a>
                                        </div>
                                        <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row['listing_id'];?>" class="link-2"><?php echo limitStrLen($row['title']);?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row['miles']; ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo $row['price']; ?></strong></span>
                                  </div>

           <?php endforeach; ?>
          <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=used">View All &gt;&gt;</a></div>
          <?php } ?>
      </div>
    </div>

<!--=============================END LATEST USED CARS tab#usedcars=============================================================-->
<!--=============================LATEST NEW CARS tab#newcars===================================================================-->
    <div id="newcars" class="tab_content-1" style="height:585px;">
      <div class="tabs-1-padd">
      
      <?php
	   if($n2 == 0) {
			?> 
            <div style="height:580px;">
          	<img src="images/nofound.png" width="40" height="40" style="vertical-align:bottom"/>&nbsp;No record found.
            </div>
			<?php   
	   }
	   else {
      $counter1 =0;
      foreach($newcars as $row1): $counter1++;
      ?> 	 
       

                              <div class="tab-col tab-col-indent">
                                    <div class="p2">
                                    <a href="listings_details.php?lid=<?php echo $row1['listing_id'];?>">
                                    <?php  if(empty($row1['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row1['image_name'] as $list_image => $image_name_newcars): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_newcars['image_name']; ?>" alt="<?php echo $image_name_newcars['image_name']; ?>" /> 
                                          
                                     <?php endforeach; ?>
                                    </a>
                                    </div>
                                    <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row1['listing_id'];?>" class="link-2"><?php echo limitStrLen($row1['title']);?></a></span> 
                                    <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row1['miles']; ?> ml.</strong></span> 
                                    <span class="block text-1">Price: <strong class="color-5">$<?php echo $row1['price']; ?></strong></span>
                              </div>

     
       <?php endforeach; ?>
       <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=new">View All &gt;&gt;</a> </div>
       <?php  } ?>
      </div>
    </div>
<!--=============================END LATEST NEW CARS tab#newcars==============================================================-->
<!--=============================DICKER CARS tab#dealsnsteal===================================================================-->
    <div id="dealnsteals" class="tab_content-1" style="height:585px;">
      <div class="tabs-1-padd">
      <?php
	   if($n3 == 0) {
			?> 
            <div style="height:580px;">
          	<img src="images/nofound.png" width="40" height="40" style="vertical-align:bottom"/>&nbsp;No record found.
            </div>
            <?php   
	   }
	   else {
      $counter2 =0;
      foreach($is_dicker as $row2): $counter2++;
      ?> 	 

                              <div class="tab-col tab-col-indent">
                                    <div class="p2">
                                    <a href="listings_details.php?lid=<?php echo $row2['listing_id'];?>">
                                     <?php  if(empty($row2['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row2['image_name'] as $list_image => $image_name_dicker): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_dicker['image_name']; ?>" alt="<?php echo $image_name_dicker['image_name']; ?>" /> 
                                          
                                     <?php endforeach; ?>
                                      </a>
                                    </div>
                                    <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row2['listing_id'];?>" class="link-2"><?php echo limitStrLen($row2['title']);?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row2['miles']; ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo $row2['price']; ?></strong></span>
                              </div>
       <?php endforeach; ?>
       <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=dicker">View All &gt;&gt;</a> </div>
       <?php } ?>
      </div>
    </div>
<!--=============================END DICKER CARS tab#dealsnsteal==============================================================-->
<!--=============================FINANCE CARS tab#buyhere===================================================================-->
    <div id="buyhere" class="tab_content-1">
      <div class="tabs-1-padd">
      <?php
	  if($n4 == 0) {
			?> 
            <div style="height:580px;">
          	<img src="images/nofound.png" width="40" height="40" style="vertical-align:bottom"/>&nbsp;No record found.
            </div>
            <?php   
	   }
	   else {
      $counter3 =0;
      foreach($is_finance as $row3): $counter3++;
      ?> 	 
                              <div class="tab-col tab-col-indent">
                                    <div class="p2">
                                    <a href="listings_details.php?lid=<?php echo $row3['listing_id'];?>">
                                      <?php  if(empty($row3['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row3['image_name'] as $list_image => $image_name_finance): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_finance['image_name']; ?>" alt="<?php echo $image_name_finance['image_name']; ?>" /> 
                                          
                                     <?php endforeach; ?>
                                    </a>
                                    </div>
                                    <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row3['listing_id'];?>" class="link-2"><?php echo limitStrLen($row3['title']);?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row3['miles']; ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo $row3['price']; ?></strong></span>
                              </div>
       <?php endforeach; ?>
          <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=finance">View All &gt;&gt;</a> </div>
       <?php } ?>
      </div>
    </div>
<!--=============================END DICKER CARS tab#dealsnsteal==============================================================-->
<!--=============================SEARCH CARS tab#searchby=====================================================================-->
    <div id="searchby" class="tab_content-1">
      <div class="tabs-1-padd">
       <form action="listings.php" name="searchby" id ="searchby" method="get">
        <div class="tab_search_top">
          <div><span>Search</span></div>
          <input name="searchby[]" checked="checked" type="checkbox" value="New">
          <div>New</div>
          <input name="searchby[]" checked="checked" type="checkbox" value="Used">
          <div>Used</div>
          <input name="searchby[]" type="checkbox" value="preowned">
          <div>Certified Pre-Owned <span id="sprytrigger1"><img src="images/info_icon.jpg" width="11" height="12" alt="" style="margin-top:5px;" title="This category of cars are pre-owned"/></span></div>
        </div>
        <div class="clear"></div>
        <div class="left_sec">
          <div class="title">Make</div>
          <div class="clear"></div>
          <div>
            <select name="make_tab" class="mm_frm" id="make_tab">
              <option value="anymake" selected="selected">Any Make</option>
               <?php
              $dispMake = $listing_obj->get_all_makes();
              foreach($dispMake as $arrmake){
                      if($_GET['make'] == $arrmake['make_name']){ ?>
                          <option value="<?php echo $arrmake['make_name']; ?>" selected="selected"><?php echo $arrmake['make_name']; ?></option>
                      <?php 
                      }
                      else
                          echo "<option value='".$arrmake['make_name']."'>". $arrmake['make_name']."</option>";
              }
              ?>
            </select>
          </div>
          <div class="clear"></div>
          <div class="title">Model</div>
          <div class="clear"></div>
          <div id = "box-model_tab">
             <select name="model_tab" class="mm_frm" id="model_tab">
              <option value="anymodel">Any Model</option>
             
            </select>
          </div>
          <div class="clear"></div>
          <div class="title">Year</div>
          <div>
            <select name="year" class="yp_frm">
                    <option value="any">Any</option>
                    <?php
                   for($i=2010;$i<=2013;$i++):
                            if($_GET['max'] == $i){ ?>
                                <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                            <?php 
                            }
                            else
                                echo "<option value='".$i."'>". $i."</option>";
                    endfor;
                    ?>
              </select>
            <div class="newer">Or Newer</div>
          </div>
          <div class="clear"></div>
          <div class="title" style="padding-top:10px;">Price From</div>
          <div>
            <select name="pricefrom" class="yp_frm">
                    <option value="any" selected="selected">Any</option>
                    <option value="0">0</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
             </select>
          </div>
          <div class="clear"></div>
          <div class="to">To</div>
          <div>
             <select name="priceto" class="yp_frm">
                    <option value="any" selected="selected">Any</option>
                    <option value="5000">5000</option>
                    <option value="10000">10000</option>
                    <option value="15000">15000</option>
                    <option value="50000">50000</option>
             </select>
          </div>
          <div class="clear"></div>
          <div class="title">Fuel Type</div>
          <div class="clear"></div>
          <div style="margin-top:-10px; text-align:left; float:left">
            <input name="fueltype[]" type="checkbox" value="Gasoline">
            Gasoline
            <div class="clear"></div>
            <input name="fueltype[]" type="checkbox" value="Diesel">
            Diesel
            <div class="clear"></div>
            <input name="fueltype[]" type="checkbox" value="Hybrid">
            Hybrid
            <div class="clear"></div>
            <input name="fueltype[]" type="checkbox" value="Electric">
            Electric
            <div class="clear"></div>
            <input name="fueltype[]" type="checkbox" value="Flexible_Fuel">
            Flexible Fuel
            <div class="clear"></div>
            <input name="fueltype[]" type="checkbox" value="Natural_Gas">
            Natural Gas </div>
        </div>
        <div class="right_sec">
          <div class="title" style="padding-bottom:5px">Type</div>
          <div class="clear"></div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="SUV">
            </div>
            <div class="v_type_image"><img src="images/suv_v.jpg" alt=""></div>
            <div class="v_type_g_name">SUV</div>
          </div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Wagon">
            </div>
            <div class="v_type_image"><img src="images/weagon_v.jpg" alt=""></div>
            <div class="v_type_g_name">Wagon</div>
          </div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Coupe">
            </div>
            <div class="v_type_image"><img src="images/coupe_v.jpg" alt=""></div>
            <div class="v_type_g_name">Coupe</div>
          </div>
          <div class="v_type_bx no_l_m">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Sedan">
            </div>
            <div class="v_type_image"><img src="images/sedan_v.jpg" alt=""></div>
            <div class="v_type_g_name">Sedan</div>
          </div>
          <div class="clear"></div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Pickup">
            </div>
            <div class="v_type_image"><img src="images/pickup_v.jpg" alt=""></div>
            <div class="v_type_g_name">Pickup</div>
          </div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Van/Minivan">
            </div>
            <div class="v_type_image"><img src="images/minvan_v.jpg" alt=""></div>
            <div class="v_type_g_name">Van/Minivan</div>
          </div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Convertible">
            </div>
            <div class="v_type_image"><img src="images/convertible_v.jpg" alt=""></div>
            <div class="v_type_g_name">Convertible</div>
          </div>
          <div class="v_type_bx  no_l_m">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Hatchback">
            </div>
            <div class="v_type_image"><img src="images/hatchback_v.jpg" alt=""></div>
            <div class="v_type_g_name">Hatchback</div>
          </div>
          <div class="v_type_bx">
            <div class="chkbx">
              <input name="type[]" type="checkbox" value="Commercial">
            </div>
            <div class="v_type_image"><img src="images/commercial_v.jpg" alt=""></div>
            <div class="v_type_g_name">Commercial</div>
          </div>
          <div class="left_bx">
            <div class="title2">Color</div>
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Beige">
            Beige
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Black">
            Black
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Blue">
            Blue
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Brown">
            Brown
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Burgundy">
            Burgundy </div>
          <div class="center_bx">
            <div class="title2">&nbsp;</div>
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Charcoal">
            Charcoal
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Gold">
            Gold
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Gray">
            Gray
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Green">
            Green
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Offwhite">
            Offwhite </div>
          <div class="right_bx">
            <div class="title2">&nbsp;</div>
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Orange">
            Orange
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Pink">
            Pink
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Purple">
            Purple
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Red">
            Red
            <div class="clear"></div>
            <input name="color[]" type="checkbox" value="Silver">
            Silver </div>
          <div class="clear"></div>
          <div class="left_bx">
            <div class="title2">Engine</div>
            <div class="clear"></div>
            <input name="engine[]" type="checkbox" value="3 cylinder">
            3 cylinder
            <div class="clear"></div>
            <input name="engine[]" type="checkbox" value="4 cylinder">
            4 cylinder
            <div class="clear"></div>
            <input name="engine[]" type="checkbox" value="5 cylinder">
            5 cylinder
            <div class="clear"></div>
            <input name="engine[]" type="checkbox" value="6 cylinder">
            6 cylinder
            <div class="clear"></div>
            <input name="engine[]" type="checkbox" value="8 cylinder">
            8 cylinder
            <div class="clear"></div>
            <input name="engine[]" type="checkbox" value="10 cylinder">
            10 cylinder </div>
          <div class="center_bx">
            <div class="title2">Drive</div>
            <div class="clear"></div>
            <input name="drive[]" type="checkbox" value="Two-Wheel">
            Two-Wheel
            <div class="clear"></div>
            <input name="drive[]" type="checkbox" value="Four-Wheel">
            Four-Wheel
            <div class="clear"></div>
            <input name="drive[]" type="checkbox" value="All-Wheel">
            All-Wheel
            <div class="clear"></div>
            <div class="title2" style="padding-top:17px;">Other</div>
            <div class="clear"></div>
            <input name="is_3rd_row" type="checkbox" value="1">
            3rd Row Seats </div>
          <div class="right_bx">
            <div class="title2">Transmission</div>
            <div class="clear"></div>
            <input name="transmission[]" type="checkbox" value="Automatic">
            Automatic
            <div class="clear"></div>
            <input name="transmission[]" type="checkbox" value="Manual">
            Manual
            <div class="clear"></div>
            <div class="title2" style="padding-top:20px">&nbsp;</div>
            <div class="clear"></div>
            <input name="is_luxury" type="checkbox" value="1">
            Only Luxury Models </div>
          <div class="clear"></div>
          <div class="bottom_search">
            <div class="fleft">Within</div>
            <div class="fleft">
              <select name="miles">
                <option value="anymiles" selected="selected">Any Miles</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="5000">5000</option>
                <option value="10000">10000</option>
                <option value="50000">50000</option>
              </select>
            </div>
            <div class="fleft">of Zip/PC Code* </div>
            <div class="fleft">
              <input name="zip" type="text">
              <input name="event" type="hidden" value="searchtab">
            </div>
            <div class="fleft" style="margin-top:-20px; margin-left:15px;">
              <!--<input name="" type="image" src="images/go_tab_btn.jpg">-->
              <input type="submit" name="submit-search" style="background-image:url('images/go_tab_btn.jpg');width:48px;height:49px;background-color:transparent;border:none;cursor:pointer;" value=""/>
            </div>
          </div>
          <div class="clear"></div>
        </div>
       </form>
      </div>
      <div class="clear"></div>
    </div>
      </div>

<!--=============================END SEARCH CARS tab#searchby===================================================================-->
  </div>
</div>
          <!--END CARS TAB-->
        </div>
      </div>
    </section>
<?php include("footer.php");?>