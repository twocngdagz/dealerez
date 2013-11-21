<?php  session_start();

include_once("includes.php");


$listing_obj = new Listing();

$contents_obj = new Contents();

$user_listing = new User;

$admin_obj = new Admin;


$user_id =  $_GET['uid'];

$user_detail = $user_listing->get_user_detail($user_id);

$site_detail = $admin_obj->getSiteSettings($user_id);


 

 


$createdDate=now;

$data_page_count=array();

$data_page_count["table_name"]="page_visit_count";

$data_page_count['columns_name']["user_id"]=$user_id;

$data_page_count['columns_name']["user_type"]=USER_TYPE_DEALER;

$data_page_count['columns_name']["listing_id"]="";

$data_page_count['columns_name']["page_type"]=PAGE_TYPE_PROFILE;

$data_page_count['columns_name']["ip"]=get_user_ip();

$data_page_count['columns_name']["createdDate"]=$createdDate;

$page_count=$contents_obj->add_dynamic_data($data_page_count);

include("header.php");

?>

 <script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>

 <script type="text/javascript">

  

    $(document).ready(function () {



			var msg_type		= $('#msg_type');

			var txtareaRounded	= $('.txtareaRounded');

			

			msg_type.on('change', function() {

				var index = $(this).val();

				txtareaRounded.text($('#val'+index).val());

			});

  

  		     //execute when form submit click

	//DIV with inputs descendant

	  grey = $('div.grey_box').find('input[type=text]');

	  grey.css({color:'grey'});

	  var listing_form	  = $(':input[type=text]');

	  

	   //execute every onchange

	 //validation for the form steps

	  

	  function isValidEmailAddress(emailAddress) {

		  var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);

		  return pattern.test(emailAddress);

	  };	

	  

	  listing_form.each(function() 

	  {

		  $(this).on('change',function(){

			  			  

			  if($(this).val().length === 0 || $(this).val()=== ''){

				$(this).css({border:'1px solid red'});

				

				  e.preventDefault();	

				  $(this).focus();

				  		  

			  }

			  else if($(this).val().length > 0){

				$(this).css({border:'1px solid #A7A6AA'});	

			  }	

			  

		  });

	  });

	  

	  var codex = $('.disabledTxt').text();



	  $('#phone').mask("(999) 999-9999");

	  

	  $('#submit_df').click(function(e){

		

		listing_form.each(function() {



            if($(this).val().length === 0 || $(this).val()=== ''){

				$(this).css({border:'1px solid red'});

				

				  	e.preventDefault();

					

			}

		

			else if($(this).val().length > 0){

				$(this).css({border:'1px solid #A7A6AA'});	

			}

		

        });

		

		if(!isValidEmailAddress($("#emailaddress").val()) ) { 

				$("#emailaddress").css({border:'1px solid red'});

				$("#emailaddress").val("");

			

				$("#emailaddress").attr('placeholder','Please enter your real email address!');

				e.preventDefault();

		}

		

		if($('#verificationcode').val()!= codex) {

				$("#verificationcode").css({border:'1px solid red'});

				$("#verificationcode").val("");

				

				$("#verificationcode").attr('placeholder','Invalid Code!');

				e.preventDefault();

		}

	});

	grey = $('form').find('input[type=text]');

	$('.cleartxt').on('click', function(e) {

		$('.txtareaRounded').text("");

		listing_form.each(function() {

            grey.val('');

				

        });

	e.preventDefault();

	});

    });

  

</script>

<?php

if($_SESSION['message_sent']) {	?>

     <script type="text/javascript">

	 $.msgBox({

				title:"Message Sent!",

				content:"Thank you, Your Request has been sent.",

				type:"info"

			});

	 </script>

<?php	

}

unset($_SESSION['message_sent']);

?>

      <div class="container_12">

        <!--=================MAIN-MENU==========================-->

					<?php include("menu.inc.php"); ?>

        <!--===============END MAIN-MENU========================-->

      </div>

    </header>

    <!--==============================content================================-->

    <section id="content">

      <div class="container_12">

        <div class="wrapper">

          <div class="grid_8">

            <div class="clear"></div>

            <div class="clear"></div>

            <div class="profile_page">

              <div class="inner_padding1">

              

                <!-- start new here -->

                

             	<div class="dSocialMedia">

                	<a href="listings.php" class="aLinks"><p class="redd">&lt;&lt; </p>Back to Search Results</a>

                </div><!--end dSocialMedia -->

                <div class="clear"></div>

                

                 <?php
				
			  $chkFeatured =  $user_detail['is_featured'];
			  if($site_detail['header_image']!='' && $chkFeatured==1)

					{ 
						$header_image_url= SITE_URL.SITE_WEBISTE_HEADER_PATH.$site_detail['header_image'];

					}

					else

					{

					$header_image_url=SITE_URL."sandbox/web/theme/images/banner_here.jpg";

					}

					?>

                    

                <div class="pro_hr_top_ads"><img src="<?php echo $header_image_url;?>"  width="574" height="116"></div>

                

                <?php $images_list = $listing_obj->get_listing_images($lid); ?>

			   

               <form name="contact_form" id="contact_form" method="post" action="send_email.php">

                <div class="listing_contact_form nRow n2">

                	<h2>Contact</h2>

                 	
                    	<input type="text" name="firstname" id="firstname" placeholder="*First Name"/>

                    	<input type="text" name="lastname" id="lastname" placeholder="*Last Name"/>

                        <input type="text" name="phone" id="phone" placeholder="*Phone"/>

                        <input type="text" name="emailaddress" id="emailaddress" placeholder="*Email Address"/>

                        

                        <label class="p_msg_required">*All Fields Required. <p>We will not share your info.</p></label>

                        

                        

                        <input type="text" name="verificationcode" id="verificationcode" class="shortTxt" placeholder="Enter Code"/>

                    

                        <p class="disabledTxt">XYZ12F7</p>

                        <?php

			

							

							$make  = $_GET['make'];

							$model = $_GET['model'];

							$year  = $_GET['year'];

							$formatted_price = $_GET['price'];

						?>

                        <div class="contact_message">

                        	<div id="msgImage"></div>

                        	<Select name="msg_type" id="msg_type">

                                <option value="1">I'd like more information</option>

                                <option value="2">Schedule a test drive</option>

                                <option value="3">Get a quote</option>

                                <option value="4">Make an offer</option>

                                <option value="5">Your comment or question</option>

                            </Select>

                            <input type="hidden" name="val1" id="val1" value="Hello, I'm interested in this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com and would like to know more. I can be reached by phone or email." />

                            <input type="hidden" name="val2" id="val2" value="Hello, I'm interested in scheduling a test drive of this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com  Please contact me ASAP to schedule a time." />

                            <input type="hidden" name="val3" id="val3" value="Hello, I'm interested in a price quote on this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com  Please contact me ASAP with your best price." />

                            <input type="hidden" name="val4" id="val4" value="Hello, I want this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com and would like to make you the following offer $0000.00   Please let me know ASAP." />

                            <input type="hidden" name="val5" id="val5" value="Hello, Enter your comment or question here." />

                            

                            <textarea cols="31" rows="5" class="txtareaRounded" name="message">Hello,  I'm interested in this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com and would like to know more. I can be reached by phone or email.</textarea>

                            <p class="cleartxt"><a href="#" class="clrmsg">Clear Message</a></p>

                            

                            <input type="submit" value="Submit Your Request" name="submit_df" id="submit_df"> 

                        </div>

                        

                 

                   

                    

                </div><!-- end listing_contact_form -->

                </form>

                

                <div class="clear"></div>

                 <div class="listing_dealers nRow">

                	<h2>Seller</h2>

                 	<?php
				 
					if($site_detail['header_image']!='' && $chkFeatured==1)

					{

						$header_image_url= SITE_URL.SITE_WEBISTE_HEADER_PATH.$user_detail['header_image'];

					}

					else

					{

					$header_image_url=SITE_URL."sandbox/web/theme/images/banner_here.jpg";

					}

					?>                

                   <img src="<?php echo $header_image_url;?>" style="padding-top:4px" width="210" height="85" alt="logo" />

                   <?php   SITE_URL.SITE_WEBISTE_HEADER_PATH.$user_detail['header_image']; ?>

                        <div class="listing_dealers_contact">

                        	<img src="images/telephone.jpg" alt="telephone"/>

                            <p class="phone"><?php echo $_GET['p']; ?></p>

                            

                            <p class="dealerName"><?php echo $user_detail['company_name']; ?></p>

                            <p class="dealerAddress"><?php echo  $user_detail['address']."<br />".$user_detail['city'].", ".$user_detail['state']." ".$user_detail['zip']; ?></p>

                            <p class="dealerWebsite"><a href="#">Website</a>

                           

                            </p>

                        </div>
 
                        <div class="clear"></div>

                   <?php if($user_comments<>"") {   ?>   

                   <p class="p_features">

                   <?php

				   	if(strlen($user_comments) >= 430) {

						echo limitStrlen($user_comments,430);

					}

				   ?>

                  

                   </p>

          

                   <?php } ?>

                </div><!-- end lisiting features -->

                

                <!--end new elements here-->

                

                <div class="clear"></div>

                <div class="inventory_title">Inventory</div>

					<!--DEALER LISTING STARTS HERE-->

  				<?php include_once("profile_listing2.php");?>                

					<!--DEALER LISTING ENDS HERE-->    

                <div class="clear"></div>

                             

                <div class="more_a nRow">

                       <a href="listings.php" class="aLinks"><p class="redd">&lt;&lt; </p>Back to Search Results</a>

                </div>

                

                <div class="clear"></div>

              </div>

              <div class="clear"></div>

            </div>

            <div class="clear"></div>

          </div>

          <div class="grid_4">

          <?php include_once("ads_r.php"); ?>

          </div>

        </div>

      </div>

    </section>

<?php include("footer.php");?>