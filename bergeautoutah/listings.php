<?php  
session_start();
include_once("includes.php");
include_once("Pagination.php");
$listing_obj = new Listing;
$user_obj    = new User;

include_once("header.php"); 

$pagesPerSection=5;

// How many pages will be displayed in the navigation bar
// If total number of pages is less than this number, the
// former number of pages will be displayed
												
$options		 = 25;//RESULT_PER_PAGE;	// Display options
$options		 = array(25, 50, 100);		// Display options
$paginationID	 = "inventory";				// This is the ID name for pagination object
$stylePageOff	 = "pageOff";				// The following are CSS style class names. See styles.css
$stylePageOn	 = "pageOn";
$styleErrors	 = "paginationErrors";
$styleSelect	 = "paginationSelect";

$user_id  = 5;

$make 			= isset($_GET['make'])&&$_GET['make']<>"All" ? " and make='".$_GET['make']."'" : "";
$model 			= isset($_GET['model'])&&$_GET['model']<>"All" ? " and model='".$_GET['model']."'" : "";
$body 			= isset($_GET['bodystyle']) ? " and body_style='".$_GET['bodystyle']."'" : "";
$priceto		= isset($_GET['priceto']) ? ' and price <='.$_GET['priceto'] : "";
$pricefrom		= isset($_GET['pricefrom']) ? ' and price >='.$_GET['pricefrom'] : "";
$vyear			= isset($_GET['year'])&&$_GET['year']<>"All" ? ' and year='.$_GET['year'] : "";
$mileagefrom		= isset($_GET['mileagefrom'])&&$_GET['mileagefrom']<>"Any" ? " and miles >='".$_GET['mileagefrom']."'" : "";
$mileageto		= isset($_GET['mileageto'])&&$_GET['mileageto']<>"Any" ? " and miles <='".$_GET['mileageto']."'" : "";
$yearfrom		= isset($_GET['yearfrom'])&&$_GET['yearfrom']<>"Any" ? " and year >=".$_GET['yearfrom'] : "";
$yearto 		= isset($_GET['yearto'])&&$_GET['yearto']<>"Any" ? " and year <=".$_GET['yearto'] : "";


$cond 		= "user_id=$user_id $make $model $body $pricefrom $priceto $vyear $mileagefrom $mileageto $yearfrom $yearto";
$orderby	= isset($_GET['order-by']) ? $_GET['order-by'] : "price";
$sortby 	= isset($_GET['sort-by']) ? $_GET['sort-by'] : "desc";

	
$_counter 		= $listing_obj->getListings(false,false,$orderby,$sortby,$cond);
$totalEntries 	= count($_counter);
			
$Pagination 	= new Pagination($totalEntries, $pagesPerSection, $options, $paginationID, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect);
$start 			= $Pagination->getEntryStart();
$end 			= $Pagination->getEntryEnd(); 
	
$listings	= $listing_obj->getListings($start,$end,$orderby,$sortby,$cond);
$lcount 	= $listing_obj->getListings(false,false,$orderby,$sortby,$cond);		
?>
<div class="container_1">
	<?php include_once("menu.inc.php"); ?>
    <div class="container_2">
        <div class="search-box-1">
            <p class="listings-results">Results [<?php echo number_format($totalEntries); ?> Found]</p>
            <section class="refine-search filters" <?php if(empty($_GET)) { ?> style="display:none;"<?php } ?>>
                <?php 
                    foreach($_GET as $list=>$key) {
                        $extras.="&".$list."=".$key;
                        $extras1.=$list."=".$key."&";
					}
				?>
                <?php foreach($_GET as $list=>$key) { ?>
                <p><?php echo ucfirst($list); ?>: <?php echo $key; ?> <a href="listings.php?<?php echo str_replace($list."=".$key, "",$extras1); ?>">(x)</a></p>
                <?php } ?>
                <p><a href="listings.php">Clear Filter</a></p>
            </section>
            <h2>Refine Your Search</h2>
            <!-- <section class="refine-search">
                 <dl>
                    <dt>Vehicles</dt>
                    <dd><a href="">Preowned (171)</a></dd>
                 </dl>
            </section>-->
             <section class="refine-search" <?php if($body) { ?> style="display:none;" <?php }?>>
                 <dl>
                    <dt>Body Styles</dt>
                        <?php 
                            $bodystyle = $listing_obj->getListingsGroupBy(false,false,"created_date","desc",$cond,"body_style");
                            foreach($bodystyle as $newbodystyle) {
                                if($body=='') {
                                    $body_cond = "user_id=$user_id and body_style='$newbodystyle[body_style]'";	
								} else {
									$body_cond = $cond;	
								}
                
                				$sqlbodystyle_c = mysql_query("select count(body_style) as countbody_style from listing where $body_cond");
                				echo "<dd class='ddBodyStyle'><a href='listings.php?bodystyle=$newbodystyle[body_style]$extras'>".$newbodystyle['body_style']. " (".mysql_result($sqlbodystyle_c,0). ")" ."</a></dd>";
							}
						?>
                    <!--<dt class="view-more"><a href="">View More</a></dt>-->
                 </dl>
            </section>
            <section class="refine-search" <?php if($make) { ?> style="display:none;" <?php }?>>
                 <dl>
                    <dt>Makes</dt>
                        <?php 
                            $makes = $listing_obj->getListingsGroupBy(false,false,"created_date","desc",$cond,"make");
                            foreach($makes as $newmakes) {
                            if($make=='') {
                                $make_cond = "user_id=$user_id and make='$newmakes[make]'";	
                            } else {
                                $make_cond = $cond;	
                            }
                            $sqlmakes_c = mysql_query("select count(make) as countmake from listing where $make_cond");
                            echo "<dd class='ddMake'><a href='listings.php?make=$newmakes[make]$extras'>".$newmakes['make']. " (".mysql_result($sqlmakes_c,0). ")" ."</a></dd>";
                        }
                        ?>
                   <!--<dt class="view-more"><a href="">View More</a></dt>-->
                 </dl>
            </section>
            <section class="refine-search" <?php if($model) { ?> style="display:none;" <?php }?>>
                 <dl>
                    <dt>Models</dt>
                        <?php 
                        $models = $listing_obj->getListingsGroupBy(false,false,"created_date","desc",$cond,"model");
                        
                        foreach($models as $newmodels) {
                            if($model=='') {
                                $model_cond = "user_id=$user_id and model='$newmodels[model]'";	
                            } else {
                                $model_cond = $cond;	
                            }
                            $sqlmodel_c = mysql_query("select count(model) as countmodel from listing where $model_cond");
                            echo "<dd class='ddModel'> <a href='listings.php?model=$newmodels[model]$extras'>".$newmodels['model']. " (".mysql_result($sqlmodel_c,0). ")" ."</a></dd>";
                        }
                        ?>
                    <!--<dt class="view-more"><a href="">View More</a></dt>-->
                 </dl>
            </section>
            <section class="refine-search" <?php if($year) { ?> style="display:none;" <?php }?>>
                 <dl>
                    <dt>Years</dt>
                        <?php 
                        $years = $listing_obj->getListingsGroupBy(false,false,"created_date","desc",$cond,"year");
                    
                        foreach($years as $newyear) {
							if($year=='') {
								$year_cond = "user_id=$user_id and year='$newyear[year]'";
							}  else {
								$year_cond = $cond;	
							}
                            $sqlyear_c = mysql_query("select count(year) as countyear from listing where $year_cond");
                            echo "<dd class='ddYear'><a href='listings.php?year=$newyear[year]$extras'>".$newyear['year']. " (".mysql_result($sqlyear_c,0). ")" ."</a></dd>";
                        }
                        ?>
                    <!--<dt class="view-more"><a href="">View More</a></dt>-->
                 </dl>
            </section>
            
        </div>
        
        <div class="listings-container">
            <section class="listings-container-info rounded">
            <form name="listing-filter-form">
                <select id="inventory_year" onChange="filter_by_year(this.value);">
                        <option <?php if($_GET['year'] == "All"){echo "selected";} ?> value="All">All Years</option>
                         <?php 
                            $years = $listing_obj->getListingsGroupBy(false,false,"year","desc",$cond,"year");
                            foreach($years as $newyear) {
                                $sqlyear_c = mysql_query("select count(year) as countyear from listing where $cond and year=".$newyear['year']);
								
								if(isset($_GET['year']) && $_GET['year'] == $newyear['year'])
                                	echo "<option selected value='$newyear[year]'>".$newyear['year']. " (".mysql_result($sqlyear_c,0). ")" ."</option>";
								else
									echo "<option value='$newyear[year]'>".$newyear['year']. " (".mysql_result($sqlyear_c,0). ")" ."</option>";
                            }
                         ?>
                    </select>
                    <select id="inventory_make" onChange="filter_by_make();">
                        <option <?php if($_GET['make'] == "All"){echo "selected";} ?> value="All">All Makes</option>
						<?php 
                            $makes = $listing_obj->getListingsGroupBy(false,false,"make","desc",$cond,"make");
                            foreach($makes as $newmakes) {
                                $sqlmakes_c = mysql_query("select count(make) as countmake from listing where $cond and make='$newmakes[make]'");
								
								if(isset($_GET['make']) && $_GET['make'] == $newmakes['make'])
									echo "<option selected value='$newmakes[make]'>".$newmakes['make']. " (".mysql_result($sqlmakes_c,0). ")" ."</option>";
								else
                                	echo "<option value='$newmakes[make]'>".$newmakes['make']. " (".mysql_result($sqlmakes_c,0). ")" ."</option>";
                            }
                        ?>
                    </select>
                    <select id="inventory_model" onChange="filter_by_model();">
                        <option <?php if($_GET['model'] == "All"){echo "selected";} ?> value="All">All Models</option>
						<?php 
                            $models = $listing_obj->getListingsGroupBy(false,false,"model","desc",$cond,"model");
                            foreach($models as $newmodels) {
                                $sqlmodel_c = mysql_query("select count(model) as countmodel from listing where $cond and model='$newmodels[model]'");
								
								if(isset($_GET['model']) && $_GET['model'] == $newmodels['model'])
									echo "<option selected value='$newmodels[model]'>".$newmodels['model']. " (".mysql_result($sqlmodel_c,0). ")" ."</option>";
								else
                                	echo "<option value='$newmodels[model]'>".$newmodels['model']. " (".mysql_result($sqlmodel_c,0). ")" ."</option>";
                            }
                        ?>
                    </select>
                    <input type="button" onclick="filter_listing();" value="Go" />
                </form>
                </section><!-- end filter form -->
                <script>
                    function filter_listing() {
                        var year = document.getElementById('inventory_year').value;
                        var make = document.getElementById('inventory_make').value;
                        var model = document.getElementById('inventory_model').value;
                        
                        window.location = "listings.php?year="+year+"&make="+make+"&model="+model;
                    }
					
					function filter_by_year(value) {
						var params = "";
						
						if(value != "All")
							params = "and year="+value;
						
						$.ajax({
							type: "POST",
							url: "ajax.php",
							data: "work=filterByYear&year="+value+"&params="+params,
							async: false
						}).done(function(data) {
							var str = data.split("@");
							$("#inventory_year").html(str[0]);
							$("#inventory_make").html(str[1]);
							$("#inventory_model").html(str[2]);
						});
						
					}
					
					function filter_by_make() {
						var params = "";
						var year = document.getElementById('inventory_year').value;
                        var make = document.getElementById('inventory_make').value;
						
						$.ajax({
							type: "POST",
							url: "ajax.php",
							data: "work=filterByMake&year="+year+"&make="+make,
							async: false
						}).done(function(data) {
							var str = data.split("@");
							$("#inventory_year").html(str[0]);
							$("#inventory_make").html(str[1]);
							$("#inventory_model").html(str[2]);
						});
						
					}
					
					function filter_by_model() {
						var params = "";
						var year = document.getElementById('inventory_year').value;
                        var make = document.getElementById('inventory_make').value;
                        var model = document.getElementById('inventory_model').value;
						
						$.ajax({
							type: "POST",
							url: "ajax.php",
							data: "work=filterByModel&year="+year+"&make="+make+"&model="+model,
							async: false
						}).done(function(data) {
							var str = data.split("@");
							$("#inventory_year").html(str[0]);
							$("#inventory_make").html(str[1]);
							$("#inventory_model").html(str[2]);
						});
						
					}
                </script>
            
            <section class="listings-container-info rounded">
                <p style="width: 70%;float:left;"><strong>Sort By: </strong> 
                	<a href="listings.php?order-by=make&sort-by=<?php if($_GET['sort-by']=="asc"){echo "desc";}else{echo "asc";} ?>">Make</a> | 
                	<a href="listings.php?order-by=model&sort-by=<?php if($_GET['sort-by']=="asc"){echo "desc";}else{echo "asc";} ?>">Model</a> | 
                    <a href="listings.php?order-by=year&sort-by=<?php if($_GET['sort-by']=="asc"){echo "desc";}else{echo "asc";} ?>">Year</a> | 
                    <a href="listings.php?order-by=miles&sort-by=<?php if($_GET['sort-by']=="asc"){echo "desc";}else{echo "asc";} ?>">Mileage</a> | 
                    <a href="listings.php?order-by=price&sort-by=<?php if($_GET['sort-by']=="asc"){echo "desc";}else{echo "asc";} ?>">Price</a>
                <span style="padding-left: 50px !important;"><?php echo $Pagination->display(); ?></span>
                </p>
                <span style="float: right;margin-right: 10px;font-size: 13px;"><?php echo $Pagination->displaySelectInterface();?></span>
            </section><!-- end sorting and paging filters -->
            
<!-- ==================================data to be loaded from mysql=============================================-->   
                       
         <?php foreach($listings as $dispListing){ ?>
         <?php $newuserdetails = $user_obj->get_user_detail($dispListing['user_id']);    
            $carname = $dispListing['year']." ".$dispListing['make']." ".$dispListing['model'];
         ?>
            <section class="listings-container-info">
                <div class="listings-container-data">
                    <a href="listing_detail.php?lid=<?php echo $dispListing['listing_id']; ?>">
                    <!--IMAGE HERE-->
					<?php
						$listing_id = $dispListing['listing_id'];
						$row_img = $listing_obj->get_img_name($listing_id);
						$images_list = $listing_obj->get_listing_images($listing_id);
						$thumb = $listing_obj->get_listing_images($listing_id,1);
						if(empty($row_img)) {
					?>
                      		<img src="images/lp_fl_no_image.jpg"/>
                    <?php } else { ?>                                   
                      		<img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$thumb[0]["image_name"]; ?>" alt="<?php echo $row_img; ?>" width="152" height="113"/> 
                    <?php } ?>
                    <!--END IMAGE-->
                    </a>
                </div>
                <div class="listings-container-data">
                    <p class="listing-data-name"><a href="listing_detail.php?lid=<?php echo $dispListing['listing_id']; ?>"><?php echo $carname; ?></a></p>
                    <p class="listing-data-color"><strong>Colors:</strong> Ext. <?php echo $dispListing['exterior']; ?>  Int. <? echo $dispListing['interior']; ?></p>
                    <p class="listing-data-drive"><strong>Drive:</strong> <? echo $dispListing['trans'].", ".$dispListing['drive']; ?></p>
                    <p class="listing-data-miles" style="margin-bottom:17px !important;"><strong>Mileage:</strong> <?php echo number_format($dispListing['miles']); ?></p>
                    <p class="listing-data-others"><a href="listinggallery.php?lid=<?php echo $dispListing['listing_id']; ?>&amp;img_id=1" class="fancybox fancybox.iframe"><strong>Photos (<?php echo count($images_list); ?>)</strong></a></p>
                </div>
                <div class="listings-container-data">
                    <p class="listing-data-price">$<?php echo number_format($dispListing['price']); ?></p>
                    <p class="listing-data-sub">Internet Price</p>
                    <p class="listing-data-link marginan"><a href="listing_detail.php?lid=<?php echo $dispListing['listing_id'];?>">View Details</a></p>
                </div>
                <div class="clear"></div>
            </section><!--end listing data -->
         <?php } ?>                    
<!-- ==================================data to be loaded from mysql=============================================-->               
            
        </div>
        <div class="clear"></div>
<?php include_once("footer.php"); ?>