<?php 


if(isset($_SESSION["state"])) {
	$state_con = " and state = '".$_SESSION["state"]."' ";
}else $state_con = "";


$listing_obj = new Listing;

$usedcars	 = $listing_obj->getall_listing(0,12,"created_date","DESC","condition_ = 'Used' $state_con"); 

$newcars  	 = $listing_obj->getall_listing(0,12,"created_date","DESC","condition_ = 'New' $state_con");

$is_dicker 	 = $listing_obj->getall_listing(0,12,"created_date","DESC","is_featured = 1 $state_con");

$is_finance  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_hotbuy_guaranteed = 1 $state_con");	

$n1 = count($usedcars);

$n2 = count($newcars);

$n3 = count($is_dicker);

$n4 = count($is_finance);


?>

<div class="grid_9">
  <div class="wrapper">
    <ul class="tabs-1">
      <li><a href="#usedcars" id="#uc">Latest <span>used cars</span></a></li>
      <li><a href="#newcars">Latest <span>new cars</span></a></li>
     <!-- <li><a href="#dealnsteals">Low Price <span>Guaranteed!</span></a></li>-->
      <li><a href="#dealnsteals">Hot Buy <span>Guaranteed!</span></a></li>
      <li><a href="#buyhere">Buy Here -<span> Pay Here!</span></a></li>
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
                                        <a href="listingdetail.php?lid=<?php echo $row['listing_id'];?>">
                                        <?php  if(empty($row['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row['image_name'] as $list_image => $image_name_usedcars): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_usedcars['image_name']; ?>" alt="<?php echo $image_name_usedcars['image_name']; ?>" /> 
                                          
                                        <?php endforeach; ?>
                                        </a>
                                        </div>
                                        <span class="block mb5"><a href="listingdetail.php?lid=<?php echo $row['listing_id'];?>" class="link-2" title="<?php echo $row['year']." ".$row['make']." ".$row['model']; ?>"><?php echo limitStrLen($row['year']." ".$row['make']." ".$row['model']);?></a></span> <span class="block text-1">Mileage: <strong class="color-5"><?php echo number_format($row['miles']); ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-3">$<?php echo number_format($row['price']); ?></strong></span>
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
                                    <a href="listingdetail.php?lid=<?php echo $row1['listing_id'];?>">
                                    <?php  if(empty($row1['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row1['image_name'] as $list_image => $image_name_newcars): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_newcars['image_name']; ?>" alt="<?php echo $image_name_newcars['image_name']; ?>" /> 
                                          
                                     <?php endforeach; ?>
                                    </a>
                                    </div>
                                    <span class="block mb5"><a href="listingdetail.php?lid=<?php echo $row1['listing_id'];?>" class="link-2" title="<?php echo $row1['year']." ".$row1['make']." ".$row1['model']; ?>"><?php echo limitStrLen($row1['year']." ".$row1['make']." ".$row1['model']);?></a></span> 
                                    <span class="block text-1">Mileage: <strong class="color-5"><?php echo number_format($row1['miles']); ?> ml.</strong></span> 
                                    <span class="block text-1">Price: <strong class="color-3">$<?php echo number_format($row1['price']); ?></strong></span>
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
                                    <a href="listingdetail.php?lid=<?php echo $row2['listing_id'];?>">
                                     <?php  if(empty($row2['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row2['image_name'] as $list_image => $image_name_dicker): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_dicker['image_name']; ?>" alt="<?php echo $image_name_dicker['image_name']; ?>" /> 
                                          
                                     <?php endforeach; ?>
                                      </a>
                                    </div>
                                    <span class="block mb5"><a href="listingdetail.php?lid=<?php echo $row2['listing_id'];?>" class="link-2" title="<?php echo $row2['year']." ".$row2['make']." ".$row2['model'];?>"><?php echo limitStrLen($row2['year']." ".$row2['make']." ".$row2['model']);?></a></span> <span class="block text-1">Mileage: <strong class="color-5"><?php echo number_format($row2['miles']); ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-3">$<?php echo number_format($row2['price']); ?></strong></span>
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
                                    <a href="listingdetail.php?lid=<?php echo $row3['listing_id'];?>">
                                      <?php  if(empty($row3['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
                                        <?php  foreach($row3['image_name'] as $list_image => $image_name_finance): ?>
                                            
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name_finance['image_name']; ?>" alt="<?php echo $image_name_finance['image_name']; ?>" /> 
                                          
                                     <?php endforeach; ?>
                                    </a>
                                    </div>
                                    <span class="block mb5"><a href="listingdetail.php?lid=<?php echo $row3['listing_id'];?>" class="link-2" title="<?php echo $row3['year']." ".$row3['make']." ".$row3['model']; ?>"><?php echo limitStrLen($row3['year']." ".$row3['make']." ".$row3['model']);?></a></span> <span class="block text-1">Mileage: <strong class="color-5"><?php echo number_format($row3['miles']); ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-3">$<?php echo number_format($row3['price']); ?></strong></span>
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