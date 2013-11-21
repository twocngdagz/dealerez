<script>

$(function() {

	$('.show-tooltip-top').on('mouseover', function() {

		$('.tooltip').show();

	});



	$('.show-tooltip-top').on('mouseout', function() {

		$('.tooltip').hide();

	});

		

});

</script>



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
				
				if(isset($_SESSION['state']) && $_SESSION['state'] == $row_region['state']){
					echo "<option value='".$row_region['state']."' selected='selected'>". $row_region['state']."</option>";
				}
             //  else if($row_region['state']=="Utah")			   {
             	//  echo "<option value='".$row_region['state']."' selected='selected'>". $row_region['state']."</option>";               }

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
				
				if(isset($_SESSION['state']) && $_SESSION['state'] == $row_region['state']){
					echo "<option value='".$row_region['state']."' selected='selected'>". $row_region['state']."</option>";
				}
				
//               if($row_region['state']=="Utah"){
  //                 echo "<option value='".$row_region['state']."' selected='selected'>". $row_region['state']."</option>";        }

               else {

                 echo "<option value='".$row_region['state']."'>". $row_region['state']."</option>";

               }

               }

               ?>

              </select>

              <div class="clear"></div>

            </div>

            <div class="rowElem select" id="box-make_new"><span class="name-input1">Make:</span>

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

</div>