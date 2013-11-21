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



$action = isset($_POST['action']) ?$_POST['action'] :false;



if($action=="add_comment"){

	

	$blog_id = $_REQUEST["blog_id"];

	

	$name = isset($_POST['name']) ?$_POST['name'] :false;

	$email = isset($_POST['email']) ?$_POST['email'] :false;

	$user_id=$_SESSION['USER_ID'];

	$comment = isset($_POST['comment']) ?$_POST['comment'] :false;

		

	$blog_detail=$blogs_object->get_blogs_detail($blog_id,1);

	$added_ip=get_user_ip();

	

	if(count($blog_detail)>0 and $blog_detail["allow_comment"]==1){

		$add_date=get_today_date();

		

		$add_date = date('Y-m-d H:i:s');

		

		if($name==""){

			$_SESSION["msg_eror"][]="Please provide Name title";

		}

		if($email==""){

			$_SESSION["msg_eror"][]="Please provide Email";

		}

		else if(!check_email_address($email)){

			$_SESSION["msg_eror"][]="Please provide correct Email";

		}	

		

		if($comment==""){

			$_SESSION["msg_eror"][]="Please provide comments";

		}

		

		//ADD BLOG COMMENTS 

		if($_SESSION['msg_eror']==""){		

			$data_array['added_by']=$user_id;

			$data_array['name']=$name;

			$data_array['email']=$email;

			$data_array['comment']=$comment;

			$data_array['blog_id']=$blog_id;

			$data_array['add_date']=$add_date;

			$data_array['added_ip']=$added_ip;

			

			$result= $blogs_object->add_comments($data_array);



			if(!isset($_SESSION['mysql_eror'])){

				$_SESSION['msg_alert']="your comment has been created successfully";

				redirect_page("blog_detail.php?blog=".base64_encode($blog_id)."&");

				exit;

			}

			else{

				$_SESSION['msg_eror']="There is some error while updating database ".display_sql_error()."";

			}

			

		}

	}

	else{

		$_SESSION["msg_eror"][]="Please provide valid information to add comments";	

	}

}



//print_r($data_list);die();



$count=1;



include("header.php");?>



<script type="text/javascript">

function MM_validateForm() { //v4.0

  if (document.getElementById){

    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;

    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);

      if (val) { nm=val.name; if ((val=val.value)!="") {

        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');

          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';

        } else if (test!='R') { num = parseFloat(val);

          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';

          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');

            min=test.substring(8,p); max=test.substring(p+1);

            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';

      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }

    } if (errors) alert('The following error(s) occurred:\n'+errors);

    document.MM_returnValue = (errors == '');

} }



$(function() {

	$('.show-tooltip-top').on('mouseover', function() {

		$('.tooltip').show();

	});



	$('.show-tooltip-top').on('mouseout', function() {

		$('.tooltip').hide();

	});

});

</script>



      <div class="container_12">

        <?php include("menu.inc.php");?>

        <div class="grid_3 inh">

           <ul class="tabs">

            <li class="firs"><a href="#tab1" class="searchtabLink" style="font-size:15px;font-weight: 600;">Used</a></li>

            <li class="last"><a href="#tab2" class="searchtabLink" style="font-size:15px;font-weight: 600;">New</a></li>

          </ul>

          <div class="clear"></div>

          <div class="tab_container">

    <div id="tab1" class="tab_content">

      <div class="tab-container-padding">

        <form method="get" id="search-form-1" name="search-form-1" action="listings.php">

          <fieldset>

            

            <div class="rowElem select"> <span class="name-input">Search:</span>

              <?php

            $region_u = loadStates();

            ?>

              <select name="region" id="region">

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

              <div class="clear"></div>

            </div>

            <div class="rowElem select" id="box-make"><span class="name-input1">Make:</span>

              <select name="make" id="make">

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

              <div class="clear"></div>

            </div>

            <div class="rowElem select" id="box-model"><span class="name-input1">Model:</span>

              <select name="model" id="model">

                   <option value="anymodel">Any Model</option>

              </select>

              <div class="clear"></div>

            </div>

            <div class="rowElem select" id="box-price"><span class="name-input1">Price:</span>

              <select name="price" id="price">

                   <option value="">No Maximum Price</option>

                   <option value="1000">$1,000</option>

                   <option value="2000">$2,000</option

                   ><option value="3000">$3,000</option>

                   <option value="4000">$4,000</option>

                   <option value="5000">$5,000</option>

                   <option value="6000">$6,000</option>

                   <option value="7000">$7,000</option>

                   <option value="8000">$8,000</option>

                   <option value="9000">$9,000</option>

                   <option value="10000">$10,000</option>

                   <option value="11000">$11,000</option>

                   <option value="12000">$12,000</option>

                   <option value="13000">$13,000</option>

                   <option value="14000">$14,000</option>

                   <option value="15000">$15,000</option>

                   <option value="16000">$16,000</option>

                   <option value="17000">$17,000</option>

                   <option value="18000">$18,000</option>

                   <option value="19000">$19,000</option>

                   <option value="20000">$20,000</option>

                   <option value="21000">$21,000</option>

                   <option value="22000">$22,000</option>

                   <option value="23000">$23,000</option>

                   <option value="24000">$24,000</option>

                   <option value="25000">$25,000</option>

                   <option value="30000">$30,000</option>

                   <option value="35000">$35,000</option>

                   <option value="40000">$40,000</option>

                   <option value="45000">$45,000</option>

                   <option value="50000">$50,000</option>

                   <option value="55000">$55,000</option>

                   <option value="60000">$60,000</option>

                   <option value="65000">$65,000</option>

                   <option value="70000">$70,000</option>

                   <option value="75000">$75,000</option>

                   <option value="80000">$80,000</option>

                   <option value="85000">$85,000</option>

                   <option value="90000">$90,000</option>

                   <option value="95000">$95,000</option>

                   <option value="100000">$100,000</option>

              </select>

              <div class="clear"></div>

            </div>

            <div class="mini-blok">

              

              <div class="rowElem select2"> <span class="name-input1">Zip/PC:</span>

                <input type="text" name="zip" id="zip" class="inputText" maxlength="5"/>

                <div class="clear"></div>

              </div>

            </div>

            <div class="mini-blok1">

              <div class="rowElem select2"> <span class="name-input1">Within:</span>

                <select id="miles" name="miles">

                    <option value="10">10 Miles</option>

                    <option value="20">20 Miles</option>

                    <option value="30">30 Miles</option>

                    <option value="40">40 Miles</option>

                    <option value="50">50 Miles</option>

                    <option value="75">75 Miles</option>

                    <option value="100">100 Miles</option>

                    <option value="150">150 Miles</option>

                    <option value="200">200 Miles</option>

                    <option value="250">250 Miles</option>

                    <option value="500">500 Miles</option>

                    <option value="" selected="selected">All Miles</option>

                </select>

                <div class="clear"></div>

              </div>

              

            </div>

            <input type="hidden" name="event" value="usedcars" />

            <div class="clear"></div>

            <!--tooltip-->

			<div class="tooltip" style="position: absolute; z-index: 99999; left: 63px; top: 195px; display: none;">

			    <div class="wrapper top" id="ism-wt">

			        <div class="tooltip-content" id="ism-tc">

			        	<p>

			            A certified pre-owned car is a type of used car that has been inspected by the manufacturer or dealer and typically includes an extended warranty.

			        	</p>

			        </div>

			    </div>

			</div>

	 <!--end tooltip-->

            <div class="box-form-button">

            <input type="submit" class="button-form" value="SEARCH"/>

            <input type="checkbox" name="onlyCertified" style="margin: 14px 0 0 4px;"/>

            <span style="color: #fff;margin:6px;position: absolute;font-weight:600;line-height:1.3em">

              Only<a class="qmark-link" href="#">

							<img width="15" height="15" alt="Question Mark" class="show-tooltip-top" src="images/question-mark-icon.png">

						</a>

              <br>

              Certified

            </span>

            <br />

           <a class="link-form1 ajax" href="v_search.php" style="font-size:15px;padding:14px 0 0 15px;">Advanced Search >></a>

            <div style='display:none'>

            <div id="inline_content">

            <div class="pop_zip_box">

            <div class="inner_bx_pop">

            <div class="fright"><a href="" onClick="window.parent"><img src="images/color_box_close.jpg" width="14" height="16" alt=""></a></div>

            <div class="clear"></div>

            <div class="zip_pop_title">Enter Your ZIP/PC Code</div>

            <div class="zip_pop_location"><label>Location</label> <input name="" type="text"> <input name="" type="image" src="images/pop_zip_btn.jpg"></div>

            <div class="zip_pop_content">Your Zip/PC code is used to provide you the most accurate information specific to your location.</div>

            <div class="zip_pop_policy"><a href="#">Privacy Policy</a></div>

            

      

            

            </div>

            

            </div>

            </div>

            </div>

            

              <!--<p><a class="group1" href="../content/ohoopee1.jpg" title="Me and my grandfather on the Ohoopee.">Grouped Photo 1</a></p>-->

            </div>

          </fieldset>

        </form>

      </div>

    </div>

    <div id="tab2" class="tab_content">

      <div class="tab-container-padding">

        <form method="get" id="search-form-2" name="search-form-2" action="listings.php">

          <fieldset>

          

            <div class="rowElem select"> <span class="name-input">Search:</span>

              <?php

            $region_u = loadStates();

            ?>

              <select name="region1" id="region1">

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

              <div class="clear"></div>

            </div>

            <div class="rowElem select" id="box-make"><span class="name-input1">Make:</span>

              <select name="make_new" id="make_new">

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

              <div class="clear"></div>

            </div>

            <div class="rowElem select" id="box-model_new"> <span class="name-input1">Model:</span>

              <select name="model_new" id="model_new">

                   <option value="anymodel">Any Model</option>

              </select>

              <div class="clear"></div>

            </div>

             <div class="rowElem select" id="box-price"><span class="name-input1">Price:</span>

              <select name="price" id="price">

                   <option value="">No Maximum Price</option>

                   <option value="1000">$1,000</option>

                   <option value="2000">$2,000</option

                   ><option value="3000">$3,000</option>

                   <option value="4000">$4,000</option>

                   <option value="5000">$5,000</option>

                   <option value="6000">$6,000</option>

                   <option value="7000">$7,000</option>

                   <option value="8000">$8,000</option>

                   <option value="9000">$9,000</option>

                   <option value="10000">$10,000</option>

                   <option value="11000">$11,000</option>

                   <option value="12000">$12,000</option>

                   <option value="13000">$13,000</option>

                   <option value="14000">$14,000</option>

                   <option value="15000">$15,000</option>

                   <option value="16000">$16,000</option>

                   <option value="17000">$17,000</option>

                   <option value="18000">$18,000</option>

                   <option value="19000">$19,000</option>

                   <option value="20000">$20,000</option>

                   <option value="21000">$21,000</option>

                   <option value="22000">$22,000</option>

                   <option value="23000">$23,000</option>

                   <option value="24000">$24,000</option>

                   <option value="25000">$25,000</option>

                   <option value="30000">$30,000</option>

                   <option value="35000">$35,000</option>

                   <option value="40000">$40,000</option>

                   <option value="45000">$45,000</option>

                   <option value="50000">$50,000</option>

                   <option value="55000">$55,000</option>

                   <option value="60000">$60,000</option>

                   <option value="65000">$65,000</option>

                   <option value="70000">$70,000</option>

                   <option value="75000">$75,000</option>

                   <option value="80000">$80,000</option>

                   <option value="85000">$85,000</option>

                   <option value="90000">$90,000</option>

                   <option value="95000">$95,000</option>

                   <option value="100000">$100,000</option>

              </select>

              <div class="clear"></div>

            </div>

            <div class="mini-blok">

              

              <div class="rowElem select2"> <span class="name-input1">Zip/PC:</span>



               		 <input type="text" name="zip" id="zip" class="inputText" maxlength="5"/>



                <div class="clear"></div>

              </div>

            </div>

            <div class="mini-blok1">

              <div class="rowElem select2"> <span class="name-input1">Within:</span>

                <select id="miles" name="miles">

                    <option value="10">10 Miles</option>

                    <option value="20">20 Miles</option>

                    <option value="30">30 Miles</option>

                    <option value="40">40 Miles</option>

                    <option value="50">50 Miles</option>

                    <option value="75">75 Miles</option>

                    <option value="100">100 Miles</option>

                    <option value="150">150 Miles</option>

                    <option value="200">200 Miles</option>

                    <option value="250">250 Miles</option>

                    <option value="500">500 Miles</option>

                    <option value="" selected="selected">All Miles</option>

                </select>

                <div class="clear"></div>

              </div>

              

            </div>

            <input type="hidden" name="event" value="newcars" />

            <div class="clear"></div>

             <!--tooltip-->

			<div class="tooltip" style="position: absolute; z-index: 99999; left: 63px; top: 195px; display: none;">

			    <div class="wrapper top" id="ism-wt">

			        <div class="tooltip-content" id="ism-tc">

			        	<p>

			            A certified pre-owned car is a type of used car that has been inspected by the manufacturer or dealer and typically includes an extended warranty.

			        	</p>

			        </div>

			    </div>

			</div>

	 <!--end tooltip-->

            <div class="box-form-button">

            <input type="submit" class="button-form" value="SEARCH"/>

            <input type="checkbox" name="onlyCertified" style="margin: 14px 0 0 4px;"/>

             <span style="color: #fff;margin:6px;position: absolute;font-weight:600;line-height:1.3em">

              Only<a class="qmark-link" href="#">

							<img width="15" height="15" alt="Question Mark" class="show-tooltip-top" src="images/question-mark-icon.png">

						</a>

              <br>

              Certified

            </span>

            <br />

            <a class="link-form1 ajax" href="v_search.php" style="font-size:15px;padding:14px 0 0 15px;">Advanced Search >></a>

            <div style='display:none'>

            <div id="inline_content">

            <div class="pop_zip_box">

            <div class="inner_bx_pop">

            <div class="fright"><a href="" onClick="window.parent"><img src="images/color_box_close.jpg" width="14" height="16" alt=""></a></div>

            <div class="clear"></div>

            <div class="zip_pop_title">Enter Your ZIP/PC Code</div>

            <div class="zip_pop_location"><label>Location</label> <input name="" type="text"> <input name="" type="image" src="images/pop_zip_btn.jpg"></div>

            <div class="zip_pop_content">Your Zip/PC code is used to provide you the most accurate information specific to your location.</div>

            <div class="zip_pop_policy"><a href="#">Privacy Policy</a></div>

            

            

            </div>

            

            </div>

            </div>

            </div>

            

              <!--<p><a class="group1" href="../content/ohoopee1.jpg" title="Me and my grandfather on the Ohoopee.">Grouped Photo 1</a></p>-->

            </div>

          </fieldset>

        </form>

      </div>

    </div>

  </div>

          <!--=======added to fixed problem in display===========-->

          <div>

          &nbsp;

          </div>

          <div class="box-1 box-indent">

              <h3 class="dark">News & Views</h3>

               <!--========News and Views Start=======================-->

               <?php include_once("news.inc.php");?>

              <!--========News and Views end=======================-->

            </div>

            

            <!--========Featured Dealers Start=======================-->
               <?php include_once("featured-dealers-slider.php");?>
              <!--========Featured Dealers End=======================-->
            

            

           <!--==================================================-->

        </div>

        <div class="grid_9">

		<!--CONTENT HERE-->

		<div class="usedCars">

                    

            

            <?php

            

            	$blog_id = base64_decode($_REQUEST["blog"]);

            	$blogs = new Blogs();

            	$user = new User();

				

				$action = isset($_POST['action']) ?$_POST['action'] :false;

				

				$name = isset($_POST['name']) ?$_POST['name'] :false;

				

				$email = isset($_POST['email']) ?$_POST['email'] :false;

				

				$comment = isset($_POST['comment']) ?$_POST['comment'] :false;

				

				if($blog_id == '' || $blog_id <= 0){

					redirect_page("blogs.php");

					exit();

				}

				

				$blog_detail = $blogs->get_blogs_detail($blog_id,1);

				

				if(count($blog_detail)>0){

					

					$author = $user->get_user_detail($blog_detail["added_by"]);

						

					if($blog_detail["blog_image"]!=''){

					

						$photo_path=SITE_URL.SITE_BLOG_THUMB.$blog_detail["blog_image"];

						

					}

					else{

						

						$photo_path=SITE_URL."images/no_blogimages.jpg";

						

					}

						

					$blog_comments=$blogs->get_blogs_comment($blog_id);

					

				}



            

            ?>

            <div class="usedcar_header"><?php echo $blog_detail["blog_title"];?></span></div>

            <div class="usedCars_Inner"> 

            

            <table cellpadding="0" cellspacing="0" width="100%">

							

				<tr>

					<td width="450px;">

						<div><p>Posted by <a href="#"><?php echo $author["name"];?></a> Date: <?php echo date('d/m/Y',strtotime($blog_detail['add_date'])); ?></p></div>

					</td>

					<td>

						<div style="float:right;">

						

						<fb:like send="true" layout="button_count" width="90" font="arial" action="like" href="<?php echo SITE_URL_HOTBUYCARS;?>blog_detail.php?blog_id=<?php echo $blog_detail["blog_id"];?>&amp;"></fb:like>

                        <br />   

                   

                        <script>

                        (function(d, s, id) 

                            { 

                            var js, fjs = d.getElementsByTagName(s)[0]; 

                            if (d.getElementById(id)) {

                                return;

                                } 

                                js = d.createElement(s); js.id = id; 

                                js.src = "//connect.facebook.net/en_US/all.js#&xfbml=1";

                                fjs.parentNode.insertBefore(js, fjs); 

                                }(document, 'script', 'facebook-jssdk'));

                        </script>  

                      

						</div>

					</td>

				</tr>

			</table>

			

			

			<img src="<?php echo $photo_path;?>" width="170" height="160"  />

			

			<p><?php echo str_replace("\n","<BR>","<p class='pdecs'>".$blog_detail["blog_description"])."</p>";?></p>

			

			<?php

				if($blog_detail["video_url"]!=''){

					echo display_youtube_video($blog_detail["video_url"],500,350);

				}

			?>

			<div id="comments">

				<div id="comments-contents">&nbsp;</div>

			</div>

			

			<?php

			

				if(count($blog_comments)>0 and $blog_detail["show_comment"]==1){

					

					#################MAKE LOOPS FOR ALL  COMMENTS########################

							

					foreach($blog_comments as $comments){

						

						?>

						<div class="post-comments">

						

							<h2><a href="mailto:<?php echo $comments["email"];?>"><?php echo $comments["name"];?></a></h2>

							<p style="font-size: 10px; color: #ccc;">posted on <?php echo date('d/m/Y h:i a',strtotime($comments['add_date'])); ?></p>

							<p><?php echo str_replace("\n","<br>",$comments["comment"]);?></p>

							<hr style="color:  #ccc;" />

							

						</div>

						<?php

						

					}

					

					#################MAKE LOOPS FOR ALL  COMMENTS END ########################

					

				}

				

				if($blog_detail["allow_comment"]==1){

					

					?>

					<table width="100%">

							<tr>

								<td align="center">

			

									<?php echo display_message();?>

			

								</td>

			

							</tr>

			

						</table>

						

						<h2>Post Comment:</h2><br />

						

						<form action="" method="post" name="form1" id="form1" onsubmit="MM_validateForm('name','','R','email','','RisEmail','comment','','R');return document.MM_returnValue">

						  <table width="100%" border="0" cellspacing="0" cellpadding="0">

						    <tr>

						      <td width="27%"><label>Name:</label></td>

						      <td width="73%"><label for="name4"></label>

						        <input name="name" type="text" id="name" maxlength="50" class="inputText_gray" style="width: 230px"/></td>

						    </tr>

						    <tr>

						      <td><label>Email:</label></td>

						      <td><label for="email"></label>

						        <input type="text" name="email" id="email"  maxlength="50" class="inputText_gray" style="width: 230px"/></td>

						    </tr>

						    <tr>

						      <td><label>Comments:</label></td>

						      <td><label for="textarea"></label>

						        <textarea name="comment" id="comment" cols="45" rows="5" class="inputText_gray" style="height: 113px; width: 416px;"></textarea>

						        <label for="name5"></label></td>

						    </tr>

						    <tr>

						      <td>&nbsp;</td>

						      <td><input type="submit" name="button" id="submit" value="Submit" class="button-form1"/></td>

						    </tr>

						  </table>

						  

						  <input type="hidden" name="action" value="add_comment" />

						  <input type="hidden" name="blog_id" value="<?php echo ($blog_id);?>" />

						 

						</form>

						

					<?php

					

				}

			

			?>

            

            

            <div class="clear" style="padding-top:12px;"></div>

            </div>

          </div>

        <!--  END HERE  -->

        </div>

        <div class="clear"></div>

      </div>

    </header>

    

    <!--==============================content================================-->

 

<?php include("footer.php");?>