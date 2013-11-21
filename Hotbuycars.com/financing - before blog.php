<?php  session_start();
include("includes.php");
$listing_obj = new Listing;
$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'Used'"); //function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","new_used = 'New'");
$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_dicker = 1");
$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_finance = 1");
include("header.php");?>
      <div class="container_12">
        <?php include("menu.inc.php");?>
        <div class="grid_3 inh">
          <ul class="tabs">
            <li class="firs"><a href="#tab1">Used Cars</a></li>
            <li class="last"><a href="#tab2">New Cars</a></li>
          </ul>
          <div class="clear"></div>
          <div class="tab_container">
            <div id="tab1" class="tab_content">
              <div class="tab-container-padding">
                <form method="get" id="search-form-1" name="search-form-1" action="listings.php">
                  <fieldset>
                    <div class="rowElem select"> <span class="name-input">Body:</span>
                      <select name="type" id="type">
                        <option value="anytype" selected="selected">Any</option>
                        <?php
						$dispCat = $listing_obj->get_all_categories();
						foreach($dispCat as $arrtype){
								if($_GET['category'] == $arrtype['cat_name']){ ?>
									<option value="<?php echo $arrtype['cat_name']; ?>" selected="selected"><?php echo $arrtype['cat_name']; ?></option>
								<?php 
								}
								else
									echo "<option value='".$arrtype['cat_name']."'>".$arrtype['cat_name']."</option>";
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
                    <div class="mini-blok">
                      <div class="rowElem select2"> <span class="name-input1">Min Year:</span>
                        <select name="minyear">
                              <option value="minyear">Min</option>
                              <?php
							 for($i=1980;$i<=2013;$i++):
									  if($_GET['minyear'] == $i){ ?>
										  <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
									  <?php 
									  }
									  else
										  echo "<option value='".$i."'>". $i."</option>";
							  endfor;
							  ?>
                        </select>
                        <div class="clear"></div>
                      </div>
                      <div class="rowElem select2"> <span class="name-input1">Min Price:</span>
                        <select name="minprice">
                          <option value="minprice">Min</option>
                          <option value="0">0</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                        </select>
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="mini-blok1">
                      <div class="rowElem select2"> <span class="name-input1">Max Year:</span>
                        <select name="maxyear">
                              <?php
							 for($i=2013;$i>=2010;$i--):
									  if($_GET['maxyear'] == $i){ ?>
										  <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
									  <?php 
									  }
									  else
										  echo "<option value='".$i."'>". $i."</option>";
							  endfor;
							  ?>
                        </select>
                        <div class="clear"></div>
                      </div>
                      <div class="rowElem select2"> <span class="name-input1">Max price:</span>
                        <select name="maxprice">
                          <option value="maxprice">Max</option>
                          <option value="5000">5000</option>
                          <option value="10000">10000</option>
                          <option value="15000">15000</option>
                          <option value="50000">50000</option>
                        </select>
                        <input type="hidden" name="event" value="usedcars" />
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="rowElem select"> <span class="name-input1">Region:</span>
                      <select name="select">
                        <option value="">Utah</option>
                        <option value="opt1">...</option>
                      </select>
                      <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="box-form-button"><input type="submit" class="button-form" value="SEARCH"/><a class="link-form1" href="#searchby">Detailed Search</a>
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
                    <div class="rowElem select"> <span class="name-input">Body:</span>
                      <select name="type_new" id ="type_new">
                        <option value="anytype" selected="selected">Any</option>
                        <?php
						$dispCat = $listing_obj->get_all_categories();
						foreach($dispCat as $arrtype){
								if($_GET['category'] == $arrtype['cat_name']){ ?>
									<option value="<?php echo $arrtype['cat_name']; ?>" selected="selected"><?php echo $arrtype['cat_name']; ?></option>
								<?php 
								}
								else
									echo "<option value='".$arrtype['cat_name']."'>".$arrtype['cat_name']."</option>";
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
                    <div class="mini-blok">
                      <div class="rowElem select2"> <span class="name-input1">Min Year:</span>
                        <select name="minyear" id ="minyear">
                              <option value="minyear">Min</option>
                              <?php
							 for($i=1980;$i<=2013;$i++):
									  if($_GET['minyear'] == $i){ ?>
										  <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
									  <?php 
									  }
									  else
										  echo "<option value='".$i."'>". $i."</option>";
							  endfor;
							  ?>
                        </select>
                        <div class="clear"></div>
                      </div>
                      <div class="rowElem select2"> <span class="name-input1">Min Price:</span>
                        <select name="minprice">
                          <option value="minprice">Min</option>
                          <option value="0">0</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                        </select>
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="mini-blok1">
                      <div class="rowElem select2"> <span class="name-input1">Max Year:</span>
                        <select name="maxyear">
                              <?php
							 for($i=2013;$i>=2010;$i--):
									  if($_GET['maxyear'] == $i){ ?>
										  <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
									  <?php 
									  }
									  else
										  echo "<option value='".$i."'>". $i."</option>";
							  endfor;
							  ?>
                        </select>
                        <div class="clear"></div>
                      </div>
                      <div class="rowElem select2"> <span class="name-input1">Max price:</span>
                        <select name="maxprice">
                          <option value="maxprice">Max</option>
                          <option value="5000">5000</option>
                          <option value="10000">10000</option>
                          <option value="15000">15000</option>
                          <option value="50000">50000</option>
                        </select>
                        <input type="hidden" name="event" value="newcars" />
                        <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="rowElem select"> <span class="name-input1">Region:</span>
                      <select name="select">
                        <option value="Utah">Utah</option>
                      </select>
                      <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="box-form-button"><input type="submit" class="button-form" value="SEARCH"/><a class="link-form1" href="#searchby">Detailed Search</a>
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
        </div>
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
              <div class="box-1-container">

                <ul class="list-1 p2">
                  <li><span>
                    <time datetime="2013-03-01">12.25.2012</time>
                    </span><a href="#">HotBuyCars new website just in time for dealers busy season. </a></li>
                  <li class="sec"><span>
                    <time datetime="2013-02-01">12.25.2012</time>
                    </span><a href="#">Welcome new team members Asad, Marion and Leo to assist</a></li>
                  <li class="last"><span>
                    <time datetime="2012-01-01">12.25.2012</time>
                    </span><a href="#">New improved website coming </a></li>
                </ul>
                <a href="#" class="link-1 color-3">More &nbsp;Reviews</a> </div>
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
          <div class="grid_9">
            <div class="wrapper">
              <ul class="tabs-1">
                <li><a href="#usedcars">Latest <span>used</span></a></li>
                <li><a href="#newcars">Latest <span>new</span></a></li>
                <li><a href="#dealnsteals">Deals n' <span>Steals!</span></a></li>
                <li><a href="#buyhere">Buy Here- <span>You're Approved!</span></a></li>
                <li><a href="#searchby">Search</a></li>
              </ul>
            </div>
            <div class="tab_container-1">
            
 <!--=============================LATEST USED CARS tab#usedcars=============================================================-->
             
              <div id="usedcars" class="tab_content-1">
                <div class="tabs-1-padd">
				 <?php
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
                                                  <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row[listing_id];?>" class="link-2"><?php echo $row['title'];?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row['miles']; ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo $row['price']; ?></strong></span>
                                            </div>
    
                     <?php endforeach; ?>
                	<div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=used">View All &gt;&gt;</a> </div>
                </div>
              </div>
              
 <!--=============================END LATEST USED CARS tab#usedcars=============================================================-->
 <!--=============================LATEST NEW CARS tab#newcars===================================================================-->
              <div id="newcars" class="tab_content-1">
                <div class="tabs-1-padd">
                <?php
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
                                              <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row1[listing_id];?>" class="link-2"><?php echo $row1['title'];?></a></span> 
                                              <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row1['miles']; ?> ml.</strong></span> 
                                              <span class="block text-1">Price: <strong class="color-5">$<?php echo $row1['price']; ?></strong></span>
										</div>

               
                 <?php endforeach; ?>
                 <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=new">View All &gt;&gt;</a> </div>
                </div>
              </div>
  <!--=============================END LATEST NEW CARS tab#newcars==============================================================-->
  <!--=============================DICKER CARS tab#dealsnsteal===================================================================-->
              <div id="dealnsteals" class="tab_content-1">
                <div class="tabs-1-padd">
                <?php
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
                                              <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row2[listing_id];?>" class="link-2"><?php echo $row2['title'];?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row2['miles']; ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo $row2['price']; ?></strong></span>
										</div>
                 <?php endforeach; ?>
                 <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=dicker">View All &gt;&gt;</a> </div>
                </div>
              </div>
  <!--=============================END DICKER CARS tab#dealsnsteal==============================================================-->
   <!--=============================FINANCE CARS tab#buyhere===================================================================-->
              <div id="buyhere" class="tab_content-1">
                <div class="tabs-1-padd">
                <?php
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
                                              <span class="block mb5"><a href="listings_details.php?lid=<?php echo $row3[listing_id];?>" class="link-2"><?php echo $row3['title'];?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo $row3['miles']; ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo $row3['price']; ?></strong></span>
										</div>
                 <?php endforeach; ?>
                    <div style="float:right;" class="wrapper"> <a style="float:right;" href="listings.php?tab=finance">View All &gt;&gt;</a> </div>
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
  <!--=============================END SEARCH CARS tab#searchby===================================================================-->
            </div>
          </div>
        </div>
      </div>
    </section>
<?php include("footer.php");?>